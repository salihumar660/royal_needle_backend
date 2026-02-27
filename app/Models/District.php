<?php

namespace App\Models;
use App\Models\Province;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';
    protected $fillable = [
        'name',
        'province_id',
        'latitude',
        'longitude',
    ];
    public function province() {
        return $this->belongsTo(Province::class);
    }
    public function tehsils() {
        return $this->hasMany(Tehsil::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
}
