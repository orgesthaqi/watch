<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaItem;

class HomeController extends Controller
{
    public function index()
    {
        $featured_media_items = MediaItem::where('featured', 1)
                    ->orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();

        $media_items = MediaItem::orderBy('created_at', 'desc')
                    ->get();

        return view('home', compact('featured_media_items','media_items'));
    }
}
