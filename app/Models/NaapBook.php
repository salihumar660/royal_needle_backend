<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaapBook extends Model
{
    protected $table = 'naap_book';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'chest',
        'neck',
        'waist',
        'hips',
        'shoulder',
        'sleeveLength',
        'wrist',
        'thigh',
        'shirt_length',
        'trouser_length',
        'province_id',
        'district_id',
        'tehsil_id',
        'notes'
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function tehsil()
    {
        return $this->belongsTo(Tehsil::class);
    }
}
