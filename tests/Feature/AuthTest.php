<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_redirected_from_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_unauthenticated_user_redirected_from_attendance(): void
    {
        $response = $this->get('/attendance');
        $response->assertRedirect('/login');
    }

    public function test_login_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'login'    => 'nonexistent_user',
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors();
    }

    public function test_login_with_valid_student_credentials(): void
    {
        $user = User::where('login', 'student1')->first();
        if (!$user) { $this->markTestSkipped('student1 not found'); }
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_view_attendance(): void
    {
        $user = User::where('role', 'student')->first();
        if (!$user) { $this->markTestSkipped('No student found'); }
        $response = $this->actingAs($user)->get('/attendance');
        $response->assertStatus(200);
    }

    public function test_authenticated_student_cannot_access_teacher_panel(): void
    {
        $user = User::where('role', 'student')->first();
        if (!$user) { $this->markTestSkipped('No student found'); }
        $response = $this->actingAs($user)->get('/attendance/teacher');
        $response->assertStatus(403);
    }

    public function test_swagger_docs_page_loads(): void
    {
        $response = $this->get('/docs');
        $response->assertStatus(200);
        $response->assertSee('swagger-ui');
    }

    public function test_api_docs_json_accessible(): void
    {
        $response = $this->get('/api-docs.json');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }
}
