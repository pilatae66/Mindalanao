<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Position;
use App\Department;
use App\Role;
use App\LeaveType;
use App\Attendance;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->create()->each(function ($user){
            $user->department()->save(factory(Department::class)->create());
            $user->position()->sync(factory(Position::class)->create()->each(function($position){
                $position->department()->sync(factory(Department::class)->create());
            }));
        });
        factory(LeaveType::class, 1)->create();

        factory(Attendance::class, 30)->create();

        $this->call(DeductionSeeder::class);
        $this->call(BenefitSeeder::class);
    }
}
