<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $userListClass = new User();
        $userList = $userListClass->userList();
        return view('Pos.userList',[
            'userList' => $userList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pos.addUser');
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
        $userEditClass = new User();
        $userEdit = $userEditClass->userDetail($id);
        if ($userEdit == null) {
            return view('error.404');
        }
        return view('Pos.editUser',[
            'userEdit' => $userEdit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   $validateData = $request->validate([
        'username' => 'required',
    ]);
        $userUpdateClass = new User();
        $userUpdate = $userUpdateClass->userUpdate($request,$id);
        return redirect("/user");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userDel = User::find($id);
        if ($userDel) {
           $userDel->delete();
        }
        
        return redirect('/user');
    }
}
