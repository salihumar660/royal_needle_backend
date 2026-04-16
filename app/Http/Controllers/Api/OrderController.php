<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with('naapBook');
        if ($request->search) {
            $search = $request->search;
            $orders->whereHas('naapBook', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('naap_code', 'like', "%$search%")
                ->orWhere('original_amount', 'like', "%$search%")
                ->orWhere('paid_amount', 'like', "%$search%")
                ->orWhere('discount_amount', 'like', "%$search%")
                ->orWhere('order_date', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ;
            });
        }
        $orders = $orders->get();
        return response()->json(['data' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
         $imagePaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                $imagePaths[] = $image->store('orders', 'public');
            }
        }
        $data = $request->validated();
        $data['attachments'] = $imagePaths ?? [];
        $order = Order::create($data);
        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(OrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        $existing = $order->attachments ?? [];
        $deleted = $request->input('deleted_attachments', []);
        foreach ($deleted as $file) {
            if (Storage::disk('public')->exists($file)) {
                Storage::disk('public')->delete($file);
            }
            $existing = array_values(array_filter($existing, function ($item) use ($file) {
                return $item !== $file;
            }));
        }
        // new uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $existing[] = $file->store('orders', 'public');
            }
        }
        $data = $request->validated();
        $data['attachments'] = $existing;
        $order->update($data);
        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully'
        ], 200);
    }
}
