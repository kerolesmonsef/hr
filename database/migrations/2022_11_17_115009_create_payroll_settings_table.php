<?php

use App\Models\PayrollSetting;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePayrollSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->tinyInteger('payroll_dispaly')->nullable();
            $table->biginteger('created_by')->nullable();
            $table->timestamps();
        });

        $companies  = User::where('type','company')->get();
        foreach($companies as $company)
        {
            $data = [
                array('name'  => 'Employee Code','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Name','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Job','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Work Days','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Basic Salary','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Other allowances','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'OverTime','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Sales percentage','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Other dues','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Total due','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Employee social insurance','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Employee medical insurance','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Absence','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'vacations','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Advanced Loans','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Other deductions','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'Total deduction','payroll_dispaly' => 1,'created_by' => $company->id),
                array('name'  => 'net salary','payroll_dispaly' => 1,'created_by' => $company->id)
            ];
            PayrollSetting::insert($data);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_settings');
    }
}
