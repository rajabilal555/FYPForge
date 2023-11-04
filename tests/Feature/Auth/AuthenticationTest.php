<?php

namespace Tests\Feature\Auth;

use App\Models\Advisor;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_staff_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'type' => 'staff',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('staff.dashboard'));
    }

    public function test_advisor_can_authenticate_using_the_login_screen(): void
    {
        $user = Advisor::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'type' => 'advisor',
        ]);

        $this->assertAuthenticated('advisor');
        $response->assertRedirect(route('advisor.dashboard'));
    }

    public function test_student_can_authenticate_using_the_login_screen(): void
    {
        $user = Student::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'type' => 'student',
        ]);

        $this->assertAuthenticated('student');
        $response->assertRedirect(route('student.dashboard'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
            'type' => 'staff',
        ]);

        $this->assertGuest();
    }
}
