@extends('layout.sidebarandnav')

@section('title', 'Product List');
@section('body')
    <p class=" text-2xl">Stock Adjustment</p>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <form action="/stockadjustment/{{ $EditAdjust->id }}" method="POST">
            @csrf
            @method('put')
        <div class="flex space-x-3 p-5 w-full justify-items-center items-center">
            <div class="mb-6 w-full">
                <label for="product_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                    </label>
                <select name="product_id" id="product_id"
                    class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($productData as $item)
                    <option value="{{ $item->id }}" @if ($item->id == $EditAdjust->id) selected @endif>
                        {{ $item->product_name }}</option>
                @endforeach
                </select>
            </div>
            <div class="mb-6 w-full ">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Stock
                </label>
                <input type="number" name="stock" id="stock" value="{{ $EditAdjust->stock }}"
                    class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="stock">
                @error('stock')
                    <p class=" text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <span class="mt-5 ml-[83%]">
            <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
            <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
        </span>
    </form>
    </div>
    @if (session('success'))
    <script>
        let msg = @json(session('success'));
        swal("Good job!", msg, "success");
    </script>
@endif

@endsection
