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

    /**
     * @OA\Get(
     *     path="/api/recipes",
     *     operationId="getRecipesList",
     *     tags={"Recipes"},
     *     summary="Get all recipes",
     *     description="Returns a list of all recipes.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                  @OA\Property(property="id", type="integer", example=1),
     *                  @OA\Property(property="name", type="string", example="New Recipe"),
     *                  @OA\Property(property="chef_id", type="interger", example="1"),
     *                  @OA\Property(property="unique_code", type="string", example="UNI123"),
     *                  @OA\Property(property="popularity", type="interger", example="10"),
     *                  @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *              )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/recipes",
     *     operationId="createRecipe",
     *     tags={"Recipes"},
     *     summary="Create a new recipe",
     *     description="Creates a new recipe in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Recipe object to be created",
     *         @OA\JsonContent(
     *             required={"name", "chef_id", "unqiue_code"},
     *             @OA\Property(property="name", type="string", example="New recipe"),
     *             @OA\Property(property="chef_id", type="interger", example="1"),
     *             @OA\Property(property="unique_code", type="string", example="UNI234"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recipe created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="New Recipe"),
     *             @OA\Property(property="chef_id", type="interger", example="1"),
     *             @OA\Property(property="unique_code", type="string", example="UNI123"),
     *             @OA\Property(property="popularity", type="interger", example="10"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(RecipeRequest $request)
    {
        $recipe = Recipe::create($request->all());
        return response()->json($recipe, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/recipes/{recipe}",
     *     operationId="getRecipeById",
     *     tags={"Recipes"},
     *     summary="Retrieve a recipe by ID",
     *     description="Returns a single recipe based on its ID.",
     *     @OA\Parameter(
     *         name="recipe",
     *         in="path",
     *         required=true,
     *         description="ID of recipe to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recipe retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="New Recipe"),
     *             @OA\Property(property="chef_id", type="interger", example="1"),
     *             @OA\Property(property="unique_code", type="string", example="UNI123"),
     *             @OA\Property(property="popularity", type="interger", example="10"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recipe not found"
     *     )
     * )
     */
    public function show(Recipe $recipe)
    {
        
        return response()->json($recipe, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/recipes/{recipe}",
     *     operationId="updateRecipe",
     *     tags={"Recipes"},
     *     summary="Update an existing recipe",
     *     description="Updates a recipe based on its ID.",
     *     @OA\Parameter(
     *         name="recipe",
     *         in="path",
     *         required=true,
     *         description="ID of recipe to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Recipe object to be created",
     *         @OA\JsonContent(
     *             required={"name", "chef_id", "unqiue_code"},
     *             @OA\Property(property="name", type="string", example="Updated recipe"),
     *             @OA\Property(property="chef_id", type="interger", example="1"),
     *             @OA\Property(property="unique_code", type="string", example="UNI234"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Recipe created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Updated] Recipe"),
     *             @OA\Property(property="chef_id", type="interger", example="1"),
     *             @OA\Property(property="unique_code", type="string", example="UNI123"),
     *             @OA\Property(property="popularity", type="interger", example="10"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recipe not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->all());

        return response()->json($recipe, 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/recipes/{recipe}",
     *     operationId="deleteRecipe",
     *     tags={"Recipes"},
     *     summary="Delete a recipe",
     *     description="Deletes a recipe based on its ID.",
     *     @OA\Parameter(
     *         name="recipe",
     *         in="path",
     *         required=true,
     *         description="ID of recipe to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Recipe successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Recipe not found"
     *     )
     * )
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json(['message' => 'Recipe successfully deleted.'], 204);
    }

    /**
     * @OA\Post(
     *     path="/api/recipes/{recipe}/save-ingredients",
     *     operationId="saveRecipeIngredients",
     *     tags={"Recipes"},
     *     summary="Save ingredients for a recipe",
     *     description="Associates ingredients with a recipe based on recipe ID.",
     *     @OA\Parameter(
     *         name="recipe",
     *         in="path",
     *         required=true,
     *         description="ID of recipe to associate ingredients with",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="RecipeIngredient object containing ingredient IDs",
     *         @OA\JsonContent(
     *             required={"ingredient_id"},
     *             @OA\Property(property="ingredient_id", type="array", @OA\Items(type="integer", example=1), description="Array of ingredient IDs"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully saved recipe ingredients",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Successfully saved recipe ingredients.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */

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
