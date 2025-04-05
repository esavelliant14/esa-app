<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Logging;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

       
       Fortify::authenticateUsing(function (Request $post_login) {
        $user = User::where('email', $post_login->email)->first();
        
        if ($user && Hash::check($post_login->password, $user->password)) {
            if($user->status == 1){
                return $user;
            }else{
                Logging::create([
                    'action_by' => $post_login->email,
                    'category_action' => 'Login',
                    'status' => 'Failed',
                    'ip_address' => request()->ip(),
                    'agent' => request()->header('User-Agent'),
                    'details' => 'Failed login user=' . $post_login->email . ' because user is inactive',
    
                ]);
                Session::flash('error');
            }
        }else{
            Logging::create([
                'action_by' => $post_login->email,
                'category_action' => 'Login',
                'status' => 'Failed',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Failed login user=' . $post_login->email . ' because wrong credentials',

            ]);
            Session::flash('error');
        }
    });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('auth',[
                'title_url' => 'LOGIN | ESA.NET'
            ]);
        });

        Fortify::twoFactorChallengeView(function(request $request){
            $recovery = $request->get('recovery', false);
            return view('auth-2fa',[
                'title_url' => '2FA AUTH | ESA.NET',
            ], compact('recovery'));
        });

        // Fortify::requestPasswordResetLinkView(function(){
        //     return view('test');
        // });
        
    }
}
