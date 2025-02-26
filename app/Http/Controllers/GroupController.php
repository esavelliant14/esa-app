<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Privilege;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    public function index(){
        
        if (!Gate::allows('access-permission' , '1')) {
            return redirect('/main');
        }
        if ( auth()->user()->id_group == 1 ){
            $show_group = Group::all();
        } else {
            $show_group = Group::where('id' , auth()->user()->id_group)->get();
        }

        return view('group',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'group',
            'title_menu' => 'GROUP',
            'title_submenu' => 'GROUP',
            'var_show' => $show_group,
        ]);
    }

    public function add(Request $post_create_group)
    {
        $var_data = Validator::make($post_create_group->all(), [
            'txt_name_group' => 'required|unique:table_groups,name_group',
        ],[
            'txt_name_group.required' => 'Name Group is required',
            'txt_name_group.unique' => 'Name Group already exist'
        ]);
        
        if( $var_data->fails() ){
            return redirect('/group')
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
//            dd($var_data_valid);
            Group::create([
                'name_group' => $var_data_valid['txt_name_group'],
            ]);
            return redirect('/group')->with('success', 'Create Group Successfully');
        };
  }

  public function delete($id)
  {
          $check_privilege = Privilege::where('id_group' , $id)->count();
          //dd($test);
          if($check_privilege == "0"){
              Group::destroy('id' , $id);      
              return redirect('/group')->with('success', 'Delete Group Successfully');
          }else {
              return redirect('/group')->with('failed', 'Group still used by privilege');
          }
          
  }

}
