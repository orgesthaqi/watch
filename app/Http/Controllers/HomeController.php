<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\MediaItem;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featured_media_items = MediaItem::where('featured', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();

        $media_items = MediaItem::orderBy('created_at', 'desc')
                    ->get();

        return view('home', compact('featured_media_items','media_items'));
    }

    public function category(Request $request, $slug)
    {
        $featured_media_items = MediaItem::where('featured', 1)
                    ->whereHas('categories', function($query) use ($slug) {
                        $query->where('name', $slug);
                    })
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();

        $media_items = MediaItem::whereHas('categories', function($query) use ($slug) {
            $query->where('name', $slug);
        })->get();

        return view('home', compact('featured_media_items','media_items'));
    }
}
