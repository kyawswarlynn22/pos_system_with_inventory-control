@extends('layout.sidebarandnav')

@section('title', 'Add New User');

@section('body')
    <p class=" text-xl font-semibold">Add New User</p>
    <form action="/registration" method="post">
        @csrf
        <section class=" flex justify-center">
            <div class=" flex flex-col w-96 mt-5 space-y-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="">
                @error('email')
                    <p class=" text-red-500">{{ $message }}</p>
                @enderror
                <label for="username">Username</label>
                <input type="text" name="username" id="">
                @error('username')
                    <p class=" text-red-500">{{ $message }}</p>
                @enderror
                <label for="role">Role</label>
                <select name="role" id="">
                    <option value="0">Admin</option>
                    <option value="1">Staff</option>
                </select>
                <label for="password">Password</label>
                <input type="password" name="password" id="">
                @error('password')
                <p class=" text-red-500">{{ $message }}</p>
            @enderror
            </div>

        </section>
        <span class=" mt-10 ml-[82%]">
            <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
            <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
        </span>
    </form>
@endsection
