<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NaapBook;
use App\Http\Requests\NaapBookRequest;
use App\Helpers\Helper;

class NaapBookController extends Controller
{
    public function index()
    {
       $naapBooks = NaapBook::with('province', 'district', 'tehsil')->get();
        return response()->json($naapBooks);
    }
    //for live code in add form in React
    public function nextCode()
    {
        return response()->json([
            'naap_code' => generateCode()
        ]);
    }
     public function store(NaapBookRequest $request)
    {
        $data = $request->validated();
        $data['naap_code'] = generateCode();
        $naap = NaapBook::create($data);
        return response()->json([
            'message' => 'Naap created successfully',
            'naap' => $naap
        ], 201);
    }
     public function show(NaapBook $naap)
    {
        $naap->load('province', 'district', 'tehsil');
        return response()->json($naap);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NaapBookRequest $request, $id)
    {
        $naap = NaapBook::findOrFail($id);
        $data = $request->validated();
        $naap->update($data);
        return response()->json([
            'message' => 'Naap updated successfully',
            'naap' => $naap
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $naap = NaapBook::findOrFail($id);
        $naap->delete();
        return response()->json([
            'message' => 'Naap deleted successfully'
        ]);
    }
}

