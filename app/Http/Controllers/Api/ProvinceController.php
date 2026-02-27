<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by', 'asc');
        $provinces = Province::when($search, function ($query, $search){
            return $query->where('name', 'like', "%$search%");
        })
        ->orderBy('name', $sortBy)
        ->get();
        return response()->json($provinces);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    } 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        ['name' => 'Required']
        );
        $province = Province::create($request->only('name', 'latitude', 'longitude'));
        return response()->json($province, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $province = Province::findOrFail($id);
        return response()->json($province);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $province = Province::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        ['name' => 'Required']
        );
        $province->update($request->only('name', 'latitude', 'longitude'));
        return response()->json($province);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $province = Province::findOrFail($id);
        $province->delete();
        return response()->json(null, 204);
    }
}
