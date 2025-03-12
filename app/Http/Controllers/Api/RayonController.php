<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rayon;
use App\Http\Resources\RayonResource;
use App\Http\Requests\StoreRayonRequest;
use App\Http\Requests\UpdateRayonRequest;

class RayonController extends Controller
{
    public function index()
    {
        $rayons = Rayon::all();
        return RayonResource::collection($rayons);
    }


    public function store(StoreRayonRequest $request)
    {
        $request->validated();

        $rayon = Rayon::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return (new RayonResource($rayon))->response()->setStatus(201);
    }


    public function show(int $id)
    {
        $rayon = Rayon::find($id);
        if(!$rayon){
            return response()->json([
                'message' => 'Rayon not found !'
            ], 404);
        }

        return new RayonResource($rayon);
    }


    public function update(UpdateRayonRequest $request, int $id)
    {
        $validated = $request->validated();
        $rayon = Rayon::find($id);
        if(!$rayon){
            return response()->json([
                'message' => 'Rayon not found !'
            ], 404);
        }

        $rayon->update($validated);
        return new RayonResource($rayon);
    }


    public function destroy(int $id)
    {
        $rayon = Rayon::find($id);
        if(!$rayon){
            return response()->json([
                'message' => 'Rayon not found !'
            ], 404);
        }

        $rayon->delete();
        return response()->json([], 204);
    }
}
