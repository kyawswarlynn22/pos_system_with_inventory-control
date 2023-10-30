@extends('layout.sidebarandnav')

@section('title', 'Cashsale Details');
@section('body')
    <p class=" text-2xl">
        Purchase Details</p>
    <div class="mt-3 rounded-lg shadow-lg p-5">
        <div class=" border-b "></div>
        <div class="flex w-96 p-5 justify-between">
            <div class="flex flex-col">
                <span>Purchase Country</span>
                <span>Purchase Date</span>
                <span>Shipping Sataus</span>
            </div>
            <div class=" flex flex-col">
                <span>-></span>
                <span>-></span>
                <span>-></span>
            </div>
            <div class=" flex flex-col">
                <span>
                    @if ($puchaseDetail->sup_country == 0)
                        Myanmar
                    @else
                        China
                    @endif
                </span>
                <span>{{ $puchaseDetail->created_at }}</span>
                <span>
                    @if ($puchaseDetail->ship_status == 0)
                        <p class=" text-red-500 font-semibold">Pending</p>
                    @else
                        <p class=" text-green-500 font-semibold">Recived</p>
                    @endif
                </span>
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

                        <th scope="col" class="px-6 py-3 rounded-r-lg">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchaseDetail as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 text py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->product_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->price_per_unit }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->product_quantity }}
                            </td>
                            <td class="px-6 py-4 flex space-x-2">
                                {{ $item->price_per_unit * $item->product_quantity }}
                            </td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
        <div class=" mt-5 flex  flex-col justify-end items-end">
            <div class="flex mt-5 space-x-3 ">
                <span class=" font-semibold text-lg">Grand Total : </span>
                <span class=" font-semibold text-lg">{{ $puchaseDetail->grand_total }}Ks</span>
            </div>
        </div>

    </div>
    </div>

@endsection
