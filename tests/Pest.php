<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
// Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature/*.php');

uses(
    Tests\StudentTestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature/Student');

uses(
    Tests\AdvisorTestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature/Advisor');

uses(
    Tests\StaffTestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature/Staff');
