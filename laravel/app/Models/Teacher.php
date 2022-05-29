<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $primaryKey = 'id_teacher';
    protected $fillable = ['name',  'password'];

    protected $hidden = ['password', 'remember_token'];
}
