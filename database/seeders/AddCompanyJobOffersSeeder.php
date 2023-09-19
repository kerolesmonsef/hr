<?php

namespace Database\Seeders;

use App\Models\CompanyJobRequest;
use App\Models\JobRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AddCompanyJobOffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $offers = [
            'Frontend Developer' , 'Backend Developer' , 'Sales Manager' , 'Office Boy' , 'Senior Project Manager'
       ];

       foreach( $offers as $offer){
            $int= mt_rand(1262055681,1262055681);
            $joboffer = CompanyJobRequest::create([
                'title'  =>  $offer,
                'start_date' => Carbon::now()->format('Y-m-d'),
                'end_date' => Carbon::now()->format('Y-m-d'),
                'created_by' =>  22,
            ]);
            for($i = 0 ; $i < 10 ; $i ++ ){
                $row = JobRequest::create([
                    'company_job_request_id' =>  $joboffer -> id,
                    'name'                   =>  'name ' . $i,
                    'cv'                     =>  'cv.pdf',
                    'message'                =>  'I want to apply on this job',
                    'age'                    =>  mt_rand(22,60),
                    'role'                   =>  'full',
                    'findus'                 => 'Facebook',
                    'interview_day'          => 'Sunday',
                    'field'                  => null ,
                    'phone'                  => '+20 1143707240',
                    'address'                => 'Shoubra , Cairo , Egypt',
                    'is_read'                => mt_rand(0,1),
                ]);
            }



       }
    }
}
