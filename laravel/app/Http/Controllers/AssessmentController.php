<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function index()
    {
        $assessment = Assessment::all()->toArray();

        return response()->json(['status' => 1, 'errors' => null, 'data' => $assessment]);
    }
}
