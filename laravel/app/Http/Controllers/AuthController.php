<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ApiResponse;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = $this->getValidator($data);

        if ($validator->fails()) {
            return (new ApiResponse())->setError($validator->errors()->first())->get();
        }

        $teacher = Teacher::where('name', $data['name'])->first();

        if (null === $teacher) {
            return (new ApiResponse())->setError('No teacher.')->get();
        }

        if (!Hash::check($data['password'], $teacher->password)) {
            return (new ApiResponse())->setError('Password is not correct.')->get();
        }

        $writerToken = $teacher->createToken('auth_token')->plainTextToken;

        return (new ApiResponse(['token' => $writerToken]))->get();
    }

    private function getValidator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
