@extends('layout.sidebarandnav')

@section('title', 'Update Logo and Business Name');

@section('body')
    <div class="mx-5">
        <p class=" text-xl font-bold py-3 ">Update Logo and Business Name</p>
        <form action="/logoandname/{{ 1 }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="border shadow-2xl mt-5 rounded-xl border-gray-300">
                <div class="p-5">
                    <p class="font-bold text-md">Update Logo and Business Name</p>
                    <div class="flex justify-evenly items-center mt-5">
                        <p class="w-40">Logo</p>
                        <p>-</p>
                        <div name='jjj' class="flex w-[600px] h-[156px] border-gray-400 items-center justify-center">
                            <label for="logo">
                                <img class="w-28 h-28" name='photos' src=" {{ $logoandname->logo }}" id="logorec"
                                    alt="">
                            </label>
                            <input type="file" class=" hidden" id="logo" accept=".png,.jpeg,.gif" name="logo">

                        </div>
                    </div>
                    <div class="flex justify-evenly items-center py-5">
                        <p class=" w-40">Bussiness Name</p>
                        <p>-</p>
                        <input type="text" name="business" value="{{ $logoandname->business_name }}"
                            class="flex w-[600px] h-[45px] rounded-lg border shadow-lg border-gray-400 items-center justify-center outline-none indent-2"
                            value="">
                    </div>
                </div>
                <div class="py-10 mr-10 pl-[90%] w-full">
                    <input type="submit" id="update" value="Update"
                        class="py-2 cursor-pointer px-4 text-white rounded-md bg-blue-600"></input>
                </div>
        </form>


    </div>
    <script>
        document.getElementById("expense").onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById("expensephoto").src = fr.result;
                };
                fr.readAsDataURL(files[0]);
            }
        };

        document.getElementById("logo").onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById("logorec").src = fr.result;
                };
                fr.readAsDataURL(files[0]);
            }
        };
    </script>

@endsection
