@extends('layout.sidebarandnav')

@section('title', 'Edit User');

@section('body')
    <p class=" text-xl font-semibold">Edit User</p>
    <form action="/user/{{ $userEdit->id }}" method="POST">
        @csrf
        @method('put')
    <section class=" flex justify-center">
        <div class=" flex flex-col w-96 mt-5 space-y-3">
            <label for="email">Email</label>
            <input type="email" readonly name="email" value="{{ $userEdit->email }}" id="">
            <label for="username">Username</label>
            <input type="text" name="username" value="{{ $userEdit->name }}" id="">
            <label for="role">Role</label>
            <select name="role" id="">
                <option value="0" @if ($userEdit->role == 0) selected @endif>Admin</option>
                <option value="1" @if ($userEdit->role == 1) selected @endif>Staff</option>
            </select>
        </div>

    </section>
    <span class=" mt-10 ml-[82%]">
        <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
        <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
    </span>
</form>
@endsection
