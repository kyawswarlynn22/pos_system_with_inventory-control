@extends('layout.sidebarandnav')

@section('title', 'Add Category');
@section('body')
    <p class=" text-2xl">Add Expense and Income</p>
    <div class="mt-3 rounded-lg shadow-lg p-5">
        <span class=" font-semibold text-lg ">Add Expense</span>
        <form action="/income/{{ $income->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                        Name</label>
                    <select name="category_id" id="category_id"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @forelse ($incomeCategory as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $income->expense_categories_id) selected @endif>
                                {{ $item->e_c_name }} </option>
                        @empty
                            <span class=" text-red-500 font-bold">No Category</span>
                        @endforelse
                    </select>
                </div>
                <div class="mb-6 w-full">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input type="text" name="categoryDescription" id="description"
                        value="{{ $income->description }}"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Description" required>
                </div>
                <div class="mb-6 w-full">
                    <label for="amount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                    <input type="number" name="amount" id="amount" value="{{ $income->amount }}"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Amount" required>
                </div>
            </div>
            <div
                class=" w-56 h-56 shadow-xl ml-5  justify-center flex-col items-center flex outline-dotted outline-gray-400 rounded-lg">
                <label for="expenset">
                    <img class="h-52" src="{{ $income->photo }}" id="expensephotot" alt="">
                </label>
                <input type="file" class="hidden" id="expenset" accept=".png,.jpeg" name="expphoto">
            </div>
            <span class=" ml-[82%]">
                <button type="submit" class=" bg-yellow-400 text-white rounded-lg font-medium px-5 py-2">Submit</button>
                <button type="button" class=" bg-gray-400 rounded-lg font-medium px-5 py-2">Cancel</button>
            </span>
        </form>
    </div>

    <script>
        document.getElementById("expenset").onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById("expensephotot").src = fr.result;
                };
                fr.readAsDataURL(files[0]);
            }
        };

        document.getElementById("income").onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById("incomephoto").src = fr.result;
                };
                fr.readAsDataURL(files[0]);
            }
        };
    </script>

@endsection
