<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaItem;

class HomeController extends Controller
{
    public function index()
    {
        $media_items = MediaItem::orderBy('created_at', 'DESC')->get();

        return view('home', compact('media_items'));
    }
}
