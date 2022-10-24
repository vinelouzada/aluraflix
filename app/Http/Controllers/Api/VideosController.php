<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        return Video::all();
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'titulo' => ['required', 'min:4']
            ],
            [
                'descricao' => ['required', 'min:4']
            ],
            [
                'url' => ['required', 'min:5']
            ]
        );

        return response(Video::create($request->all())->json, 201);
    }

    public function show(Request $request)
    {
        return Video::findOrFail($request->video);
    }

    public function update(Video $video, Request $request)
    {
       $video->fill($request->all())->save();
        /*
        Video::findOrFail($request->id)->update($request->all());
        return Video::findOrFail($request->id);*/
    }

    public function destroy(Request $request)
    {
        $video = Video::findOrFail($request->video);
        Video::destroy($video);
        return response()->noContent();
    }
}
