<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $categories = Category::get();

            return view('category.index', compact('categories'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Employee'))
        {
            return view('category.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Employee'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                    'name_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $category             = new Category();
            $category->name       = $request->name;
            $category->name_ar    = $request->name_ar;
            $category->created_by = auth()->user()->creatorId();
            $category->save();

            return redirect()->route('category.index')->with('success', __('category  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Category $category)
    {
        return redirect()->route('category.index');
    }

    public function edit(Category $category)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($category->created_by == auth()->user()->creatorId())
            {
                return view('category.edit', compact('category'));
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

    public function update(Request $request, Category $category)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($category->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                       'name_ar' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $category->name    = $request->name;
                $category->name_ar = $request->name_ar;
                $category->save();

                return redirect()->route('category.index')->with('success', __('category successfully updated.'));
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

    public function destroy(Category $category)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            if($category->created_by == auth()->user()->creatorId())
            {
                $category->delete();

                return redirect()->route('category.index')->with('success', __('category successfully deleted.'));
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
