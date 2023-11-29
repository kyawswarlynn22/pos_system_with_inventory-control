@extends('layout.sidebarandnav')

@section('title', 'Add Complaint');

@section('body')

    <p class=" text-2xl">Add Complaint</p>
    <form action="/complaint" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-3 rounded-lg shadow-lg p-5">
            <div class="flex w-full justify-around items-center space-x-3 p-5">
                <div class="mb-6 w-full ">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Customer Name
                    </label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Name">
                </div>
                <div class="mb-6 w-full ">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Phone
                    </label>
                    <input type="text" name="phone" id="phone"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Phone">
                </div>
                <div class="mb-6 w-full">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address
                    </label>
                    <input name="address" id="address"
                        class="bg-gray-50 border w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
           
            <div class="mt-50 p-5 mb-5  flex flex-col">
                <label for="description">Cheif Complaint</label>
                <textarea name="description" class=" rounded-lg " name="description" id="" cols="100" rows="2"></textarea>
                @error('description')
                    <p class=" text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <p class="px-5 font-bold text-xl">Upload Images</p>
            <div class=" p-5 flex justify-between">
                <div
                    class=" w-56 h-56 shadow-xl  justify-center flex-col items-center flex outline-dotted outline-gray-400 rounded-lg">
                    <label for="photo1">
                        <img class="h-52" src="{{ asset('images/upload-filled.png') }}" id="photoimg1" alt="">
                    </label>
                    <input type="file" class=" hidden" id="photo1" accept=".png,.jpeg" name="photo1">
                    @error('photo1')
                        <p class=" text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div
                    class=" w-56 h-56 shadow-xl  justify-center flex-col items-center flex outline-dotted outline-gray-400 rounded-lg">
                    <label for="photo2">
                        <img class="h-52" src="{{ asset('images/upload-filled.png') }}" id="photoimg2" alt="">
                    </label>
                    <input type="file" class=" hidden" id="photo2" accept=".png,.jpeg" name="photo2">
                </div>
                <div
                    class=" w-56 h-56 shadow-xl  justify-center flex-col items-center flex outline-dotted outline-gray-400 rounded-lg">
                    <label for="photo3">
                        <img class="h-52" src="{{ asset('images/upload-filled.png') }}" id="photoimg3" alt="">
                    </label>
                    <input type="file" class=" hidden" id="photo3" accept=".png,.jpeg" name="photo3">
                </div>
              
            </div>
            <p class="px-5 font-bold text-xl mb-5">Upload Videos</p>
            <div>
                <input type="file" name="video1">
                <input type="file" name="video2" id="">
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
