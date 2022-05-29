<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ApiResponse;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all()->toArray();

        return (new ApiResponse($students))->get();
    }

    public function show($id_student)
    {
        $validator = $this->getValidator($id_student);

        if ($validator->fails()) {
            return (new ApiResponse())->setError($validator->errors()->first())->get();
        }

        $students = $this->getStudent((int) $id_student);
        $studentsFilter = $this->dataFilter($students);

        return (new ApiResponse($studentsFilter))->get();
    }

    private function getValidator($id_student): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(['id' => $id_student], [
            'id' => 'required|numeric|min:1|exists:students,id_student',
        ]);
    }

    private function getStudent(int $id_student): array
    {
        return Student::with([
            'studentsToAssessments',
            'studentsToAssessments.teacher',
            'studentsToAssessments.assessment',
        ])
            ->where('id_student', $id_student)
            ->get()
            ->toArray()
        ;
    }

    private function dataFilter(array $students): array
    {
        foreach ($students as &$student) {
            foreach ($student['students_to_assessments'] as &$studentsToAssessments) {
                unset(
                    $studentsToAssessments['id_teacher'],
                    $studentsToAssessments['id_student_to_assessment'],
                    $studentsToAssessments['id_student'],
                    $studentsToAssessments['id_assessment']
                );
            }
        }

        return $students;
    }
}
