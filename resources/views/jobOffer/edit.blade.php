
{{Form::model($offer,array('route' => array('job-offers.update', $offer->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('title',__('Job Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title',$offer->title,array('class'=>'form-control  ' , 'required' => 'required'))}}
                @error('title')
                <span class="invalid-title" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('start_date',__('Start date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('start_date',$offer->start_date,array('class'=>'form-control datepicker flatpickr-input'))}}
                @error('start_date')
                <span class="invalid-start_date" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                {{Form::label('end_date',__('End date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::date('end_date',$offer->end_date,array('class'=>'form-control datepicker flatpickr-input'))}}
                @error('end_date')
                <span class="invalid-end_date" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
{{Form::close()}}

