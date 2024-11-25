<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\DeliveryOrderDataTable;
use App\DataTables\DroppedOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\OutOfDeliveryDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\DataTables\ShippedOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        // return view('admin.order.index');
        return $dataTable->render('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderId = Order::findOrFail($id);
        $orderId->transaction()->delete();
        $orderId->orderproducts()->delete();
        $orderId->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $order = Order::find($request->id);
        $order->order_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Updated Order Status']);
    }

    public function paymentChangeStatus(Request $request)
    {
        // dd($request->all());
        $order = Order::find($request->id);
        $order->payment_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Updated Payment Status']);
    }


    public function pendingOrder(PendingOrderDataTable $dataTable)
    {

        return $dataTable->render('admin.order.pending-order');
    }

    public function processedOrder(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed-order');
    }

    public function droppedOrder(DroppedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped-order');
    }

    public function shippedOrder(ShippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped-order');
    }

    public function outOfdeliveryOrder(OutOfDeliveryDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out-of-delivery');
    }

    public function deliveredOrder(DeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered');
    }

    public function cancelOrder(CanceledOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.cancel-order');
    }
}
