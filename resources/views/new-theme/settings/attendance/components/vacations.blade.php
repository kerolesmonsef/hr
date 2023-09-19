<div class="tab-pane fade show active" id="vacationsTypes" role="tabpanel" aria-labelledby="vacationsTypes-tab">
    <div class='sectionS2'>
        <div class="head withBorder flex align between">
            <div class="flex align gap-10">
                {{-- step 1 --}}
                                {{--  لما يعمل select 
                    هيغير الجدول , اللقى نظرة على step 2 --}}
                <div class="inputS1 customeSelect">
                    <select>
                        <option value="">{{__("Company Vacations")}}</option>
                        <option value="Formal Vacations ">{{__("Formal Vacations")}} </option>
                        <option value="All Vacations">{{__("All Vacations")}}</option>
                    </select>
                </div>
                <p>( 07 {{__("Vacations")}} )</p>
            </div>

            @can('VacationSetting-Create')
                <button class='buttonS1 primary' data-bs-toggle="modal" data-bs-target="#addNew">
                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                            fill="white" />
                    </svg>
                    {{ __('Create') }}
                </button>
            @endcan
        </div>


        <div class="tableS1 scroll">
            <!-- change table on change select  -->
            <table>
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Yearly Limit') }}</th>
                        <th>{{ __('Monthly Limit') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($childs as $type)
                        <tr>
                            <td>{{ app()->isLocale('en') ? $type->title : $type->title_ar }}</td>
                            <td>{{ $type->maxDays }} Days</td>
                            <td>{{ $type->maxDaysPerMonth }} Days</td>
                            <td>
                                <div class='action flex gap-3'>
                                    @can('VacationSetting-Edit')
                                        <div data-bs-toggle="modal" data-bs-target="#addNew{{ $type->id }}">
                                            <img src="/new-theme/icons/all/edit.svg" alt="" />
                                        </div>
                                    @endcan

                                    @can('VacationSetting-Delete')
                                        <div data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('leavetype.destroy' , $type->id) }}" data-bs-toggle="modal" data-bs-target="#confirm1">
                                            <img src="/new-theme/icons/all/delete.svg" alt="" />
                                        </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @can('VacationSetting-Edit')
                            <!-- Edit  Modal -->
                            <div class="modal fade customeModal" id="addNew{{ $type->id }}" tabindex="-1"
                                aria-labelledby="addNewLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form class="formS1 ajax-submit"  method="post"
                                                action="{{ route('leavetype.update', $type) }}">
                                                @csrf
                                                @method('put')
                                                <div class="sectionS2">
                                                    <div class="head withBorder flex align between">
                                                        <h3 class='small'>{{ __('Edit vacation') }}</h3>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="content">
                                                        <div class="">
                                                            <label for="vacationName" class="form-label">Vacation
                                                                Name</label>
                                                            <div class="inputS1">
                                                                <input name="title" value="{{ old('title' , $type->title) }}" type="text"
                                                                    id="vacationName" placeholder='Enter Vacation Name'>
                                                            </div>
                                                            @include('new-theme.components.error1', ['error' => 'title'])
                                                        </div>
                                                        <div class="">
                                                            <label for="vacationName" class="form-label">Vacation
                                                                Name Arabic</label>
                                                            <div class="inputS1">
                                                                <input name="title_ar" value="{{ old('title_ar' , $type->title_ar) }}" value="" type="text"
                                                                    id="vacationName" placeholder='Enter Vacation Name'>

                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'title_ar',
                                                            ])
                                                        </div>
                                                        <div class="">
                                                            <label for="yearlyLimit" class="form-label">Yearly Limit</label>
                                                            <div class="inputS1">
                                                                <input name="maxDays"  value="{{ old('maxDays' , $type->maxDays) }}" type="text"
                                                                    id="yearlyLimit" placeholder='Enter Yearly Limit'>

                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'maxDays',
                                                            ])
                                                        </div>
                                                        <div class="">
                                                            <label for="monthlyLimit" class="form-label">Monthly
                                                                Limit</label>
                                                            <div class="inputS1">
                                                                <input name="maxDaysPerMonth"  value="{{ old('maxDaysPerMonth' , $type->maxDaysPerMonth) }}" type="text"
                                                                    id="monthlyLimit" placeholder='Enter Monthly Limit'>
                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'maxDaysPerMonth',
                                                            ])
                                                        </div>
                                                        <div class="">
                                                            <label for="monthlyLimit" class="form-label">daysBeforeApply
                                                            </label>
                                                            <div class="inputS1">
                                                                <input name="daysBeforeApply"  value="{{ old('daysBeforeApply' , $type->daysBeforeApply) }}" type="text"
                                                                    id="monthlyLimit" placeholder='Days before apply'>
                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'daysBeforeApply',
                                                            ])
                                                        </div>
                                                        <div class="">
                                                            <label for="monthlyLimit" class="form-label">daysBeforeApply
                                                            </label>
                                                            <div class="inputS1">
                                                                <input name="afterMaxHour" value="{{ old('afterMaxHour' , $type->afterMaxHour) }}" type="text"
                                                                    id="monthlyLimit" placeholder='Days before apply'>
                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'afterMaxHour',
                                                            ])
                                                        </div>

                                                        <div class="">
                                                            <label for="monthlyLimit" class="form-label">
                                                                deduction</label>
                                                            <div class="inputS1">
                                                                <input name="deduction" value="{{ old('deduction' , $type->deduction) }}" type="text"
                                                                    id="monthlyLimit" placeholder='deduction'>
                                                            </div>
                                                            @include('new-theme.components.error1', [
                                                                'error' => 'deduction',
                                                            ])
                                                        </div>
                                                        <div class="flex align end gap-15 orders  mt-5 mb-4">
                                                            <button class="buttonS1 rejected" type="button"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                {{ __('Cancel') }}
                                                            </button>
                                                            <button class="buttonS1 primary" type="submit">
                                                                {{ __('Save') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="paginater flex gap-4 align">
        @include('new-theme.settings.attendance.paginate')
    </div>
</div>

<!-- Add  Modal -->
<div class="modal fade customeModal" id="addNew" tabindex="-1" aria-labelledby="addNewLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1 ajax-submit"   method="post" action="{{ route('leavetype.store') }}">
                    @csrf

   
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>{{ __("Edit Vacation") }}</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content scroll" style="max-height: 450px;overflow: auto;">
                            <div class="">
                                <label for="vacationName" class="form-label">{{__("Vacation Name")}}</label>
                                <div class="inputS1">
                                    <input name="title" value="" type="text" id="vacationName" placeholder="{{__("Vacation Name")}}">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'title'])
                            </div>
                            <div class="">
                                <label for="vacationName" class="form-label">{{__("Vacation Name Arabic")}}</label>
                                <div class="inputS1">
                                    <input name="title_ar" value="" type="text" id="vacationName" placeholder="{{__("Vacation Name Arabic")}}">

                                </div>
                                @include('new-theme.components.error1', ['error' => 'title_ar'])
                            </div>
                            <div class="">
                                <label for="yearlyLimit" class="form-label">{{__("Yearly Limit")}}</label>
                                <div class="inputS1">
                                    <input name="maxDays" value="" type="text" id="yearlyLimit" placeholder="{{__("Yearly Limit")}}">

                                </div>
                                @include('new-theme.components.error1', ['error' => 'maxDays'])
                            </div>
                            <div class="">
                                <label for="monthlyLimit" class="form-label">{{__("Monthly Limit")}}</label>
                                <div class="inputS1">
                                    <input name="maxDaysPerMonth" value="" type="text" id="monthlyLimit" placeholder="{{__("Monthly Limit")}}">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'maxDaysPerMonth'])
                            </div>
                            <div class="">
                                <label for="monthlyLimit" class="form-label">{{__("days Before Apply")}}
                                </label>
                                <div class="inputS1">
                                    <input name="daysBeforeApply" value="" type="text" id="monthlyLimit" placeholder="{{__("days Before Apply")}}">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'daysBeforeApply'])
                            </div>

                            <div class="">
                                <label for="monthlyLimit" class="form-label">{{__("deduction")}}</label>
                                <div class="inputS1">
                                    <input name="deduction" value="" type="text" id="monthlyLimit"
                                        placeholder='{{__("deduction")}}'>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'deduction'])
                            </div>
                            <div class="flex align end gap-15 orders  mt-5 mb-4">
                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ __('Cancel') }}
                                </button>
                                <button class="buttonS1 primary" type="submit">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm1" abindex="-1" aria-hidden="true">
    <div class="modal-dialog confirmS1 ">
        <div class="content">
            <div class="des">Are you sure you want to remove this Item?</div>
            <div class="btns">
                <button type="submit" class="buttonS2 danger">remove</button>
                <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


