<div class="card bg-none card-box">
    {{Form::model($question,array('route' => array('question.update', $question->id), 'method' => 'PUT')) }}

    <div class="form-group col-md-12">
        {{ Form::label('type', __('Evaluation category type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
        <select class="form-control" name="evaluation_category_id">
            <option>{{ __('Select evaluation category type') }}</option>
            @foreach ($evaluation_categories as $evaluation_category)
                <option value="{{ $evaluation_category->id }}" @if($evaluation_category->id == $question->evaluation_category_id) selected @endif>{{ app()->isLocale('en') ?  $evaluation_category->title : $evaluation_category->title_ar }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-12">
        {{ Form::label('type', __('Question type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
        <select class="form-control" name="type">
            <option  value="choice" @if($question->type == 'choice') selected @endif> {{ __('Choice')}} </option>
            <option value="text" @if($question->type == 'text') selected @endif> {{ __('Text')}} </option>
        </select>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('English Question'))}}
                {{Form::textarea('title', $question->title ,array('class'=>'form-control','placeholder'=>__('English Question')))}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title_ar',__('Arabic Question'))}}
                {{Form::textarea('title_ar', $question->title_ar ,array('class'=>'form-control','placeholder'=>__('Arabic Question')))}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

