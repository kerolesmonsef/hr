@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')


<div class="card shadow-sm">

    <div class="card-body">
        <div class="py-5">
            <div class="table-responsive">
             <a href="{{ route('landpage.landfeature.form') }}" class="btn btn-primary " style="display: inline-block;">{{ __('landpage.Add') }}</a>
             <table class="table table-row-bordered table-row-gray-300 gy-7">
              <thead>
               <tr class="fw-bold fs-6 text-gray-800">
                <th>{{ __('landpage.#ID') }}</th>
                <th>{{ __('landpage.Plan') }}</th>
                <th>{{ __('landpage.English description') }}</th>
                <th>{{ __('landpage.Arabic description') }}</th>
                <th>{{ __('landpage.Actions') }}</th>
               </tr>
              </thead>
              <tbody>
                @foreach ($rows  as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <th>{{ $row->plan->type }} - {{  $row->plan->dateType }}</th>
                        <td>{{ $row->descriptionEn }}</td>
                        <td>{{ $row->descriptionAr }}</td>
                        <td>
                            <a href="{{ route('landpage.landfeature.form' , ['id' => $row->id]) }}" class="btn btn-icon btn-primary btn-sm"><i class="far fa-edit text-white"></i></a>
                            <a data-url="{{ route('landpage.landfeature.delete' , ['id' => $row->id]) }}" href="#" class="btn btn-icon btn-danger btn-sm confirm-btn-delete"><i class="fa-solid fa-trash text-white"></i></a>
                        </td>
                   </tr>
                @endforeach
              </tbody>
             </table>
             {!! $rows->links('pagination::bootstrap-4') !!}
            </div>
           </div>
    </div>
</div>
@endsection
