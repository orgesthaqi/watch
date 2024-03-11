<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMediaProgress;

class MediaProgressController extends Controller
{
    public function save(Request $request)
    {
        $userMediaProgress = UserMediaProgress::updateOrCreate(
            ['user_id' => auth()->user()->id, 'media_id' => $request->media_id],
            ['progress' => $request->progress]
        );

        return response()->json(['success' => true]);
    }
}
