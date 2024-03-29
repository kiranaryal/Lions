<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BusinessProfile;
use App\Models\Profile;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Get search criteria from the request
        $searchTerm = $request->input('searchQuery');
        $categoryId = $request->input('selectedCategoryId');

        // Initialize search results array
        $searchResults = [];

        // Search in Business Profiles
        $businessProfiles = BusinessProfile::where('status', true)
            ->when($categoryId, function ($query) use ($categoryId) {
                return $query->whereHas('categories', function ($subQuery) use ($categoryId) {
                    $subQuery->where('category_id', $categoryId);
                });
            })
            ->where(function ($query) use ($searchTerm) {
                $query->where('org_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('city', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            })
            ->limit(10)
            ->get();

        // Search in Profiles
        $profiles = Profile::where(function ($query) use ($searchTerm) {
                $query->where('full_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('home_club', 'like', '%' . $searchTerm . '%')
                    ->orWhere('public_email', 'like', '%' . $searchTerm . '%')
                    ->orWhere('public_phone', 'like', '%' . $searchTerm . '%');
            })
            ->limit(10)
            ->get();

            foreach($businessProfiles as $b){
                $b->logo = $b->getLogo();
                $b->photo = $b->getPhoto();
            }
            foreach($profiles as $p){
                $p->photo = $p->getImage();
            }
        $searchResults['business'] = $businessProfiles;

        $searchResults['profile'] = $profiles;

        return response()->json(['search_results' => $searchResults]);
    }
}
