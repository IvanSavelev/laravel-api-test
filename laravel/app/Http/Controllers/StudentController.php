<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function show($id_student)
    {
        $validator = Validator::make(['id' => $id_student], [
            'id' => 'required|numeric|min:1|exists:students,id_student',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->first(), 'data' => null]);
        }

        $students = Student::with([
            'studentsToAssessments',
            'studentsToAssessments.teacher',
            'studentsToAssessments.assessment',
        ])
            ->where('id_student', (int) $id_student)
            ->get()
            ->toArray()
        ;

        $studentsFilter = $this->dataFilter($students);

        return response()->json(['status' => 1, 'errors' => null, 'data' => $studentsFilter]);
    }

    public function index()
    {
        $students = Student::all()->toArray();

        return response()->json(['status' => 1, 'errors' => null, 'data' => $students]);
    }

    private function dataFilter(array $students): array
    {
        foreach ($students as &$student) {
            foreach ($student['students_to_assessments'] as &$studentsToAssessments) {
                unset($studentsToAssessments['id_teacher'], $studentsToAssessments['id_student_to_assessment'], $studentsToAssessments['id_student'], $studentsToAssessments['id_assessment']);
            }
        }

        return $students;
    }
}
