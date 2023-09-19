<?php
$action = route('employee.update', $employee);
$method = 'put';
?>
<div class="tabsS1">
    <ul class="detailsTabsHead scrollS2 nav nav-pills mb-3" id="pills-tab" role="tablist" style="padding: 0px 10px;">
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.edit', $employee) }}" class="nav-link {{ $active == 'personal' ? 'active' : '' }}"
                role="tab" aria-controls="personal" aria-selected="true">@lang('Personal & Organization')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.editFinancial', $employee) }}"
                class="nav-link {{ $active == 'financial' ? 'active' : '' }}" role="tab" aria-controls="pills-Notes"
                aria-selected="false">@lang('Financial')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.assets', $employee) }}"
                class="nav-link {{ $active == 'assets' ? 'active' : '' }}" role="tab" aria-controls="pills-Notes"
                aria-selected="false">@lang('Assets')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.attendance', $employee) }}"
                class="nav-link {{ $active == 'attendance' ? 'active' : '' }}" role="tab"
                aria-controls="pills-Notes" aria-selected="false">@lang('Attendance')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.breaks', $employee) }}"
                class="nav-link {{ $active == 'breaks' ? 'active' : '' }}" role="tab" aria-controls="pills-Notes"
                aria-selected="false">@lang('Breaks')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.contract', $employee) }}"
                class="nav-link {{ $active == 'printContract' ? 'active' : '' }}" role="tab"
                aria-controls="pills-Notes" aria-selected="false">{{ __('Print Contract') }}</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.vacations', $employee) }}"
                class="nav-link {{ $active == 'vacations' ? 'active' : '' }}" role="tab"
                aria-controls="pills-Notes" aria-selected="false">@lang('Vacation')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="{{ route('employee.editDocuments', $employee) }}"
                class="nav-link {{ $active == 'documents' ? 'active' : '' }}" role="tab"
                aria-controls="pills-Notes" aria-selected="false">@lang('Documents')</a>
        </li>
    </ul>
</div>

<div class="tab-content" id="pills-tabContent">
    {!! $slot !!}
    <!-- Personal & Organization Tab -->
    {{--    @include("new-theme.employee.components.edit-employee-tabs.personal") --}}

    <!-- Financial Tab -->
    {{--    @include("new-theme.employee.components.edit-employee-tabs.financial") --}}
    {{--                    <!-- Assets Tab --> --}}
    {{--                <?php include './employees-details-tabs/assets.php'; ?> --}}

    {{--                    <!-- Attendance Tab --> --}}
    {{--                <?php include './employees-details-tabs/attendance.php'; ?> --}}

    {{--                    <!-- Breaks Tab --> --}}
    {{--                <?php include './employees-details-tabs/breaks.php'; ?> --}}

    {{--                    <!-- Print Contract Tab --> --}}
    {{--                <?php include './employees-details-tabs/print-contract.php'; ?> --}}

    {{--                    <!-- Vacation Credit Tab --> --}}
    {{--                <?php include './employees-details-tabs/vacation-credit.php'; ?> --}}
    {{--                --}}
    {{--                    <!-- Documents Tab --> --}}
    {{--                <?php include './employees-details-tabs/documents.php'; ?> --}}

</div>





@push('script')
    <script src="{{ url('new-theme/js/activeTabs.js') }}"></script>
@endpush
