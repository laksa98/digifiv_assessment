<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
Use App\Http\Requests\Api\CategoryRequest;
use OpenApi\Annotations as OA;

     /**
     * @OA\Info(
     *     title="API",
     *     version="1.0.0",
     *     description="Api for all the function",
     *
     *     @OA\License(
     *         name="Apache 2.0",
     *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *     )
     * )
    */
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     operationId="getCategoriesList",
     *     tags={"Categories"},
     *     summary="Get all categories",
     *     description="Returns a list of all categories.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1"),
     *                 @OA\Property(property="name", type="string", example="New Category"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-28 12:00:00"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-28 12:00:00")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @OA\Post(
     *     path="/api/categories",
     *     operationId="createCategory",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     description="Creates a new category in the database.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Category object to be created",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="New Category"),
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="interger", example="1"),
     *             @OA\Property(property="name", type="string", example="New Category"),
     *             @OA\Property(property="created_at", type="datetime", example="2024-06-28 12:00:00"),
     *             @OA\Property(property="updated_at", type="datetime", example="2024-06-28 12:00:00"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     operationId="getCategory",
     *     tags={"Categories"},
     *     summary="Retrieve a category by ID",
     *     description="Returns a single category based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of category to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Category Name"),
     *                 @OA\Property(property="created_at", type="datetime", example="2024-06-28 12:00:00"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2024-06-28 12:00:00"),
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     operationId="updateCategory",
     *     tags={"Categories"},
     *     summary="Update an existing category",
     *     description="Updates a category based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of category to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated category object",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Updated Category Name"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             properties={
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Category Name"),
     *                 @OA\Property(property="created_at", type="datetime", example="2024-06-28 12:00:00"),
     *                 @OA\Property(property="updated_at", type="datetime", example="2024-06-28 12:00:00"),
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json($category,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     operationId="deleteCategory",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     description="Deletes a category based on its ID.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of category to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Category deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Category not found"
     *     )
     * )
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category successfully deleted.'], 204);
    }
}
