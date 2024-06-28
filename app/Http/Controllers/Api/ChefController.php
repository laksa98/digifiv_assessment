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
    public function index()
    {
        $chef = Chef::all();
        return response()->json($chef, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefRequest $request)
    {
        $chef = Chef::create($request->all());
        return response()->json($chef, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chef $chef)
    {
        return response()->json($chef, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefRequest $request, Chef $chef)
    {
        $chef->update($request->all());

        return response()->json($chef,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chef $chef)
    {
        $chef->delete();

        return response()->json(['message' => 'Chef successfully deleted.'], 204);
    }
}
