<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ProjectStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test Coordinator',
            'email' => 'test@szabist.pk',
            'role' => 'admin',
        ]);

        \App\Models\Student::factory(100)->create();
        \App\Models\Advisor::factory(20)->create();

        $project1 = \App\Models\Project::factory()->create([
            'name' => 'Test Project 1',
            'description' => 'Test Project 1 Description',
            'status' => ProjectStatus::InProgress,
        ]);

        $project2 = \App\Models\Project::factory()->create([
            'name' => 'Test Project 2',
            'description' => 'Test Project 2 Description',
            'status' => ProjectStatus::InProgress,
        ]);

        $evaluator = \App\Models\EvaluationPanel::factory()->create([
            'name' => 'Test Evaluator',
            'email' => 'evaluator@szabist.pk',
            'description' => 'Test Evaluators for evaluation of Test Projects.',
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student 1P1',
            'email' => 'student1@szabist.pk',
            'project_id' => $project1->id,
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student 2P1',
            'email' => 'student2@szabist.pk',
            'project_id' => $project1->id,
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student 3P2',
            'email' => 'student3@szabist.pk',
            'project_id' => $project2->id,
        ]);

        \App\Models\Student::factory()->create([
            'name' => 'Test Student',
            'email' => 'student@szabist.pk',
        ]);

        \App\Models\Advisor::factory()->create([
            'name' => 'Test Advisor',
            'email' => 'advisor@szabist.pk',
            'room_no' => '404 A',
            'field_of_interests' => ['Web Development', 'Android Development', 'Artificial Intelligence'],
        ]);

        \App\Models\Advisor::factory()->create([
            'name' => 'Ali Mobin',
            'email' => 'ali.mobin@szabist.pk',
            'room_no' => '303 A',
            'field_of_interests' => ['Artificial Intelligence', 'Web'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Asim Riaz',
            'email' => 'asim.riaz@szabist.pk',
            'room_no' => '154C',
            'field_of_interests' => ['Software Engineering', 'Machine Learning', 'Management Information System'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Dr. Adeel Ansari',
            'email' => 'adeel.ansari@szabist.pk',
            'room_no' => '100C Room 102-B',
            'field_of_interests' => ['Artificial Intelligence', 'Computational Algorithms', 'Web Development', 'Software Engineering'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Shahzad Haroon',
            'email' => 'shahzad.haroon@szabist.pk',
            'room_no' => '100C, Room 203B',
            'field_of_interests' => ['Networking', 'Machine Learning', 'Management Information Systems'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Khalid Rasheed',
            'email' => 'khalid.rasheed@szabist.pk',
            'room_no' => '100C Room 201',
            'field_of_interests' => ['Image Processing', 'Machine Learning', 'Web Development', 'Android Development', 'Artificial Intelligence'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Khawaja Mohiuddin',
            'email' => 'khawaja.mohiuddin@szabist.pk',
            'room_no' => '154C',
            'field_of_interests' => ['Software Engineering', 'MIS'],
        ]);
        \App\Models\Advisor::factory()->create([
            'name' => 'Adeel Ahmed',
            'email' => 'adeel.ahmed@szabist.pk',
            'room_no' => '100C Room 201',
            'field_of_interests' => ['Natural Language Processing', 'Text Mining', 'Machine Learning', 'Data Science'],
        ]);
    }
}
