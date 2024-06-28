<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecipeCategory;
Use App\Http\Requests\Api\RecipeCategoryRequest;



class RecipeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipeCategories = RecipeCategory::with(['recipe', 'category'])->get();

        $data = [];
        foreach($recipeCategories as $recipeCategory){
            $data[] = [
                'Recipe' => $recipeCategory->recipe->name,
                'Category' => $recipeCategory->category->name,
            ];
        }

        return response()->json(($data));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeCategoryRequest $request)
    {
        $recipes = $request->recipe_id;
        foreach($recipes as $recipe){
            RecipeCategory::create([
                'recipe_id' => $recipe,
                'category_id' => $request->category_id,
            ]);
        }
        return response()->json(['success', 'message' => 'Successfully categorise recipe.'], 201);
    }
}
