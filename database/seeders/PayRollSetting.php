<?php

namespace Database\Seeders;

use App\Models\PayrollSetting as ModelsPayrollSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class PayRollSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies  = User::where('type','company')->where('id' , 22)->get();
        foreach($companies as $company)
        {
            $data = [
                array('name'  => 'Currency rate','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Egyptian net salary','payroll_dispaly' => 1,'created_by' => $company->id),
            ];
            ModelsPayrollSetting::insert($data);
        }
    }
}
