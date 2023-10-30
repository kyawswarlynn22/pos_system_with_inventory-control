@extends('layout.sidebarandnav')

@section('title', 'Add Expense Category');
@section('body')
    <p class=" text-2xl">Add Expense and Income Category</p>
    <form action="/expenseCategory/{{ $CategoryDetails->id }}" method="post">
        @csrf
        @method('put')
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <span class=" font-semibold text-lg ">Add Category</span>
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full ">
                    <label for="categoryName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                        Name</label>
                    <input type="text" name="categoryName" id="categoryName" value="{{ $CategoryDetails->e_c_name }}"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Category Name" required>
                </div>
                <div class="mb-6 w-full">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input type="text" name="categoryDescription" id="description" value="{{ $CategoryDetails->description }}"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Description">
                </div>

            </div>
            <span class=" ml-[82%]">
                <button class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
                <button class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
            </span>
    </form>
    </div>

@endsection
