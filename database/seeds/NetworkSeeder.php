<?php

use App\Network;
use Illuminate\Database\Seeder;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $networks = [
            "Facebook",
            "Instagram",
            "Linkedin",
            "Twitter",
        ];
        foreach ($networks as $value) {
            Network::create(["network" => $value]);
        }
    }
}
