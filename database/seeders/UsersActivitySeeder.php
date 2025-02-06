<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use App\Models\UserActivity;
use App\Models\UsersLeaderboard;
use Faker\Factory as Faker;

class UsersActivitySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create the 3 specific activities
        $activities = [
            Activity::create(['name' => 'Running']),
            Activity::create(['name' => 'Zumba']),
            Activity::create(['name' => 'Cardio']),
        ];

        User::factory(10)->create()->each(function ($user) use ($faker, $activities) {
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

            $totalPoints = UserActivity::where('user_id', $user->id)->sum('points');

            UsersLeaderboard::create([
                'user_id' => $user->id,
                'total_points' => $totalPoints,
                'rank' => 0,
            ]);
        });

        // Update ranks in users_leaderboard table
        $this->updateRanks();
    }

    private function updateRanks()
    {
        $usersLeaderboard = UsersLeaderboard::orderBy('total_points', 'desc')->get();

        $rank = 1;
        $prevPoints = null;

        foreach ($usersLeaderboard as $leaderboard) {
            if ($prevPoints !== $leaderboard->total_points) {
                $leaderboard->rank = $rank;
                $prevPoints = $leaderboard->total_points;
            } else {
                $leaderboard->rank = $rank - 1;
            }
            $leaderboard->save();
            $rank++;
        }
    }
}