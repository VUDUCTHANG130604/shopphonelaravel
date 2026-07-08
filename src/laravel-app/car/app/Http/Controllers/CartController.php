<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $cart = $this->cartItems();

        return view('cart.index', compact('cart'));
    }

    public function legacyIndexPost(Request $request)
    {
        if ($request->query('url') !== 'gio-hang') {
            return redirect()->route('legacy.index', $request->query());
        }

        if ($request->has('add_to_cart')) {
            return $this->store($request);
        }

        if ($request->has('update_cart')) {
            return $this->updateMany($request);
        }

        return redirect()->route('cart.index');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thực hiện chức năng.');
        }

        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'product_quantity' => ['nullable', 'integer', 'min:1'],
            'buy_now' => ['nullable', 'string'],
        ], [
            'product_quantity.min' => 'Số lượng sản phẩm không được nhỏ hơn 1.',
        ]);

        $product = Product::where('status', 1)->findOrFail($data['product_id']);
        if ((int) $product->quantity <= 0) {
            return back()->with('error', 'Sản phẩm đã hết hàng.');
        }

        $quantity = min((int) ($data['product_quantity'] ?? 1), max((int) $product->quantity, 1));

        $cart = Cart::firstOrNew([
            'user_id' => Auth::user()->user_id,
            'product_id' => $product->product_id,
        ]);
        $cart->product_name = $product->name;
        $cart->product_price = $product->sale_price;
        $cart->product_image = $product->image;
        $cart->product_quantity = min(((int) $cart->product_quantity) + $quantity, (int) $product->quantity);
        $cart->save();

        if ($request->filled('buy_now')) {
            return redirect()->route('checkout');
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function update(Request $request, int $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        if ((int) $data['quantity'] <= 0) {
            Cart::where('user_id', Auth::user()->user_id)->where('product_id', $productId)->delete();
            return back()->with('success', 'Đã xóa sản phẩm ra khỏi giỏ hàng.');
        }

        Cart::where('user_id', Auth::user()->user_id)
            ->where('product_id', $productId)
            ->update(['product_quantity' => $data['quantity']]);

        return back()->with('success', 'Cập nhật thành công.');
    }

    public function updateMany(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'product_id' => ['required', 'array'],
            'product_id.*' => ['integer'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['integer'],
        ]);

        $removed = 0;
        foreach ($data['product_id'] as $index => $productId) {
            $quantity = (int) ($data['quantity'][$index] ?? 0);
            $query = Cart::where('user_id', Auth::user()->user_id)->where('product_id', $productId);

            if ($quantity <= 0) {
                $removed += $query->delete();
            } else {
                $query->update(['product_quantity' => $quantity]);
            }
        }

        return back()->with('success', $removed > 0 ? "Đã xóa {$removed} sản phẩm ra khỏi giỏ hàng." : 'Cập nhật thành công.');
    }

    public function destroy(int $productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        Cart::where('user_id', Auth::user()->user_id)->where('product_id', $productId)->delete();

        return back()->with('success', 'Đã xóa 1 sản phẩm.');
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $cart = $this->cartItems();
        $savedAddress = Address::where('user_id', Auth::user()->user_id)->first();
        $mode = match (true) {
            $request->routeIs('checkout.address') => 'default',
            $request->routeIs('checkout.address2') => 'saved',
            default => 'custom',
        };

        return view('checkout.index', compact('cart', 'savedAddress', 'mode'));
    }

    public function placeOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'note' => ['nullable', 'string'],
        ], $this->checkoutMessages());

        $cart = $this->cartItems();
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        $this->persistOrder($cart, $data);

        return redirect()->route('thanks');
    }

    public function momo(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $cart = $this->cartItems();
        $savedAddress = Address::where('user_id', Auth::user()->user_id)->first();
        $mode = match (true) {
            $request->routeIs('checkout.momo.address') => 'default',
            $request->routeIs('checkout.momo.address2') => 'saved',
            default => 'custom',
        };

        return view('checkout.momo', compact('cart', 'savedAddress', 'mode'));
    }

    public function placeMomoOrder(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(03|05|07|08|09)\d{8}$/'],
            'note' => ['nullable', 'string'],
        ], $this->checkoutMessages());

        $cart = $this->cartItems();
        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        $order = $this->persistOrder($cart, $data);
        $payUrl = $this->createMomoPaymentUrl($order);

        if ($payUrl) {
            return redirect()->away($payUrl);
        }

        return redirect()->route('thanks')->with('success', 'Đã tạo đơn hàng. Chưa kết nối được cổng MoMo test nên đơn đang chờ xác nhận.');
    }

    private function cartItems()
    {
        return Cart::where('user_id', Auth::user()->user_id)
            ->orderByDesc('cart_id')
            ->get()
            ->map(fn ($item) => [
                'product_id' => $item->product_id,
                'name' => $item->product_name,
                'image' => $item->product_image,
                'price' => (int) $item->product_price,
                'quantity' => (int) $item->product_quantity,
            ]);
    }

    private function persistOrder($cart, array $data): Order
    {
        return DB::transaction(function () use ($cart, $data) {
            $total = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);
            $order = Order::create([
                'user_id' => Auth::user()->user_id,
                'total' => $total,
                'address' => $data['address'],
                'phone' => $data['phone'],
                'note' => $data['note'] ?? null,
                'status' => 1,
                'date' => now(),
            ]);

            foreach ($cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                Product::where('product_id', $item['product_id'])->update([
                    'quantity' => DB::raw('GREATEST(quantity - '.(int) $item['quantity'].', 0)'),
                    'sell_quantity' => DB::raw('sell_quantity + '.(int) $item['quantity']),
                ]);
            }

            Cart::where('user_id', Auth::user()->user_id)->delete();
            session()->forget('cart');

            return $order;
        });
    }

    private function createMomoPaymentUrl(Order $order): ?string
    {
        $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
        $partnerCode = env('MOMO_PARTNER_CODE', 'MOMOBKUN20180529');
        $accessKey = env('MOMO_ACCESS_KEY', 'klm05TvNBzhg7h7j');
        $secretKey = env('MOMO_SECRET_KEY', 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');
        $redirectUrl = route('thanks');
        $ipnUrl = route('thanks');
        $requestId = (string) time();
        $orderId = (string) $order->order_id;
        $orderInfo = 'Thanh toán qua MoMo';
        $amount = (string) (int) $order->total;
        $requestType = 'payWithATM';
        $extraData = '';

        $rawHash = "accessKey={$accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$ipnUrl}&orderId={$orderId}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";
        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        try {
            $response = Http::timeout(5)->post($endpoint, [
                'partnerCode' => $partnerCode,
                'partnerName' => 'Test',
                'storeId' => 'MomoTestStore',
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature,
            ]);
        } catch (\Throwable) {
            return null;
        }

        return $response->json('payUrl');
    }

    private function checkoutMessages(): array
    {
        return [
            'address.required' => 'Địa chỉ không được để trống.',
            'address.max' => 'Địa chỉ tối đa 255 ký tự.',
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
