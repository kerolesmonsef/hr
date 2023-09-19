<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class View extends Component
{

    protected Event $event;

    public $listeners = ['showEventModal'];


    public function __construct()
    {
         $this->event = new Event();
    }


    public function render()
    {
        $event =  $this->event;
        return view('livewire.event.view',compact('event'));
    }


    public function showEventModal($id)
    {
        $event = Event::find( $id );
        $this->event = $event;
        // $this->show = 'active';
    }
}
