<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Resources\TaskActivityLogResource;
use App\Http\Resources\TaskResource;
use App\Models\Employee;
use App\Models\Task;
use App\Services\TaskService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaskController extends Controller
{

    private TaskService $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }


    public function index()
    {

        $employee = Employee::where('user_id', auth()->id())->first();
        $tasks = $employee->tasks()->with(['employees'])->orderBy('priority')->get();
        foreach (Task::getStatuses() as $status) {
            $boards[] = [
                'id' => $status,
                'title' => __('task_status_' . $status),
                'tasks' =>  TaskResource::collection( $tasks->where('status', $status)),
            ];
        }

        return $this->success([
            'task_status' => $this->getTasksStatus($employee),
            'boards' => $boards

        ], '');

    }


    public function MangerTasks()
    {

        $employee = Employee::where('user_id', auth()->id())->first();
        $sub_employees_ids = $employee->subEmployees()->pluck('id')->toArray();

        $tasks = Task::with(['employees','activityLogs','activityLogs.employee'])->whereHas('employees',function($q)use($sub_employees_ids){
            $q->whereIn('employees.employee_id',$sub_employees_ids);
        })->orderBy('priority')->get();

        foreach (Task::getStatuses() as $status) {
            $boards[] = [
                'id' => $status,
                'title' => __('task_status_' . $status),
                'tasks' =>  TaskResource::collection( $tasks->where('status', $status)),
            ];
        }
        return $this->success([
            'task_status' => $this->getTasksStatus($employee),
            'boards' => $boards

        ], '');

    }

    public function show($id)
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $task  = $employee->tasks()->with(['employees','activityLogs','activityLogs.employee'])->where('tasks.id',$id)->firstOrFail();
        return $this->success([
            'task' => new TaskResource($task),
        ], '');
    }

    public function activityLogs($id)
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $task  = $employee->tasks()->with(['activityLogs','activityLogs.user.employee'])->where('tasks.id',$id)->firstOrFail();
        return $this->success([
            'logs' =>  TaskActivityLogResource::collection($task->activityLogs),
        ], '');
    }



    public function updateTaskBoard(Request $request)
    {

        $request->validate([
            'task_id'       => 'required|exists:tasks,id',
            'status'        => 'required|in:1,2,3',
            'priority'      => 'required|numeric'
        ]);


        $employee = Employee::where('user_id', auth()->id())->first();
        $task = $employee->tasks()->where('tasks.id',$request->task_id)->first();

        if( empty($task) )  // if
        return $this->error('',403);


        if($this->taskService->updateTaskBoard($request->task_id, $request->status, $request->priority)){
            return $this->success([], __('Updated successfully'));
        }

        return $this->error('some thing went wrong',500);

    }


    private function getTasksStatus(Employee $employee): array
    {
        $tasks = $employee->tasks;
        $tasks_total_count = $tasks->count() ?: 1 ;

        $boards = [];
        foreach (Task::getStatuses() as $status) {
            $current_status_count = $tasks->where('status', $status)->count();
            $boards[] = [
                'title' => __('task_status_' . $status),
                'id'    => $status,
                'tasks_count' => $current_status_count,
                'precentage' => ($current_status_count * 100) / $tasks_total_count ,
            ];
        }

        return $boards;
    }


    public function store(StoreTaskRequest $request)
    {
        $data = Arr::except($request->validated(), 'employees');
        $data['created_by']         = auth()->id();
        $data['start_date']         = Carbon::createFromFormat('d/m/Y', $request->start_date);
        $data['due_date']           = Carbon::createFromFormat('d/m/Y', $request->due_date);
        $task = Task::create($data);
        $task->employees()->sync($request->employees);
        return $this->success(__('Added successfully'));
    }

    public function update(StoreTaskRequest $request,$id)
    {

        $data = Arr::except($request->validated(), 'employees');
        $data['created_by']         = auth()->id();
        $data['start_date']         = Carbon::createFromFormat('d/m/Y', $request->start_date);
        $data['due_date']           = Carbon::createFromFormat('d/m/Y', $request->due_date);

        $employee = Employee::where('user_id', auth()->id())->first();
        $sub_employees = $employee->subEmployees()->pluck('id')->push($employee->id)->toArray();

        $task = Task::whereHas('employees', function ($query) use ($sub_employees) {
            $query->whereIn('employees.id', $sub_employees);
        })->where('id',$id)->first();

        if( empty($task) )  // if
        return $this->error('',403);

        $task->update($data);
        $task->employees()->sync($request->employees);
        return $this->success(__('Updated successfully'));

    }


    public function destroy(Task $task )
    {
        if(  !auth()->user()->employee->isManger() )  // if
        return $this->error('',403);

        $task->delete();
        return $this->success(__('Deleted successfully'));

    }





}
