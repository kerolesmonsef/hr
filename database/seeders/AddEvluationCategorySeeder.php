<?php

namespace Database\Seeders;

use App\Models\EvaluationCategory;
use Illuminate\Database\Seeder;
use Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle\EvaluationList;

class AddEvluationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $elements = [
            [
                'title' => 'Poll',
                'title_ar' => 'استطلاع راي',
            ],
            [
                'title' => 'overall_evaluation',
                'title_ar' => 'تقييم عام',
            ],
            [
                'title' => 'technical_evaluation',
                'title_ar' => 'تقييم الاداء',
            ],
        ];
        foreach($elements as $element ){
            EvaluationCategory::Create([
                'title' => $element['title'],
                'title_ar' => $element['title_ar'],
                'created_by' => 22,
            ]);
        }

    }
}
