<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\ChefController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RecipeCategoryController;
use App\Http\Controllers\Api\IngredientController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('recipes', RecipeController::class);
Route::post('recipes/{recipe}/ingredients', [RecipeController::class, 'saveRecipeIngredient']);
Route::get('recipes/getRecipe', [RecipeController::class, 'getRecipesByIngredient']);

Route::apiResource('chefs', ChefController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('recipeCategories', RecipeCategoryController::class);
Route::apiResource('ingredients', IngredientController::class);

