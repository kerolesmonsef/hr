<div class="modal fade customeModal" id="editStructure-{{ $structureList->id }}" tabindex="-1" aria-labelledby="addNewBranchLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route('companystructure.update', $structureList) }}">
                    @csrf
                    @method('put')
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Update')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content">

                            <div class="col-12">
                                <div class="form-group">
                                    {{Form::label('name_ar',__('Name_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                    {{Form::text('name_ar',$structureList->name_ar,array('class'=>'form-control','placeholder'=>__('Enter Name arabic')))}}
                                    @include('new-theme.components.error1',['error' => 'name_ar'])
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    {{Form::label('name',__('Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                    {{Form::text('name',$structureList->name,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                                    @include('new-theme.components.error1',['error' => 'name'])
                                </div>
                            </div>

                            <div class="">
                                <label for="branchName-Ar" class="form-label">{{__('Structure list')}}</label>
                                <div class="inputS1">
                                    <select name="parent">
                                        <option value="">{{__('Main')}}</option>
                                        @foreach($CompanyStructures as $structure)
                                            <option value="{{$structure->id}}" @if($structure->id == $structureList->parent) selected @endif>{{$structure['name'.$lang]}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    {{Form::label('numberOfRows',__('Number Of Rows'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                                    {{Form::text('numberOfRows',$numberOfRows,array('class'=>'form-control','placeholder'=>__('Enter Number')))}}
                                    @include('new-theme.components.error1',['error' => 'numberOfRows'])
                                </div>
                            </div>

                            <div class="flex align end gap-15 orders  mt-5 mb-4">

                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                    @lang('Cancel')
                                </button>

                                <button class="buttonS1 primary" type="submit">
                                    @lang('Save')
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
