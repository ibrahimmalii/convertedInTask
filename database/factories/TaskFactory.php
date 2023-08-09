<?php

namespace Database\Factories;

use App\Http\Enums\RoleEnums;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'assigned_to_id' => function () {
                return User::factory()->create(['role_id' => RoleEnums::User->value])->id;
            },
            'assigned_by_id' => function () {
                return User::factory()->create(['role_id' => RoleEnums::Admin->value])->id;
            }
        ];
    }
}
