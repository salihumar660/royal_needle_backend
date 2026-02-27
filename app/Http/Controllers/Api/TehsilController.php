<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tehsil;
use App\Models\District;

class TehsilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $province = $request->query('province_id');
        $province = $province ? (int)$province : null;
        $district = $request->query('district_id');
        $district = $district ? (int)$district : null;
        $search = $request->query('search');
        $sortBy = $request->query('sort', 'asc');
        $tehsils = Tehsil::when($province, function ($query, $province) {
            return $query->where('province_id', $province);
        })
        ->when($district, function ($query, $district) {
            return $query->where('district_id', $district);
        })
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%$search%");
        })
        ->with('district', 'province')
        ->orderBy('name', $sortBy)
        ->get();
        return response()->json($tehsils);
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
            'district_id' => 'required|exists:district,id',
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        [
            'province_id' => 'Required',
            'district_id' => 'Required',
            'name' => 'Required',
        ]
        );
        $tehsil = Tehsil::create($request->only('province_id', 'district_id', 'name', 'latitude', 'longitude'));
        return response()->json($tehsil, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tehsil = Tehsil::findOrFail($id);
        return response()->json($tehsil);
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
            'district_id' => 'required|exists:district,id',
            'name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ],
        [
            'province_id' => 'Required',
            'district_id' => 'Required',
            'name' => 'Required',
        ]
        );
        $tehsil = Tehsil::findOrFail($id);
        $tehsil->update($request->only('province_id', 'district_id', 'name', 'latitude', 'longitude'));
        return response()->json($tehsil);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tehsil = Tehsil::findOrFail($id);
        $tehsil->delete();
        return response()->json(null, 204);
    }
    public function getDistricts(Request $request, $provinceId)
    {
        $districts = District::where('province_id', $provinceId)->get();
        return response()->json($districts);
    }
    public function getTehsils(Request $request, $districtId)
    {
        $tehsils = Tehsil::where('district_id', $districtId)->get();
        return response()->json($tehsils);
    }
}
