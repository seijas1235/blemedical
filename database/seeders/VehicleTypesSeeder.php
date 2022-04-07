<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleType::create(['vehicle_type'=>'Oficial','toll_fee_id'=>1]);
        VehicleType::create(['vehicle_type'=>'Residente','toll_fee_id'=>2]);
        VehicleType::create(['vehicle_type'=>'No Residente','toll_fee_id'=>3]);
    }
}
