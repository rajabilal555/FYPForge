<?php

namespace Tests;

use App\Models\Advisor;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class AdvisorTestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(Advisor::factory()->create(), 'advisor');
    }
}
