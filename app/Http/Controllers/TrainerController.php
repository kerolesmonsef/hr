<?php

namespace App\Http\Controllers;

use App\Exports\TrainerExport;
use App\Imports\TrainerImport;
use App\Models\Branch;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TrainerController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Trainer'))
        {
            $trainers = Trainer::get();

            return view('trainer.index', compact('trainers'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if(auth()->user()->can('Create Trainer'))
        {
            $branches = Branch::get()->pluck('name', 'id');

            return view('trainer.create', compact('branches'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Trainer'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'firstname' => 'required',
                                   'lastname' => 'required',
                                   'firstname_ar' => 'required',
                                   'lastname_ar' => 'required',
                                   'contact' => 'required',
                                   'email' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $trainer             = new Trainer();
            $trainer->branch     = $request->branch;
            $trainer->firstname  = $request->firstname;
            $trainer->lastname   = $request->lastname;
            $trainer->firstname_ar  = $request->firstname_ar;
            $trainer->lastname_ar   = $request->lastname_ar;
            $trainer->contact    = $request->contact;
            $trainer->email      = $request->email;
            $trainer->address    = $request->address;
            $trainer->expertise  = $request->expertise;
            $trainer->created_by = auth()->user()->creatorId();
            $trainer->save();

            return redirect()->route('trainer.index')->with('success', __('Trainer  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(Trainer $trainer)
    {
        return view('trainer.show', compact('trainer'));
    }


    public function edit(Trainer $trainer)
    {
        if(auth()->user()->can('Edit Trainer'))
        {
            $branches = Branch::get()->pluck('name', 'id');

            return view('trainer.edit', compact('branches', 'trainer'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function update(Request $request, Trainer $trainer)
    {
        if(auth()->user()->can('Edit Trainer'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'firstname' => 'required',
                                   'lastname' => 'required',
                                   'firstname_ar' => 'required',
                                   'lastname_ar' => 'required',
                                   'contact' => 'required',
                                   'email' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $trainer->branch    = $request->branch;
            $trainer->firstname = $request->firstname;
            $trainer->lastname  = $request->lastname;
            $trainer->firstname_ar = $request->firstname_ar;
            $trainer->lastname_ar  = $request->lastname_ar;
            $trainer->contact   = $request->contact;
            $trainer->email     = $request->email;
            $trainer->address   = $request->address;
            $trainer->expertise = $request->expertise;
            $trainer->save();

            return redirect()->route('trainer.index')->with('success', __('Trainer  successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy(Trainer $trainer)
    {
        if(auth()->user()->can('Delete Trainer'))
        {
            if($trainer->created_by == auth()->user()->creatorId())
            {
                $trainer->delete();

                return redirect()->route('trainer.index')->with('success', __('Trainer successfully deleted.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
    public function export()
    {
        $name = 'trainer_' . date('Y-m-d i:h:s');
        $data = Excel::download(new TrainerExport(), $name . '.xlsx');
        if(ob_get_contents()) ob_end_clean();

        return $data;
    }
    public function importFile(Request $request)
    {
        return view('trainer.import');
    }
    public function import(Request $request)
    {

        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];
        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $trainer = (new TrainerImport())->toArray(request()->file('file'))[0];

        $totaltrainer = count($trainer) - 1;
        $errorArray    = [];

        for($i=1;$i<=$totaltrainer;$i++)
        {
            $trainers = $trainer[$i];

            $trainersData=Trainer::where('email',$trainers[4])->first();


            if(!empty($trainersData))
            {
                $errorArray[]=$trainersData;
            }
            else
            {
                $trainer_data=new Trainer();
                $getBranchId = Branch::where('name', $trainers[0])->first();
                $trainer_data->branch=$getBranchId->id;
                $trainer_data->firstname=$trainers[1];
                $trainer_data->lastname=$trainers[2];
                $trainer_data->contact=$trainers[3];
                $trainer_data->email=$trainers[4];
                $trainer_data->address=$trainers[5];
                $trainer_data->expertise=$trainers[6];
                $trainer_data->created_by=auth()->user()->id;
                $trainer_data->save();

            }
        }

        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        } else {

            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totaltrainer . ' ' . 'record');


            foreach ($errorArray as $errorData) {
                $errorRecord[] = implode(',', $errorData->toArray());
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }


}