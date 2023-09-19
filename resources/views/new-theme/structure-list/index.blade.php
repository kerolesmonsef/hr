@extends('new-theme.layout.layout1', [])

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />
@endpush

@section('content')
    <div class="Page">
        <div class="pageS1">
            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <div class="search p-0 m-0">
                        <div class="inputS1">
                            <input type="text" placeholder="@lang('Search')....">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                    fill="#D9D9D9"></path>
                                <path
                                    d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                    fill="#D9D9D9"></path>
                                <path
                                    d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                    fill="#D9D9D9"></path>
                                <path
                                    d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                    fill="#D9D9D9"></path>
                            </svg>
                        </div>
                    </div>

                    <button class='buttonS1 primary' data-bs-toggle="modal" data-bs-target="#addNewStructure">
                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                fill="white" />
                        </svg>
                        @lang('Add New')
                    </button>
                </div>

                <div class="tableS1 scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($CompanyStructures as $structureList)
                                <?php 
                                    $numberOfRows = DB::table('company_structures')->where('structure_key',$structureList->structure_key)->count();
                                ?>
                                <tr>
                                    <td>{{ $structureList->{'name' . $lang} }}</td>
                                    <td>
                                        <div class='action flex gap-3'>
                                            <div data-bs-toggle="modal"
                                                data-bs-target="#editStructure-{{ $structureList->id }}">
                                                <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                                            </div>
                                            <div data-bs-toggle="modal" data-bs-target="#delete-{{ $structureList->id }}">
                                                <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                                                    alt="" />
                                            </div>
                                        </div>
                                        @include('new-theme.structure-list.components.editStructureModel')
                                        @include('new-theme.structure-list.components.deleteStructureModel')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>


            <!-- Add New Branch Modal -->
            <div class="modal fade customeModal" id="addNewStructure" tabindex="-1" aria-labelledby="addNewStructureLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            {{Form::open(array('url'=>'companystructure','class' => 'formS1','method'=>'post'))}}
                            <div class="sectionS2">
                                <div class="head withBorder flex align between">
                                    <h3 class="small">{{__('Add New')}}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="content">

                                    <div class="col-12">
                                        <label for="paymentType" class="form-label">{{__('Structure list')}}</label>
                                        <div class="inputS1">
                                            <select name="parent">
                                                <option value="">{{__('Main')}}</option>
                                                @foreach($CompanyStructures as $structure)
                                                    <option value="{{$structure->id}}">{{$structure['name'.$lang]}}</option>
                                                @endforeach
                                            </select>
                                            @include('new-theme.components.error1',['error' => 'parent'])
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            {{Form::label('name_ar',__('Name_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                            {{Form::text('name_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Name arabic')))}}
                                            @include('new-theme.components.error1',['error' => 'name_ar'])
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            {{Form::label('name',__('Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                                            @include('new-theme.components.error1',['error' => 'name'])
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            {{Form::label('numberOfRows',__('Number Of Rows'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                            {{Form::text('numberOfRows','1',array('class'=>'form-control','placeholder'=>__('Enter Number')))}}
                                            @include('new-theme.components.error1',['error' => 'numberOfRows'])
                                        </div>
                                    </div>
                                    

                                    <div class="flex align end gap-15 mt-5 mb-4">
                                        <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                            {{__('Cancel')}}
                                        </button>
                                        <button class="buttonS1 primary" type="submit">
                                            {{__('Save')}}
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
