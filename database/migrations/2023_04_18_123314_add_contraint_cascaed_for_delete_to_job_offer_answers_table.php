<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddContraintCascaedForDeleteToJobOfferAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `job_offer_answers` DROP FOREIGN KEY `job_offer_answers_company_job_request_id_foreign`');
        DB::statement('ALTER TABLE `job_offer_answers` ADD CONSTRAINT `job_offer_answers_company_job_request_id_foreign` FOREIGN KEY (`company_job_request_id`) REFERENCES `company_job_requests`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        DB::statement('ALTER TABLE `job_offer_answers` DROP FOREIGN KEY `job_offer_answers_job_offer_question_id_foreign`');
        DB::statement('ALTER TABLE `job_offer_answers` ADD CONSTRAINT `job_offer_answers_job_offer_question_id_foreign` FOREIGN KEY (`job_offer_question_id`) REFERENCES `job_offer_questions`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        DB::statement('ALTER TABLE `job_offer_answers` DROP FOREIGN KEY `job_offer_answers_job_offer_user_id_foreign`');
        DB::statement('ALTER TABLE `job_offer_answers` ADD CONSTRAINT `job_offer_answers_job_offer_user_id_foreign` FOREIGN KEY (`job_offer_user_id`) REFERENCES `job_offer_users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
