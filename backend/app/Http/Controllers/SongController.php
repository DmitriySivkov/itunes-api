<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $songs = Song::query()->orderBy('id', 'desc')->get();
        return response()->json($songs);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $song = Song::query()->create($request->all());
        return response()->json($song);
    }
}
