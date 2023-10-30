@extends('layout.sidebarandnav')

@section('title', 'User List');

@section('body')
    <p class=" text-xl font-semibold ">User List</p>
    <a href="/user/create"> <button class=" bg-blue-500 px-5 py-2 text-white rounded-lg float-right mb-5">Add New
            User</button></a>
    <table class="w-full text-sm mt-5 text-left text-gray-500 rounded-lg dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-l-lg">
                    Email
                </th>
                <th scope="col" class="px-6 text-center  py-3">
                    Username
                </th>
                <th scope="col" class="px-6 text-center  py-3">
                    Role
                </th>

                <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userList as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th scope="row" class="px-6 text py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->email }}
                    </th>
                    <td class="px-6 text-center  py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 text-center  py-4">
                        @if ($user->role == 0)
                            Admin
                        @else
                            Staff
                        @endif
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2 ">

                        <a href="/user/{{ $user->id }}/edit"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <g fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415zM16 5l3 3" />
                                </g>
                            </svg>
                        </a>
                        <form action="/user/{{ $user->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <svg width="24" height="24" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#ef4444"
                                        d="M11.5 6h5a2.5 2.5 0 0 0-5 0ZM10 6a4 4 0 0 1 8 0h6.25a.75.75 0 0 1 0 1.5h-1.31l-1.217 14.603A4.25 4.25 0 0 1 17.488 26h-6.976a4.25 4.25 0 0 1-4.235-3.897L5.06 7.5H3.75a.75.75 0 0 1 0-1.5H10ZM7.772 21.978a2.75 2.75 0 0 0 2.74 2.522h6.976a2.75 2.75 0 0 0 2.74-2.522L21.436 7.5H6.565l1.207 14.478ZM11.75 11a.75.75 0 0 1 .75.75v8.5a.75.75 0 0 1-1.5 0v-8.5a.75.75 0 0 1 .75-.75Zm5.25.75a.75.75 0 0 0-1.5 0v8.5a.75.75 0 0 0 1.5 0v-8.5Z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>


            @empty
                <span class=" text-red-500 font-bold">No User</span>
            @endforelse
        </tbody>
    </table>
@endsection
