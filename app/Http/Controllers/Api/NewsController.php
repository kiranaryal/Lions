<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function showNews(Request $request)
    {
        $perPage = $request->input('per_page', 1); // Number of items per page (default: 10)
        $page = $request->input('page', 1); // Current page (default: 1)

        $news = News::where('status', true)
                    ->orderBy('date', 'desc')
                    ->paginate($perPage, ['*'], 'page', $page);
        foreach($news as $n){
            $n->image = $n->getImage();

        }


        return response()->json(['news' => $news], 200);
    }
}
