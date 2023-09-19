@foreach ($tasks as $task)
<tr data-row-key="1" class="ant-table-row ant-table-row-level-0">
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>
        {{ $task->id }}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div> {{ $task->name }}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>{{ $task->label }}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>
        {{ $task->start_date->format('d-m-Y') }}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>
        {{-- {{ $task->due_date_string }} --}}
        {{-- {{ $task->due_date }} --}}
        {{ $task->days_until_due }}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>
        <div class="buttonS2 {{ $task->task_status_label }} ">{{ __('task_status_'.$task->status) }}</div>
        {{-- success --}}
    </td>
    <td class="tooltipS1 get-data" data-id="{{ $task->id }}" data-bs-toggle="offcanvas" data-bs-target="#id1" aria-controls="id1">
        <div class="tooltip">{{ __('View Details') }}</div>
        <ul class="members flex align">
            @foreach ($task->employees as $employee)
            <li><img src="/new-theme/photos/person.png" alt="{{ $employee->name }}"></li>
            @endforeach
            {{-- <li class="number">+5</li> --}}
        </ul>
    </td>
</tr>
@endforeach