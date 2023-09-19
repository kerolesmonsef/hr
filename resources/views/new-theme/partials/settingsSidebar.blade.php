<div class="navFoChild">
    <div class="navFoChildFixed">
        <div class="head">
            <h2>{{ __('Settings') }}</h2>
        </div>
        <div class="menu">
            <ul class="scroll">
                <li>
                    <a href="{{ route('user.index') }}"
                        class="{{ is_active_link_sidebar(route('user.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/settingsUser.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/settingsUserActive.svg') }}" />
                        </div>


                        <span>{{ __('Users') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('roles.index') }}"
                        class="{{ is_active_link_sidebar(route('roles.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/roles.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/rolesActive.svg') }}" />
                        </div>


                        <span>{{ __('Roles') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('branch.index') }}"
                        class="{{ is_active_link_sidebar([route('branch.index') , route('department.index')]) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/branches.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/branchesActive.svg') }}" />
                        </div>

                        <span>{{ __('Branches')}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('s-attendance.index') }}"
                        class="{{ is_active_link_sidebar(route('s-attendance.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/attendance.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/attendanceActive.svg') }}" />
                        </div>
                        <span>{{ __('Attendance') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('PerformanceFactor.index') }}"
                        class="{{ is_active_link_sidebar(route('PerformanceFactor.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/performance.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/performanceActive.svg') }}" />
                        </div>

                        <span>{{  __('Performance Indicator') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('salary_setting.index') }}"
                    class="{{ is_active_link_sidebar([route('salary_setting.index') , route('payroll_setting.index') , route('paysliptype.index') , route('allowanceoption.index')  ,route('awardtype.index') , route('deductionoption.index') , route('loanoption.index') , route('paymenttype.index')]) }}"
                    >
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/salary.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/salaryActive.svg') }}" />
                        </div>

                        <span>@lang("Salary")</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('insurance-companies.index') }}" class="{{ is_active_link_sidebar(route('insurance-companies.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/insuranceCompany.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/insuranceCompanyActive.svg') }}" />
                        </div>


                        <span>{{ __('Insurance Companies') }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('assets-types.index') }}" class="{{ is_active_link_sidebar(route('assets-types.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/assetsType.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/assetsTypeActive.svg') }}" />
                        </div>
                        
                        <span>{{ __('Assets Types') }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('document.index') }}" class="{{ is_active_link_sidebar(route('document.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/documentType.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/documentTypeActive.svg') }}" />
                        </div>
                        
                        <span>{{ __('Documents') }} </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('contract-templates.index') }}"
                        class="{{ is_active_link_sidebar(route('contract-templates.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/printContract.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/printContractActive.svg') }}" />
                        </div>


                        <span>{{ __('Contract Templates') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
