<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
{
    $user = Auth::user();
    $rentals = $user->rentals()->with('book')->get();

    return view('profile.show', compact('user', 'rentals'));
}

public function update(Request $request)
{
    $user = Auth::user();

    $user->update($request->except('image'));

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        if ($image->isValid() && $image->getMimeType() && $image->getSize()) {

            if ($user->image && file_exists(public_path('profile_images/' . $user->image))) {
                unlink(public_path('profile_images/' . $user->image));
            }

            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images'), $imageName);

            $user->update(['image' => $imageName]);
        }
    }

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

}
