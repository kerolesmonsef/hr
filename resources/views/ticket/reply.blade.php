@extends('layouts.admin')

@section('page-title')
    {{__('Ticket Reply')}}
@endsection

@section('content')

<div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
        <!--begin::Card-->
        <div class="card card-docs flex-row-fluid mb-2">
            <!--begin::Card Body-->
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                <!--begin::Section-->
                <div class="py-0">
                    <!--begin::Heading-->
                    <h1 class="fw-bold mb-5">{{__('Manage Ticket')}}</h1>

                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Primary button-->
                        @if(auth()->user()->type=='company' || $ticket->ticket_created == auth()->user()->id)
                        <a href="#" data-url="{{ URL::to('ticket/'.$ticket->id.'/edit') }}" data-ajax-popup="true"
                        data-title="{{__('Edit Ticket')}}" class="btn btn-sm fw-bold btn-primary">{{__('Edit')}}</a>
                        @endif
                        <!--end::Primary button-->
                    </div>

                    <!--end::Heading-->

                    <!--begin::Block-->
                    <div class="py-5">
                        <!--begin::Card-->
                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                            <!--begin::Card header-->
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">


                                <!--begin::Card body-->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($ticketreply as $reply)
                                                <div class="card">
                                                    <div class="card-header p-3">
                                                        <div class="d-flex justify-content-between w-100">
                                                            <h6 class="mb-0">{{!empty(auth()->user()->getUser($reply->created_by))?auth()->user()->getUser($reply->created_by)->name:'' }} </h6>
                                                            <small class="text-gray text-xs">{{$reply->created_at->diffForHumans()}}</small>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>{{ $reply->description }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($ticket->status=='open')
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header p-3">
                                                        <div class="d-flex justify-content-between w-100">
                                                            <h6 class="m-0">{{__('Add Reply')}}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        {{Form::open(array('url'=>'ticket/changereply','method'=>'post'))}}
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                                                    {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Ticket Reply')))}}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <input type="hidden" value="{{$ticket->id}}" name="ticket_id">
                                                                <input type="submit" value="{{__('Send')}}" class="btn btn-primary">
                                                            </div>
                                                        </div>
                                                        {{Form::close()}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Block-->
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Card Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>

@endsection

