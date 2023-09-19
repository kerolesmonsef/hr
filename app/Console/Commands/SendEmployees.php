<?php

namespace App\Console\Commands;

use App\Mail\SendEmployeeEmail;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendemployees:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $companies = User::where('type', 'company')->get();
        foreach ($companies as $company) {
            $employees = Employee::where('created_by', $company->id)->whereNotNull('iqama_issuance_expirydate_gregorian')->get();
            foreach ($employees as $employee) {
                if (Carbon::parse($employee->iqama_issuance_expirydate_gregorian)->diffInDays(Carbon::now()) + 1 < 5) {
                    try {

                        Mail::to($employee->email)->send(new SendEmployeeEmail($employee));
                    } catch (\Exception $e) {
                        $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                    }
                }
            }
        }
        info('success');
    }
}
