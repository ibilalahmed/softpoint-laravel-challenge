<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{
    public function definition(): array
    {
        $type = $this->faker->randomElement(['house', 'department', 'land', 'commercial_ground']);
        $isLandType = in_array($type, ['land', 'commercial_ground']);

        return [
            'name' => $this->faker->words(3, true),
            'real_state_type' => $type,
            'street' => $this->faker->streetName(),
            'external_number' => $this->faker->buildingNumber(),
            'internal_number' => in_array($type, ['department', 'commercial_ground']) ? $this->faker->secondaryAddress() : null,
            'neighborhood' => $this->faker->word(),
            'city' => $this->faker->city(),
            'country' => $this->faker->countryCode(),
            'rooms' => $isLandType ? 0 : $this->faker->numberBetween(1, 10),
            'bathrooms' => $isLandType ? 0 : $this->faker->numberBetween(1, 5),
            'comments' => $this->faker->optional()->sentence(),
        ];
    }
}