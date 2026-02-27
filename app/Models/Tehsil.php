<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tehsil extends Model
{
    protected $table = 'tehsil';
    protected $fillable = [
        'province_id',
        'district_id',
        'name',
        'latitude',
        'longitude',
    ];
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
}
