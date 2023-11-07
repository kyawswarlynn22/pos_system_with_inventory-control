<!DOCTYPE html>
<html lang="en">
@php
    $logo = session()->get('logo');
    $business_name = session()->get('business_name');
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('images/SKS Logo.png') }}" sizes="16x16" type="image/png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/31104486ca.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <title>@yield('title')</title>
</head>

<body>
    <nav
        class=" bg-blue-700  dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-center p-4">
            <div class=" flex justify-center items-center">
                <a href="/dashboard" class="flex justify-center items-center">
                    <img src="{{ $logo }}" class="h-40 " alt="SKS Logo">
                    <div class=" flex  flex-col justify-center items-center text-blue-800">
                        <span
                            class="self-center text-4xl font-semibold text-blue-800 whitespace-nowrap">{{ $business_name }}</span>
                        <span class=" pl-8">No.24, Nguwar str, Ahlone Tsp, Yangon.<br>
                            +95995045555, +959798800801</span>
                    </div>
                    
                    <img class=" h-24"  src="{{ asset('images/infinity plus logo.jpg') }}" alt="Example Image">

                </a>
               
            </div>
    </nav>
    <div class=" mt-56 ">
        <p class=" mt-52 ml-5 text-2xl font-bold">Invoice</p>
        <button id="hidden" onclick="printInvoice()"
            class="bg-sky-950 float-right mx-5 -mt-8 text-sky-400 border border-sky-400 border-b-4 font-medium overflow-hidden relative px-4 py-2 rounded-md hover:brightness-150 hover:border-t-4 hover:border-b active:opacity-75 outline-none duration-300 group">
            <span
                class="bg-sky-400 shadow-sky-400 absolute -top-[150%] left-0 inline-flex w-80 h-[5px] rounded-md opacity-50 group-hover:top-[150%] duration-500 shadow-[0_0_10px_10px_rgba(0,0,0,0.3)]"></span>
            Print
        </button>
    </div>

    <div class="mt-3 rounded-lg p-5">
        <div class=" border-b "></div>
        <div class="flex justify-between">
            <div class=" flex-col flex ">
                <span class=" text-lg text-blue-500">Invoice To</span>
                <span>{{ $ProductDetails->cus_name }}</span>
                <span>{{ $ProductDetails->phone }}</span>
                <span>{{ $ProductDetails->address }}</span>
            </div>
            <div class=" flex-col flex">
                <span class=" text-lg text-blue-500">Invoice Info</span>
                <span>Invoice No : {{ $InvoiceNo }}</span>
                <div>
                    <span>Invoice Date :</span>
                    <span>{{ $ProductDetails->date_only }}</span>
                </div>
            </div>

        </div>
        <div class="mt-5">
            <table class="w-full text-sm text-left text-gray-500 rounded-lg dark:text-gray-400">
                <thead class="text-xs text-blue-800 uppercase bg-blue-400  dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 rounded-l-lg">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($CashDetails as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 text py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->product_name }}
                            </th>
                            <td class="px-6 py-4 iprice">
                                {{ $item->price }}
                            </td>
                            <td class="px-6 py-4 iquantity">
                                {{ $item->quantity }}
                            </td>
                            <td id="itotal" class="px-6 py-4 itot">
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>

        </div>
        <div class=" mt-5 flex  flex-col justify-end items-end">
            <div class="flex mt-5 space-x-3  ">
                <span class=" font-semibold text-lg">Discount : </span>
                <span class=" font-semibold text-lg">{{ $ProductDetails->discount }}Ks</span>
            </div>
            <div class="flex mt-5 space-x-3 ">
                <span class=" font-semibold text-lg">Grand Total : </span>
                <input id="total" type="text" hidden value="{{ $ProductDetails->grand_total }}">
                <span class=" font-semibold text-lg " id="gtotal">Ks</span>
            </div>
            
        </div>
        <div class=" overflow-x-auto">
            <p class=" mt-40 w-full whitespace-pre-line break-words h-40 text-blue-800">
                {{ $ProductDetails->remark }}"
            </p>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {

            var iprice = document.getElementsByClassName("iprice");
            var iquantity = document.getElementsByClassName("iquantity");
            var subtotal = document.getElementsByClassName("itot");
            var itotal = document.getElementById("total").value;
            var it = document.getElementById('gtotal');
            var strtonum = Number(itotal);
            it.innerHTML = strtonum.toLocaleString() + " " + 'Ks';

            for (let i = 0; i < iprice.length; i++) {

                var price = Number(iprice[i].innerText);
                var quantity = Number(iquantity[i].innerText);
                console.log(price);
                console.log(quantity);
                var total = price * quantity;
                subtotal[i].innerHTML = total.toLocaleString();
            }
            var button = document.getElementById('hidden');
            console.log(button);
            button.addEventListener("click", function() {
                window.print();
            });
        });
    </script>
    <style>
        #hidden {
            display: block;
            /* or any other display property */
        }

        /* Styles for printing (hidden) */

        @media print {
            #hidden {
                display: none;
            }
        }
    </style>
</body>

</html>
