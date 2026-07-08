<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function orders()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::with('details.product')
            ->where('user_id', Auth::user()->user_id)
            ->orderByDesc('order_id')
            ->paginate(10);

        return view('pages.orders', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ((int) $order->user_id !== (int) Auth::user()->user_id) {
            abort(403);
        }

        $order->load(['details.product', 'user']);

        return view('pages.order-detail', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ((int) $order->user_id !== (int) Auth::user()->user_id) {
            abort(403);
        }

        if ((int) $order->status !== 1) {
            return back()->with('error', 'Chỉ có thể hủy đơn hàng đang chờ xác nhận.');
        }

        DB::transaction(function () use ($order) {
            $order->load('details');

            foreach ($order->details as $detail) {
                Product::where('product_id', $detail->product_id)->update([
                    'quantity' => DB::raw('quantity + '.(int) $detail->quantity),
                    'sell_quantity' => DB::raw('GREATEST(sell_quantity - '.(int) $detail->quantity.', 0)'),
                ]);
            }

            $order->update(['status' => 0]);
        });

        return back()->with('success', 'Đã hủy đơn hàng thành công.');
    }

    public function account()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->user_id)->first();

        return view('account.show', compact('address'));
    }

    public function editProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('account.edit');
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
        ], [
            'full_name.required' => 'Họ tên không được để trống.',
            'full_name.max' => 'Họ tên tối đa 255 ký tự.',
            'address.required' => 'Địa chỉ không được để trống.',
            'address.max' => 'Địa chỉ tối đa 255 ký tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
            'image.image' => 'File ảnh không hợp lệ.',
            'image.mimes' => 'File ảnh chỉ được tải định dạng JPG, PNG.',
        ]);

        if ($request->hasFile('image')) {
            $filename = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('upload'), $filename);
            $data['image'] = $filename;
        }

        $data['name'] = $data['full_name'];
        Auth::user()->update($data);

        return back()->with('success', 'Cập nhật hồ sơ thành công.');
    }

    public function address()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->user_id)->first();

        return view('account.address', compact('address'));
    }

    public function storeAddress(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'address' => ['required', 'string', 'max:255'],
        ], [
            'address.required' => 'Địa chỉ không được để trống.',
            'address.max' => 'Địa chỉ tối đa 255 ký tự.',
        ]);

        Address::updateOrCreate(['user_id' => Auth::user()->user_id], $data + ['user_id' => Auth::user()->user_id]);

        return redirect()->route('account.show')->with('success', 'Đã lưu địa chỉ.');
    }

    public function removeAddress()
    {
        if (Auth::check()) {
            Address::where('user_id', Auth::user()->user_id)->delete();
        }

        return redirect()->route('account.address')->with('success', 'Đã xóa địa chỉ.');
    }

    public function changePassword()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('account.password');
    }

    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ], [
            'current_password.required' => 'Mật khẩu cũ không được để trống.',
            'password.required' => 'Mật khẩu mới không được để trống.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.confirmed' => 'Nhập lại mật khẩu không trùng khớp với mật khẩu mới.',
        ]);

        if (!Hash::check($data['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.']);
        }

        Auth::user()->update(['password' => Hash::make($data['password'])]);

        return back()->with('success', 'Thay đổi mật khẩu thành công.');
    }
}
