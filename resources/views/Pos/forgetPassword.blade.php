<!doctype html>
<html>
@php
    $logo = session()->get('logo');
    $business_name = session()->get('business_name');
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ $logoandname->logo }}" sizes="16x16" type="image/png">
    <script src="https://kit.fontawesome.com/31104486ca.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <title>Forget Password</title>
</head>

<body>
    <!-- component -->
    <div class="flex h-screen w-full items-center justify-end pr-20 bg-gray-900 bg-cover bg-no-repeat"
        style="background-image:url('{{ asset('images/login_bg.jpg') }}">
        <div class="rounded-xl bg-gray-400 mr-10  bg-opacity-50 px-5 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
            <div class="text-white">
                <div class="mb-8 flex flex-col  items-center">
                    <img src="{{ $logoandname->logo }}" class="mb-5" width="200" alt=""
                        srcset="" />
                    <p class=" text-xl font-semibold">Forget Password?</p>
                    <span class="text-black">Enter the email address assoiated with your account <br>
                        and we will send a link to reset your password.
                    </span>
                </div>
                <form action="/forget_password" method="post">
                    @csrf
                    <div class="mb-4 text-lg justify-center flex">
                        <input
                            class=" rounded-lg border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md"
                            type="email" name="email" placeholder="Enter your email" />
                        @error('email')
                            <p class=" text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mt-8 flex  justify-center text-lg text-black">
                        <button type="submit"
                            class="rounded-xl bg-yellow-400 bg-opacity-50 px-5 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-yellow-600">Send
                            reset link</button>

                    </div>
                </form>

                @if (session('success'))
                    <script>
                        let msg = @json(session('success'));
                        swal("Good job!", msg, "success");
                    </script>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
