<?php

namespace Tests\Feature;

use App\Http\Enums\RoleEnums;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();

        Role::factory()->count(2)->create();
        $this->admin = User::factory()->create([
            'role_id' => RoleEnums::Admin->value,
        ]);
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1;');
    }
    public function test_update_statistics_job_when_create_new_task(): void
    {
        $this->actingAs($this->admin);
        $response = $this->get('/statistics');

        $response->assertStatus(200);
        $response->assertSee('Statistics');
    }
}
