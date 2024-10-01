<?php

namespace Database\Factories;

use App\Models\Absence;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    protected $model = Absence::class;

    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'is_absent' => true,
        ];
    }
}
