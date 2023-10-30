<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

$email = Session::get('email');

class UpdateprofileController extends Controller 
{
    
    public function usernameUpdate()
    {
       
    }
        
    

    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $email = session('email');
        $usernameUpdateClass = new User();
        $usernameUpdate = $usernameUpdateClass->usernameUpdate($email);
        return view('Pos.editProfileandPassword',[
            'username' => $usernameUpdate
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:users'
        ]);
        $usernameChangeClass = new User();
        $usernameClass = $usernameChangeClass->usernameChange($request,$id);
        return redirect('/profileandpassword');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
