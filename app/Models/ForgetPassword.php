<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Str;

class ForgetPassword extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'password_reset_tokens';

    protected $fillable = ['mail', 'token'];

    public function ForgetPassword($request)
    {
        $token = Str::random(64);

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        session()->put('token', $token);

        ForgetPassword::create([
            'mail' => $request->email,
            'token' => $token,
            // 'update_at' => now(),
        ]);
    }

    public function newPasswordUpdate($request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $password = ForgetPassword::where([
            'mail' => $request->email,
            'token' => $request->token
        ]);
       
        if (!$password) {
            dd("good");
            return redirect()->intended('/forget_password')->withSuccess('Invalid Reset Link. Try Again!');
        }
        
        $user = DB::table('users')->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

            if (!$user) {
                
                echo '<script>alert("Invalid Reset Link.Back and Send Reset Link Again!");</script>';
                
            } 
            
        $delete = ForgetPassword::where('mail',$request->email);
        if ($delete) {
            $delete->delete();
        }

       
    }
}
