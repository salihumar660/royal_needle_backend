<?php

namespace App\Models;
use App\Models\District;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];
    public function districts() {
        return $this->hasMany(District::class);
    }
    public function tehsils() {
        return $this->hasMany(Tehsil::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
}
