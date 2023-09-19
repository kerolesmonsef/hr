
{{Form::model($RequestType,array('route' => array('request_types.update', $RequestType->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::hidden('parent',$RequestType->parent,array('class'=>'form-control','placeholder'=>__('Enter parent')))}}
                {{Form::label('title',__('title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title',$RequestType->title,array('class'=>'form-control'))}}
                @error('title')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                {{Form::label('title_ar',__('Name_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title_ar',$RequestType->title_ar,array('class'=>'form-control'))}}
                @error('title_ar')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('maxDays',__('Max days'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('maxDays',$RequestType->maxDays,array('class'=>'form-control','min' => 0))}}
                @error('number')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('maxDaysPerMonth',__('Max days per month'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('maxDaysPerMonth',$RequestType->maxDaysPerMonth,array('class'=>'form-control','min' => 0))}}
                @error('maxDaysPerMonth')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('afterMaxHour',__('Apply after max hour'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('afterMaxHour',$RequestType->afterMaxHour,array('class'=>'form-control','min' => 0))}}
                @error('afterMaxHour')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('daysBeforeApply',__('Number days before apply'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('daysBeforeApply',$RequestType->daysBeforeApply,array('class'=>'form-control'))}}
                @error('daysBeforeApply')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('deduction',__('Deduction percent'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('deduction',$RequestType->deduction,array('class'=>'form-control','min' => 0 ,'step' => 0.01))}}
                @error('deduction')
                <span class="invalid-name" role="alert">
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

