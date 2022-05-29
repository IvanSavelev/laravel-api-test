<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ApiResponse;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all()->toArray();

        return (new ApiResponse($teachers))->get();
    }
}
