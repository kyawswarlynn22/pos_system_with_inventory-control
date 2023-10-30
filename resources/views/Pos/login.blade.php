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
    <title>Login</title>
</head>

<body>
    <!-- component -->
    <div class="flex h-screen w-full items-center justify-end pr-20 bg-gray-900 bg-cover bg-no-repeat"
        style="background-image:url('{{ asset('images/login_bg.jpg') }}">
        <div class="rounded-xl bg-gray-400 mr-10  bg-opacity-50 px-5 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
            <div class="text-white">
                <div class="mb-3 flex flex-col  items-center">
                    <img src="{{ $logoandname->logo }}" class="mb-5" width="200" alt="" srcset="" />
                    <span class=" text-4xl font-bold">{{ $logoandname->business_name }}</span>
                    <span class="text-gray-300">Enter Login Details</span>
                </div>
                <form action="/signin" method="post">
                    @csrf
                    <div class=" flex  flex-col justify-center items-center">
                        <div class="mb-4 text-lg">
                            <input
                                class=" rounded-lg border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md"
                                type="email" name="email" placeholder="your email" />
                        </div>
                        <div class="mb-4 text-lg">
                            <input
                                class="rounded-lg border-none bg-yellow-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md"
                                type="Password" name="password" placeholder="*********" />
                        </div>
                    </div>

                    <div class=" flex  justify-center text-lg text-black">
                        <button type="submit"
                            class="rounded-xl bg-yellow-400 bg-opacity-50 px-5 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-yellow-600">Login</button>
                    </div>
                </form>
                <a class=" flex justify-center mt-2 underline text-red-500 " href="/forget_password">Forget
                    Password?</a>
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
