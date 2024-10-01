<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subject;


class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'subject_id',
    ];
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'teacher_grade')
                    ->using(TeacherGrade::class);
    }
}
