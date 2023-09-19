<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Landpage\Api\StoreForm;
use App\Mail\ContactLandPage;
use App\Models\Landsupportform;
use App\Services\ContactPageService;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Mail;

class ContactPage extends Controller
{
    //
    use ApiResponser;
    protected ContactPageService $contactpageservice;

    public function __construct(ContactPageService $contactpageservice)
    {
        $this->contactpageservice = $contactpageservice;
    }
    public function index(){
        return $this->contactpageservice->getData();
    }
    public function store(StoreForm $request){
        $data = $request->validated();
        Landsupportform::create($data);
        try {
            Mail::to('marketing@mwardi.com')->send(new ContactLandPage($data));
        } catch (\Exception $e) {
            $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
        }
        return $this->success([] , 'success');
    }
}
