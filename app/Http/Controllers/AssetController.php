<?php

namespace App\Http\Controllers;

use App\Exports\AssetsExport;
use App\Http\Requests\AssetRequest;
use App\Imports\AssetsImport;
use App\Models\Asset;
use App\Models\AssetsType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Assets-List', ['only' => ['index']]);
        $this->middleware('permission:Assets-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Assets-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Assets-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Assets-Export', ['only' => ['export']]);
        $this->middleware('permission:Assets-Print', ['only' => ['print']]);
    }

    public function index(Request $request)
    {
        $employees   = Employee::select('name','id')->get()->toArray();
        $assets_types = AssetsType::pluck('name','id')->toArray();

        $assets = Asset::query()->with('employee')
            ->when($request->filled('type'), function ($q) {
                $q->where('type', request('type'));
            })
            ->when($request->filled('search'), function ($q) {
                $q->where('name', 'like', "%" . request('search') . "%")
                    ->orWhere('serial_number', 'like', "%" . request('search') . "%")
                    ->orWhere('amount',  request('search'));
            })
            ->paginate();

        if ($request->ajax()) {
            $search   = view('new-theme.assets.assets', compact("assets", 'employees'));
            $paginate = view('new-theme.assets.paginate', compact("assets"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.assets.index', compact('assets', 'employees','assets_types'));
    }

    public function create(Request $request)
    {
        $employees = $request->employee ? Employee::where('id',$request->employee)->get() : Employee::get();
        $types     = AssetsType::get();
        return view('new-theme.assets.create', compact('employees','types'));
    }

    public function store(AssetRequest $request)
    {
        $data = $request->validated();
        $data['created_by']  = auth()->user()->creatorId();

        Asset::create($data);
        return redirect(route('account-assets.index'))->with('success', __('Assets successfully created.'));
    }

    public function edit(Request $request , $id)
    {
        $asset     = Asset::findorFail($id);
        $employees = $request->employee ? Employee::where('id',$request->employee)->pluck('name', 'id')->prepend(__('Select'),'') : Employee::pluck('name', 'id')->prepend(__('Select'),'');
        return view('new-theme.assets.edit', compact('employees','asset'));
    }

    public function update(AssetRequest $request, $id)
    {
        $asset = Asset::find($id);
        $asset->update($request->validated());
        return back()->with('success', __('Assets successfully updated.'));
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);
        if ($asset->created_by == auth()->user()->creatorId()) {
            $asset->delete();

            return back()->with('success', __('Assets successfully deleted.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function export()
    {
        $name = 'assets_' . date('Y-m-d i:h:s');
        $data = Excel::download(new AssetsExport(), $name . '.xlsx');
        if (ob_get_contents()) ob_end_clean();
        return $data;
    }

    public function importFile(Request $request)
    {
        return view('assets.import');
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

        $assets = (new AssetsImport())->toArray(request()->file('file'))[0];

        $totalassets = count($assets) - 1;
        $errorArray    = [];

        for ($i = 1; $i <= $totalassets; $i++) {
            $asset = $assets[$i];

            $assetsData = Asset::where('name', $asset[0])->where('purchase_date', $asset[1])->first();


            if (!empty($assetsData)) {
                $errorArray[] = $assetsData;
            } else {
                $asset_data = new Asset();
                $asset_data->name = $asset[0];
                $asset_data->purchase_date = $asset[1];
                $asset_data->supported_date = $asset[2];
                $asset_data->amount = $asset[3];
                $asset_data->description = $asset[4];
                $asset_data->created_by = auth()->user()->id;
                $asset_data->save();
            }
        }

        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        } else {

            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalassets . ' ' . 'record');


            foreach ($errorArray as $errorData) {
                $errorRecord[] = implode(',', $errorData->toArray());
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }
}
