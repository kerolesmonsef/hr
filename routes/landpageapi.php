<?php

use App\Http\Controllers\API\V1\Landpage\Aboutpage;
use App\Http\Controllers\API\V1\Landpage\Blogpage;
use App\Http\Controllers\API\V1\Landpage\ChatBot;
use App\Http\Controllers\API\V1\Landpage\ContactPage;
use App\Http\Controllers\API\V1\Landpage\DemoPage;
use App\Http\Controllers\API\V1\Landpage\FooterPage;
use App\Http\Controllers\API\V1\Landpage\Homepage;
use App\Http\Controllers\API\V1\Landpage\PlanPage;
use App\Http\Controllers\API\V1\Landpage\PrivacyPage;
use App\Http\Controllers\API\V1\Landpage\SeoPage;
use App\Http\Controllers\API\V1\Landpage\TermPage;
use Illuminate\Support\Facades\Route;

Route::group([], function() {
    Route::get('home-page', [Homepage::class , 'index']);
    Route::get('blog-page', [Blogpage::class , 'index']);
    Route::get('about-page', [Aboutpage::class , 'index']);
    Route::get('plan-page', [PlanPage::class , 'index']);
    Route::get('demo-page', [DemoPage::class , 'index']);
    Route::get('term-page', [TermPage::class , 'index']);
    Route::get('privacy-page', [PrivacyPage::class , 'index']);
    Route::get('contact-page', [ContactPage::class , 'index']);
    Route::get('blog/show/{blog}', [Blogpage::class , 'show']);
    Route::get('footer', [FooterPage::class , 'index']);
    Route::post('contact-form', [ContactPage::class , 'store']);
    Route::post('request-demo', [DemoPage::class , 'request_demo']);
    Route::get('seo' , [SeoPage::class , 'index']);
    Route::get('chatbot' , [ChatBot::class , 'index']);
});

