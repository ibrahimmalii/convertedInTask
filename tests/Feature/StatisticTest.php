<?php

namespace Tests\Feature;

use App\Http\Enums\RoleEnums;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_update_statistics_job_when_create_new_task(): void
    {
        Role::factory()->count(2)->create();
        $admin = User::factory()->create([
            'role_id' => RoleEnums::Admin->value,
        ]);

        $this->actingAs($admin);
        $response = $this->get('/statistics');

        $response->assertStatus(200);
        $response->assertSee('Statistics');
    }
}
