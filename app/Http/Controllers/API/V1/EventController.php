<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Controller;
use App\Http\Resources\EventResource;
use App\Mail\sendemail;
use App\Models\Employee;
use App\Models\Event;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{

    use ApiResponser;

    public function join($event_id){
        $event = Event::findorfail($event_id);
        if(!$event->employees->contains(auth()->user()->employee->id)){
            $event->employees()->attach([auth()->user()->employee->id]);
        }
        return $this->success(__('Joined successfully'));
    }

    public function unjoin($event_id){
        $event = Event::findorfail($event_id);
        if($event->employees->contains(auth()->user()->employee->id)){
            $event->employees()->detach([auth()->user()->employee->id]);
        }
        return $this->success(__('Un Joined successfully'));
    }

    public function index(Request $request)
    {
        $events = Event::query()->when($request->filled('search'), function ($q) {
            return $q->where('title', 'like', '%' . request('search') . '%');
        })->get();
        $upcoming_events = $events->where('start_date', '>=', now());
        $past_events = $events->where('start_date', '<', now());

        return $this->success([
            'upcoming_events' => EventResource::collection($upcoming_events),
            'past_events'     => EventResource::collection($past_events),
        ], '');
    }

    public function noted(Request $request)
    {
        Event::where('id', $request->id)->update(['noted' => 1]);
        return $this->success('', __('messages.data_updated'));
    }

}
