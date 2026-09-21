<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showCheckForm()
    {
        return view('customer.check-laundry');
    }

    public function searchLaundry(Request $request)
    {
        $validated = $request->validate([
            'customer_code' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ]);

        $customerQuery = Customer::where(
            'customer_code',
            $validated['customer_code']
        )->where(
            'full_name',
            $validated['full_name']
        );

        // Contact number is optional.
        // If the customer provides it, use it as an additional check.
        if (!empty($validated['contact_number'])) {
            $customerQuery->where(
                'contact_number',
                $validated['contact_number']
            );
        }

        $customer = $customerQuery->first();

        if (!$customer) {
            return back()
                ->withInput()
                ->with('error', 'Customer information could not be verified.');
        }

        $order = $customer->laundryOrders()
            ->with('service')
            ->where('status', '!=', 'Claimed')
            ->latest()
            ->first();

        if (!$order) {
            return back()
                ->withInput()
                ->with('error', 'No active laundry order was found for this customer.');
        }

        return view('customer.laundry-status', compact('customer', 'order'));
    }
    public function showAvailService()
{
    $services = \App\Models\Service::whereIn('service_name', [
        'Self Service',
        'Wash, Dry, and Fold',
    ])->get();

    return view('customer.avail-service', compact('services'));
}

    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:20'],
        ]);

        // Find existing customer by name and optional contact number
        $customerQuery = \App\Models\Customer::where(
            'full_name',
            $validated['full_name']
        );

        if (!empty($validated['contact_number'])) {
            $customerQuery->where(
                'contact_number',
                $validated['contact_number']
            );
        }

        $customer = $customerQuery->first();

        // Create new customer if not found
        if (!$customer) {
            $lastCustomer = \App\Models\Customer::orderByDesc('id')->first();

            $nextCode = $lastCustomer
                ? ((int) $lastCustomer->customer_code + 1)
                : 101;

            $customer = \App\Models\Customer::create([
                'customer_code' => (string) $nextCode,
                'full_name' => $validated['full_name'],
                'contact_number' => $validated['contact_number'] ?? null,
            ]);
        }

        $service = \App\Models\Service::findOrFail(
            $validated['service_id']
        );

        $servicePrefix = $service->service_name === 'Wash, Dry, and Fold'
            ? 'WDF'
            : 'SS';

        $lastOrder = \App\Models\LaundryOrder::where(
            'service_number',
            'like',
            $servicePrefix . '-%'
        )->latest('id')->first();

        $nextNumber = $lastOrder
            ? ((int) substr($lastOrder->service_number, 4) + 1)
            : 1;

        $serviceNumber = $servicePrefix . '-' . str_pad(
            $nextNumber,
            5,
            '0',
            STR_PAD_LEFT
        );

        $order = \App\Models\LaundryOrder::create([
            'customer_id' => $customer->id,
            'service_id' => $service->id,
            'service_number' => $serviceNumber,
            'kilos' => null,
            'load_count' => 0,
            'total_amount' => 0,
            'status' => 'Received',
            'received_at' => now(),
        ]);

        return view('customer.service-confirmation', compact(
            'customer',
            'order'
        ));
    }
}