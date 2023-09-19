    {{Form::model($complaint,array('route' => array('complaint.update', $complaint->id), 'method' => 'PUT')) }}
    <div class="row">
        @if(auth()->user()->type !='employee')
            <div class="form-group col-md-6 col-lg-6">
                {{ Form::label('complaint_from', __('Complaint From'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::select('complaint_from', $employees,null, array('class' => 'form-control  ','required'=>'required')) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('complaint_against',__('Complaint Against'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::select('complaint_against',$employees,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{Form::label('title',__('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('title',null,array('class'=>'form-control'))}}
        </div>
         <div class="form-group col-md-6 col-lg-6">
            {{Form::label('title_ar',__('Title_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('title_ar',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-md-12 col-lg-12">
            {{Form::label('complaint_date',__('Complaint Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('complaint_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Description arabic')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}

    <script>
        $(function () {
            $(".gregorian-date , .datepicker").flatpickr({
            format:'YYYY-M-D',
            showSwitcher: false,
            hijri:false,
            useCurrent: true,
            });
        });
    </script>
