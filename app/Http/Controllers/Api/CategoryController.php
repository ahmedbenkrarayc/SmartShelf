<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
