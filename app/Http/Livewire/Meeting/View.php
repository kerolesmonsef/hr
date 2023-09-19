<?php

namespace App\Http\Livewire\Meeting;

use App\Models\Meeting;
use Livewire\Component;

class View extends Component
{
    protected Meeting $meeting;

    public $listeners = ['showModal'];

    public function __construct()
    {
         $this->meeting = new Meeting();
    }

    public function showModal($id)
    {
        $meeting = Meeting::with(['employees'])->find( $id );
        $this->meeting = $meeting;
        // $this->show = 'active';
    }
    

    public function render()
    {
       $meeting =  $this->meeting;

        return view('livewire.meeting.view',compact('meeting'));
    }
}
