<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\OrderReportMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        return view('orders.checkout', [
            'cart' => $cart,
            'user' => Auth::user()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|in:debit_credit_card, cod',
            'payment_type' => 'required|in:pre_paid, post_paid'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        $order = Auth::user()->orders()->create([
            'total_amount' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method
        ]);

        foreach ($cart as $id => $details) {
            $order->items()->create([
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }
        $order->load(['items.product', 'user']);

        Mail::to($order->user->email)->send(new OrderReportMail($order));

        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }

    public function emailReport(Order $order)
    {
        $order->load(['items.product', 'user']);

        Mail::to($order->user->email)->send(new OrderReportMail($order));

        return redirect()->route('orders.show', $order)->with('success', 'Laporan telah dikirim ke email.');
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('orders.show', compact('order'));
    }

    public function report(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('orders.report', compact('order'));
    }

    public function download(Order $order)
    {
        $order->load(['user', 'items.product']);

        $pdf = Pdf::loadView('orders.report', compact('order'))->setPaper('A4', 'portrait');

        return $pdf->download('Laporan-Pesanan-' . $order->id . '.pdf');
    }

    public function cancel(Order $order)
    {
        // Only allow cancellation if the order has not been shipped
        if ($order->status === 'shipped') {
            return redirect()->back()->with('error', 'This order has already been shipped and cannot be canceled.');
        }

        $order->update(['status' => 'canceled']);

        return redirect()->route('orders.index', $order)->with('success', 'Order has been canceled successfully.');
    }

    public function adminIndex()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function ship(Order $order)
    {
        $order->update(['status' => 'shipped']);
        return redirect()->back()->with('success', 'Order marked as shipped!');
    }
}
