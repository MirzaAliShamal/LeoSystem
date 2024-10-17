<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddLatLongToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->lat = $this->generateRandomLatitude();
            $user->long = $this->generateRandomLongitude();
            $user->save();
        }
    }

    private function generateRandomLatitude(): float|int
    {
        return mt_rand(-90000000, 90000000) / 1000000;
    }

    private function generateRandomLongitude(): float|int
    {
        return mt_rand(-180000000, 180000000) / 1000000;
    }
}
