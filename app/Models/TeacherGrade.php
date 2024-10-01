<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherGrade extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'teacher_grade';

    protected $fillable = [
        'teacher_id',
        'grade_id',
    ];


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Relationship to the Grade model
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
