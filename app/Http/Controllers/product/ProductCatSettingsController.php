<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DataTables;
use File;
use DB;
#models
use App\Categories;

class ProductCatSettingsController extends Controller
{
    public function __construct(){
        $this->addViewData([
            'active_menu'   =>  ['name'=>'product_setting','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'active_child_menu'         =>  ['name'=>'product_category','link'=>'product/category'],
            'alerts'                    =>  [],
        ]);
        return view('product_settings.category')->with($this->viewData);
    }

    public function datatable()
    {
        $categories = Categories::select(['id','parent','name','is_deleted','created_at','updated_at'])->latest('id');

        return Datatables::of($categories)
            ->editColumn('id',function ($data){
                return $data->id;
            })
            ->editColumn('parent',function ($data){
                $parent_name = get_cat($data->parent);
                return $parent_name;
            })
            ->editColumn('name',function ($data){
                return $data->name;
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at != $data->updated_at){
                    return $data->created_at . '<br>' . $data->updated_at;
                }else{
                    return $data->created_at ;
                }
            })
            ->addColumn('action',function ($data){
                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-xs dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">';
                $edit_url = url('product/category/edit/'.$data->id);
                $html .= '  <li>
                                <a href="'.$edit_url.'">Edit</a>
                            </li><li class="divider"></li>';

                if ($data->is_deleted == 0) {
                    $deactivate_url = url('product/category/deactivate/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to deactivate this ?\');" href="' . $deactivate_url . '">
                                    Deactivate
                                </a>
                            </li>';
                }
                else{//if($data->is_deleted == 1){
                    $reactive_url = url('product/category/reactive/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to reactive this ?\');" href="' . $reactive_url . '">
                                    Reactive
                                </a>
                            </li>';
                }
                return $html;
            })
            ->rawColumns(['action','created_at'])
            ->make(true);
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|max:190',
            'parent'        => 'required|max:11',
            'img'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    }

    
    public function store(Request $request)
    {
        $this->validation($request);
        $photos_path = public_path('/soft/uploads');
        if ($request->hasFile('img')) {

            $photo = $request->file('img');
            $name = sha1(date('YmdHis') . str_random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $photo->move($photos_path, $save_name);

            $data = [
                '_token'                =>  $request->token,
                'name'                  =>  $request->name,
                'parent'                =>  $request->parent,
                'img'                   =>  $save_name,                
            ];

            Categories::create($data);
            set_notification('open a new category ('.$request->name.') .');
        }else{
            $data = [
                '_token'                =>  $request->token,
                'name'                  =>  $request->name,
                'parent'                =>  $request->parent
            ];

            Categories::create($data);
            set_notification('open a new category ('.$request->name.') .');
        }

        return back()->with('success_','Successfully created!');
    }


    public function edit($id)
    {
        $this->addViewData([
            'active_child_menu'         =>  ['name'=>'product_category','link'=>'product/category'],
            'this_record'               =>  DB::table('categories')->where('id',$id)->get(),
            'alerts'                    =>  [],
        ]);
        return view('product_settings.category')->with($this->viewData);
    }


    public function update(Request $request, $id)
    {
        $this->validation($request);
        $cat = Categories::find($id);
        $photos_path = public_path('/soft/uploads');
        if (!empty($cat)){
            if ($request->hasFile('img')){
                /*
                 * remove previous picture and add new picture
                 */

                #get file name
                $file = $cat->img;

                #set file location
                $filename = public_path('soft/uploads/'.$file);

                /*
                 * first upload new file then delete previous file
                 */
                #upload new file
                $photo = $request->file('img');
                $name = sha1(date('YmdHis') . str_random(30));
                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                $photo->move($photos_path, $save_name);

                #now save information on database
                $cat->name   = $request->name;
                $cat->parent  = $request->parent;
                $cat->img    = $save_name;

                #delete previous file
                if(file_exists($filename)){
                    File::delete($filename);
                }
            }
            else{
                /*
                 * add update without picture
                 */
                if(isset($request->remove_img)){
                    /*
                     * remove picture from database
                     * make img Field empty
                     */
                    #get file name
                    $file = $cat->img;

                    #set file location
                    $filename = public_path('soft/uploads/'.$file);

                    #now save information on database
                    $cat->name   = $request->name;
                    $cat->parent  = $request->parent;
                    $cat->img    = '';

                    #delete previous file
                    if(file_exists($filename)){
                        File::delete($filename);
                    }

                }else{
                    /*
                     * do nothing in img field
                     */
                    $cat->name   = $request->name;
                    $cat->parent   = $request->parent;
                }
            }
            $cat->save();
            set_notification('update category information ('.$request->name.')');
            return back()->with('success_','Successfully Done!');
        }
        else{
            return back()->with('error_', 'There is no record found');
        }
        return $cat;
    }

    public function deactivate($id)
    {
        $cat = Categories::find($id);
        if (!empty($cat)) {
            $cat->is_deleted = 1;
            $cat->save();
            set_notification('deactivate a categories ('.get_cat($id).') .');
            return back()->with('success_','Successfully Done!');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }

    public function reactive($id)
    {
        $cat = Categories::find($id);
        if (!empty($cat)) {
            $cat->is_deleted = 0;
            $cat->save();
            set_notification('reactive a categories ('.get_cat($id).') .');
            return back()->with('success_','Successfully Done!');
        }else{
            return back()->with('error_', 'There is no record found');
        }
    }
}
