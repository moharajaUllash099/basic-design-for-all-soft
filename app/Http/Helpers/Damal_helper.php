<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('get_basic_setting')){
    function get_basic_setting($name){
        $info = DB::table('basic_settings')->where('name', $name)->get();
        if (isset($info[0])){
            return $info[0]->val;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_author')){
    function get_author($id,$role = ''){
        $info = DB::table('users')->where('id', $id)->get();

        if (!empty($role)) {
            $role = DB::table('damal_role')->where('id', $role)->get();
        }
        if (isset($role[0]) && isset($info[0])) {
            return $info[0]->name.' ('.$role[0]->type.')';
        }elseif(isset($info[0])){
            return $info[0]->name;
        }
    }
}

if (!function_exists('get_cat')){
    function get_cat($id){
        $info = DB::table('categories')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_soft_role')){
    function get_soft_role($id){
        $role = DB::table('roles')->where('id', $id)->get();
        if(isset($role[0])){
            return $role[0]->role_type;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_branch_name')){
    function get_branch_name($id){
        if ($id == 0 ){
            return 'Principal Branch';
        }else{
            $role = DB::table('branches')->where('id', $id)->get();
            if(isset($role[0])){
                return $role[0]->name;
            }else{
                return 'unknown';
            }
        }
    }
}

if(!function_exists('set_notification')){
    function set_notification($msg=''){
        $data = [
            'name'          =>  Auth::user()->name,
            'uid'           =>  Auth::user()->id,
            'role'          =>  Auth::user()->role,
            'msg'           =>  $msg,
            'created_at'    =>  date('Y-m-d H:i:s'),
        ];
        DB::table('notifications')->insert($data);
    }
}

if(!function_exists('have_permission')){
    function have_permission($permission_array = []){
        $role = Auth::user()->role;
        if(in_array($role, $permission_array)){
            return true;
        }else{
            return false;
        }
    }
}