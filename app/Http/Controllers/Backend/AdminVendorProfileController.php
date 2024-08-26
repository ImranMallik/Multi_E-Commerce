<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminVendor;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vendor = AdminVendor::where('user_id', Auth::user()->id)->first();
        // return view('admin.vendor-profile.index', compact('vendor'));
        if ($vendor) {
            // If the vendor data exists, return the index view with the vendor data
            return view('admin.vendor-profile.index', compact('vendor'));
        } else {
            // If the vendor data does not exist, return the create view
            return view('admin.vendor-profile.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendor-profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'banner' => ['nullable', 'image', 'max:3000'],
            'phone' => ['required', 'max:20'],
            'email' => ['email', 'required', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb-link' => ['nullable', 'url'],
            'insta-link' => ['nullable', 'url'],
            'tw-link' => ['nullable', 'url'],
            'shop_name' => ['nullable']
        ]);

        $vendor = AdminVendor::where('user_id', Auth::user()->id)->first();
        if ($vendor) {
            $bannerPath = $this->updateImage($request, 'banner', 'uploads', $vendor->banner);
            $vendor->banner = empty(!$bannerPath) ? $bannerPath : $vendor->banner;
        } else {
            $vendor = new AdminVendor();
            $vendor->user_id = Auth::user()->id;
            $bannerPath = $this->uploadImage($request, 'banner', 'uploads');
            $vendor->banner = $bannerPath;
        }
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->description = $request->description;
        $vendor->fb_link = $request->fb_link;
        $vendor->insta_link = $request->insta_link;
        $vendor->shop_name = $request->shop_name;
        $vendor->tw_link = $request->tw_link;
        $vendor->save();
        if ($vendor->wasRecentlyCreated) {
            toastr('Created Successfully!', 'success');
        } else {
            toastr('Updated Successfully!', 'success');
        }
        return redirect()->back();
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
