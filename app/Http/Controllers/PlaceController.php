<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Employee;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Branch'))
        {
            $places = Place::get();
            return view('places.index', compact('places'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Branch'))
        {
            return view('places.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Branch'))
        {
            $validator = \Validator::make(
            $request->all(),
            [
                'name'        => 'required',
                'name_ar'     => 'required',
            ]);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $place                = new Place();
            $place->name          = $request->name;
            $place->name_ar       = $request->name_ar;
            $place->lat           = $request->lat;
            $place->lon           = $request->lon;
            $place->created_by    = auth()->user()->creatorId();
            $place->save();

            return redirect()->route('place.index')->with('success', __('Location  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Place $place)
    {
        return redirect()->route('places.index');
    }

    public function edit(Place $place)
    {
        if(auth()->user()->can('Edit Branch'))
        {
            if($place->created_by == auth()->user()->creatorId())
            {
                return view('places.edit', compact('place'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Place $place)
    {
        //dd($request->all());
        if(auth()->user()->can('Edit Branch'))
        {
            if($place->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'name'        => 'required',
                        'name_ar'     => 'required',
                    ]);
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $place->name          = $request->name;
                $place->name_ar       = $request->name_ar;
                $place->lat           = $request->lat;
                $place->lon           = $request->lon;
                $place->save();

                return redirect()->route('place.index')->with('success', __('Location successfully updated.'));
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

    public function destroy(Place $place)
    {
        if(auth()->user()->can('Delete Branch'))
        {
            if($place->created_by == auth()->user()->creatorId())
            {
                $place->delete();
                return redirect()->route('place.index')->with('success', __('Location successfully deleted.'));
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

}
