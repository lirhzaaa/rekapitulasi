<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\users;


class rayons extends Model
{
    use HasFactory;
    protected $fillable = [
        'rayons',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(users::class);
    }

    public function rayon(){
        return $this->hasMany(students::class);
    }
}
