<?php

namespace Tests;

use App\Models\Student;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class StudentTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(Student::factory()->create(), 'student');
    }
}
