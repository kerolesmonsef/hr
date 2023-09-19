<?php

namespace App\Http\Controllers;

use App\Filters\TaskFilter;
use App\Http\Requests\NewTheme\StoreTaskRequest;
use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TaskController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Task-List', ['only' => ['index']]);
        $this->middleware('permission:Task-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Task-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Task-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Task-Print', ['only' => ['print']]);
    }

    public function index(Request $request)
    {
        $tasks = (new TaskFilter($request))->apply(Task::query())->paginate(10);

        if ($request->ajax()) {
            $search   = view('new-theme.tasks.tasks-table', compact("tasks"));
            $paginate = view('new-theme.tasks.tasks-paginate', compact("tasks"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }


        $employees = Employee::get()->pluck('name', 'id');
        return view('new-theme.tasks.index', compact('tasks', 'employees'));
    }

    public function kanban(Request $request)
    {

        $tasks = (new TaskFilter($request))->apply(Task::query())->orderBy('priority')->paginate(30);

        $boards = [];
        foreach (Task::getStatuses() as $status) {

            $boards[] = [
                'id' => "$status",
                'title' => __('task_status_' . $status),
                'class' =>  __('task_status_classes_' . $status, [], 'en'),
                'order' => 0,
                'item' => $tasks->where('status', $status)->map(function ($task) {
                    $taskEmployees = '';
                    foreach ($task->employees as $employee) {
                        $taskEmployees .= '<img src="/new-theme/images/person.png" alt="' . $employee->name . '" title="' . $employee->name . '">';
                    }
                    return [
                        'title' => '<div class="taskCard get-data" data-id="' . $task->id . '" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
                            <div class="categorey">' . $task->label . '</div>
                            <h4 class="title">' . $task->name . '</h4>
                            <p class="date"> ' . __('Last Edit')  . $task->updated_at->diffForHumans() . '</p>
                            <div class="persons flex align gap-2 scroll">
                            ' . $taskEmployees . '
                            </div>
                        </div>'
                    ];
                })->toArray(),
            ];
        }

        if ($request->ajax()) {
            $search   = view('new-theme.tasks.kanban', compact("tasks",'boards'));
            $paginate = view('new-theme.tasks.tasks-paginate', compact("tasks"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }


        $employees = Employee::get()->pluck('name', 'id');
        return view('new-theme.tasks.grid', compact('employees', 'boards','tasks'));
    }


    public function create()
    {
        $employees = Employee::get()->pluck('name', 'id');
        return view('new-theme.tasks.create', compact('employees'));
    }



    public function store(StoreTaskRequest $request)
    {
        $data = Arr::except($request->validated(), 'employees');
        $data['created_by']         = auth()->id();
        $data['start_date']         = Carbon::createFromFormat('d/m/Y', $request->start_date);
        $data['due_date']           = Carbon::createFromFormat('d/m/Y', $request->due_date);

        $task = Task::create($data);
        $task->employees()->sync($request->employees);

        if( request('view') == 'grid' ){
            return redirect()->route('get.tasks.grid')->with('success', __('created successfully'));
        }

        return redirect()->route('tasks.index')->with('success', __('created successfully'));
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', __('Deleted successfully'));
    }
}
