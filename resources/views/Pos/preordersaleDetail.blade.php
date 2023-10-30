@extends('layout.sidebarandnav')

@section('title', 'Preorder sale Details');
@section('body')
    <form action="/cashsale" method="post">
        @csrf
        <p class=" text-2xl">Preorder Sale Invoice Details</p>
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <span class=" text-lg">See Details : {{ $InvoiceNo }}</span>
            <div class=" border-b "></div>
            <input type="text" hidden name="preorder_id" value="{{ $CashDetails->preorder_id }}">
            <div class="flex justify-between">
                <div class=" flex-col flex ">
                    <span class=" text-lg text-blue-500">Customer Info</span>
                    <input hidden name="customer" value="{{ $CashDetails->id }}">
                    <span>{{ $CashDetails->cus_name }}</span>
                    <span>{{ $CashDetails->phone }}</span>
                    <span>{{ $CashDetails->address }}</span>
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
                            <th scope="col" class="px-6 py-3">
                                Serial No
                            </th>
                            <th scope="col" class="px-6 text-right  py-3">
                                Subtotal
                            </th>
                            <th scope="col" class="px-6  flex justify-start py-3">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ProductDetails as $item)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <input type="text" readonly
                                        class="outline-none border-gray-300 border-transparent rounded-md product_select"
                                        value="{{ $item->product_name }}">
                                </td>
                                <td class="px-6 py-3">
                                    <input type="number" readonly name="price[]"
                                        class="outline-none border-transparent rounded-lg iprice"
                                        value="{{ $item->price }}">
                                </td>
                                <td>
                                    <input type="number" readonly name="quantities[]"
                                        class="outline-none border-transparent border-gray-300 rounded-lg iquantity"
                                        value="{{ $item->quantity }}">
                                </td>
                                <td>
                                    <input type="text"  name="serial[]"
                                        class="outline-none border-grey-400 border-gray-300 rounded-lg "
                                        >
                                </td>
                                <td>
                                    <input type="text" readonly
                                        class="outline-none w-full text-right float-right border-transparent rounded-lg itotal"
                                        value="">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="text" readonly name="productsid[]" hidden
                                        class="outline-none border-gray-300 border-transparent rounded-md product_select"
                                        value="{{ $item->id }}">
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
                    <input id="discount" readonly name="discount" value="{{ $CashDetails->discount }}"
                        class=" font-semibold w-20 text-lg">
                </div>
                <div class="flex mt-5 space-x-3 ">
                    <span class=" font-semibold text-lg">Grand Total : </span>
                    <input readonly id="gtotal" value="{{ $CashDetails->grand_total }}" name='grandtotal'
                        class=" font-semibold w-20 text-lg">
                </div>

            </div>
            <div>
                <span>Remarks</span>:<input type="text" readonly class=" border-transparent" name="remark"
                    value="{{ $CashDetails->remark }}" id="">
            </div>
            <div class=" flex justify-end space-x-1 pt-5">
                <button class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Add to Cashsale</button>
                <button class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
            </div>
        </div>
        @if (session('fail'))
        <script>
            let msg = @json(session('fail'));
            swal("Done", msg, "error");
        </script>
    @endif
        </div>

        <script src="{{ asset('js/output.js') }}" defer></script>
    </form>
@endsection
