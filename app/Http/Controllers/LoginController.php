<?php

namespace App\Http\Controllers;

use App\Models\LogoandName;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('Pos.accounting');
    }

    public function signup()
    {
        return view('auth.Signup');
    }

    public function customeRegistration(Request $request)
    {

        $request->session()->put("email", $request->email);

        $request->validate([
            'username' => ['required', 'min:4', 'max:20'],
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => [
                'required',
                'string',
                'min:8'
            ],
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect('/user');
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

    /**
     * Update the specified resource in storage.
     */
    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $userRole = $user->role;
            Session::put('userRole', $userRole);
            $request->session()->put("email", $request->email);
            if ($userRole == 0) {
                return redirect('/dashboard')
                    ->withSuccess('Login Successfully');
            }
            if ($userRole == 1) {
                return redirect('/customer/create')
                    ->withSuccess('Login Successfully');
            }
        }
        Session::flush();


        return redirect("/")->withSuccess('Worng Email or username');
    }

    public function logoandname()
    {
        $logoAndNameDataClass = new LogoandName();
        $logoAndNameData = $logoAndNameDataClass->logoAndNameData();

        session([
            'logo' => $logoAndNameData->logo,
            'business_name' => $logoAndNameData->business_name,
        ]);
        return view('Pos.login', [
            'logoandname' => $logoAndNameData
        ]);
    }
}
