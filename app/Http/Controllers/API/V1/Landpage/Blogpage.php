<?php

namespace App\Http\Controllers\API\V1\Landpage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Landpage\BlogResource;
use App\Models\Landblog;
use App\Services\BlogPageService;
use App\Traits\ApiResponser;

class Blogpage extends Controller
{
    //
    use ApiResponser;
    protected BlogPageService $blogpageservice;
    public function __construct(BlogPageService $blogpageservice)
    {
        $this->blogpageservice = $blogpageservice;
    }
    public function index()
    {
        return $this->blogpageservice->getData();
    }
    public function show(Landblog $blog)
    {
        return $this->success(new BlogResource($blog), 'success');
    }
}
