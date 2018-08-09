<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#packages
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
#models
use App\User as Users;
use App\Role;

#Notification
use App\Notifications\UserRegisteredSuccessfully;

class UserController extends Controller
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
            'active_child_menu'     =>  ['name'=>'users','link'=>'setting/users'],
            'alerts'    =>  [],
        ]);
        return view('settings.users.users')->with($this->viewData);
    }

    public function datatable()
    {
        $id = Auth::user()->id;
        $users = Users::select(['id','name','email','role','block','status','created_at','updated_at'])
            ->whereNotIn('id',[$id,'1'])->orderby('id','DESC');

        return Datatables::of($users)
            ->addColumn('action', function ($data) {
                $detail_url = url('setting/user/details/'.$data->id);
                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.$detail_url.'">
                                        Details
                                    </a>
                                </li>';
                if($data->block == 0){
                    $update_url = url('setting/user/block/'.$data->id);
                    $html .=    '<li>
                                    <a href="'.$update_url.'" onclick="return confirm(\'Are you sure want to block this user?\');">
                                        Block
                                    </a>
                                </li>';
                }
                else {
                    $update_url = url('setting/user/unblock/'.$data->id);
                    $html .=    '<li>
                                    <a href="'.$update_url.'"
                                       onclick="return confirm(\'Are you sure want to unblock this user?\');"
                                    >
                                        Unblock
                                    </a>
                                </li>';
                }
                $delete_url =   url('setting/user/delete/'.$data->id);
                $html .='<li class="divider"></li>
                            <li>
                                <a href="'.$delete_url.'"
                                   onclick="return confirm(\'Are you sure want to delete this admin?\')"
                                >
                                    Delete
                                </a>
                            </li>
                        </ul>
                    </div>';
                return $html;
            })
            ->editColumn('name',function ($data){
                $url = '';
                if (!empty($data->img)){
                    $url = asset('soft/uploads/default/'.$data->img);
                }else{
                    $url = asset('soft/uploads/default/user.png');
                }
                $role = get_soft_role($data->role);
                return '<div class="media">
                            <div class="pp" style="display: inline;float: left">
                                <img src="'.$url.'" width="44" height="44">
                            </div>
                            <div class="media-body p-l-10">
                                <div class="heading mt-1">'.$data->name.'</div>
                                <div class="subtext">As <strong>'.$role.'</strong></div>
                            </div>
                       </div>';
            })
            ->editColumn('created_at',function ($data){
                return $data->created_at.'<br>'.$data->updated_at;
            })
            ->editColumn('block',function ($data) {
                $status = '';
                if ($data->status == 0){
                    $status .= '<span class="badge badge-primary">email verified</span>';
                }else{
                    $status .= '<span class="badge badge-danger">email not verified</span>';
                }
                $status .= '<br>';
                if ($data->block == 0){
                    $status .= '<span class="badge badge-primary">login open</span>';
                }else {
                    $status .= '<span class="badge badge-danger">login block</span>';
                }
                return $status;
            })
            ->rawColumns(['name','created_at','block','action'])
            ->removeColumn('password')
            ->make(true);
    }


    public function create()
    {
        $this->addViewData([
            'roles'                     =>  Role::all(),
            'active_child_menu'         =>  ['name'=>'users','link'=>'setting/users'],
            'active_grandchild_menu'    =>  ['name'=>'new_users','link'=> 'setting/user/new'],
            'branches'                  =>  DB::table('branches')->where('status',0)->get(),
            'alerts'                    =>  [
                'info'                  =>  'Fields with (*) are required.',
            ],
        ]);
        return view('settings.users.new_user')->with($this->viewData);
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|max:190',
            'email'         => 'required|email|unique:users,email|max:190',
            'branch'        => 'required|max:11',
            'role'          => 'required|max:11',
            'password'      => 'required|min:8|max:190',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $data = [
            '_token'                =>  $request->token,
            'name'                  =>  $request->name,
            'email'                 =>  $request->email,
            'password'              =>  Hash::make($request->password),
            'branch'                =>  $request->branch,
            'activation_code'       =>  md5(str_random(30).time()),
            'role'                  =>  $request->role,
        ];

        try{
            $user   =  Users::create($data);
            set_notification('New user creates. ('.$request->name.')');
        }catch (Exception $exception){
            return redirect()->back()->with('error_', 'Unable to create new user.');
        }
        $user->notify(new UserRegisteredSuccessfully($user));
        return redirect()->back()->with('success_', 'Successfully created a new account. Please check your email and activate your account.');

    }

    public function show($id)
    {
        $user = get_author($id);
        $this->addViewData([
            'active_child_menu'         => ['name'=>'users','link'=>'setting/users'],
            'active_grandchild_menu'    =>  ['name'=> $user,'link'=>'setting/user/details/'.$id],
            'this_record'               =>  DB::table('users')->where('id',$id)->get(),
            'branches'                  =>  DB::table('branches')->where('status',0)->get(),
            'roles'                     =>  Role::all(),
            'alerts'                    =>  [
                'info'                  =>  'Fields with (*) are required',
            ],
        ]);
        return view('settings.users.details')->with($this->viewData);
    }

    public function block($id)
    {
        $user = Users::find($id);
        if (!empty($user)){
            $user->block = '1';
            $user->save();
            set_notification('Block an user ('.get_author($id).') .');
            return back()->with('success_','Successfully blocked!');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function unblock($id)
    {
        $user = Users::find($id);
        if (!empty($user)){
            $user->block = '0';
            $user->save();

            set_notification('unblock an user ('.get_author($id).') .');
            return back()->with('success_','Successfully unblocked!');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function resetUserPassword(Request $request, $id)
    {
        $user = Users::find($id);
        if (!empty($user)) {
            if(!empty($request->password)) {
                $request->validate([
                    'password'  => 'required|min:8|max:190',
                    'branch'    => 'required|max:11',
                    'role'      => 'required|max:11',
                ]);

                $user->branch = $request->branch;
                $user->role = $request->role;
                $user->password = Hash::make($request->password);
                $user->save();

                set_notification('reset Password and other info like branch OR role('.get_author($id).') .');
                return back()->with('success_', 'Successfully Done!');
            }else{
                $request->validate([
                    'branch'    => 'required|max:11',
                    'role'      => 'required|max:11',
                ]);

                $user->branch = $request->branch;
                $user->role = $request->role;
                $user->save();

                set_notification('reset branch OR role('.get_author($id).') .');
                return back()->with('success_', 'Successfully Done!');
            }
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function destroy($id)
    {
        if (!empty(Users::find($id))){
            Users::where('id',$id)->delete();

            set_notification('delete and user ('.get_author($id).') .');
            return redirect('setting/users')->with('success_', 'Successfully removed!!');
        }else{
            return back()->with('error_','There is no record found');
        }
    }
}
