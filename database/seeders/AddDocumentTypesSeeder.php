<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\EvaluationCategory;
use Illuminate\Database\Seeder;
use Twilio\Rest\Numbers\V2\RegulatoryCompliance\Bundle\EvaluationList;

class AddDocumentTypesSeeder extends Seeder
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
                'title' => 'Personal Documents',
                'title_ar' => 'مستندات شخصية',
            ],
            [
                'title' => 'Company Documents',
                'title_ar' => 'مستندات الشركة',
            ],
            [
                'title' => 'Assets Documents',
                'title_ar' => 'مستندات العهد',
            ],
            [
                'title' => 'Insurance Documents',
                'title_ar' => 'مستندات التأمين',
            ],
        ];

        foreach($elements as $element ){
            DocumentType::query()->firstOrCreate([
                'name'    => $element['title'],
            ],[
                'name_ar' => $element['title_ar'],
            ]);
        }

    }
}
