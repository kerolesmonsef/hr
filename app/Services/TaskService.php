<?php

namespace App\Services;


use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskService
{

    public function updateTaskBoard($id, $status, $priority)
    {
        $task = Task::find($id);
        $old_status = $task->status;
        $old_priority = $task->priority;
        DB::beginTransaction();
        try {
            if ($old_status != $status) { // not at same board
                Task::where('status', $old_status)->where('priority', '>', $task->priority)->update(['priority' => DB::raw('priority - 1')]); // update old board tasks priority

                $task->update([
                    'status' => $status,
                    'priority' => $priority,
                ]);
                Task::where('status', $status)->where('priority', '>=', $priority)->where('id', '!=', $task->id)->update(['priority' => DB::raw('priority + 1')]); // update new board tasks priority
                $task->activityLogs()->create([
                    'employee_id' => auth()->id() ,
                    'description' => $status,
                ]);
            } else { // at same board
                $task->update([
                    'priority' => $priority,
                ]);
                $last_index = Task::where('status', $status)->count() - 1;
                if ($priority < $old_priority) {
                    Task::where('status', $status)->where('priority', '>=', $priority)->where('priority', '<', $last_index)->where('id', '!=', $task->id)->update(['priority' => DB::raw('priority + 1')]);
                } else {
                    Task::where('status', $status)->where('priority', '<=', $priority)->where('priority', '>', 0)->where('id', '!=', $task->id)->update(['priority' => DB::raw('priority - 1')]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            return false;

        }
    }
}
