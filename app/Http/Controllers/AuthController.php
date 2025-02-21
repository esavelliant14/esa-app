<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index() {
        return view('auth' ,[
            'title_url' => 'LOGIN | ESA.NET',
        ]);
    }

    public function authenticate(Request $post_login) {
        
        $post_login->validate([
            'txt_email' => 'required|email:dns',
            'txt_password' => 'required',
        ]);

        
        $var_data = [
            'email' => $post_login->txt_email,
            'password' => $post_login->txt_password,
        ];

        if(Auth::attempt($var_data)) {
            $post_login->session()->regenerate();
            return redirect()->intended('main/');
        }
        return back()->with('failed','Wrong Username/Password');
    }

    public function logout(Request $post_logout): RedirectResponse
    {
        Auth::logout();
    
        $post_logout->session()->invalidate();
    
        $post_logout->session()->regenerateToken();
    
        return redirect('main');
    }

    public function profile(){
        return view('profile',[
            'title_url' => 'PROFILE',
            'active' => 'profile',
            'title_menu' => 'PROFILE',
            'title_submenu' => 'PROFILE',
        ]);
    }

    public function change_password(){
        return view('change-password',[
            'title_url' => 'PROFILE',
            'active' => 'profile',
            'title_menu' => 'PROFILE',
            'title_submenu' => 'PROFILE',
        ]);
    }

}
