<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileExtra;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function show($user_id)
        {
            $profile = Profile::where('user_id', $user_id)->first();
            $profile->photo = $profile->getImage();

            $profileExtras = ProfileExtra::where('profile_id', $profile->id)->get()->all();
            if($profileExtras){
                foreach($profileExtras as $p)
                $p->photo = $p->getImage();
            }

            if (!$profile) {
                return response()->json(['message' => 'Profile not found'], 404);
            }

            return response()->json(['profile' => $profile,'profileExtra'=>$profileExtras], 200);
        }


        public function update(Request $request, $user_id)
    {
        if (Auth::id() != $user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'full_name' => 'nullable|string',
            'position' => 'nullable|string',
            'home_club' => 'nullable|string',
            'public_email' => 'nullable|string|email',
            'public_phone' => 'nullable|string',
            'nationality' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
        ]);

        // Update profile details
        $profile = $user->profile;
        $profile->update($validatedData);

        return response()->json(['message' => 'Profile updated successfully', 'profile' => $profile], 200);
    }


    public function uploadPhoto(Request $request, $user_id)
    {
        if (Auth::id() != $user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $input = [
        'photo'=>$request->photo,
        ];
        try {
            Validator::make($input, [
                'photo' => 'required|image|max:2048',

            ])->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $profile = Profile::where('user_id', $user_id)->first();
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $profile->updatePhoto($request->file('photo'));
        $photoUrl = $profile->getImage();

        return response()->json(['message' => 'Photo uploaded successfully', 'photo_url' => $photoUrl], 200);
    }


    public function addProfileExtra(Request $request, $profile_id)
    {
        // Check if the authenticated user's profile matches the requested profile
        if (Auth::user()->profile->id != $profile_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // Validate the request input
        $validator = Validator::make($request->all(), [
            'category' => 'nullable|string',
            'org_name' => 'nullable|string',
            'position' => 'nullable|string',
            'photo' =>  'image|max:2048',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Find the profile
        $profile = Profile::findOrFail($profile_id);

        // Create ProfileExtra entry
        $profileExtra = new ProfileExtra([
            'category' => $request->input('category'),
            'org_name' => $request->input('org_name'),
            'position' => $request->input('position'),
        ]);

        // Save the ProfileExtra
        $profile->profileExtra()->save($profileExtra);

        // Update photo if provided
        if ($request->file('photo')) {
            $profileExtra->updatePhoto($request->file('photo'));
            $profileExtra->photo = $profileExtra->getImage();
        }

        return response()->json(['message' => 'Profile Extra added successfully', 'profile_extra' => $profileExtra], 201);
    }

    public function deleteProfileExtra($extra_id)
    {
        try {
            $profileExtra = ProfileExtra::findOrFail($extra_id);

            // Check if the authenticated user's profile ID matches the profile ID associated with the ProfileExtra
            if (Auth::user()->profile->id != $profileExtra->profile_id) {
                return response()->json(['error' => 'Forbidden'], 403);
            }

            $profileExtra->delete();

            return response()->json(['message' => 'Profile Info deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json(['error' => 'Failed to delete Profile Info'], 500);
        }
    }



}
