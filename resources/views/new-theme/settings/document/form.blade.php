<div class="row">

    <div class="col-lg-6">
        <label for="name_ar" class="form-label">{{__('Name_ar')}}</label>
        <div class="inputS1">
            <input type="text" name="name_ar" value="{{ isset($document) ? $document->name_ar : ''}}"  placeholder='{{__('Name_ar')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'name_ar'])
    </div>

    <div class="col-lg-6">
        <label for="name" class="form-label">{{__('Name')}}</label>
        <div class="inputS1">
            <input type="text" name="name" value="{{ isset($document) ? $document->name : ''}}"  placeholder='{{__('Name')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'name'])
    </div>

    <div class="col-lg-6">
        <label for="is_required" class="form-label">{{__('Required Field')}}</label>
        <div class="inputS1">
            <select name="is_required">
                <option value="0" {{ isset($document) ? ($document->is_required == 0 ? 'selected' : '')  : ''}}>{{__('Not Required')}}</option>
                <option value="1" {{ isset($document) ? ($document->is_required == 1 ? 'selected' : '') : ''}}>{{__('Is Required')}}</option>
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'is_required'])
    </div>


    <div class="col-lg-6">
        <label for="document_type" class="form-label">{{__('Document Type')}}</label>
        <div class="inputS1">
            <select name="document_type">
                <option value="">{{__('Choose')}}</option>
                @foreach($documentTypes as $documentType)
                    <option value="{{$documentType->id}}" {{ isset($document) ? ($document->document_type == $documentType->id ? 'selected' : '')  : ''}}>{{$documentType['name'.$lang]}}</option>
                @endforeach
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'document_type'])
    </div>

</div>