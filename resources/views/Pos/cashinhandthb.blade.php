@extends('layout.sidebarandnav')

@section('title', 'Product List');
@section('body')
    <p class=" text-2xl">THB Adjustment</p>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <form action="/cashthb/{{ 1 }}" method="post">
            @csrf
            @method('PUT')
            <div class="flex space-x-3 p-5 w-full justify-items-center items-center">
                <div class="mb-6 w-full">
                    <label for="dateInput" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                    </label>
                    <input type="date" name="dateInput" id="dateInput" disabled
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </input>
                </div>
                <div class="mb-6 w-full ">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Amont(THB)
                    </label>
                    <input type="number" name="amount" id="amount"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="amount" required>
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
    <script>
        // Get the current date
        const currentDate = new Date();

        // Format the date as "YYYY-MM-DD" (required for input type="date")
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const day = String(currentDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;

        // Set the input's value to the current date
        document.getElementById("dateInput").value = formattedDate;
    </script>
@endsection
