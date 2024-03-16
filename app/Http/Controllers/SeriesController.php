<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaItem;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        $series = MediaItem::orderBy('created_at', 'desc')
                    ->where('type', 2)
                    ->get();

        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $series = Series::create($request->all());

        if($request->from_media_item_form) {
            return redirect()->route('media_items.create');
        }

        return redirect()->route('series.index');
    }

    public function show(Series $series)
    {
        return $series;
    }

    public function update(Request $request, Series $series)
    {
        $series->update($request->all());
        return $series;
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
