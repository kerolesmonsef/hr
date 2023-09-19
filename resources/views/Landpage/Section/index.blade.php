@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="py-5">
            <div class="table-responsive">
             <table class="table table-row-bordered table-row-gray-300 gy-7">
              <thead>
               <tr class="fw-bold fs-6 text-gray-800">
                <th>{{ __('landpage.#ID') }}</th>
                <th>{{ __('landpage.Sections')}}</th>
                <th>{{ __('landpage.Title') }}</th>
                <th>{{ __('landpage.Description') }}</th>
                <th>{{ __('landpage.Icon') }}</th>
                <th>{{ __('landpage.Actions') }}</th>
               </tr>
              </thead>
              <tbody>
                @foreach ($rows  as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->key }}</td>
                        <td> {{ $row->titleEn ? $row->titleEn : '-' }}</td>
                        <td> {{ $row->descriptionEn ? substr( $row->descriptionEn ,0, 40 ) : '-' }}</td>
                        <td>
                            @if($row->image != null && in_array($row->key , ['getTouchSection','homeSection','useSection','helpSection','aboutSection','demoSection']))
                            <a href="{{ url('storage/'.$row->image) }}">
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="{{ url('storage/'.$row->image) }}" alt="user">
                                </div>
                            </a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('landpage.section.form' , ['id' => $row->id]) }}" class="btn btn-icon btn-primary btn-sm"><i class="far fa-edit text-white"></i></a>
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
