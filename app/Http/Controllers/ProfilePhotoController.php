<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfilePhotoController extends Controller
{
    public function updateUser(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated =$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {$file = $request->file('profile_photo');$mime = $file->getMimeType() ?: 'image/jpeg';$base64 = base64_encode(file_get_contents($file->getRealPath()));$validated['profile_photo'] = "data:{$mime};base64,{$base64}";
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {$user->email_verified_at = null;
        }

        $user->save();

        return back()->with('success', 'Profile updated.');
    }

    public function updateAdmin(Request $request): RedirectResponse
    {
        return $this->updateUser($request);
    }
}