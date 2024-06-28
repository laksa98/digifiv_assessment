<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chef;
Use App\Http\Requests\Api\ChefRequest;



class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * @OA\Get(
     *     path="/api/chefs",
     *     operationId="getChefsList",
     *     tags={"Chefs"},
     *     summary="Get all chefs",
     *     description="Returns a list of all chefs.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="John Doe"),
     *                 @OA\Property(property="signature_dish", type="string", example="Spaghetti"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $chef = Chef::all();
        return response()->json($chef, 200);
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * @OA\Post(
     *     path="/api/chefs",
     *     operationId="createChef",
     *     tags={"Chefs"},
     *     summary="Create a new chef",
     *     description="Creates a new chef in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Chef object to be created",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Chef created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(ChefRequest $request)
    {
        $chef = Chef::create($request->all());
        return response()->json($chef, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/chefs/{id}",
     *     operationId="getChefById",
     *     tags={"Chefs"},
     *     summary="Retrieve a chef by ID",
     *     description="Returns a single chef based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the chef to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Chef retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chef not found"
     *     )
     * )
     */
    public function show(Chef $chef)
    {
        return response()->json($chef, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * @OA\Put(
     *     path="/api/chefs/{id}",
     *     operationId="updateChef",
     *     tags={"Chefs"},
     *     summary="Update an existing chef",
     *     description="Updates a chef based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the chef to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Chef object data to be updated",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Updated John Doe"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Chef updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Updated John Doe"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chef not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(ChefRequest $request, Chef $chef)
    {
        $chef->update($request->all());

        return response()->json($chef,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/chefs/{id}",
     *     operationId="deleteChef",
     *     tags={"Chefs"},
     *     summary="Delete a chef",
     *     description="Deletes a chef based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the chef to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Chef successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Chef not found"
     *     )
     * )
     */
    public function destroy(Chef $chef)
    {
        $chef->delete();

        return response()->json(['message' => 'Chef successfully deleted.'], 204);
    }
}
