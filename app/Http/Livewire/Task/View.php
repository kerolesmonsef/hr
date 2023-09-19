<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class View extends Component
{

    protected Task $task;


    public $listeners = ['showTaskModal'];

    public function __construct()
    {
         $this->task = new Task();
    }


    public function render()
    {
        $task =  $this->task;
        return view('livewire.task.view',compact('task'));
    }

    public function showTaskModal($id)
    {
        
        $task = Task::with(['employees','activityLogs','activityLogs.user'])->find( $id );
        $this->task = $task;
        // $this->show = 'active';
    }

}
