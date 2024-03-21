<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaItem;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $topMediaItems = MediaItem::orderBy('views', 'desc')->take(5)->get();
        $topMediaLater = MediaItem::orderBy('created_at', 'desc')->take(5)->get();
        $latestUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        //$latestReviews = Review::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard.index', compact('topMediaItems', 'topMediaLater', 'latestUsers'));
    }
}
