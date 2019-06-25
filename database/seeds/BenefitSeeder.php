<?php

use Illuminate\Database\Seeder;
use App\Benefit;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Benefit::create([
            'name' => 'Grocery',
            'amount' => '1000'
        ]);

        Benefit::create([
            'name' => 'Health Insurance',
            'amount' => '500'
        ]);
    }
}
