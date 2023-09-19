<div class="navFoChild">
    <div class="navFoChildFixed">
        <div class="head">
            <h2>{{ __('Employees') }}</h2>

        </div>
        <?php $emp = (isset($employee) and $employee->exists) ? $employee->id : 0; ?>
        
        
        <div class="menu">
            <ul class="scroll">
                <li>
                 <a href="{{ route('employee.index') }}" class="{{ is_active_link_sidebar(route('employee.index') , route('employee.create'), route('employee.edit',$emp)
                    , route('employee.editFinancial',$emp)
                    , route('employee.editDocuments',$emp)
                    , route('employee.breaks',$emp)
                    , route('employee.assets',$emp)
                    , route('employee.vacations',$emp)
                    , route('employee.attendance',$emp)
                    , route('employee.contract',$emp)) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/users.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/usersActive.svg') }}" />
                        </div>

                        <span>{{ __('Employees') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('employee-shifts.index') }}"
                        class="{{ is_active_link_sidebar(route('employee-shifts.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/attendance.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/attendanceActive.svg') }}" />
                        </div>

                        <span>{{ __('Shifts') }}</span>
                    </a>
                </li> 


                <li>
                    <a href="{{ route('attendance.index') }}"
                        class="{{ is_active_link_sidebar(route('attendance.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/attendance.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/attendanceActive.svg') }}" />
                        </div>

                        <span>{{ __('Attendance') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('saturationdeduction.index') }}"
                        class="{{ is_active_link_sidebar(route('saturationdeduction.index')) }}">


                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/deduction.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/deductionActive.svg') }}" />
                        </div>


                        <span>@lang('Deduction')</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
