<?php

namespace App\Http\Controllers;

use App\Models\ForgetPassword;
use App\Models\LogoandName;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    use \OwenIt\Auditing\Auditable;



    public function showForgetPassword()
    {
        $logoAndNameDataClass = new LogoandName();
        $logoAndNameData = $logoAndNameDataClass->logoAndNameData();
        return view('Pos.forgetPassword', [
            'logoandname' => $logoAndNameData
        ]);
    }

    public function submitForgetPassword(Request $request)
    {
        $foregetPasswordSubmitClass = new ForgetPassword();
        $foregetPasswordSubmit = $foregetPasswordSubmitClass->ForgetPassword($request);

        $token = session()->get('token');

        Mail::send('Pos.emailform', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        $request->session()->put('useremail', $request->email);
        return back()->withSuccess('Reset link sent succefully to your mail!');
    }

    public function showResetPassword($token)
    {
        $token = session()->get('token');
        return view('Pos.resetPassword', [
            'token' => $token,
        ]);
    }

    public function newPassword(Request $request)
    {
        $newUpdatePasswordClass = new ForgetPassword();
        $newUpdatePassword   = $newUpdatePasswordClass->newPasswordUpdate($request);
        session()->flush();
        return redirect('/');
    }
}
