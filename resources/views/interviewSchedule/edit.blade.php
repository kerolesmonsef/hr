    {{Form::model($interviewSchedule,array('route' => array('interview-schedule.update', $interviewSchedule->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('candidate',__('Interviewer'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{ Form::select('candidate', $candidates,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('employee',__('Assign Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{ Form::select('employee', $employees,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('date',__('Interview Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('time',__('Interview Time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('time',null,array('class'=>'form-control timepicker'))}}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('comment',__('Comment'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('comment',null,array('class'=>'form-control'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
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

