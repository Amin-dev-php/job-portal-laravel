<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'user_id' => User::all()->random()->id,
            'company_id' => Company::all()->random()->id,
            'title' => $title = $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'slug' => str::slug($title, '-'),
            'position' => $this->faker->jobTitle,
            'address' => $this->faker->address,
            'category_id' => rand(1, 5),
            'type' => 'fullTime',
            'status' => rand(0, 1),
            'description' => $this->faker->paragraph(rand(2, 10)),
            'roles' => $this->faker->text,
            'last_date' => $this->faker->dateTime,
            'number_of_vacancy' => rand(1, 10),
            'experience' => rand(1, 10),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'salary' => rand(10000, 50000)

        ];
    }
}
