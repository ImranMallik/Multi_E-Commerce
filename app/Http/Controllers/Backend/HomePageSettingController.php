<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $popularCategorySection = HomePageSetting::where('key', 'popular_category_section')->first();
        $productSliderOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        return view('admin.home-page-setting.index', compact('categories', 'popularCategorySection', 'productSliderOne'));
    }


    public function storePopularData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cata_one' => ['required'],
            'cata_two' => ['required'],
            'cata_three' => ['required'],
            'cata_four' => ['required']
        ], [
            'cata_one.required' => 'Category field is required',
            'cata_two.required' => 'Category field is required',
            'cata_three.required' => 'Category field is required',
            'cata_four.required' => 'Category field is required'
        ]);
        $data = [
            [
                'category' => $request->cata_one,
                'subcategory' => $request->sub_cata_one,
                'childcategory' => $request->child_cata_one,
            ],
            [
                'category' => $request->cata_two,
                'subcategory' => $request->sub_cata_two,
                'childcategory' => $request->child_cata_two,
            ],
            [
                'category' => $request->cata_three,
                'subcategory' => $request->sub_cata_three,
                'childcategory' => $request->child_cata_three,
            ],
            [
                'category' => $request->cata_four,
                'subcategory' => $request->sub_cata_four,
                'childcategory' => $request->child_cata_four,
            ],
        ];

        // dd($data);
        HomePageSetting::updateOrCreate(
            [
                'key' => 'popular_category_section',
            ],
            [
                'value' => json_encode($data)
            ]
        );
        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->back();
    }


    public function updateProductSliderData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'cata_one' => ['required']
        ], [
            'cata_one.required' => 'Category field is required'
        ]);
        $data =
            [
                'category' => $request->cata_one,
                'subcategory' => $request->sub_cata_one,
                'childcategory' => $request->child_cata_one,
            ];
        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_one',
            ],
            [
                'value' => json_encode($data)
            ]
        );

        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->back();
    }
}
