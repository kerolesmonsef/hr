<div class="tab-pane show active" role="tabpanel" aria-labelledby="vacationCredit-tab">

    <div class='sectionS2'>
        <div class="head withBorder flex align between options">
            <h3 class='small'>@lang('Leave Credit Details')</h3>
            <div class='flex align gap-3 options'>
                <button id="print" class='buttonS2  withBorder'>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.4375 5.25H12.5625V3.75C12.5625 2.25 12 1.5 10.3125 1.5H7.6875C6 1.5 5.4375 2.25 5.4375 3.75V5.25Z"
                            stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M12 11.25V14.25C12 15.75 11.25 16.5 9.75 16.5H8.25C6.75 16.5 6 15.75 6 14.25V11.25H12Z"
                              stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M15.75 7.5V11.25C15.75 12.75 15 13.5 13.5 13.5H12V11.25H6V13.5H4.5C3 13.5 2.25 12.75 2.25 11.25V7.5C2.25 6 3 5.25 4.5 5.25H13.5C15 5.25 15.75 6 15.75 7.5Z"
                            stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M12.75 11.25H11.8425H5.25" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.25 8.25H7.5" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    {{__('Print')}}
                </button>

                <button id="export" class='buttonS2 withBorder'>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.33 6.67505C15.03 6.90755 16.1325 8.29505 16.1325 11.3325V11.43C16.1325 14.7825 14.79 16.125 11.4375 16.125H6.55499C3.20249 16.125 1.85999 14.7825 1.85999 11.43V11.3325C1.85999 8.31755 2.94749 6.93005 5.60249 6.68255"
                            stroke="#292D32" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9 1.5V11.16" stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M11.5125 9.48755L8.99999 12L6.48749 9.48755" stroke="#292D32" stroke-width="1.2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{__('Export')}}
                </button>
            </div>
        </div>


        <div class="tableS1 scroll ">
            <table>
                <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    @foreach (\App\Models\LeaveType::all() as $leaveType)
                        <th>{{ $leaveType->{'title' . $lang} }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $employee->name }}</td>
                    @foreach (\App\Models\LeaveType::all() as $leaveType)
                        <td>
                                <?php
                                $com = 0;
                                $leaves = \App\Models\Leave::query()
                                    ->where('employee_id', $employee->id)
                                    ->where('leave_type_id', $leaveType->id)
                                    ->get()
                                    ->each(function (\App\Models\Leave $leave) use (&$com) {
                                        $start = new \Carbon\Carbon($leave->start_date);
                                        $end = new \Carbon\Carbon($leave->end_date);
                                        $com += $start->diffInDays($end);
                                    });

                                ?>
                            {{ $com }} @lang('Days')

                        </td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>


@push("script")
    @include('new-theme.components.export_print', [
        'print_url' => route('vacations.print')."?employee_id=$employee->id",
        'export_url' => route('vacations.export')."?employee_id=$employee->id",
        'no_query_param'=>true,
    ])
@endpush