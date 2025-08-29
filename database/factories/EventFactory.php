<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::now()->addDays($this->faker->numberBetween(1, 10));
        $endDate   = (clone $startDate)->addDays($this->faker->numberBetween(5, 15));
        $drawTime  = (clone $endDate)->addDay();

        return [
            'title' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
            'ticket_price' => $this->faker->randomFloat(2, 10, 500),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'draw_time' => $drawTime,
            'cause' => $this->faker->randomElement([
                'Education Fund',
                'Health Support',
                'Community Project',
                'Animal Welfare'
            ]),
            'banner' => 'event_banners/sample' . $this->faker->numberBetween(1, 3) . '.jpg',
            'rules' => 'event_rules/rules' . $this->faker->numberBetween(1, 2) . '.pdf',
            'max_tickets_per_user' => $this->faker->numberBetween(1, 10),
            'is_publish' => true,
            'is_active' => true,
            'created_by' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
