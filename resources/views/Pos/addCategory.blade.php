@extends('layout.sidebarandnav')

@section('title', 'Add Category');
@section('body')
    <p class=" text-2xl">Add Category</p>
    <div class="mt-3 rounded-lg shadow-lg p-5">
        <form action="/category" method="post">
            @csrf
            <span class=" font-semibold text-lg ">Add Main Category</span>
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full ">
                    <label for="categoryName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                        Name</label>
                    <input type="text" name="categoryName" id="categoryName"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Category Name" required>
                </div>
                <div class="mb-6 w-full">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input type="text" name="categoryDescription" id="description"
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
    <div class="mt-3 rounded-lg shadow-lg p-5">
        <form action="/subcategory" method="post">
            @csrf
        <span class=" font-semibold ">Add Sub Category</span>
        <div class="flex w-full justify-around items-center space-x-3 p-5">
            <div class="mb-6 w-full ">
                <label for="subcategoryName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                    Name</label>
                <input type="text" name="subcategoryName" id="subcategoryName"
                    class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Sub Category Name" required>
            </div>
            <div class="mb-6 w-full">
                <label for="mainCategory_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Main
                    Category</label>
                <select name="mainCategory_id" id="mainCategory_id"
                    class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @forelse ($categoryList as $category)
                        <option value="{{ $category->id }}">{{ $category->c_name }}</option>
                    @empty
                        <span class=" text-red-500 font-bold">No Sub Category Data</span>
                    @endforelse
                </select>
            </div>

        </div>

        <div class="mb-6 w-full p-5">
            <label for="sub_description"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <input type="textarea" name="sub_description" id="sub_description"
                class="bg-gray-50 border outline-none w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Description">
        </div>
        <span class=" ml-[82%]">
            <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
            <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
        </span>
    </form>
    </div>
@endsection
