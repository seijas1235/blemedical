<?php

namespace Database\Seeders;

use App\Models\VehicleRegistrationType;
use Illuminate\Database\Seeder;

class VehicleRegistrationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleRegistrationType::create(['vehicle_registration_type'=>'A']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'C']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'CC']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'CD']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'M']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'MI']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'O']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'P']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'TC']);
        VehicleRegistrationType::create(['vehicle_registration_type'=>'U']);
    }
}
