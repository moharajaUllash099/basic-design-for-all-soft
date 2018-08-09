<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting;
use DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'   =>  ['name'=>'settings','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'active_child_menu'     =>  ['name'=>'general_setting','link'=> 'javascript:void(0)'],
            'alerts'                =>  [
                'info'              =>  'Fields with (*) are required.',
            ],
        ]);

        return view('settings.basic_settings')->with($this->viewData);
    }

    public function validation(Request $request)
    {
        $validate = array();
        foreach ($_POST as $key => $value){
            if ($key != '_token')
                $validate[$key] = 'max:2000';
        }
        return $request->validate($validate);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $saveData = array();
        foreach ($_POST as $key => $value){
            if ($key != '_token')
                $saveData[$key] = $value;
        }

        foreach ($saveData as $key => $val){

            $BasicSettings = BasicSetting::where('name',$key)->get();

            if (count($BasicSettings) > 0) {
                DB::table('basic_settings')
                    ->where('name', $key)
                    ->update(['val' => $val]);
                set_notification('update on general information ('.$key.')');
            }else{
                if (!empty($val)) {
                    $data = [
                        'name' => $key,
                        'val' => $val
                    ];
                    DB::table('basic_settings')->insert($data);
                    set_notification('set new general information ('.$key.')');
                }
            }
        }
        return back()->with('success_', 'Successfully saved!');
    }
}
