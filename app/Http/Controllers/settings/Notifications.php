<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications as Notification;
use DB;
use Auth;

class Notifications extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'   =>  ['name'=>'Notifications','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'notifications'         =>  DB::table('notifications')->orderBy('id', 'desc')->paginate(25),
            'alerts'                =>  [],
        ]);
        DB::table('notifications')->where('status', 0)->update(['status' => 1]);
        return view('settings.notifications.notification')->with($this->viewData);
    }

    public function get_total_new_notification()
    {
        $total_new_notification = DB::table('notifications')->where('status',0)->count();
        $data = [];
        if($total_new_notification > 0){
            $data = [
                'status'    =>  'success',
                'data'      =>  $total_new_notification
            ];
        }
        return $data;
    }

    public function check_jquery_login()
    {
        if(Auth::check()){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function notification_see()
    {
        if (DB::table('notifications')->where('status', 0)->update(['status' => 1])){
            return 'true';
        }else{
            return 'false';
        }
    }
}
