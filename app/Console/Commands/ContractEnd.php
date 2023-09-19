<?php

namespace App\Console\Commands;

use App\Models\EmployeeContracts;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ContractEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:end';

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
        $rows = EmployeeContracts::with('employee.user')->get();
        foreach ($rows as $row) {

            $enddate = Carbon::createFromFormat('Y-m-d', $row->contract_enddate);
            $datenow = Carbon::now();
            if ($enddate->diffInDays($datenow) <= 10) {

                if (!$row->employee || !$row->employee->user) {
                    continue;
                }
                $notificationData = [
                    'user_id' => $row->employee->user->id,
                    'type' => 'contract_reminder',
                    'title' => 'Contract expiry reminder',
                    'title_ar' => 'تذكير انتهاء مدة العقد',
                    'body' => 'Reminder , ' . $row->employee->name . ' \'s contract will end in' . $row->contract_enddate,
                    'body_ar' => ' عقد الموظف ' . $row->employee->name_ar . ' سوف ينهي في ' . $row->contract_enddate,
                    'created_by' => $row->employee->created_by,
                    'for_admin' => 1,
                    'redirect_url' => route('employee.index'),
                ];
                store_notification($notificationData);

                $notificationData = [
                    'user_id' => $row->employee->user->id,
                    'type' => 'contract_reminder',
                    'title' => 'Contract expiry reminder',
                    'title_ar' => 'تذكير انتهاء مدة العقد',
                    'body' => 'Reminder , your contract will end in ' . $row->contract_enddate,
                    'body_ar' => 'عقدك سوف ينتهي في ' . $row->contract_enddate,
                    'created_by' => $row->employee->created_by,
                    'for_admin' => 0,
                    'redirect_url' => null,
                ];
                store_notification($notificationData);
                info('contract_end');
                info($row->employee);
                pushNotification('تذكير انتهاء مدة العقد', 'Reminder , your contract will end in ' . $row->contract_enddate, [], [$row->employee->user->fcm_token]);
            }
        }

    }
}
