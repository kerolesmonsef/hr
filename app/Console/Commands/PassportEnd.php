<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PassportEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:end';

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
        $rows = Employee::where('passport_issuance_expirydate_gregorian' , '!=' , null)->get();
        foreach ( $rows as $row ) {
            $enddate = Carbon::createFromFormat('Y-m-d', $row->passport_issuance_expirydate_gregorian);
            $datenow = Carbon::now();
            if ($enddate->diffInDays($datenow) <= 10) {
                $notificationData = [
                    'user_id' => $row->user->id,
                    'type' => 'passport_reminder',
                    'title' => 'Passport expiry reminder',
                    'title_ar' => 'تذكير انتهاء جواز سفر',
                    'body' => 'Reminder , ' . $row->name . ' \'s passport will end in' . $row->passport_issuance_expirydate_gregorian,
                    'body_ar' => ' جواز سفر الموظف ' . $row->name_ar . ' سوف ينهي في ' . $row->passport_issuance_expirydate_gregorian,
                    'created_by' => $row->created_by,
                    'for_admin' => 1,
                    'redirect_url' => route('employee.index'),
                ];
                store_notification($notificationData);

                $notificationData = [
                    'user_id' => $row->user->id,
                    'type' => 'passport_reminder',
                    'title' => 'Passport expiry reminder',
                    'title_ar' => 'تذكير انتهاء مدة جواز السفر',
                    'body' => 'Reminder , your passport will end in ' . $row->passport_issuance_expirydate_gregorian,
                    'body_ar' => 'جواز السفر سوف ينتهي في ' . $row->passport_issuance_expirydate_gregorian,
                    'created_by' => $row->created_by,
                    'for_admin' => 0,
                    'redirect_url' => null,
                ];
                store_notification($notificationData);
                pushNotification('تذكير انتهاء مدة العقد', 'Reminder , your passport will end in ' . $row->passport_issuance_expirydate_gregorian, [], [$row->user->fcm_token]);
            }
        }
    }
}
