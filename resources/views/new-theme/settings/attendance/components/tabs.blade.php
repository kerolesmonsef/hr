<div class="tabsS1" style="width: fit-content;">
    <ul class="nav nav-pills mb-3 scrollS2" id="pills-tab" role="tablist" style="padding: 0px 10px;">
            <li class="nav-item" role="presentation">
                <a href="{{ route('s-attendance.index', ['type' => 'attendance']) }}" class="nav-link  {{ $active == 'attendance-m' ? 'active' : '' }}" id="vacationsTypes-tab"  
                    role="tab" aria-controls="pills-Notes" aria-selected="false">@lang("Attendance")
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('leavetype.index') }}" class="nav-link  {{ $active == 'vacation' ? 'active' : '' }}" id="vacationsTypes-tab"  
                     role="tab" aria-controls="pills-Notes" aria-selected="false">{{ __('Vacation Types') }}
                </a>
            </li>
    </ul>
</div>

<div class="tab-content" id="pills-tabContent">
{!! $slot !!}
</div>



