<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use App\Models\rayons;


class users extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role'
    ];

    public function user()
    {
        return $this->hasMany(rayons::class);
    }
}
