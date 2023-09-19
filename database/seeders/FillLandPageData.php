<?php

namespace Database\Seeders;

use App\Models\Landaboutcard;
use App\Models\Landblog;
use App\Models\Landcloudcard;
use App\Models\Landcontactcard;
use App\Models\Landdemocard;
use App\Models\Landfeature;
use App\Models\Landhelpcard;
use App\Models\Landplan;
use App\Models\Landsaycard;
use App\Models\Landsection;
use App\Models\Landslider;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class FillLandPageData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = ['homeSection' ,'purposeSection' , 'sliderSection' ,'aboutSection','cloudSection','helpSection','planSection','saySection','blogSection','priceSection','demoSection','contactSection','getTouchSection'];
        $types = ['lite' , 'regular' , 'pro'];
        $dateTypes = ['yearly','monthly'];
        foreach( $sections as $section){
            Landsection::create([
                'titleEn' => in_array($section , ['termSection','sliderSection','homeSection','purposeSection','aboutSection','cloudSection','helpSection','planSection','saySection','blogSection','priceSection','demoSection','contactSection','getTouchSection']) ? 'title english' : null,
                'titleAr' => in_array($section , ['termSection','sliderSection','homeSection','purposeSection','aboutSection','cloudSection','helpSection','planSection','saySection','blogSection','priceSection','demoSection','contactSection','getTouchSection']) ? 'تايتل عربي' : null,
                'descriptionEn' => in_array($section , ['termSection','footerSection','sliderSection','homeSection','purposeSection','aboutSection','cloudSection','planSection','priceSection','demoSection']) ? 'description english' : null,
                'descriptionAr' => in_array($section , ['termSection','footerSection','sliderSection','homeSection','purposeSection','aboutSection','cloudSection','planSection','priceSection','demoSection']) ? 'ديسكربشن عربي' : null,
                'image' => in_array($section , ['termSection','homeSection','purposeSection','aboutSection','helpSection','demoSection']) ? 'image' : null,
                'key' => $section,
                //seo
                'metaTitleEn' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'meta title english' : null,
                'metaTitleAr' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'ميتا تايتل عربي' : null,
                'metaDescriptionEn' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'meta description english' : null,
                'metaDescriptionAr' => in_array($section , ['homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'ميتا ديسكربشن انجليش' : null,
                'metakeyEn' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'meta key english' : null,
                'metakeyAr' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'ميتا كي عربي' : null,
                'metaTagEn' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'meta tag englsih' : null,
                'metaTagAr' => in_array($section , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection']) ? 'ميتتا تاج عربي' : null,
                //seo

            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landaboutcard::create([
                'titleEn' => 'title english' ,
                'titleAr' => 'تايتل عربي',
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landblog::create([

                'titleEn' => 'title english' ,
                'titleAr' => 'تايتل عربي',

                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',

                'image' => 'image',


                'metaTitleEn' => 'meta description english meta',
                'metaTitleAr' => 'ديسكربشن عربي ميتا',

                'metaDescriptionEn' => 'description english meta',
                'metaDescriptionAr' => 'ديسكربشن عربي ميتا',

                'metakeyEn' => 'description english meta',
                'metakeyAr' => 'ديسكربشن عربي ميتا',

                'metaTagEn' => 'description english meta',
                'metaTagAr' => 'ديسكربشن عربي ميتا',
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landcloudcard::create([
                'number' => '20' ,
                'image' => 'image',
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landcontactcard::create([
                'titleEn' => 'title english' ,
                'titleAr' => 'تايتل عربي',
                'image' => 'image',
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landdemocard::create([
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
            ]);
        }
        for($i = 0 ; $i < 6 ; $i ++){
            Landplan::create([
                'type' => $types[array_rand($types)],
                'price' => 250,
                'dateType' => $dateTypes[array_rand($dateTypes)],
            ]);
        }
        for($i = 0 ; $i < 20 ; $i ++){
            Landfeature::create([
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
                'landplan_id' => Landplan::inRandomOrder()->first()->id
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landhelpcard::create([
                'titleEn' => 'title english' ,
                'titleAr' => 'تايتل عربي',
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
                'image' => 'image',
            ]);
        }

        for($i = 0 ; $i < 3 ; $i ++){
            Landsaycard::create([
                'image' => 'image' ,
                'name' => 'Saad Nabil',
                'descriptionEn' => 'description english',
                'descriptionAr' => 'ديسكربشن عربي',
            ]);
        }
        for($i = 0 ; $i < 3 ; $i ++){
            Landslider::create([
                'image' => 'image' ,
            ]);
        }
    }
}
