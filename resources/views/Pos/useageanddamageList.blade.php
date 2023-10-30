@extends('layout.sidebarandnav')
@php
    $userRole = Session::get('userRole');
@endphp
@section('title', 'Product List');
@section('body')
    <p class=" text-2xl">Serial List</p>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <div class="pb-4 bg-white dark:bg-gray-900">
            <div class="py-3 text-xl">Usage Product List</div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">
            </div>
        </div>

        <table class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3 rounded-l-lg">
                        Product Name
                    </th>
                    <th scope="col" class="px-6 text-center  py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                        Stock
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usageList as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="px-6 text py-4 flex items-center space-x-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            <p class=" text-base">{{ $item->product_name }}</p>
                        </th>
                        <td class="px-6 text-center  py-4">
                            {{ $item->date_only }}
                        </td>
                        <td class="px-6 text-center  py-4">
                            {{ $item->stock }}
                        </td>
                     
                    </tr>
                @empty
                    <span class=" text-red-500 font-bold">No Product Data</span>
                @endforelse


            </tbody>

        </table>

        <div class="p-5">
            {{ $usageList->links('pagination::tailwind') }}
        </div>

        <div class="pb-4 bg-white dark:bg-gray-900">
            <div class="py-3 text-xl">Damage Product List</div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3 rounded-l-lg">
                        Product Name
                    </th>
                    <th scope="col" class="px-6 text-center  py-3">
                       Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                       Stock
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($damageList as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="px-6 text py-4 flex items-center space-x-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            <p class=" text-base">{{ $item->product_name }}</p>
                        </th>
                        <td class="px-6 text-center  py-4">
                            {{ $item->date_only }}
                        </td>
                        <td class="px-6 text-center py-4">
                            {{ $item->stock }}
                        </td>
                        
                    </tr>
                @empty
                    <span class=" text-red-500 font-bold">No Product Data</span>
                @endforelse


            </tbody>

        </table>
        <div class="p-5">
            {{ $damageList->links('pagination::tailwind') }}
        </div>
        @if (session('success'))
            <script>
                let msg = @json(session('success'));
                swal("Good job!", msg, "success");
            </script>
        @endif
    </div>

@endsection
