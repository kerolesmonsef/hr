<?php
namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Traits\ApiResponser;
use Hash;
use Illuminate\Http\Request;
use Validator;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\V1\User
 */
class NotificationController extends Controller
{
    use ApiResponser;
    public function on_off_notifications(Request $request){
        $data = $request->validate([
            'value' => 'required|numeric|min:0|max:1',
        ]);
        auth()->user()->employee->update([
            'on_off_notification' => $data['value'],
        ]);
        return $this->success([],'success');
    }
    public function index()
    {
        $notifications = Notification::where([
            'user_id' => auth()->user()->id,
            'for_admin' => 0,
        ])->get();
        return $this->success(NotificationResource::collection($notifications),'');
    }
    public function read_notifications(){
        Notification::where('created_by' , auth()->user()->creatorId())->update([
            'read' => 1,
        ]);
        return;
    }
}
