@extends('layout.sidebarandnav')

@section('title', 'Expense List');
@section('body')
    <p class=" text-2xl">Expense List</p>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">

        <div class="pb-4 pt-4 font-medium text-lg bg-white flex items-center space-x-2 dark:bg-gray-900">
            <div class="">
                Total Expense Amount
            </div>
            <span id="gtotal"></span>MMK
        </div>

        <table class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3 rounded-l-lg">
                        Description
                    </th>

                    <th scope="col" class="px-6 text-center  py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($expenseList as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 text-center  py-4">
                            {{ $item->description }}
                        </td>
                        <td class="px-6 text-center  py-4">
                            {{ $item->date }}
                        </td>
                        <td class="px-6 text-center  py-4 expsubotal">
                            {{ $item->amount }}
                        </td>
                    </tr>
                @empty
                    <span class=" text-red-500 font-bold">No Expense Data</span>
                @endforelse
            </tbody>
        </table>

    </div>

    <script>
        var subtotal = document.getElementsByClassName("expsubotal");
        var gtotal = document.getElementById("gtotal");
        var gsub = 0;
        for (let i = 0; i < subtotal.length; i++) {
            gsub += parseInt(subtotal[i].innerText);
            gtotal.innerText = gsub;
        }
    </script>

    </div>

    </div>
@endsection
