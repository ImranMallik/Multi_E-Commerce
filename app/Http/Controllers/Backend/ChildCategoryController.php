<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {

        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $subCategory = SubCategory::all();
        return view('admin.child-category.create', compact('category', 'subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name,'],
            'status' => ['required']
        ]);

        $childCategory = new ChildCategory();
        $childCategory->category_id = $request->category_id;
        $childCategory->subcategory_id = $request->sub_category_id;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.child-category.index');
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
        $category = Category::all();
        $childCategory = ChildCategory::findOrFail($id);
        $subCategory = SubCategory::where('category_id', $childCategory->category_id)->get();
        // dd($subCategory);
        return view('admin.child-category.edit', compact('category', 'childCategory', 'subCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name,' . $id],
            'status' => ['required']
        ]);

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->category_id = $request->category_id;
        $childCategory->subcategory_id = $request->subcategory;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        toastr('Update Successfully!', 'success');
        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ChildCategory::findOrFail($id);
        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    // Get SubCategories
    // public function getSubCategories(Request $request)
    // {
    //     $subCategory = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
    //     return $subCategory;
    // }

    //Get Sub Catery for AJAX--
    public function getSubCategories(Request $request)
    {
        //  return $request->all();
        $subcategory = SubCategory::where('category_id', $request->id)->where('status', 1)->get();
        return $subcategory;
    }

    // Status Change

    public function changeStatus(Request $request)
    {
        // dd($request->all());
        $category = ChildCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
