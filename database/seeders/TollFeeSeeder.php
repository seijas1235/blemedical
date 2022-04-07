<?php

namespace Database\Seeders;

use App\Models\TollFee;
use Illuminate\Database\Seeder;

class TollFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TollFee::create(['toll_fee'=>0.00]);
        TollFee::create(['toll_fee'=>0.05]);
        TollFee::create(['toll_fee'=>0.5]);

    }
}
