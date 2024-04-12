<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function update(Request $request, $userId, UpdateUserProfileInformation $updater): JsonResponse
    {
        $user = User::find($userId);

        // Check if user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the authenticated user is the same as the requested user
        if ($user->id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validate request data
        $input = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'max:255', 'unique:users,phone,' . $user->id],
            'lion_id' => ['required', 'max:255', 'unique:users,lion_id,' . $user->id],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        try {
            $updater->update($user, $input);
            return response()->json(['message' => 'Profile information updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update profile information'], 500);
        }
    }

    public function getUserProfile($userId): JsonResponse
    {
        $user = User::find($userId);

        // Check if user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the authenticated user is the same as the requested user
        if ($user->id != Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Return user profile
        return response()->json(['user' => $user]);
    }
}