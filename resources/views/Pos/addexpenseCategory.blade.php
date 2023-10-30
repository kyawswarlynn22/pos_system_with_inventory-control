@extends('layout.sidebarandnav')

@section('title', 'Add Expense Category');
@section('body')
    <p class=" text-2xl">Add Expense and Income Category</p>
    <form action="/expenseCategory" method="post">
        @csrf
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <span class=" font-semibold text-lg ">Add Category</span>
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-3">
        <table class="w-full text-sm text-left  text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white  uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Category Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 float-right py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ExpenseCategoryList as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->e_c_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->description }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="/expenseCategory/{{ $item->id }}/edit"
                                class="font-medium float-right text-blue-600 dark:text-blue-500 hover:underline">
                                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <g fill="none" stroke="#3b82f6" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415zM16 5l3 3" />
                                    </g>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                @endforelse


            </tbody>
        </table>
    </div>

@endsection
