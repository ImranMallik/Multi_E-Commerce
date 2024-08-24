<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class VendorProfileController extends Controller
{
    public function index()
    {
        return view('vendor.dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
        ]);

        $user = Auth::user();
        if ($request->has('image')) {
            $request->validate([
                'image' => ['image', 'required', 'max:2048']
            ]);
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = 'uploads/' . $imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        // toastr()->success('Profile Updated Successfully');
        // toastr('Profile Updated Successfully', 'success');
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    // Update Password

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);
        // toastr()->success('Password Updated Successfully!');
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }
}
