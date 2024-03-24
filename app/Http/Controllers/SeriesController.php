<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaItem;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::orderBy('created_at', 'desc')->get();

        return view('admin.series.index', compact('series'));
    }

    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $series = Series::create($request->all());

        if($request->from_media_item_form) {
            return redirect()->route('admin.media_items.create');
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

        return redirect()->route('series.index');
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('series.index');
    }
}
