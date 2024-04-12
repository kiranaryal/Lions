<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function showNews(Request $request)
    {
        $news = News::where('status', true)
                    ->orderBy('date', 'desc')
                    ->get(); // Retrieve all news without pagination

        foreach ($news as $n) {
            $n->image = $n->getImage();
        }

        return response()->json(['news' => $news], 200);
    }
}
