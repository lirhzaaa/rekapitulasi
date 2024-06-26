<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rombels;
use App\Models\rayons;

class students extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nis',
        'nama',
        'rombel_id',
        'rayon_id',
    ];

    public function rombel(){
        return $this->belongsTo(rombels::class);
    }
    public function rayon(){
        return $this->belongsTo(rayons::class);
    }

    public function student(){
        return $this->hasMany(lates::class);
    }
}
