<?php

namespace App\Http\Livewire\Meeting;

use App\Models\Employee;
use App\Models\Meeting;
use Carbon\Carbon;
use Livewire\Component;

class Edit extends Component
{

    private Meeting $meeting;
    public  $meeting_id = '';

    public $data = [
        'title' => '',
        'date' => '',
        'time' => '',
        'duration' => '',
        'location' => '',
        'note' => '',
        // 'employees' => '',
    ];

    protected $employees = [];

    public $listeners = ['editModal'];


    public function __construct()
    {
        $this->meeting = new Meeting();
    }


    public function editModal($id)
    {
        $meeting = Meeting::with(['employees'])->find($id);
        $this->meeting = $meeting;
        $this->data = [
            'title'     => $meeting->title,
            'date'      => $meeting->date->format('d/m/Y') ?? '',
            'time'      => $meeting->time ?? '',
            'duration'  => $meeting->duration ?? '',
            'location'  => $meeting->location ?? '',
            'note'      => $meeting->note ?? '',
            // 'employees' => $meeting->employees->pluck('id')->toArray() ?? '',
        ];

        $this->employees =  $meeting->employees->pluck('id')->toArray() ?? '';
        $this->meeting_id = $id;
    }



    public function render()
    {
        return view('livewire.meeting.edit', [
            'all_employees' => Employee::get()->pluck('employee_name', 'id'),
            'meeting'       =>  $this->meeting,
            'employees'     =>  $this->employees ?? [],
        ]);
    }

    public function edit()
    {

        $data = $this->validate([
            'data.title' => ['required', 'string', 'max:191'],
            'data.date' => ['required'],
            'data.time' => ['required'],
            'data.duration' => ['required', 'string'],
            'data.location' => ['required', 'string'],
            'data.note' => ['nullable', 'string'],

            'data.employee_id' => ['required', 'array'],
            'data.employee_id.*' => ['required', 'exists:employees,id'],
        ]);
        $employees = $this->data['employee_id'];
        $this->data['employee_id']            = json_encode($employees);
        $this->data['date']                   = Carbon::createFromFormat('d/m/Y', ($this->data['date']));
        $meeting = tap(Meeting::find($this->meeting_id))->update($this->data);
        $meeting->employees()->syncWithPivotValues($employees,['created_by' => auth()->user()->creatorId() ]);
        flash()->addSuccess(__('Updated successfully'));
        return redirect(route('meeting.index'));
    }
}
