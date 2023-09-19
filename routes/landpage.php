<?php

use App\Http\Controllers\Landpage\BlogController;
use App\Http\Controllers\Landpage\FeatureController;
use App\Http\Controllers\Landpage\LandAboutCardController;
use App\Http\Controllers\Landpage\LandChatbotController;
use App\Http\Controllers\Landpage\LandCloudCardController;
use App\Http\Controllers\Landpage\LandContactCardController;
use App\Http\Controllers\Landpage\LandDemoCardController;
use App\Http\Controllers\Landpage\LandHelpCardController;
use App\Http\Controllers\Landpage\LandPlanController;
use App\Http\Controllers\Landpage\LandSayCardController;
use App\Http\Controllers\Landpage\SectionController;
use App\Http\Controllers\Landpage\LandSliderController;
use App\Http\Controllers\Landpage\LandSocialController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => [
    'auth',
    'XSS',
]],function(){
    Route::Get('section' , [SectionController::class , 'index'])->name('section');
    Route::Get('/section/form' , [SectionController::class , 'form'])->name('section.form');
    Route::POST('/section/update/{id}' , [SectionController::class , 'update'])->name('section.update');

    Route::Get('blog' , [BlogController::class , 'index'])->name('blog');
    Route::Get('blog/form' , [BlogController::class , 'form'])->name('blog.form');
    Route::Get('blog/delete/{id}' , [BlogController::class , 'delete'])->name('blog.delete');
    Route::POST('blog/update/{id}' , [BlogController::class , 'update'])->name('blog.update');
    Route::POST('blog/store' , [BlogController::class , 'store'])->name('blog.store');

    Route::Get('landcloudcard' , [LandCloudCardController::class , 'index'])->name('landcloudcard');
    Route::Get('landcloudcard/form' , [LandCloudCardController::class , 'form'])->name('landcloudcard.form');
    Route::Get('landcloudcard/delete/{id}' , [LandCloudCardController::class , 'delete'])->name('landcloudcard.delete');
    Route::POST('landcloudcard/update/{id}' , [LandCloudCardController::class , 'update'])->name('landcloudcard.update');
    Route::POST('landcloudcard/store' , [LandCloudCardController::class , 'store'])->name('landcloudcard.store');

    Route::Get('landchatbot' , [LandChatbotController::class , 'index'])->name('landchatbot');
    Route::Get('landchatbot/form' , [LandChatbotController::class , 'form'])->name('landchatbot.form');
    Route::Get('landchatbot/delete/{id}' , [LandChatbotController::class , 'delete'])->name('landchatbot.delete');
    Route::POST('landchatbot/update/{id}' , [LandChatbotController::class , 'update'])->name('landchatbot.update');
    Route::POST('landchatbot/store' , [LandChatbotController::class , 'store'])->name('landchatbot.store');

    Route::Get('landcontactcard' , [LandContactCardController::class , 'index'])->name('landcontactcard');
    Route::Get('landcontactcard/form' , [LandContactCardController::class , 'form'])->name('landcontactcard.form');
    Route::Get('landcontactcard/delete/{id}' , [LandContactCardController::class , 'delete'])->name('landcontactcard.delete');
    Route::POST('landcontactcard/update/{id}' , [LandContactCardController::class , 'update'])->name('landcontactcard.update');
    Route::POST('landcontactcard/store' , [LandContactCardController::class , 'store'])->name('landcontactcard.store');

    Route::Get('landdemocard' , [LandDemoCardController::class , 'index'])->name('landdemocard');
    Route::Get('landdemocard/form' , [LandDemoCardController::class , 'form'])->name('landdemocard.form');
    Route::Get('landdemocard/delete/{id}' , [LandDemoCardController::class , 'delete'])->name('landdemocard.delete');
    Route::POST('landdemocard/update/{id}' , [LandDemoCardController::class , 'update'])->name('landdemocard.update');
    Route::POST('landdemocard/store' , [LandDemoCardController::class , 'store'])->name('landdemocard.store');

    Route::Get('landfeature' , [FeatureController::class , 'index'])->name('landfeature');
    Route::Get('landfeature/form' , [FeatureController::class , 'form'])->name('landfeature.form');
    Route::Get('landfeature/delete/{id}' , [FeatureController::class , 'delete'])->name('landfeature.delete');
    Route::POST('landfeature/update/{id}' , [FeatureController::class , 'update'])->name('landfeature.update');
    Route::POST('landfeature/store' , [FeatureController::class , 'store'])->name('landfeature.store');

    Route::Get('landhelpcard' , [LandHelpCardController::class , 'index'])->name('landhelpcard');
    Route::Get('landhelpcard/form' , [LandHelpCardController::class , 'form'])->name('landhelpcard.form');
    Route::Get('landhelpcard/delete/{id}' , [LandHelpCardController::class , 'delete'])->name('landhelpcard.delete');
    Route::POST('landhelpcard/update/{id}' , [LandHelpCardController::class , 'update'])->name('landhelpcard.update');
    Route::POST('landhelpcard/store' , [LandHelpCardController::class , 'store'])->name('landhelpcard.store');

    Route::Get('landplan' , [LandPlanController::class , 'index'])->name('landplan');
    Route::Get('landplan/form' , [LandPlanController::class , 'form'])->name('landplan.form');
    Route::Get('landplan/delete/{id}' , [LandPlanController::class , 'delete'])->name('landplan.delete');
    Route::POST('landplan/update/{id}' , [LandPlanController::class , 'update'])->name('landplan.update');
    Route::POST('landplan/store' , [LandPlanController::class , 'store'])->name('landplan.store');

    Route::Get('landsaycard' , [LandSayCardController::class , 'index'])->name('landsaycard');
    Route::Get('landsaycard/form' , [LandSayCardController::class , 'form'])->name('landsaycard.form');
    Route::Get('landsaycard/delete/{id}' , [LandSayCardController::class , 'delete'])->name('landsaycard.delete');
    Route::POST('landsaycard/update/{id}' , [LandSayCardController::class , 'update'])->name('landsaycard.update');
    Route::POST('landsaycard/store' , [LandSayCardController::class , 'store'])->name('landsaycard.store');

    Route::Get('landaboutcard' , [LandAboutCardController::class , 'index'])->name('landaboutcard');
    Route::Get('landaboutcard/form' , [LandAboutCardController::class , 'form'])->name('landaboutcard.form');
    Route::Get('landaboutcard/delete/{id}' , [LandAboutCardController::class , 'delete'])->name('landaboutcard.delete');
    Route::POST('landaboutcard/update/{id}' , [LandAboutCardController::class , 'update'])->name('landaboutcard.update');
    Route::POST('landaboutcard/store' , [LandAboutCardController::class , 'store'])->name('landaboutcard.store');

    Route::Get('landslider' , [LandSliderController::class , 'index'])->name('landslider');
    Route::Get('landslider/form' , [LandSliderController::class , 'form'])->name('landslider.form');
    Route::Get('landslider/delete/{id}' , [LandSliderController::class , 'delete'])->name('landslider.delete');
    Route::POST('landslider/update/{id}' , [LandSliderController::class , 'update'])->name('landslider.update');
    Route::POST('landslider/store' , [LandSliderController::class , 'store'])->name('landslider.store');

    Route::Get('landsocial' , [LandSocialController::class , 'index'])->name('landsocial');
    Route::Get('landsocial/form' , [LandSocialController::class , 'form'])->name('landsocial.form');
    Route::Get('landsocial/delete/{id}' , [LandSocialController::class , 'delete'])->name('landsocial.delete');
    Route::POST('landsocial/update/{id}' , [LandSocialController::class , 'update'])->name('landsocial.update');
    Route::POST('landsocial/store' , [LandSocialController::class , 'store'])->name('landsocial.store');

});
