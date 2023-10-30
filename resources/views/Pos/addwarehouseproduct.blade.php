@extends('layout.sidebarandnav')

@section('title', 'Add Warehouse Product');

@section('body')

    <p class=" text-2xl">Add Warehouse Product</p>
    <form action="/warehouse" method="post" >
        @csrf
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full ">
                    <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Product Name
                    </label>
                    <input type="text" name="product_name" id="product_name"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Product Name" required>
                    @error('product_name')
                        <p class=" text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="flex space-x-3 p-5 w-full justify-items-center items-center">

                <div class="mb-6 w-full ">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Buying Price
                    </label>
                    <input type="number" name="price" id="price"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Selling price" required>
                    @error('price')
                        <p class=" text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6 w-full ">
                    <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white " >
                        Quantity
                    </label>
                    <input type="number" name="quantity" id="quantity"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Quantity" required>
                    @error('quantity')
                        <p class=" text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <span class="mt-5 ml-[83%]">
                <button class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
                <button class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
            </span>
    </form>

    @if (session('success'))
        <script>
            let msg = @json(session('success'));
            swal("Done", msg, "success");
        </script>
    @endif
    @if (session('fail'))
        <script>
            let msg = @json(session('fail'));
            swal("Done", msg, "error");
        </script>
    @endif

    </div>

    <script src="{{ asset('js/uploadPhoto.js') }}" defer></script>



@endsection
