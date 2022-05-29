<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentToAssessment extends Model
{
    use HasFactory;
    protected $table = 'students_to_assessments';
    protected $primaryKey = 'id_student_to_assessment';
    protected $fillable = ['id_teacher', 'id_student', 'id_assessment'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student', 'id_student');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher', 'id_teacher');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'id_assessment', 'id_assessment');
    }
}
