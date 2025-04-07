<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use App\Models\Logging;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ReCaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // $value = 'asdasdasd';
        $response = Http::get('https://www.google.com/recaptcha/api/siteverify',[
            "secret" => config('app.gsec'),
            "response" => $value,
        ])->json();
        if(!$response['success']){
        //     // dd($response);
            Logging::create([
                'action_by' => 'Guest',
                'category_action' => 'Login',
                'status' => 'Failed',
                'ip_address' => request()->ip(),
                'agent' => request()->header('User-Agent'),
                'details' => 'Failed login because invalid captcha',
    
            ]);
            $fail('Gagal');
        //     dd($response);
            
        }else{
            
        }
    }
}
