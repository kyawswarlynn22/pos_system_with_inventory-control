@extends('layout.sidebarandnav')

@section('title', 'Create Customer');
@section('body')
    <p class=" text-2xl">Add Customer</p>
    <form action="/customer" method="post">
        @csrf
    <div class="mt-3 rounded-lg shadow-lg p-5 ">
        <div class="flex space-x-3">
            <div class="mb-6 w-full ">
                <label for="categoryName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                    Name</label>
                <input type="text" name="cus_name" id="categoryName"
                    class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Category Name" required>
            </div>
            <div class="mb-6 w-full ">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="text" name="phone" id="description"
                    class="bg-gray-50 border outline-none w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Phone">
            </div>
        </div>
        <div class="mb-6 w-full ">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" name="address" id="description"
                class="bg-gray-50 border outline-none w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Address">
        </div>
        <span class=" ml-[83%]">
            <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
            <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
        </span>
    </form>
    </div>
    </div>
@endsection
