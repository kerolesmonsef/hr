@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')


<div class="card shadow-sm">

    <div class="card-body">
        <div class="py-5">
            <div class="table-responsive">
             <a href="{{ route('landpage.blog.form') }}" class="btn btn-primary " style="display: inline-block;">{{ __('landpage.Add') }}</a>
             <table class="table table-row-bordered table-row-gray-300 gy-7">
              <thead>
               <tr class="fw-bold fs-6 text-gray-800">
                <th>{{ __('landpage.Icon') }}</th>
                <th>{{ __('landpage.English title') }}</th>
                <th>{{ __('landpage.English description') }}</th>
                <th>{{ __('landpage.Actions') }}</th>
               </tr>
              </thead>
              <tbody>
                @foreach ($rows  as $row)
                    <tr>
                        <td>
                            <a href="{{ $row->image != null ?  url('storage/'.$row->image) :  'icon'    }}">
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="{{ $row->image != null ?  url('storage/'.$row->image) :  'icon'    }}" alt="icon">
                                </div>
                            </a>
                        </td>
                        <td>{{ $row->titleEn }}</td>
                        <td>{{ substr($row->descriptionEn , 0, 40)  }}</td>
                        <td>
                            <a href="{{ route('landpage.blog.form' , ['id' => $row->id]) }}" class="btn btn-icon btn-primary btn-sm"><i class="far fa-edit text-white"></i></a>
                            <a data-url="{{ route('landpage.blog.delete' , ['id' => $row->id]) }}" href="#" class="btn btn-icon btn-danger btn-sm confirm-btn-delete"><i class="fa-solid fa-trash text-white"></i></a>
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
