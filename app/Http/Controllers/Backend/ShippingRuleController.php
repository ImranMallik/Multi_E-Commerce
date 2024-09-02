<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippigRuleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ShippigRule;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippigRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        $shipping_rule = new ShippigRule();
        $shipping_rule->name = $request->name;
        $shipping_rule->type = $request->type;
        $shipping_rule->min_cost = $request->min_cost;
        $shipping_rule->cost = $request->cost;
        $shipping_rule->status = $request->status;
        $shipping_rule->save();
        return redirect()->route('admin.shipping-rules.index')->with('success', 'Created Successfully');
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
        $shipping = ShippigRule::findOrfail($id);
        return view('admin.shipping-rule.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);
        $shipping_rule = ShippigRule::findOrFail($id);
        $shipping_rule->name = $request->name;
        $shipping_rule->type = $request->type;
        $shipping_rule->min_cost = $request->min_cost;
        $shipping_rule->cost = $request->cost;
        $shipping_rule->status = $request->status;
        $shipping_rule->save();
        return redirect()->route('admin.shipping-rules.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete_data = ShippigRule::findOrFail($id);
        $delete_data->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $shipping_rule = ShippigRule::find($request->id);
        $shipping_rule->status = $shipping_rule->status == 1 ? 0 : 1;
        $shipping_rule->save();
        return response(['message' => 'Status has been updated!']);
    }
}
