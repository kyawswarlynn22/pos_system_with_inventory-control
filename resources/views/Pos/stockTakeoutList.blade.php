@extends('layout.sidebarandnav')
@php
    $userRole = Session::get('userRole');
@endphp
@section('title', 'Cash Sale List');
@section('body')
    <p class=" text-2xl">Stock Takeout List</p>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <div class="pb-4 bg-white dark:bg-gray-900">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
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
                        Customer Name
                    </th>
                    <th scope="col" class="px-6 text-center  py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 text-center  py-3">
                        Disount
                    </th>
                    <th scope="col" class="px-6 text-center  py-3">
                        Grand Total
                    </th>
                    <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($CashSaleData as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="px-6 text py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->cus_name }}
                        </th>
                        <td class="px-6 text-center  py-4">
                            {{ $item->date_only }}
                        </td>
                        <td class="px-6 text-center  py-4">
                            {{ $item->discount }}
                        </td>
                        <td class="px-6 text-center  py-4">
                            {{ $item->grand_total }}
                        </td>

                        <td class="px-6 py-4 flex justify-center space-x-2 ">
                            <a href="/stocktakeout/{{ $item->id }}">
                                <svg width="24" height="24" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#3b82f6"
                                        d="M33.62 17.53c-3.37-6.23-9.28-10-15.82-10S5.34 11.3 2 17.53l-.28.47l.26.48c3.37 6.23 9.28 10 15.82 10s12.46-3.72 15.82-10l.26-.48Zm-15.82 8.9C12.17 26.43 7 23.29 4 18c3-5.29 8.17-8.43 13.8-8.43S28.54 12.72 31.59 18c-3.05 5.29-8.17 8.43-13.79 8.43Z"
                                        class="clr-i-outline clr-i-outline-path-1" />
                                    <path fill="#3b82f6"
                                        d="M18.09 11.17A6.86 6.86 0 1 0 25 18a6.86 6.86 0 0 0-6.91-6.83Zm0 11.72A4.86 4.86 0 1 1 23 18a4.87 4.87 0 0 1-4.91 4.89Z"
                                        class="clr-i-outline clr-i-outline-path-2" />
                                    <path fill="none" d="M0 0h36v36H0z" />
                                </svg>
                            </a>
                            @if ($userRole == 0)
                                <a href="/stocktakeout/{{ $item->id }}/edit"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415zM16 5l3 3" />
                                        </g>
                                    </svg>
                                </a>
                            @endif

                        

                            <form action="/stocktakeout/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button 
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline delete_icon">
                                    <svg width="24" height="24" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path fill="#ef4444" d="m19.828 18.256l-.002.015c249.642 36.995 371.904 169.983 397.32 278.01c-2.094 5.977-4.496 11.044-7.068 14.968c-17.29 26.383-62.522 40.075-101.654 28.596c5.984-19.75 10.132-39.834 12.07-59.12c-95.46 8.177-212.544 8.42-301.207-22.642c41.727 95.317 99.325 164.465 164.983 230.08c18.296-2.164 35.807-11.35 51.837-25.37c85.218 34.667 188.066-2.555 226.748-60.68c46.922-70.5 74.07-317.52-167.462-383.856H232.81c160.326 54.874 195.73 167.74 191.573 239.03c-37.15-93.627-137.68-191.855-312.38-239.03H19.83z"/>
                                    </svg>
                                </button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <div class=" text-red-500 text-xl font-bold ">No CashSale Details</div>
                @endforelse
            </tbody>
        </table>
        @foreach ($CashSaleData as $item)
            <span class="created-at hidden">{{ $item->created_at }}</span>
        @endforeach
        <div class="p-5">
            {{ $CashSaleData->links('pagination::tailwind') }}
        </div>
    </div>


@endsection
