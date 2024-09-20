<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        Classes::factory()
            ->count(10)
            ->sequence(fn($sequence) => ['name' => 'Class' . $sequence->index + 1])
            ->has(

                Section::factory()
                    ->count(2)
                    ->state(new Sequence(['name' => 'Section 1'], ['name' => 'Section 2'],))
                    ->has(

                        Student::factory()
                            ->count(5)
                            ->state(
                                function (array $attributes, Section $section) {
                                    return ['class_id' => $section->class_id];
                                }
                            )
                    )
            )
            ->create();
    }
}
