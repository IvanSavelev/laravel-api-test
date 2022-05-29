<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_student';
    protected $fillable = ['name'];

    public function studentsToAssessments()
    {
        return $this->hasMany(StudentToAssessment::class, 'id_student', 'id_student');
    }
}
