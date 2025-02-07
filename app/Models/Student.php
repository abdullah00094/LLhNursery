<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'parent_info',
        'grade_id',
    ];

    public function grade() {
        return $this->belongsTo(Grade::class); 
    }
    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
