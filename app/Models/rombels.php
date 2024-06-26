<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\students;

class rombels extends Model
{
    use HasFactory;
    protected $fillable = [
        'rombels',
    ];

    public function rombel(){
        return $this->hasMany(students::class);
    }
}
