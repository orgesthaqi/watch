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
                    ->where('type', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();

        $media_items = MediaItem::orderBy('created_at', 'desc')
                    ->where('type', 1)
                    ->get();

        return view('home', compact('featured_media_items','media_items'));
    }

    public function movieCategory(Request $request, $slug)
    {
        if($slug && !Category::where('name', $slug)->exists()) {
            return redirect()->route('home');
        }

        $featured_media_items = MediaItem::where('featured', 1)
                    ->whereHas('categories', function($query) use ($slug) {
                        $query->where('name', $slug);
                    })
                    ->where('type', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();

        $media_items = MediaItem::whereHas('categories', function($query) use ($slug) {
            $query->where('name', $slug);
        })
        ->where('type', 1)
        ->get();

        return view('home', compact('featured_media_items','media_items'));
    }

    public function series(Request $request)
    {
        $series = MediaItem::orderBy('created_at', 'desc')
                    ->where('type', 2)
                    ->get();

        return view('series', compact('series'));
    }

    public function continueWatching(Request $request)
    {
        $media_progress = $request->user()->mediaProgress()
                    ->where('progress', '>', 0)
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('continue-watching', compact('media_progress'));
    }
}
