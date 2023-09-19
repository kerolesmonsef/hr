<div id="filterSection" class="formS1 hidden">
    <form action="{{ route(Route::currentRouteName()) }}" method="get">
        <div class="content contentForm">
            <div class="row">
                <div class="col-lg-6">
                    {{Form::label('labels',__('Labels'),['class' => 'form-label'])}}
                    <div class="inputS1">
                        {{Form::text('label',request('label',null),array('class'=>'',
                        'placeholder'=>__('Enter Label'),'autocomplete'=>'off'))}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="employee" class="form-label">{{ __('Employee') }}</label>
                    <div class="inputS1">
                        {{ Form::select('employee',$employees->prepend(__('Select'),''),request('employee',null), array('class'
                        => '')) }}
                    </div>
                </div>

                <div class="col-lg-6">
                    {{Form::label('labels',__('Start Date'),['class' => 'form-label'])}}

                    <div class="inputS1">
                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                        {{Form::text('start_date',request('start_date',null),array('class'=>'datePickerBasic',
                        'placeholder'=>__('Start Date')))}}
                    </div>
                </div>

                <div class="col-lg-6">
                    {{Form::label('due_date',__('Due Date'),['class' => 'form-label'])}}
                    <div class="inputS1">
                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                        {{Form::text('due_date',request('due_date',null),array('class'=>'datePickerBasic',
                        'placeholder'=>__('Due Date')))}}
                    </div>
                </div>

                <div class="col-lg-6">
                    {{Form::label('label',__('Status'),['class' => 'form-label'])}}
                    <div class="inputS1">
                        <select name="status">
                            <option value="">{{ __('Select') }}</option>
                            @foreach(\App\Models\Task::getStatuses() as $status)
                            <option value="{{ $status }}" {{ request('status',null) == $status ? 'selected' : ''  }}>{{ __('task_status_'.$status) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="content flex align gap-4">
            <button class='buttonS1 primary' type="submit">
                {{ __('Filter') }}
            </button>
            <button class='buttonS2 noBG resetBtn' type="reset">
                {{ __('Reset') }}
            </button>
        </div>
    </form>
</div>