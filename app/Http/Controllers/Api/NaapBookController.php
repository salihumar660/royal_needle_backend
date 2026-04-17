<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NaapBook;
use App\Http\Requests\NaapBookRequest;
use App\Helpers\Helper;

class NaapBookController extends Controller
{
    public function index(Request $request)
    {
       $naapBooks = NaapBook::with('province', 'district', 'tehsil');
       if($request->search) {
        $search = $request->search;
            $naapBooks->where(function ($q) use ($search){
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('naap_code', 'like', '%'.$search.'%')
                ->orWhereHas('province', function ($q1) use ($search) {
                    $q1->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('district', function ($q2) use ($search) {
                    $q2->where('name', 'like', '%'.$search.'%');
                })
                ->orWhereHas('tehsil', function ($q3) use ($search) {
                    $q3->where('name', 'like', '%'.$search.'%');
                });
            });
       }
       $naapBooks = $naapBooks->get();
        return response()->json(['data' => $naapBooks]);
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

