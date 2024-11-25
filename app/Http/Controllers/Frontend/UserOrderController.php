<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function showOrder($id)
    {
        $order = Order::with(['transaction'])->findOrFail($id);
        return view('Frontend.dashboard.order.show', compact('order'));
    }
}
