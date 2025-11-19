<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ProfileController extends Controller
{
    /**
     * Get authenticated user's profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'bio' => $user->bio,
                'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                'member_since' => $user->created_at->format('F Y'),
            ]
        ], 200);
    }

    /**
     * Get user profile by username (public)
     * 
     * @param string $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'bio' => $user->bio,
                'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                'member_since' => $user->created_at->format('F Y'),
            ]
        ], 200);
    }

    /**
     * Update authenticated user's profile
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:50',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => ['nullable', File::types(['png', 'jpg', 'webp'])],
        ]);

        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->storeAs(
                'profile_images',
                uniqid() . '.' . $request->file('profile_picture')->extension(),
                'public'
            );
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'username' => $user->username,
                'email' => $user->email,
                'bio' => $user->bio,
                'profile_picture' => $user->profile_picture ? asset('storage/' . $user->profile_picture) : null,
                'created_at' => $user->created_at->format('Y-m-d H:i:s'),
                'member_since' => $user->created_at->format('F Y'),
            ]
        ], 200);
    }
}

