<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.create');
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name'        => 'required|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'phone'             => 'required|string|max:255',
            'password'          => ['required', 'confirmed', Password::min(8)],
            'profile_picture'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'is_admin'          => 'required|in:0,1',
            'status'        => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $imagePath;
        }


        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create([
            'first_name'    => $validatedData['first_name'],
            'last_name'     => $validatedData['last_name'],
            'email'         => $validatedData['email'],
            'phone'         => $validatedData['phone'],
            'password'      => $validatedData['password'],
            'is_admin'      => $validatedData['is_admin'],
            'status'      => $validatedData['status'],
            'profile_picture' => $validatedData['profile_picture'] ?? null,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {


        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone'      => 'required|string|max:20',
            'password'   => 'nullable|string|min:8|confirmed',
            'is_admin'   => 'required|boolean',
            'status'     => 'required|in:active,inactive',
            'profile_picture' => 'nullable|image|max:2048',
        ]);


        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store the new profile picture
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        // Update password only if filled
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user's profile image if it exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
