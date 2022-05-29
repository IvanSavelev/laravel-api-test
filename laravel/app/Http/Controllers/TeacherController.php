<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all()->toArray();

        return response()->json(['status' => 1, 'errors' => null, 'data' => $teachers]);
    }
}
