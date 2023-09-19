<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\TrainingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Imports\TrainingImport;
use App\Exports\TrainingExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{

    public function index()
    {
        if (auth()->user()->can('Manage Training')) {
            $trainings = Training::get();
            $status    = Training::$Status;

            return view('training.index', compact('trainings', 'status'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if (auth()->user()->can('Create Training')) {
            $branches      = Branch::get()->pluck('name', 'id');
            $trainingTypes = TrainingType::get()->pluck('name', 'id');
            $trainers      = Trainer::get()->pluck('firstname', 'id');
            $employees     = Employee::get()->pluck('name', 'id');
            $options       = Training::$options;

            return view('training.create', compact('branches', 'trainingTypes', 'trainers', 'employees', 'options'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {

        if (auth()->user()->can('Create Training')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'training_type' => 'required',
                    'training_cost' => 'required',
                    'employee' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $training                 = new Training();
            $training->branch         = $request->branch;
            $training->trainer_option = $request->trainer_option;
            $training->training_type  = $request->training_type;
            $training->trainer        = $request->trainer;
            $training->training_cost  = $request->training_cost;
            $training->employee       = $request->employee;
            $training->start_date     = $request->start_date;
            $training->end_date       = $request->end_date;
            $training->description    = $request->description;
            $training->description_ar    = $request->description_ar;
            $training->created_by     = auth()->user()->creatorId();
            $training->save();

            return redirect()->route('training.index')->with('success', __('Training successfully created.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show($id)
    {
        $traId       = Crypt::decrypt($id);
        $training    = Training::find($traId);
        $performance = Training::$performance;
        $status      = Training::$Status;

        return view('training.show', compact('training', 'performance', 'status'));
    }


    public function edit(Training $training)
    {
        if (auth()->user()->can('Create Training')) {
            $branches      = Branch::get()->pluck('name', 'id');
            $trainingTypes = TrainingType::get()->pluck('name', 'id');
            $trainers      = Trainer::get()->pluck('firstname', 'id');
            $employees     = Employee::get()->pluck('name', 'id');
            $options       = Training::$options;

            return view('training.edit', compact('branches', 'trainingTypes', 'trainers', 'employees', 'options', 'training'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function update(Request $request, Training $training)
    {
        if (auth()->user()->can('Edit Training')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'training_type' => 'required',
                    'training_cost' => 'required',
                    'employee' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $training->branch         = $request->branch;
            $training->trainer_option = $request->trainer_option;
            $training->training_type  = $request->training_type;
            $training->trainer        = $request->trainer;
            $training->training_cost  = $request->training_cost;
            $training->employee       = $request->employee;
            $training->start_date     = $request->start_date;
            $training->end_date       = $request->end_date;
            $training->description    = $request->description;
            $training->description_ar    = $request->description_ar;
            $training->save();

            return redirect()->route('training.index')->with('success', __('Training successfully updated.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy(Training $training)
    {
        if (auth()->user()->can('Delete Training')) {
            if ($training->created_by == auth()->user()->creatorId()) {
                $training->delete();

                return redirect()->route('training.index')->with('success', __('Training successfully deleted.'));
            } else {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function export()
    {
        $name = 'training_' . date('Y-m-d i:h:s');
        $data = Excel::download(new TrainingExport(), $name . '.xlsx');
        if(ob_get_contents()) ob_end_clean();

        return $data;
    }

    public function updateStatus(Request $request)
    {
        $training              = Training::find($request->id);
        $training->performance = $request->performance;
        $training->status      = $request->status;
        $training->remarks     = $request->remarks;
        $training->save();

        return redirect()->route('training.index')->with('success', __('Training status successfully updated.'));
    }
}
