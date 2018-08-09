<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('get_soft_category_select')){
    function Get_soft_category_select(){
        $parent_categorys = DB::table('categories')->where('parent', 0)->get();
        $parent[0] = 'None';
        foreach ($parent_categorys as $pc) {
            $parent[$pc->id] =  $pc->name;
            if (check_have_sub_cat($pc->id)){
                $parent = array_merge($parent,get_sub_cat($pc->id,1));
                //$parent .= ;
                //$html .=$this->get_sub_cat($pc->id,1);
            }
        }
        return $parent;
    }
}

if (!function_exists('get_sub_cat')){
    function get_sub_cat($id,$level){
        $sub_categorys = DB::table('categories')->where('parent', $id)->get();
        $l = get_level($level);
        $parent =  [];
        foreach ($sub_categorys as $sc) {
            $parent[$sc->id] =  $l.$sc->name;
            if (check_have_sub_cat($sc->id)){
                $parent = array_merge($parent,supper_sub_cat($sc->id,$level+1));
            }
        }
        return $parent;
    }
}

if (!function_exists('supper_sub_cat')){
    function supper_sub_cat($id,$level){
        $sub_categorys = DB::table('categories')->where('parent', $id)->get();
        $l = get_level($level);
        $parent =  [];
        foreach ($sub_categorys as $sc) {
            $parent[$sc->id] =  $l.$sc->name;
            if (check_have_sub_cat($sc->id)){
                $parent = array_merge($parent,supper_sub_cat($sc->id,$level+1));
            }
        }
        return $parent;
    }
}

if (!function_exists('check_have_sub_cat')){
    function check_have_sub_cat($parent){
        $sub_categorys = $info = DB::table('categories')->where('parent', $parent)->count();
        if ($sub_categorys > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

if (!function_exists('get_level')){
    function get_level($level){
        $light = '';
        for ($i=1; $i <= $level; $i++) {
            $light.= '-';
        }
        return $light;
    }
}