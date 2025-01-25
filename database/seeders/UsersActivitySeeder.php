<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use App\Models\UserActivity;
use Faker\Factory as Faker;

class UsersActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create the 3 specific activities
        $activities = [
            Activity::create(['name' => 'Running']),
            Activity::create(['name' => 'Jogging']),
            Activity::create(['name' => 'Walking']),
        ];

        // Create 5 users
        User::factory(5)->create()->each(function ($user) use ($faker, $activities) {
            // Assign random activities to each user
            $numActivities = rand(1, 3);
            $userActivities = $faker->randomElements($activities, $numActivities);

            foreach ($userActivities as $activity) {
                UserActivity::create([
                    'user_id' => $user->id,
                    'activity_id' => $activity->id,
                    'performed_at' => $faker->dateTimeBetween('-1 year', 'now'),
                    'points' => 20, // Points are always 20
                ]);
            }
        });
    }
}