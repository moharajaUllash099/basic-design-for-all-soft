<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Auth;
use DB;
use File;
use Hash;
use App\User;
class ProfileController extends Controller
{

    public function __construct(){

        $this->addViewData([
            'active_menu'   =>  ['name'=>'profile','link'=>'profile']
        ]);
    }


    public function index()
    {
        $user = Auth::user();
        $this->addViewData([
            'this_record'   =>  DB::table('users')->where('id',$user->id)->get(),
            'roles'         =>  DB::table('roles')->get(),
            'alerts'        =>  [
                'info'      =>  'Fields with (*) are required.',
            ],
        ]);
        return view('profile')->with($this->viewData);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $photos_path = public_path('/soft/uploads');

        if ($request->hasFile('img')) {
            //if admin try to set his profile picture or try to updating profile picture
            if (empty($request->oldpassword)){
                // when admin password not updating
                $this->validate($request, [
                    'img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name'  => 'required|max:190',
                    'email' => 'required|email|max:190|unique:users,email,'.$id
                ]);
                $me = User::find($id);
                //return $me;
                if (!empty($me)) {

                    $file = $me->img;
                    $filename = public_path('soft/uploads/'.$file);

                    if(file_exists($filename)){
                        File::delete($filename);
                    }

                    $photo = $request->file('img');
                    $name = sha1(date('YmdHis') . str_random(30));
                    $save_name = $name . '.' . $photo->getClientOriginalExtension();
                    $photo->move($photos_path, $save_name);

                    $me->name   = $request->name;
                    $me->email  = $request->email;
                    $me->img    = $save_name;
                    $me->save();
                    set_notification('update own profile');
                    return back()->with('success_','Successfully Done!');
                }else{
                    return back()->with('error_', 'There is no record found');
                }
            }
            else{
                // when admin password updating
                $attempt = [
                    'id'                    => $id,
                    'password'              => $request->oldpassword
                ];
                if (Auth::attempt($attempt)){
                    $this->validate($request, [
                        'img'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'name'      => 'required|max:190',
                        'email' => 'required|email|max:190|unique:users,email,'.$id,
                        'password'  => 'required|confirmed|min:8|max:190'
                    ]);
                    $me = User::find($id);
                    if (!empty($me)) {

                        $file = $me->img;
                        $filename = public_path('soft/uploads/'.$file);

                        if(file_exists($filename)){
                            File::delete($filename);
                        }

                        $photo = $request->file('img');
                        $name = sha1(date('YmdHis') . str_random(30));
                        $save_name = $name . '.' . $photo->getClientOriginalExtension();
                        $photo->move($photos_path, $save_name);

                        $me->name       = $request->name;
                        $me->email      = $request->email;
                        $me->img        = $save_name;
                        $me->password   = Hash::make($request->password);

                        $me->save();
                        set_notification('update own profile');
                        return back()->with('success_','Successfully Done!');
                    }
                    else{
                        return back()->with('error_', 'There is no record found');
                    }
                }
                else{
                    return back()->with('error_', 'invalid information');
                }
            }
        }
        else{
            //if admin seting his profile picture
            if (empty($request->oldpassword)){
                // when admin password not updating
                $this->validate($request, [
                    'name'  => 'required|max:190',
                    'email' => 'required|email|max:190|unique:users,email,'.$id
                ]);
                $me = User::find($id);
                //return $me;
                if (!empty($me)) {
                    $me->name   = $request->name;
                    $me->email  = $request->email;
                    $me->save();
                    set_notification('update own profile');
                    return back()->with('success_','Successfully Done!');
                }else{
                    return back()->with('error_', 'There is no record found');
                }
            }
            else{
                // when admin password updating
                $attempt = [
                    'id'                    => $id,
                    'password'              => $request->oldpassword
                ];
                if (Auth::attempt($attempt)){
                    $this->validate($request, [
                        'name'      => 'required|max:190',
                        'email' => 'required|email|max:190|unique:users,email,'.$id,
                        'password'  => 'required|confirmed|min:8|max:190'
                    ]);
                    $me = User::find($id);
                    if (!empty($me)) {

                        $me->name       = $request->name;
                        $me->email      = $request->email;
                        $me->password   = Hash::make($request->password);

                        $me->save();
                        set_notification('update own profile');
                        return back()->with('success_','Successfully Done!');
                    }
                    else{
                        return back()->with('error_', 'There is no record found');
                    }
                }
                else{
                    return back()->with('error_', 'invalid information');
                }
            }
        }
    }
}
