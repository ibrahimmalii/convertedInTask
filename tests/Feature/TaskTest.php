<?php

namespace Tests\Feature;

use App\Http\Enums\RoleEnums;
use App\Jobs\UpdateOrCreateUserStatistics;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    private ?User $admin;

//    public static function setUpBeforeClass(): void
//    {
//        parent::setUpBeforeClass();
//
//        Role::factory()->count(2)->create();
//    }

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role_id' => RoleEnums::Admin->value,
        ]);
    }
    public function test_logged_in_admin_can_see_tasks_list_page(): void
    {
        $this->actingAs($this->admin)->get('/tasks')->assertStatus(200);
    }

    public function test_admin_can_add_task(): void
    {
        $this->actingAs($this->admin);

        $response = $this->post('/tasks', Task::factory()->make()->toArray());

        $this->assertDatabaseCount('tasks', 1);

        $response->assertStatus(302);
    }

    public function test_tasks_list_page_show_tasks_correctly()
    {
        $this->actingAs($this->admin);
        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee('Tasks');
    }

    public function test_update_statistics_job_when_create_new_task(): void
    {
        $user = User::factory()->create(['role_id' => RoleEnums::User->value]);

        $this->actingAs($this->admin);
        Queue::fake();
        Queue::assertNothingPushed();
        $this->app->call([new UpdateOrCreateUserStatistics($user->id), 'handle']);
        $response = $this->post('tasks',  Task::factory()->make()->toArray());

        $response->assertStatus(302);
    }
}
