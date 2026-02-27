<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $province = $request->query('province_id');
        $province = $province ? (int)$province : null;
        $search = $request->query('search');
        $sortBy = $request->query('sort', 'asc');
        $districts = District::with('province')
        ->when($province, function ($query, $province) {
            return $query->where('province_id', $province);
        })
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })
        ->orderBy('name', $sortBy)
        ->get();
        return response()->json($districts);
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
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        [
            'province_id' => 'Required',
            'name' => 'Required',
        ]
        );
        $district = District::create($request->only('province_id', 'name', 'latitude', 'longitude'));
        return response()->json($district, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $district = District::findOrFail($id);
        return response()->json($district);
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
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        [
            'province_id' => 'Required',
            'name' => 'Required',
        ]
        );
        $district = District::findOrFail($id);
        $district->update($request->only('province_id', 'name', 'latitude', 'longitude'));
        return response()->json($district, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $district = District::findOrFail($id);
        $district->delete();
        return response()->json(null, 204);
    }
}
