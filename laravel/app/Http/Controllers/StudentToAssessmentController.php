<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\StudentToAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentToAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_teacher' => 'required|numeric|min:1|exists:teachers,id_teacher',
            'id_student' => 'required|numeric|min:1|exists:students,id_student',
            'id_assessment' => 'required|numeric|min:1|exists:assessments,id_assessment',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->first(), 'data' => null]);
        }

        $studentToAssessment = new StudentToAssessment();
        $studentToAssessment->id_teacher = $request->id_teacher;
        $studentToAssessment->id_student = $request->id_student;
        $studentToAssessment->id_assessment = $request->id_assessment;
        $studentToAssessment->save();

        return response()->json(['status' => 1, 'errors' => null, 'data' => null]);
    }
}
