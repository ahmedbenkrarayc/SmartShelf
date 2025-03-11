<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

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


    public function show(int $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'message' => 'Category not found !'
            ], 404);
        }

        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request, int $id)
    {
        $validated = $request->validated();
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'message' => 'Category not found !'
            ], 404);
        }

        $category->update($validated);
        return new CategoryResource($category);
    }


    public function destroy(int $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'message' => 'Category not found !'
            ], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 204);
    }
}
