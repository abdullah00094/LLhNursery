<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory,
     SoftDeletes;

    protected $fillable = [
        'student_id',
        'date',
        'is_absent',
        'reason',
    ];

    public function student() {
        return  $this->belongsTo(Student::class);
    }
}
