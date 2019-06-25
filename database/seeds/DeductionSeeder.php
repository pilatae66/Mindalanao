<?php

use Illuminate\Database\Seeder;
use App\Deduction;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deduction::create([
            'name' => 'SSS',
            'amount' => '1000'
        ]);

        Deduction::create([
            'name' => 'Pag-ibig',
            'amount' => '200'
        ]);

        Deduction::create([
            'name' => 'PhilHealth',
            'amount' => '100'
        ]);
    }
}
