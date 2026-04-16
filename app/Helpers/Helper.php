<?php
use App\Http\Controllers\Api\NaapBookController;
use App\Models\NaapBook;

//naap code
if (!function_exists('generateCode')) {
    function generateCode()
    {
        $last = NaapBook::latest('id')->first();
        $lastId = $last ? $last->id + 1 : 1;
        return 'R2N' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
    }
}