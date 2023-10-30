@extends('layout.sidebarandnav')

@section('title', 'Product List');
@section('body')
    <p class=" text-2xl">Product Pending List</p>

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
                        Product Name
                    </th>

                    <th scope="col" class="px-6 text-center  py-3 ">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3 text-center  rounded-r-lg">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productData as $product)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="px-6 text py-4 flex items-center space-x-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                            <p class=" text-base">{{ $product->product_name }}</p>
                        </th>

                        <td class="px-6 text-center py-4">
                            {{ $product->stock }}
                        </td>
                        <form action="/productpending/{{ $product->product_id }}" method="post">
                            <input type="text" name="stock" value="{{ $product->stock }}" hidden>
                            <input type="text" name="p_id" value="{{ $product->id }}" hidden>
                            <td class=" flex justify-center  space-x-2 text-white items-baseline ">
                                @csrf
                                @method('put')
                                <button type="submit" class="px-5 rounded-md py-1 bg-blue-500">
                                    Accept
                                </button>
                        </form>
                        <a href="/stockadjustment/{{ $product->id }}/edit" <button
                            class="px-5 rounded-md py-1 bg-blue-500">
                            Edit
                            </button>
                        </a>

                        </td>
                    </tr>
                @empty
                    <div class=" text-center relative top-20 text-red-500 font-bold">No Product Data</div>
                @endforelse


            </tbody>

        </table>
        <div class="p-5">
            {{ $productData->links('pagination::tailwind') }}
        </div>
        @if (session('success'))
            <script>
                let msg = @json(session('success'));
                swal("Good job!", msg, "success");
            </script>
        @endif
    </div>

@endsection
