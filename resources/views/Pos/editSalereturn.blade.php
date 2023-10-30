@extends('layout.sidebarandnav')

@section('title', 'Edit Sale Return');
@section('body')
    <p class=" text-2xl">Edit Sale Return</p>
    <form action="/salereturn/{{ $SaleReturn->return_id }}" method="post">
        @csrf
        @method('put')
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <span>Invoice No: {{ $SaleReturn->return_id }}</span>
                </div>
            </div>
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full">
                    <label for="customer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer Name
                    </label>
                    <select name="customer" id="customer"
                        class="bg-gray-50 border w-1/2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse ($customerList as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $SaleReturn->customers_id) selected @endif>
                                {{ $item->cus_name }}</option>
                        @empty
                            <option value="">No Customer</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="flex hidden space-x-3 p-5 w-8/12 justify-items-center items-center">
                <div class="mb-6 w-full">
                    <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                        Name</label>
                    <select id="productselect"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">-- choose product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6 w-full ">
                    <label for="purchasedate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Puchase
                        Quantity
                    </label>
                    <input type="number" min="0" value="1" name="purchasedate" id="itemQuantity"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Category Name" required>
                </div>
                <button type="button" id="add"
                    class=" bg-yellow-400 text-white rounded-lg font-medium px-5 w-60 py-2 get-details">Add to
                    list</button>
            </div>
            <div class="card-body">
                <table id="products_table" class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 rounded-l-lg">Product</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Quantity</th>
                            <th scope="col" class="px-6 float-right py-3">Amount</th>
                            <th scope="col" class="px-6 py-3 rounded-r-lg"></th>
                        </tr>
                    </thead>
                    <tbody id="new">
                        @forelse ($SaleReturnDetail as $item)
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
                            @error('productsid')
                                <p class=" text-red-500">{{ $message }}</p>
                            @enderror
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="flex hidden justify-end">
                    <button id="delBut" type="button" class=" bg-red-500 px-2 py-1 rounded-md my-5">Delete
                        Row</button>
                </div>
                <div class="mt-5 flex items-center justify-end  ">
                    <span class=" font-semibold text-lg">Discount(Ks) : </span>
                    <input type="number" class="rounded-lg font-semibold text-lg w-28 border-transparent" name="discount"
                        value="{{ $SaleReturn->discount }}" id="discount">
                </div>
                <div class="mt-5 flex items-center justify-end  ">
                    <span class=" font-semibold text-lg">Grand Total(Ks) : </span>
                    <input type="number" readonly class="rounded-lg font-semibold text-lg w-28 border-transparent"
                        name="grandtotal" value="" id="gtotal">
                </div>
                <div class=" mt-28 mb-5 flex flex-col">
                    <label for="description">Remarks</label>
                    <textarea name="remark" id="" cols="100" rows="2">{{ $SaleReturn->remark }}</textarea>
                </div>
                <input type="hidden" id="credit">
                <input type="hidden" id="deposit">
                <span class="mt-5 ml-[83%]">
                    <button type="submit"
                        class=" bg-yellow-400  text-white rounded-lg font-medium px-5 py-2">Submit</button>
                    <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
                </span>
            </div>
    </form>

    <script src="{{ asset('js/output.js') }}" defer></script>



@endsection
