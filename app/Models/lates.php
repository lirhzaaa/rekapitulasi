<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lates extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_time_late',
        'information',
        'bukti',
        'student_id',
    ];

    public function student(){
        return $this->belongsTo(students::class);
    }

}
