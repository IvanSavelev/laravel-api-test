<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ApiResponse;
use App\Models\StudentToAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentToAssessmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = $this->getStoreValidator($data);

        if ($validator->fails()) {
            return (new ApiResponse())->setError($validator->errors()->first())->get();
        }

        $this->addTeacherId($data);
        $this->saveStore($data);

        return (new ApiResponse())->get();
    }

    public function stores(Request $request)
    {
        $data = $request->all();
        $validator = $this->getStoresValidator($data);

        if ($validator->fails()) {
            return (new ApiResponse())->setError($validator->errors()->first())->get();
        }

        $this->addTeacherId($data);
        $this->saveStores($data);

        return (new ApiResponse())->get();
    }

    /** @noinspection PhpUndefinedFieldInspection */
    private function addTeacherId(&$data): void
    {
        $teacher = Auth::user();
        $data['id_teacher'] = $teacher->id_teacher;
    }

    private function saveStore(array $data)
    {
        $studentToAssessment = new StudentToAssessment();
        $studentToAssessment->id_teacher = $data['id_teacher'];
        $studentToAssessment->id_student = $data['id_student'];
        $studentToAssessment->id_assessment = $data['id_assessment'];
        $studentToAssessment->save();
    }

    private function getStoreValidator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'id_student' => 'required|numeric|min:1|exists:students,id_student',
            'id_assessment' => 'required|numeric|min:1|exists:assessments,id_assessment',
        ]);
    }

    private function getStoresValidator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($data, [
            'assessments' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        foreach ($data['assessments'] as $item) {
            $validator = Validator::make($item, [
                'id_student' => 'required|numeric|min:1|exists:students,id_student',
                'id_assessment' => 'required|numeric|min:1|exists:assessments,id_assessment',
            ]);

            if ($validator->fails()) {
                return $validator;
            }
        }

        return $validator;
    }

    private function saveStores(array $data): void
    {
        foreach ($data['assessments'] as $item) {
            $studentToAssessment = new StudentToAssessment();
            $studentToAssessment->id_teacher = $data['id_teacher'];
            $studentToAssessment->id_student = $item['id_student'];
            $studentToAssessment->id_assessment = $item['id_assessment'];
            $studentToAssessment->save();
        }
    }
}
