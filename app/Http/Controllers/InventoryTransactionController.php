<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InventoryTransactionController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403);
        }

        $items = InventoryItem::orderBy('item_name')->get();

        return view(
            'admin.inventory.stock-in',
            compact('items')
        );
    }

    public function storeStockIn(Request $request)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403);
        }

        $validated = $request->validate([
            'inventory_item_id' => [
                'required',
                'exists:inventory_items,id',
            ],
            'quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'date' => [
                'required',
                'date',
            ],
            'supplier' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            $item = InventoryItem::where(
                'id',
                $validated['inventory_item_id']
            )
                ->lockForUpdate()
                ->firstOrFail();

            $item->increment(
                'quantity',
                $validated['quantity']
            );

            InventoryTransaction::create([
                'inventory_item_id' => $item->id,
                'type' => 'stock-in',
                'quantity' => $validated['quantity'],
                'date' => $validated['date'],
                'supplier' => $validated['supplier'],
                'reason' => null,
            ]);
        });

        return redirect()
            ->route('admin.inventory.stock-in')
            ->with(
                'success',
                'Stock-In recorded successfully.'
            );
    }

    public function createStockOut()
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403);
        }

        $items = InventoryItem::orderBy('item_name')->get();

        return view(
            'admin.inventory.stock-out',
            compact('items')
        );
    }

    public function storeStockOut(Request $request)
    {
        $user = auth()->user();

        if (!in_array($user->role, ['admin', 'staff'])) {
            abort(403);
        }

        $validated = $request->validate([
            'inventory_item_id' => [
                'required',
                'exists:inventory_items,id',
            ],
            'quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'date' => [
                'required',
                'date',
            ],
            'reason' => [
                'required',
                Rule::in([
                    'Wash, Dry, and Fold',
                    'Self Service',
                ]),
            ],
        ]);

        $result = DB::transaction(function () use ($validated) {

            $item = InventoryItem::where(
                'id',
                $validated['inventory_item_id']
            )
                ->lockForUpdate()
                ->firstOrFail();

            $quantity = (float) $validated['quantity'];

            // Prevent stock from going below zero.
            if ($quantity > $item->quantity) {
                return [
                    'success' => false,
                    'message' => 'Insufficient stock. Available quantity: '
                        . $item->quantity . ' ' . $item->unit . '.',
                ];
            }

            $item->decrement('quantity', $quantity);

            InventoryTransaction::create([
                'inventory_item_id' => $item->id,
                'type' => 'stock-out',
                'quantity' => $quantity,
                'date' => $validated['date'],
                'supplier' => null,
                'reason' => $validated['reason'],
            ]);

            return [
                'success' => true,
                'message' => 'Stock-Out recorded successfully.',
            ];
        });

        if (!$result['success']) {
            return back()
                ->withInput()
                ->with('error', $result['message']);
        }

        return redirect()
            ->route('admin.inventory.stock-out')
            ->with('success', $result['message']);
    }
}