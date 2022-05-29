<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ApiResponse;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessment = Assessment::all()->toArray();

        return (new ApiResponse($assessment))->get();
    }
}
