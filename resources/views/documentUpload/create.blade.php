    {{Form::open(array('url'=>'document-upload','method'=>'post', 'enctype' => "multipart/form-data"))}}
    {{ Form::hidden('employee_id',$employeeId, array()) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select required class="form-control" name="document_id" id="document_id" placeholder="{{ __('Select document type') }}">
                    <option value="">{{__('Select document type')}}</option>
                    @foreach($documents as $document)
                        <option value="{{ $document->id }}">{{ app()->isLocale('en') ?  $document->name : $document->name_ar }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <select required class="form-control" name="employee_id" id="employee_id" placeholder="{{ __('Select employee') }}">
                    <option value="">{{__('Select employee')}}</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('exp_date',__('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('exp_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            {{Form::label('document',__('Document'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            <div class="choose-file form-group">
                <label for="document" class="form-control-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="document[]" multiple id="document" data-filename="document_create" required>
                </label>
                <p class="document_create"></p>
            </div>
        </div>
        <div class="col-md-6 mt-6">
            <div class="form-group">
                {{Form::label('role',__('Role'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('role',$roles,null,array('class'=>'form-control'))}}
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', __('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::textarea('description',null, array('class' => 'form-control')) }}
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
