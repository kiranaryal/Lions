<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessProfileController extends Controller
{
    public function business_profile()
    {
        return view('pages.BusinessProfile');
    }

    public function business_show()
    {
        return view('pages.BusinessShow');
    }
}
