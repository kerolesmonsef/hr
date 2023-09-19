<div class="navFoChild">
    <div class="navFoChildFixed">
        <div class="head">
            <h2>{{ __('Reports') }}</h2>
        </div>
        <div class="menu">
            <ul class="scroll">
                <li>
                    <a href="{{ route('report.monthly.attendance') }}"
                        class="{{ is_active_link_sidebar(route('report.monthly.attendance')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/attendance.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/attendanceActive.svg') }}" />
                        </div>

                        <span>{{ __('Attendance') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('report.employee_with_leaves') }}"
                        class="{{ is_active_link_sidebar(route('report.employee_with_leaves')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/vacations.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/vacationsActive.svg') }}" />
                        </div>

                        <span>{{ __('Vacations') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('report.employee_with_emails') }}"
                        class="{{ is_active_link_sidebar(route('report.employee_with_emails')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/emails.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/emailsActive.svg') }}" />
                        </div>

                        <span>{{ __('Emails') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('report.payroll') }}"
                        class="{{ is_active_link_sidebar(route('report.payroll')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/reportsPayroll.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/reportsPayrollActive.svg') }}" />
                        </div>

                        <span>{{ __('Payroll') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
