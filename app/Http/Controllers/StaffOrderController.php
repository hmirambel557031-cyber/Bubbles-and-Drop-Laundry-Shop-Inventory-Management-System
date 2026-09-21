<?php

namespace App\Http\Controllers;

use App\Models\LaundryOrder;
use Illuminate\Http\Request;

class StaffOrderController extends Controller
{
    public function index()
    {
        $orders = LaundryOrder::with(['customer', 'service'])
            ->where('status', '!=', 'Claimed')
            ->latest()
            ->get();

        return view('staff.orders.index', compact('orders'));
    }

    public function edit(LaundryOrder $order)
    {
        $order->load(['customer', 'service']);

        return view('staff.orders.edit', compact('order'));
    }

    public function update(Request $request, LaundryOrder $order)
    {
        $validated = $request->validate([
            'kilos' => ['required', 'numeric', 'min:0.01'],
            'status' => [
                'required',
                'in:Received,Washing,Drying,Folding,Ready for Pickup,Claimed'
            ],
        ]);

        $kilos = (float) $validated['kilos'];

        // Each load can handle up to 8.50 kg.
        $loadCount = (int) ceil($kilos / 8.50);

        $totalAmount = $loadCount * $order->service->price;

        $order->update([
            'kilos' => $kilos,
            'load_count' => $loadCount,
            'total_amount' => $totalAmount,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('staff.orders.index')
            ->with('success', 'Laundry order updated successfully.');
    }
}