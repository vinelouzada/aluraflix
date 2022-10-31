<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Models\Video;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function store(CategoriaRequest $request)
    {

        return response(Categoria::create($request->all()),201);
    }

    public function show(Request $request)
    {
        return Categoria::findorFail($request->categoria);
    }

    public function update(CategoriaRequest $categoria, Request $request)
    {
        $categoria->fill($request->all())->save();

        return $categoria;
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->deleteOrFail();
        return response()->noContent();
    }

    public function search(Categoria $categoria)
    {
        return $categoria->video()->get()->all();
    }
}
