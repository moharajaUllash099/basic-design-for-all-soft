<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;

//models
use App\Branche;
use Yajra\DataTables\Contracts\DataTable;

class BranchController extends Controller
{
    private $total_open_branch;
    private $permissible_branch;
    public function __construct()
    {
        $this->total_open_branch = DB::table('branches')->where('status','0')->count();
        $this->permissible_branch = get_basic_setting('permissible_branch');
        $this->addViewData([
            'active_menu'   =>  ['name'=>'settings','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'active_child_menu'     =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'alerts'                =>  [],
        ]);

        return view('settings.branch.all_branch')->with($this->viewData);
    }

    public function datatable()
    {
        $branch = Branche::select(['id','name','address','email','phone','vat_id','status','created_at','updated_at'])
            ->orderby('id','DESC');//->first();
        //return $branch;

        return Datatables::of($branch)
            ->editColumn('name',function ($data){
                return '<h3>'.$data->name.'</h3><h4>'.$data->vat_id.'</h4>';
            })
            ->editColumn('address',function ($data){
                return '<p>Email : <a href="mailto:'.$data->email.'">'.$data->email.'</a></p>
                        <p>Phone : <a href="tel:'.$data->phone.'">'.$data->phone.'</a></p>
                        '.$data->address;
            })
            ->editColumn('status',function ($data){
                if($data->status == 0) {
                    return '<span class="badge badge-primary">Running</span>';
                }else{
                    return '<span class="badge badge-danger">Closed</span>';
                }
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at == $data->updated_at){
                    return $data->created_at;
                }else {
                    return $data->created_at . '<br>' . $data->updated_at;
                }
            })
            ->addColumn('action',function ($data){
                $edit_url = url('setting/branch/edit/'.$data->id);

                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.$edit_url.'">
                                        Edit
                                    </a>
                                </li>
                                <li class="divider"></li>';
                            if ($data->status == 0) {
                                $shut_down_url = url('setting/branch/shut_down/'.$data->id);
                                $html .= '<li>
                                            <a href="' . $shut_down_url . '">
                                                Shut Down
                                            </a>
                                        </li>';
                            }else{
                                $reopen_url = url('setting/branch/reopen/'.$data->id);
                                $html .= '<li>
                                            <a href="' . $reopen_url . '">
                                                Reopen
                                            </a>
                                        </li>';
                            }
                    $html .='</ul>
                        </div>';
                return $html;
            })
            ->rawColumns(['name','address','created_at','status','action'])
            ->make(true);
    }

    public function create()
    {
        $this->addViewData([
            'active_child_menu'         =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'active_grandchild_menu'    =>  ['name'=>'new_branch','link'=> 'setting/branch/new'],
            'alerts'                    =>  [
                'info'                  =>  'Fields with (*) are required.',
            ],
        ]);

        if ($this->permissible_branch > $this->total_open_branch){
            /**
             * if permissible branch less than open branch
             * will show view page
             */
            return view('settings.branch.branch')->with($this->viewData);
        }else{
            return back()->with('error_','You already open enough branch. if you want to open more branch please contact us (01533-10 55 64). Thanks');
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|unique:branches,name|max:190',
            'address'       => 'required|max:500',
            'phone'         => 'required|max:190',
            'email'         => 'required|max:190',
            'vat_id'        => 'required|max:190',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        if ($this->permissible_branch > $this->total_open_branch){
            $data = [
                '_token'                =>  $request->token,
                'name'                  =>  $request->name,
                'address'               =>  $request->address,
                'phone'                 =>  $request->phone,
                'email'                 =>  $request->email,
                'vat_id'                =>  $request->vat_id,
            ];

            Branche::create($data);
            set_notification('open a new branch ('.$request->name.') .');

            return redirect('setting/branch')->with('success_','Successfully created!');

        }else{
            return back()->with('error_','You already open enough branch. if you want to open more branch please contact us (01533-10 55 64). Thanks');
        }
    }

    public function edit($id)
    {
        $this->addViewData([
            'active_child_menu'             =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'active_grandchild_menu'        =>  ['name'=>'update_branch','link'=> 'setting/branch/edit/'.$id],
            'this_record'                   =>  DB::table('branches')->where('id',$id)->get(),
            'alerts'                        =>  [
                'info'              =>  'Fields with (*) are required.',
            ],
        ]);
        return view('settings.branch.branch')->with($this->viewData);
    }

    public function update(Request $request, $id)
    {
        $branch = Branche::find($id);
        if (!empty($branch)) {
            $this->validation($request);
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;
            $branch->email = $request->email;
            $branch->vat_id = $request->vat_id;

            $branch->save();
            set_notification('update branch information ('.$request->name.') .');

            return back()->with('success_','Successfully updated!');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function shut_down($id)
    {
        $branch = Branche::find($id);
        if (!empty($branch)) {
            $branch->status = 1;

            $branch->save();
            set_notification('shut down a branch ('.get_branch_name($id).') .');
            return back()->with('success_','This branch successfully shut down. now you can open another branch.');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function reopen($id)
    {
        $branch = Branche::find($id);
        if (!empty($branch)) {
            if ($this->permissible_branch > $this->total_open_branch){
                $branch->status = 0;
                $branch->save();
                set_notification('reopen a branch ('.get_branch_name($id).') .');
                return back()->with('success_','This branch successfully shut down. now you can open another branch.');
            }else{
                return back()->with('error_', 'You already open enough branch. if you want to open more branch please contact us (01533-10 55 64). Thanks');
            }

        }else{
            return back()->with('error_', 'There is no record found');
        }
    }
}
