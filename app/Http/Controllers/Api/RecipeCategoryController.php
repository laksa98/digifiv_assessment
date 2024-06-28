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

    /**
     * @OA\Get(
     *     path="/api/recipe-categories",
     *     operationId="getRecipeCategoriesList",
     *     tags={"Recipe Categories"},
     *     summary="Get all recipe categories",
     *     description="Returns a list of all recipe categories with associated recipes and categories.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="Recipe", type="string", example="Recipe Name"),
     *                 @OA\Property(property="Category", type="string", example="Category Name"),
     *             )
     *         )
     *     )
     * )
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

    /**
     * @OA\Post(
     *     path="/api/recipe-categories",
     *     operationId="storeRecipeCategory",
     *     tags={"Recipe Categories"},
     *     summary="Store new recipe category associations",
     *     description="Creates new associations between recipes and a category in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="RecipeCategory object containing recipe IDs and category ID",
     *         @OA\JsonContent(
     *             required={"recipe_id", "category_id"},
     *             @OA\Property(property="recipe_id", type="array", @OA\Items(type="integer", example=1), description="Array of recipe IDs"),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successfully categorize recipe(s)",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Successfully categorize recipe.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
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
