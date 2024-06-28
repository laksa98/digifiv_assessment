<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;
Use App\Http\Requests\Api\IngredientRequest;



class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/ingredients",
     *     operationId="getIngredientsList",
     *     tags={"Ingredients"},
     *     summary="Get all ingredients",
     *     description="Returns a list of all ingredients.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="new ingredient"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/ingredients",
     *     operationId="createIngredient",
     *     tags={"Ingredients"},
     *     summary="Create a new ingredient",
     *     description="Creates a new ingredient in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Ingredient object to be created",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="New Ingredient"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ingredient created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="New Ingredient"),
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
    public function store(IngredientRequest $request)
    {
        $ingredient = Ingredient::create($request->all());
        return response()->json($ingredient, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/ingredients/{id}",
     *     operationId="getIngredient",
     *     tags={"Ingredients"},
     *     summary="Retrieve a specific ingredient",
     *     description="Returns a single ingredient based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the ingredient to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ingredient retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="New Ingredient"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ingredient not found"
     *     )
     * )
     */
    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/ingredients/{id}",
     *     operationId="updateIngredient",
     *     tags={"Ingredients"},
     *     summary="Update an existing ingredient",
     *     description="Updates an ingredient based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the ingredient to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Ingredient object to be updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Updated Ingredient"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ingredient updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ingredient not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        $ingredient->update($request->all());

        return response()->json($ingredient, 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    /**
     * @OA\Delete(
     *     path="/api/ingredients/{id}",
     *     operationId="deleteIngredient",
     *     tags={"Ingredients"},
     *     summary="Delete an existing ingredient",
     *     description="Deletes an ingredient based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the ingredient to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Ingredient successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ingredient not found"
     *     )
     * )
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json(['message' => 'Ingredient successfully deleted.'], 204);
    }
}
