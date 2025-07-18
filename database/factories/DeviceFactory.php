<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    protected $model = \App\Models\Device::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}

