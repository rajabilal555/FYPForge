<?php

namespace Database\Seeders;

use App\Models\Advisor;
use Illuminate\Database\Seeder;

class RealAdvisorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advisor::factory()->create([
            'name' => 'Ali Mobin',
            'email' => 'ali.mobin@szabist.pk',
            'room_no' => '303 A',
            'field_of_interests' => ['Artificial Intelligence', 'Web'],
        ]);
        Advisor::factory()->create([
            'name' => 'Asim Riaz',
            'email' => 'asim.riaz@szabist.pk',
            'room_no' => '154C',
            'field_of_interests' => ['Software Engineering', 'Machine Learning', 'Management Information System'],
        ]);
        Advisor::factory()->create([
            'name' => 'Dr. Adeel Ansari',
            'email' => 'adeel.ansari@szabist.pk',
            'room_no' => '100C Room 102-B',
            'field_of_interests' => ['Artificial Intelligence', 'Computational Algorithms', 'Web Development', 'Software Engineering'],
        ]);
        Advisor::factory()->create([
            'name' => 'Shahzad Haroon',
            'email' => 'shahzad.haroon@szabist.pk',
            'room_no' => '100C, Room 203B',
            'field_of_interests' => ['Networking', 'Machine Learning', 'Management Information Systems'],
        ]);
        Advisor::factory()->create([
            'name' => 'Khalid Rasheed',
            'email' => 'khalid.rasheed@szabist.pk',
            'room_no' => '100C Room 201',
            'field_of_interests' => ['Image Processing', 'Machine Learning', 'Web Development', 'Android Development', 'Artificial Intelligence'],
        ]);
        Advisor::factory()->create([
            'name' => 'Khawaja Mohiuddin',
            'email' => 'khawaja.mohiuddin@szabist.pk',
            'room_no' => '154C',
            'field_of_interests' => ['Software Engineering', 'MIS'],
        ]);
        Advisor::factory()->create([
            'name' => 'Adeel Ahmed',
            'email' => 'adeel.ahmed@szabist.pk',
            'room_no' => '100C Room 201',
            'field_of_interests' => ['Natural Language Processing', 'Text Mining', 'Machine Learning', 'Data Science'],
        ]);

    }
}
