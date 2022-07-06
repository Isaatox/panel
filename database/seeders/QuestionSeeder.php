<?php

namespace Database\Seeders;

use App\Models\Question;
use Faker\Factory;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tmp = [];
        $faker = Factory::create("fr_FR");
        for ($i = 0; $i < 45; $i++){
            $rand = $faker->numberBetween(1, 3);
            $replies = "";
            for ($i2 = 0; $i2 < $rand; $i2++){

                $replies .= $i2 == 0 ? "" . $faker->text(): ",". $faker->text();
            }
            $values = [
                2 => [
                    "1",
                    "2",
                    "2,1"
                ],
                3 => [
                    "1",
                    "1,3",
                    "2",
                    "2,3"
                ]
            ];
            $validate = $rand == 1 ? "1" : array_values($values[$rand])[rand(0, count($values[$rand]) - 1)];

            $tmp[] = [
                'answer' => $faker->sentence(10),
                'replies' => $replies,
                'validate' => $validate,
            ];
        }
        Question::insert($tmp);
    }
}
