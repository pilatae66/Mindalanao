<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Payslip;
use App\Deduction;
use App\Benefit;
use App\Compensation;
use App\PayslipDetail;

class Payroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payroll:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically generate employee payrolls';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $employees = User::where('role', 'Employee')->get();
        $deductions = Deduction::all();
        $total_deductions = Deduction::sum('amount');
        $total_benefits = Benefit::sum('amount');
        $benefits = Benefit::all();
        $compensation = Compensation::all();


        foreach ($employees as $key => $employee) {
            $payslip = Payslip::create([
                'user_id' => $employee->id,
                'net_salary' => $employee->position[0]->salary,
                'gross_salary' => $employee->position[0]->salary * $employee->dtrDataEmployee()['grand_total_hours'],
            ]);

            foreach ($deductions as $key => $deduction) {

                $payslip->details()->save(new PayslipDetail([
                    'name' => $deduction->name,
                    'type' => 'Deductions',
                    'amount' => $deduction->amount
                ]));
            }

            foreach ($benefits as $key => $benefit) {
                $payslip->details()->save(new PayslipDetail([
                    'name' => $benefit->name,
                    'type' => 'Benefits ',
                    'amount' => $benefit->amount
                ]));

            }

            $payslip->net_salary = ($payslip->gross_salary + $total_benefits) - $total_deductions;
            $payslip->save();
        }
    }
}
