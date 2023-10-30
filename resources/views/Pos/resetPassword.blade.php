<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/asiaRoyalLogo.png') }}" sizes="16x16" type="image/png">
    <script src="https://kit.fontawesome.com/31104486ca.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <title>Reset Password</title>
</head>

<body>
    <!-- component -->
    <div class="flex h-screen w-full items-center justify-end pr-20 bg-gray-900 bg-cover bg-no-repeat"
        style="background-image:url('{{ asset('images/login_bg.jpg') }}">
        <div class="rounded-xl bg-gray-400 mr-10  bg-opacity-50 px-5 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
            <div class="text-white">
                <div class="mb-8 flex flex-col  items-center">
                    <img src="{{ asset('images/SKS Logo.png') }}" class="mb-5" width="200" alt=""
                        srcset="" />
                    <p class=" text-xl font-semibold">New Password</p>

                </div>
                <form action="/new_password" method="post">
                    @csrf
                    <div class="mb-4 text-lg justify-center flex">
                        <input
                            class=" rounded-lg border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md"
                            type="password" name="password"  />
                        @error('password')
                            <p class=" text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 text-lg justify-center flex">
                        @php
                           $useremail = session()->get('useremail')
                        @endphp
                        <input value=""
                            class=" rounded-lg border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md"
                            type="password" name="password_confirmation"  />
                        @error('password')
                            <p class=" text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="text" name="token" hidden value="{{ $token }}">
                    <input type="text" name="email" hidden value="{{ $useremail }}">

                    <div class="mt-8 flex  justify-center text-lg text-black">
                        <button type="submit"
                            class="rounded-xl bg-yellow-400 bg-opacity-50 px-5 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-yellow-600">Confrim</button>

                    </div>
                </form>
                <a class=" flex justify-center mt-5 underline text-red-500 " href="/forget_password">Send Reset Password Again</a>
                @if (session('success'))
                    <div class="alert alert-success flex justify-center mt-5">
                        {{ session('success') }}
                    </div>
                @endif

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
