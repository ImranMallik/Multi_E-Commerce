<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TransactionOrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(TransactionOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.transaction.index');
    }
}
