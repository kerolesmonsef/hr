<?php

namespace Database\Seeders;

use App\Models\ContractTemplate;
use Illuminate\Database\Seeder;
use Str;
class ContractTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0 ; $i < 15 ; $i++){
            ContractTemplate::create([
                'name' => Str::random(40),
                'date' => '2023-10-05',
                'template' => Str::random(450)
            ]);
        }

    }
}
