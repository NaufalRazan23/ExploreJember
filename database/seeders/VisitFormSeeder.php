<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\VisitForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class VisitFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Indonesian locale

        // Get all destinations
        $destinations = Destination::all();

        // Get all users with role 'user'
        $users = User::where('role', 'user')->get();

        if ($destinations->isEmpty()) {
            $this->command->error('No destinations found. Please run DestinationSeeder first.');
            return;
        }

        if ($users->isEmpty()) {
            $this->command->error('No users found. Please run UserSeeder first.');
            return;
        }

        $this->command->info("Found {$destinations->count()} destinations and {$users->count()} users.");

        // Create one visit form per user for a random destination
        foreach ($users as $user) {
            // Random destination for this user
            $randomDestination = $destinations->random();

            $this->command->info("Creating visit form for user: {$user->name} at destination: {$randomDestination->name}");

            // Generate random visit date within the last 2 years
            $visitDate = $faker->dateTimeBetween('-2 years', 'now');

            // Generate random times
            $arrivalHour = $faker->numberBetween(6, 14); // 6 AM to 2 PM
            $arrivalMinute = $faker->randomElement([0, 15, 30, 45]);
            $arrivalTime = sprintf('%02d:%02d:00', $arrivalHour, $arrivalMinute);

            // Departure time is 2-8 hours after arrival
            $departureHour = $arrivalHour + $faker->numberBetween(2, 8);
            if ($departureHour > 23) $departureHour = 23;
            $departureMinute = $faker->randomElement([0, 15, 30, 45]);
            $departureTime = sprintf('%02d:%02d:00', $departureHour, $departureMinute);

            // Always rombongan with random group size
            $groupSize = $faker->numberBetween(2, 50);

            // Random suggestions and reviews
            $suggestions = $faker->optional(0.7)->text(200); // 70% chance of having suggestions
            $review = $faker->optional(0.8)->text(300); // 80% chance of having review

            try {
                VisitForm::create([
                    'user_id' => $user->id,
                    'destination_id' => $randomDestination->id,
                    'visit_date' => $visitDate,
                    'arrival_time' => $arrivalTime,
                    'departure_time' => $departureTime,
                    'visit_type' => 'rombongan',
                    'group_size' => $groupSize,
                    'suggestions' => $suggestions,
                    'review' => $review,
                    'created_at' => $visitDate,
                    'updated_at' => $visitDate,
                ]);
            } catch (\Exception $e) {
                $this->command->error("Failed to create visit form for user {$user->name}: " . $e->getMessage());
                continue;
            }
        }

        $totalForms = VisitForm::count();
        $this->command->info("Visit form seeding completed! Total forms created: {$totalForms}");
    }
}
