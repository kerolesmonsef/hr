<?php

namespace App\Http\Controllers;

use App\Models\JobOfferUser;
use App\Services\JobOfferService;
use Illuminate\Http\Request;

class JobOfferUserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = JobOfferUser::findOrFail($id);

        $user->update([
            'is_seen' => 1
        ]);

        $user->load("job_offer.sections.questions.options");
        $offerService = app(JobOfferService::class);

        return view('new-theme.job-offers.show_job_offer_answer', compact('user', 'offerService'));
    }

    public function update(Request $request, $id)
    {
        $user = JobOfferUser::findOrFail($id);
        //  the to_date must be after from_date
        request()->validate([
            'interview_from' => 'nullable|date',
            'interview_to' => 'required_with:interview_from|date|after:interview_from',
        ]);

        $user->update(request()->all());
        return redirect()->back()->with('success', 'Updated successfully');
    }
}
