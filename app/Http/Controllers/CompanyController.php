<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(){
        return view('company',[
            'title_url' => 'USER | ESA.NET',
            'active' => 'company',
            'title_menu' => 'COMPANY',
            'title_submenu' => 'COMPANY',
            'var_show' => Company::all(),
        ]);
    }

    public function add(Request $post_create_company)
    {
        $var_data = Validator::make($post_create_company->all(), [
            'txt_name_company' => 'required|unique:table_companies,name_company',
        ]);
        
        if( $var_data->fails() ){
            return redirect('/company')
            ->withErrors($var_data)
            ->withInput();
        }else{
            $var_data_valid = $var_data->validated();
//            dd($var_data_valid);
            Company::create([
                'name_company' => $var_data_valid['txt_name_company'],
            ]);
            return redirect('/company')->with('success', 'Create Company Successfully');
        };
  }
}
