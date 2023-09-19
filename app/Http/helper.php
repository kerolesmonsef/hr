<?php

use App\Http\Resources\SettingResource;
use App\Models\AttendanceEmployee;
use App\Models\EmployeePermission;
use App\Models\Leave;
use App\Models\Notification;
use App\Models\Utility;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

if (!function_exists('resource_collection')) {
    function resource_collection($resource): array
    {
        return json_decode($resource->response()->getContent(), true) ?? [];
    }
}

if (!function_exists('graph_attendance_data')) {
    function graph_attendance_data($year)
    {
        $graph = AttendanceEmployee::whereYear('created_at', '=', $year)->get();
        $graph_arr = [];
        for ($i = 01; $i <= 12; $i++) {
            $filtered = $graph;
            $filtered = $filtered->filter(function ($attendance) use ($i) {
                return (new Carbon($attendance->created_at))->month == $i;
            });
            array_push($graph_arr, count($filtered));
        }
        $graph_arr = json_encode($graph_arr);
        return $graph_arr;
    }
}

if (!function_exists('graph_permission_data')) {
    function graph_permission_data($year)
    {
        $graph = EmployeePermission::whereYear('created_at', '=', $year)->get();
        $graph_arr = [];
        for ($i = 01; $i <= 12; $i++) {
            $filtered = $graph;
            $filtered = $filtered->filter(function ($attendance) use ($i) {
                return (new Carbon($attendance->created_at))->month == $i;
            });
            array_push($graph_arr, count($filtered));
        }
        $graph_arr = json_encode($graph_arr);
        return $graph_arr;
    }
}

if (!function_exists('graph_leave_data')) {
    function graph_leave_data($year)
    {
        $graph = Leave::whereYear('created_at', '=', $year)->get();
        $graph_arr = [];
        for ($i = 01; $i <= 12; $i++) {
            $filtered = $graph;
            $filtered = $filtered->filter(function ($attendance) use ($i) {
                return (new Carbon($attendance->created_at))->month == $i;
            });
            array_push($graph_arr, count($filtered));
        }
        $graph_arr = json_encode($graph_arr);
        return $graph_arr;
    }
}


if (!function_exists('is_active_link_sidebar')) {
    function is_active_link_sidebar($route)
    {
        $route = is_array($route) ? $route : func_get_args();
        return in_array(request()->url(), $route) ? "active" : '';
    }
}

if (!function_exists("is_active_link_like")) {
    function is_active_link_like($like)
    {
        return str_contains(request()->url(), $like) ? "active" : "";
    }
}

if (!function_exists("humanFileSize")) {

    function humanFileSize($size, $unit = "KB")
    {
        if ((!$unit && $size >= 1 << 30) || $unit == "GB")
            return number_format($size / (1 << 30), 2) . " GB";
        if ((!$unit && $size >= 1 << 20) || $unit == "MB")
            return number_format($size / (1 << 20), 2) . " MB";
        if ((!$unit && $size >= 1 << 10) || $unit == "KB")
            return number_format($size / (1 << 10), 2) . " KB";
        return number_format($size) . " bytes";
    }
}

if (!function_exists('compare_image')) {
    function compare_image($imageone, $imagetwo)
    {
        $imagePath1 = public_path("helmy1.png");
        $image1 = base64_encode(file_get_contents($imagePath1));

        $imagePath2 = public_path("helmy2.png");
        $image2 = base64_encode(file_get_contents($imagePath2));

        $body = array(
            "encoded_image1" => $image1,
            "encoded_image2" => $image2,
        );

        $respose = Http::withHeaders([
            'subscriptionkey' => 'D6IzWByEj1mVvecssy-5G5SM6OLKt1212',
            'Content-Type' => 'application/json'
        ])
            ->post('https://faceapi.mxface.ai/api/face/verify', $body);

        return $respose->json()['confidence'];
    }
}

if (!function_exists('store_notification')) {
    function store_notification(array $data)
    {
        $row = Notification::create($data);
        return $row;
    }
}
if (!function_exists('get_distance_between_two_points')) {
    function get_distance_between_two_points($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

if (!function_exists('pushNotification')) {
    function pushNotification($title, $body, $d, $token)
    {
        if (!$token) return;
        if (!is_array($token)) {
            $token = [$token];
        }
        $url = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = FCM_SERVER_KEY;

        $data = [
            "registration_ids" => $token,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "sound" => "default",
                "badge" => "1",
                // "click_action" => "FCM_PLUGIN_ACTIVITY",
            ],
            "data" => $d,
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        return $result;
    }
}


if (!function_exists('active_link')) {
    function active_link($param1, $param2 = null)
    {
        if ($param2 == null) {
            if ($param1 === Illuminate\Support\Facades\Request::segment(1)) {
                return 'active';
            } else {
                return '';
            }
        } else {
            if (
                $param1 === Illuminate\Support\Facades\Request::segment(1)
                &&
                $param2 === Illuminate\Support\Facades\Request::segment(2)
            ) {
                return 'active';
            } else {
                return '';
            }
        }
    }
}

function is_url($string)
{
    $parsed_url = parse_url($string);
    if ($parsed_url !== false && isset($parsed_url['scheme'], $parsed_url['host'])) {
        return 1;
    }
    return 0;
}

function company_setting()
{
    $settings = Utility::settings();
    return new SettingResource($settings);
}


if (!function_exists("front_date")) {
    function front_date($date)
    {
        return (new \Carbon\Carbon($date))->format("d/m/Y");
    }
}

if (!function_exists("back_date")) {
    function back_date($date)
    {
        try {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } catch (Exception $e) {
            return now()->format("Y-m-d");
        }
    }
}
if (!function_exists("resource_collection")) {

    function resource_collection($resource): array
    {
        return json_decode($resource->response()->getContent(), true) ?? [];
    }
}

if (!function_exists("generateStarRating")) {

    function generateStarRating($rating, $options = [])
    {
        $ul_class = $options['ul_class'] ?? "";
        // Calculate the number of full and half stars
        $fullStars = floor($rating);
        $halfStars = ceil($rating - $fullStars);

        // Generate the star rating HTML
        $html = "<ul class='$ul_class'>";
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                // Full star
                $html .= '<li><img src="/new-theme/icons/star.svg" alt=""/></li>';
            } else if ($i <= $fullStars + $halfStars) {
                // Half star
                $html .= '<li><img src="/new-theme/icons/halfStar.svg" alt=""/></li>';
            } else {
                // Empty star
                $html .= '<li><img src="/new-theme/icons/emptyStar.svg" alt=""/></li>';
            }
        }
        $html .= '<li>(' . round($rating, 2) . ':5)</li>';
        $html .= '</ul>';

        return $html;
    }
}

function structure_employee_collection($structure_id, $employees, $parent_id, $title, &$all_employees)
{
    foreach ($employees as $employee) {
        $all_employees[] = [
            'id' => $structure_id,
            'pid' => $parent_id,
            'name' => $employee->name,
            'title' => $title,
            'email' => $employee->email,
            'image' => $employee->user->avatar,
        ];
    }
}


function getCurrentMonthGroupBy(string $modal, Carbon $month)
{
    $data = $modal::query()
        ->whereMonth('created_at', $month->month)
        ->whereYear('created_at', $month->year)
        ->selectRaw("COUNT(*) as total,DAY(created_at) as day")
        ->groupByRaw('DAY(created_at)')
        ->get();

    // loop through the days of the month
    $counts = [];
    $days = [];
    for ($i = 1; $i <= $month->daysInMonth; $i++) {
        $days[] = Carbon::createFromDate($month->year, $month->month, $i)->format('d/m');
        $day_i = $data->where('day', $i)->first();
        if ($day_i) {
            $counts[] = $day_i->total;
        } else {
            $counts[] = 0;
        }
    }

    return [
        'days' => $days,
        'counts' => $counts,
    ];
}

function calculate_question_option_points($question, $option, &$over_all_answer_points)
{

    if ($option->isSelected) {
        $question->answer_points += $option->point;
        $over_all_answer_points += $option->point;
    }
}

function print_request_date($request)
{
    // dump($request->modeltype);
    // return;
    // if ($request->modeltype == 'permission') {
    //     dd($request);
    // };
    switch ($request->modeltype) {
        case 'work_from_home_request':
            return $request->date;
            break;
        case 'loan':
            // add months to date
            $end_date = Carbon::parse($request->start_date)->addMonths($request->month_nubmer);

            return $request->start_date . ' - ' . $end_date->format('Y-m-d');
            break;
        case 'leave':
            return $request->start_date . ' - ' . $request->end_date;
            break;

        case 'mission':
            $time = $request->start . ' - ' . $request->end;
            return $request->date . ' ( ' . $time . ' )';
            break;

        case 'over_time':
            $time = $request->start . ' - ' . $request->end;
            return $request->date . ' ( ' . $time . ' )';
            break;


        case 'permission':
            $time = $request->from . ' - ' . $request->to;
            return $request->date . ' ( ' . $time . ' )';
            break;
        default:
            '-';
    }
}


