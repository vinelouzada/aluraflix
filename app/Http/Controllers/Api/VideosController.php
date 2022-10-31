<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideosRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index(Request $request)
    {

        if (!$request->query('search')) {
            return Video::all();
        }

        return $this->searchParameterUrl($request->query('search'));

    }

    private function searchParameterUrl($wordToSearch)
    {

       $resultOfSearch = Video::query()->where("titulo","LIKE", "%$wordToSearch%")->get();


       return $resultOfSearch;
    }


    public function store(VideosRequest $request)
    {
        return response(Video::create($request->all()), 200);
    }

    public function show(Request $request)
    {
        return Video::findOrFail($request->video);
    }

    public function update(Video $video, VideosRequest $request)
    {
       $video->fill($request->all())->save();
        /*
        Video::findOrFail($request->id)->update($request->all());
        return Video::findOrFail($request->id);*/
    }

    public function destroy(Video $video, Request $request)
    {
        $video->deleteOrFail();
        return response()->noContent();
    }
}
