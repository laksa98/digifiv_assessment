<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
Use App\Http\Requests\Api\RecipeRequest;
Use App\Http\Requests\Api\RecipeIngredientRequest;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipeRequest $request)
    {
        $recipe = Recipe::create($request->all());
        return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        
        return response()->json($recipe, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->all());

        return response()->json($recipe, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json(['message' => 'Recipe successfully deleted.'], 204);
    }

    public function saveRecipeIngredient(RecipeIngredientRequest $request, Recipe $recipe)
    {
        $ingredients = $request->ingredient_id;
        foreach($ingredients as $ingredient){
            RecipeIngredient::create([
                'recipe_id' => $recipe->id,
                'ingredient_id' => $ingredient,
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Successfully saved recipe ingredients.', $recipe], 201);
    }

    public function getRecipesByIngredient(Request $request)
    {
        $recipes = Recipe::whereHas('recipeIngredients.ingredients', function($query) use ($request) {
            $query->where('name', $request->ingredient_name);
        })
        ->whereDoesntHave('category')->get();

        return response()->json($recipes);
    }
}
