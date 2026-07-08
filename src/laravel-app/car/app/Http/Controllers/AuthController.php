<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = $this->findUserByLogin($credentials['login']);

        if (!$user || !$this->passwordMatches($credentials['password'], $user->password)) {
            return back()->withErrors(['login' => 'Thông tin đăng nhập không đúng.'])->onlyInput('login');
        }

        if ((int) $user->active !== 1) {
            return back()->withErrors(['login' => 'Tài khoản đã bị khóa.'])->onlyInput('login');
        }

        Auth::guard('web')->login($user, $request->boolean('remember'));
        $request->session()->regenerate();
        $this->mergeSessionCart($user);

        if ($redirect = $this->safeRedirect($request->input('redirect'))) {
            return redirect()->to($redirect);
        }

        return redirect()->intended(route('home'));
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = $this->findUserByLogin($credentials['login']);

        if (!$user || !$this->passwordMatches($credentials['password'], $user->password)) {
            return back()->withErrors(['login' => 'Thong tin dang nhap khong dung.'])->onlyInput('login');
        }

        if ((int) $user->active !== 1) {
            return back()->withErrors(['login' => 'Tai khoan da bi khoa.'])->onlyInput('login');
        }

        if ((int) $user->role !== 1) {
            Auth::guard('admin')->logout();

            return back()->withErrors(['login' => 'Tai khoan nay khong co quyen truy cap admin.'])->onlyInput('login');
        }

        Auth::guard('admin')->login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        if ($redirect = $this->safeAdminRedirect($request->input('redirect'))) {
            return redirect()->to($redirect);
        }

        return redirect()->route('admin.dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'regex:/^(03|05|07|08|09)\d{8}$/', 'unique:users,phone'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
        ]);

        $data['name'] = $data['full_name'];
        $data['image'] = 'user-default.png';
        $data['role'] = 0;
        $data['active'] = 1;
        $data['password'] = Hash::make($data['password']);
        $data['user_id'] = ((int) User::max('user_id')) + 1;

        $user = User::create($data);
        Auth::guard('web')->login($user);
        $request->session()->regenerate();
        $this->mergeSessionCart($user);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
        ]);

        User::where('email', $data['email'])->update(['password' => Hash::make($data['password'])]);

        return redirect()->route('login')->with('success', 'Đã cập nhật mật khẩu mới.');
    }

    private function mergeSessionCart(User $user): void
    {
        $sessionCart = session('cart', []);
        if (empty($sessionCart)) {
            return;
        }

        foreach ($sessionCart as $item) {
            $cart = Cart::firstOrNew([
                'user_id' => $user->user_id,
                'product_id' => $item['product_id'],
            ]);
            $cart->product_name = $item['name'];
            $cart->product_price = $item['price'];
            $cart->product_image = $item['image'];
            $cart->product_quantity = ((int) $cart->product_quantity) + (int) $item['quantity'];
            $cart->save();
        }

        session()->forget('cart');
    }

    private function findUserByLogin(string $login): ?User
    {
        return User::where('email', $login)
            ->orWhere('username', $login)
            ->orWhere('phone', $login)
            ->first();
    }

    private function passwordMatches(string $input, string $stored): bool
    {
        if (password_get_info($stored)['algo'] !== 0 && password_verify($input, $stored)) {
            return true;
        }

        try {
            if (Hash::check($input, $stored)) {
                return true;
            }
        } catch (\RuntimeException $exception) {
            // Legacy imports can contain plain text or md5 passwords.
        }

        return hash_equals($stored, $input) || hash_equals($stored, md5($input));
    }

    private function safeRedirect(?string $redirect): ?string
    {
        if (!$redirect) {
            return null;
        }

        if (str_starts_with($redirect, url('/'))) {
            return $redirect;
        }

        if (str_starts_with($redirect, '/') && !str_starts_with($redirect, '//')) {
            return $redirect;
        }

        return null;
    }

    private function safeAdminRedirect(?string $redirect): ?string
    {
        $redirect = $this->safeRedirect($redirect);

        if (!$redirect) {
            return null;
        }

        $path = parse_url($redirect, PHP_URL_PATH) ?: '/';

        return str_starts_with($path, '/admin') ? $redirect : null;
    }
}
