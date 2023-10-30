@extends('layout.sidebarandnav')

@section('title', 'Cashsale Details');
@section('body')
    <p class=" text-2xl">Cash Sale Invoice Details</p>
    <div class="mt-3 rounded-lg shadow-lg p-5">
        <span class=" text-lg">See Details : {{ $InvoiceNo }}</span>
        <div class=" border-b "></div>
        <div class="flex justify-between">
            <div class=" flex-col flex ">
                <span class=" text-lg text-blue-500">Customer Info</span>

                <span>{{ $SaleReturn->cus_name }}</span>
                <span>{{ $SaleReturn->phone }}</span>
                <span>{{ $SaleReturn->address }}</span>


            </div>
            <div class=" flex-col flex">
                <span class=" text-lg text-blue-500">Invoice Info</span>
                <span>Invoice No : {{ $InvoiceNo }}</span>

            </div>
        </div>
        <div class="mt-5">
            <table class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3 rounded-l-lg">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price per items
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($SaleReturnDetail as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 text py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->product_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class=" mt-5 flex  flex-col justify-end items-end">

            <div class="flex mt-5 space-x-3  ">
                <span class=" font-semibold text-lg">Discount : </span>
                <span class=" font-semibold text-lg">{{ $SaleReturn->discount }}</span>
            </div>
            <div class="flex mt-5 space-x-3 ">
                <span class=" font-semibold text-lg">Grand Total : </span>
                <span class=" font-semibold text-lg">{{ $SaleReturn->grand_total }}</span>
            </div>
        </div>

    </div>
    </div>

@endsection
