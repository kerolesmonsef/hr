<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:News-List', ['only' => ['index']]);
        $this->middleware('permission:News-Create', ['only' => ['create','store']]);
        $this->middleware('permission:News-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News-Delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datePickerRange = explode(' to ', $request->datePickerRange);
        $startDate       = $datePickerRange[0] ?? now()->format('Y-m-d');
        $endDate         = $datePickerRange[1] ?? now()->format('Y-m-d');

        $news = News::query()->when($request->filled('search'), function ($q) {
            $q->where('title', 'like', "%" . request('search') . "%");
        })->when(request('datePickerRange'), function ($q) use($startDate) {
                $q->where('date','>=',$startDate);
        })->when(request('datePickerRange'), function ($q) use($endDate) {
            $q->where('end_date','<=',$endDate);
        })->get();

        if($request->ajax()) {
            $search   = view('new-theme.news.news-data', compact("news"));
            return response()->json(['search' => $search->render()]);
        }
        return view('new-theme.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->edit(new News());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\NewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
       $date = explode(' to ', $request->get('date'));
      // dd($date);
        News::query()->create(array_merge($request->validated(), [
            'photo'    => FileHelper::upload_file('news', $request->file('photo')),
            'logo'     => FileHelper::upload_file('news', $request->file('logo')),
            'date'     => $date[0],
            'end_date' => $date[1]
        ]));

        return redirect()->route("news.index")->with("success", __("Created Successfully"));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return $this->edit($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('new-theme.news.create', [
            'new'=>$news
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, News $news)
    {

        $news->update(array_merge($request->validated(), [
            'photo' => $request->file('photo') ? FileHelper::upload_file('news', $request->file('photo')) : $news->photo,
            'logo' => $request->file('logo') ? FileHelper::upload_file('news', $request->file('logo')) : $news->logo,
            'date' => back_date($request->get('date'))
        ]));

        return redirect()->route("news.index")->with("success", __("Updated Successfully"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\News $new
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route("news.index")->with("success", __("Deleted Successfully"));
    }
}
