<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\Student;
use App\Models\StudentToAssessment;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    private array $assessmentsSeed = [
        1 => 'Неуд',
        2 => 'Два',
        3 => 'Три',
        4 => 'Четыре',
        5 => 'Пять',
    ];

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $teachers = $this->runTeacher();
        $students = $this->runStudent();
        $assessments = $this->runAssessment();
        $this->runStudentToAssessment($teachers, $students, $assessments);
    }

    public function runTeacher(): Collection
    {
        return Teacher::factory()->count(5)->create();
    }

    public function runStudent(): Collection
    {
        return Student::factory()->count(15)->create();
    }

    public function runAssessment(): Collection
    {
        $assessments = new Collection();

        foreach ($this->assessmentsSeed as $key => $item) {
            $assessments->add(Assessment::factory()->create([
                'level' => $key,
                'description' => $item,
            ]));
        }

        return $assessments;
    }

    public function runStudentToAssessment(Collection $teachers, Collection $students, Collection $assessments): void
    {
        for ($i = 0; $i < 50; ++$i) {
            $studentToAssessment = new StudentToAssessment();
            $studentToAssessment->id_teacher = $teachers->random()->id_teacher;
            $studentToAssessment->id_student = $students->random()->id_student;
            $studentToAssessment->id_assessment = $assessments->random()->id_assessment;
            $studentToAssessment->save();
        }
    }
}
