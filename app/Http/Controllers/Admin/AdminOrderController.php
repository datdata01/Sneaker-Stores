<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.pages.orders.index', compact('orders'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $totalProduct = 0;
        foreach($order->orderDetails as $item) {
            $totalProduct += $item->price * $item->quantity;
        }
        return view('admin.pages.orders.show', compact('order', 'totalProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $order= Order::findOrFail($id);
            $order->status =  $request->status;
            $order->payment_status = $request->payment_status;
            $order->save(); 
            return redirect()->back()->with('status_success','Cập nhật thành công');
        }catch(\Exception $e){  
            return redirect()->back()->with('status_failed','Cập nhật không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
