<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Services\TaskService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{

    public  $task = '';
    public  $task_id = '';

    public $data = [
        'id'            => '',
        'name'          => '',
        'label'         => '',
        'start_date'    => '',
        'due_date'      => '',
        'status'        => '',
        'note'          => '',
    ];

    public    $members = [];
    public    $new_employees = [];
    public    $not_assigned_employees = [];

    // public    $activityLogs = [];


    public $listeners = ['updateTaskBoard', 'editTaskModal'];
    private TaskService $taskService;


    public function __construct()
    {
        $this->task = new Task();
        $this->taskService = new TaskService();
    }


    public function render()
    {
        return view('livewire.task.edit', [
            // 'task'                      => $this->task,
            // 'employees'                 => $this->task->employees,
            // 'not_assigned_employees'    => $this->task->getNonJoinedMembers()
        ]);
    }





    public function editTaskModal($id)
    {
        $this->new_employees = [];

        $task = Task::with(['employees'])->find($id);
        // $this->task = $task;
        $this->data = [
            'id'            => (string) $task->id,
            'name'          => $task->name,
            'label'         => $task->label,
            'start_date'    => $task->start_date->format('d/m/Y') ?? '',
            'due_date'      => $task->due_date->format('d/m/Y') ?? '',
            'status'        => (string) $task->status,
            'note'          => $task->note ?? '',
        ];
        $this->members =  $task->employees->pluck('name', 'id')->toArray() ?? [];
        $this->not_assigned_employees = $task->getNonJoinedMembers();
        // $this->activityLogs = $task->activityLogs;

        $this->task_id = (string) $id;
    }

    public function deleteMember($member_id, $task_id)
    {
        $task = Task::find($task_id);
        $task->employees()->detach($member_id);
        $this->members =  $task->employees()->get()->pluck('name', 'id')->toArray() ?? [];
        flash(__('member removed from task successfully'));
    }

    public function addMember()
    {
        $this->new_employees[] = [];
    }

    public function assignMember($index)
    {

        $this->validate([
            'new_employees'     => 'required',
            'new_employees.*'   => 'required|integer',
        ]);
        $employee_id = $this->new_employees[$index];
        $task = Task::with(['employees'])->find($this->task_id);
        $task->employees()->attach($employee_id);
        unset($this->new_employees[$index]);
        // $this->new_employees = $this->new_employees;
        $this->members =  $task->employees()->get()->pluck('name', 'id')->toArray() ?? [];
        flash(__('member added to task successfully'));
    }

    public function removeKey($index)
    {
        unset($this->new_employees[$index]);
    }


    public function updateTaskBoard($id, $status, $priority)
    {
        if($this->taskService->updateTaskBoard($id, $status, $priority)){
            return flash(__('Updated successfully '));
        }
        return flash(__('Error'), 'error');
    }


    public function edit($id)
    {
        $data = $this->validate([
            'data.name'              => ['required', 'string', 'max:191'],
            'data.label'             => ['required', 'string', 'max:191'],
            'data.start_date'        => 'required|date_format:d/m/Y',
            'data.due_date'          => 'required|date_format:d/m/Y',
            'data.status'            => 'required',
            'data.note'              => 'nullable|string',
        ]);

        $this->data['start_date']         = Carbon::createFromFormat('d/m/Y', $this->data['start_date']);
        $this->data['due_date']           = Carbon::createFromFormat('d/m/Y', $this->data['due_date']);
        $this->data['status']             =(int)  $this->data['status'];

        $task = Task::find($id);
        $old_status = $task->status;
        $task->update($this->data);
        if( $task->status !=  $old_status  ){
            $task->activityLogs()->create([
                'employee_id'   => auth()->id(),
                'description'   => $this->data['status'],
            ]);
        }

        flash()->addSuccess(__('Updated successfully'));

        if( request('view') == 'grid' ){
            return redirect(route('get.tasks.grid'));

        }
        return redirect(route('tasks.index'));
    }
}
