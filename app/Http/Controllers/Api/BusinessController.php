<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;

use Illuminate\Support\Facades\Validator;
class BusinessController extends Controller
{
    public function getBusiness(){
        $business = auth()->user()->businessProfile->all();
        return response()->json(['message' => 'Business profile retrived successfully', 'business' => $business], 201);

    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'org_name' => 'required|string',
            'logo' => 'nullable|string',
            'photo' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string',
            'services' => 'nullable|string',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'about' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $businessProfile = new BusinessProfile();
        $businessProfile->user_id = auth()->id();
        $businessProfile->fill($request->only([
            'org_name',
            'address',
            'city',
            'email',
            'phone',
            'services',
            'website',
            'facebook',
            'instagram',
            'linkedin',
            'about',
        ]));
          // Update photo if provided
          if ($request->file('photo')) {
            $businessProfile->updatePhoto($request->file('photo'));
            $businessProfile->photo = $businessProfile->getImage();
        }  // Update logo if provided
        if ($request->file('logo')) {
            $businessProfile->updateLogo($request->file('logo'));
            $businessProfile->logo = $businessProfile->getLogo();
        }
        $businessProfile->save();
        return response()->json(["business"  => $businessProfile], 201);
    }
    public function destroy($id)
    {
        // Find business profile
        $businessProfile = BusinessProfile::findOrFail($id);

        // Check if the authenticated user owns the business profile
        if ($businessProfile->user_id != auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete business profile
        $businessProfile->delete();

        return response()->json(['message' => 'Business profile deleted successfully']);
    }

     // Update an existing business profile
     public function update(Request $request, $id)
     {
         // Find business profile
         $businessProfile = BusinessProfile::findOrFail($id);

         // Check if the authenticated user owns the business profile
         if ($businessProfile->user_id != auth()->id()) {
             return response()->json(['error' => 'Unauthorized'], 403);
         }

         // Validation
         $validator = Validator::make($request->all(), [
             'org_name' => 'nullable|string',
             'logo' => 'nullable|string',
             'photo' => 'nullable|string',
             'address' => 'nullable|string',
             'city' => 'nullable|string',
             'email' => 'nullable|email|string',
             'phone' => 'nullable|string',
             'services' => 'nullable|string',
             'website' => 'nullable|string',
             'facebook' => 'nullable|string',
             'instagram' => 'nullable|string',
             'linkedin' => 'nullable|string',
             'about' => 'nullable|string',
         ]);

         // Check validation
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 422);
         }

         // Update business profile
         $businessProfile->fill($request->only([
             'org_name',
             'address',
             'city',
             'email',
             'phone',
             'services',
             'website',
             'facebook',
             'instagram',
             'linkedin',
             'about',
         ]));

         // Update photo if provided
         if ($request->file('photo')) {
             $businessProfile->updatePhoto($request->file('photo'));
             $businessProfile->photo = $businessProfile->getImage();
         }

         // Update logo if provided
         if ($request->file('logo')) {
             $businessProfile->updateLogo($request->file('logo'));
             $businessProfile->logo = $businessProfile->getLogo();
         }

         // Save business profile
         $businessProfile->save();

         return response()->json(['business_profile' => $businessProfile]);
     }
     public function toggleStatus($id)
     {
         // Find the business profile
         $businessProfile = BusinessProfile::findOrFail($id);

         // Check if the authenticated user owns the business profile
         if ($businessProfile->user_id != auth()->id()) {
             return response()->json(['error' => 'Unauthorized'], 403);
         }

         // Toggle the status
         $businessProfile->status = !$businessProfile->status;
         $businessProfile->save();

         // Return response
         return response()->json(['message' => 'Business profile status toggled successfully', 'business_profile' => $businessProfile]);
     }



     public function updateCategories(Request $request, $profile_id)
     {
         // Validate the request input
         $validator = Validator::make($request->all(), [
             'selectedCategories' => 'required|array',
             'selectedCategories.*' => 'exists:categories,id',
         ]);

         // Check if validation fails
         if ($validator->fails()) {
             return response()->json(['error' => $validator->errors()], 422);
         }

         // Find the business profile
         $businessProfile = BusinessProfile::findOrFail($profile_id);

         // Check if the authenticated user owns the business profile
         if ($businessProfile->user_id != auth()->id()) {
             return response()->json(['error' => 'Unauthorized'], 403);
         }

         // Sync categories with the business profile
         $businessProfile->categories()->sync($request->input('selectedCategories'));

         return response()->json(['message' => 'Categories updated successfully']);
     }

}
