<?php

namespace App\Http\Livewire\Event;

use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{
    private Event $event;
    public  $event_id = '';

    public $data = [
        'title' => '',
        'start_date' => '',
        'end_date' => '',
        'start_time' => '',
        'end_time' => '',
        'lectures' => '',
        'lectures' => '',
        'about' => '',
    ];


    protected $employees = [];

    public $listeners = ['editEventModal'];


    public function __construct()
    {
        $this->event = new Event();
    }


    public function editEventModal($id)
    {
        $event = Event::find($id);
        $this->event = $event;
        $this->data = [
            'title'          => $event->title,
            'start_date'     => $event->start_date->format('d/m/Y') ?? '',
            'end_date'       => $event->end_date->format('d/m/Y') ?? '',
            'start_time'              => $event->start_time ?? '',
            'end_time'              => $event->end_time ?? '',
            'lectures'  => $event->lectures ?? '',
            'location'  => $event->location ?? '',
            'about'      => $event->about ?? '',
            // 'employees' => $event->employees->pluck('id')->toArray() ?? '',
        ];

        $this->event_id = $id;
    }



    public function render()
    {
        return view('livewire.event.edit', [
            'event'         =>  $this->event,
        ]);
    }

    public function edit()
    {

        $data = $this->validate([
            'data.title'         => ['required', 'string', 'max:191'],
            'data.start_date'    => ['required'],
            'data.end_date'      => ['required'],
            'data.start_time'    => ['required'],
            'data.end_time'      => ['required'],
            'data.lectures'      => ['required', 'string'],
            'data.location'      => ['required', 'string'],
            'data.about'         => ['nullable', 'string'],
        ]);
        $this->data['start_date']                   = Carbon::createFromFormat('d/m/Y', ($this->data['start_date']));
        $this->data['end_date']                     = Carbon::createFromFormat('d/m/Y', ($this->data['end_date']));

        $event = tap(Event::find($this->event_id))->update($this->data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect(route('event.index'));
    }
}
