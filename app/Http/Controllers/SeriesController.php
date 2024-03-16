<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        return Series::all();
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        return Series::create($request->all());
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
