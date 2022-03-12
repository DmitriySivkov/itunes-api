<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $songs = Song::query()->orderBy('trackPrice', 'desc')
            ->get()->map(function (&$item) {
                $item['releaseYear'] = Carbon::parse($item['releaseDate'])->year;
                return $item;
            })->groupBy('releaseYear');

        return response()->json($songs);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $props = [
            'kind', 'collectionName', 'trackName',
            'collectionPrice', 'trackPrice', 'primaryGenreName', 'trackCount',
            'trackNumber', 'releaseDate'
        ];
        $data = collect($request->all())->map(function($item) use ($props) {
            return array_filter($item, function($prop) use ($props) {
                return in_array($prop, $props);
            }, ARRAY_FILTER_USE_KEY);
        })->toArray();

        if (!Song::query()->upsert($data, ['collectionName', 'releaseDate', 'trackName']))
            return response()->json('fail');

        $data = collect($data)->map(function ($item) {
            $item['releaseDate'] = Carbon::parse($item['releaseDate'])->format('Y-m-d H:i:s');
            $item['releaseYear'] = Carbon::parse($item['releaseDate'])->year;
            return $item;
        })->groupBy('releaseYear')->toArray();

        return response()->json($data);
    }

    public function truncate()
    {
        Song::query()->truncate();
        return response()->json('song table is empty now');
    }
}
