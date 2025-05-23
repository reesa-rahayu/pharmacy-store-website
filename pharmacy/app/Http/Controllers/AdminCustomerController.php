<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('is_admin', false)
            ->withCount('orders')
            ->latest()
            ->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        if ($customer->is_admin) {
            abort(404);
        }

        $orders = $customer->orders()->with('items.product')->latest()->paginate(10);
        return view('admin.customers.show', compact('customer', 'orders'));
    }

    public function edit(User $customer)
    {
        if ($customer->is_admin) {
            abort(404);
        }

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        if ($customer->is_admin) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'username' => 'required|string|max:255|unique:users,username,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string'
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.show', $customer)
            ->with('success', 'Customer information updated successfully.');
    }

    public function destroy(User $customer)
    {
        if ($customer->is_admin) {
            abort(404);
        }

        if ($customer->orders()->count() > 0) {
            return redirect()->route('admin.customers.index')
                ->with('error', 'Cannot delete customer with order history.');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
