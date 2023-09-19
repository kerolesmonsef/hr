 @foreach ($employees as $employee)
        <?php
            $editLink = '#';
            if(auth()->user()->can('Employee-Edit'))
            {
                $editLink = route("employee.edit",$employee);
            }
        ?>
     <tr>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 <div class="userTabl user">
                     <img src="{{ asset('/new-theme/icons/all/user.svg') }}" />
                 </div>
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
             </a>
         </td>

         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ \Auth::user()->employeeIdFormat($employee->id) }}
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
         </td>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ $employee['name' . $lang] }}
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
         </td>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ ($employee->jobtitle ? $employee->jobtitle['name' . $lang] : 'N/A') }}
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
         </td>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ ($employee->department ? $employee->department['name' . $lang] : 'N/A')  }}
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
         </td>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ ($employee->shifts ? $employee->shifts['name' . $lang] : 'N/A')  }}
                 <div class="tooltip">{{__('View Details')}}</div>
             </a>
         </td>
         <td class="tooltipS1">
             <a href="{{ $editLink }}">
                 {{ \Auth::user()->priceFormat($employee->salary) }}
             </a>
         </td>
     </tr>
 @endforeach