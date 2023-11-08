@extends('layout.sidebarandnav')

@section('title', 'Accounting');
@section('body')
    <div>
        <p class=" text-2xl">Daily In and Out Balance</p>

        <form action="/account" method="post">
            @csrf
            <div class=" flex items-center space-x-2 mt-5">
                <p>Start Date</p>
                <input name="start_date" type="date">
                <p>End Date</p>
                <input name="end_date" type="date">
                <button type="submit" class=" rounded-lg bg-yellow-400 px-3 py-1">Submit</button>
        </form>
    </div>
    @php
        $timezone = 'Asia/Yangon';
        $currentDateTime = \Carbon\Carbon::now($timezone);
        $currentDateFormatted = $currentDateTime->format('Y-m-d');
    @endphp
    <form class=" float-right -mt-14" action="/saleClosing" method="post">
        @csrf
        <input type="text" class="" hidden name="grand_total" id="grandtotalamt">
        @if ($currentDateFormatted == $salecolse->crdate_only)
            <input type="text" hidden name="update">
            <button class=" float-right bg-blue-500 rounded-lg px-3 py-1">Closed Update?</button>
        @else
            <button class=" float-right bg-red-500 rounded-lg px-3 py-1">Balance Closing</button>
        @endif
    </form>

    <div class=" flex space-x-2 ">

        <div class="relative overflow-x-auto w-1/2 shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xl">Income</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>

                        <th scope="col" class="px-6 py-3 float-right">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Cash Sale
                        </th>
                        <td id="cash" class="px-6 py-4 float-right">
                            {{ $cash }}
                        </td>
                    </tr>
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Deposit Sale
                        </th>

                        <td id="deposit" class="px-6 py-4 float-right">
                            {{ $deposit }}
                        </td>
                    </tr>
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Income
                        </th>

                        <td id="income" class="px-6 py-4 float-right">
                            {{ $income }}
                        </td>
                    </tr>
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Paid Credit Sale
                        </th>

                        <td id="paid" class="px-6 py-4 float-right">
                            {{ $paidamt }}
                        </td>
                    </tr>
                    <tr class="bg-blue-500 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Total Income(mmk)
                        </th>

                        <td id="debit" class="px-6 py-4 float-right">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto w-1/2 shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-blue-100 dark:text-blue-100">
                <thead class="text-xs text-white uppercase bg-pink-900 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xl ">Outcome</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3 float-right">
                            Amount
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="bg-pink-800 border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Purchase
                        </th>

                        <td id="pur" class="px-6 py-4 float-right">
                            0
                        </td>
                    </tr>
                    <tr class="bg-pink-800 border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Sale Return
                        </th>

                        <td id="salereturn" class="px-6 py-4 float-right">
                            {{ $salereturn }}
                        </td>
                    </tr>
                    <tr class="bg-pink-800 border-b ">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Expense
                        </th>

                        <td id="exp" class="px-6 py-4 float-right">
                            {{ $expense }}
                        </td>
                    </tr>
                    <tr class="bg-pink-800 border-b border-blue-400">
                        <th scope="row" class="px-6 py-4 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                            Total Outcome(mmk)
                        </th>

                        <td id="credit" class="px-6 py-4 float-right">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class=" rounded-lg  mt-5 p-4 text-right font-medium shadow-md bg-blue-500">
        <span class=" text-xl font-semibol mt-5">Today Balance: </span>
        <span id="balance" class="text-xl font-semibol mt-5">546587</span>
    </div>

    </div>
    <div class=" flex justify-between space-x-3">
        <div class=" p-5 shadow-lg w-1/2 rounded-2xl mt-10 font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Cash In Hand Balance: </span>
            <span class=" text-2xl" id="cashinhand">{{ $cashinhand }} </span>MMK
        </div>
        <div class=" p-5 shadow-lg w-1/2  rounded-2xl mt-10 font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Cash In Hand(THB): </span>
            <span class=" text-2xl" id="bat">{{ $cashinhandThb }} </span>THB
        </div>
    </div>
    <div class=" flex justify-between space-x-3">
        <div class=" p-5 shadow-lg w-1/2 rounded-2xl  font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Showroom Product Values: </span>
            <span class=" text-2xl" id="productsamt"></span>MMK
        </div>
        <div class=" p-5 shadow-lg w-1/2 rounded-2xl font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Total Purchase: </span>
            <span class=" text-2xl" id="warehousepur">{{ $pendingpurchase }} </span>MMK
        </div>
    </div>
    <div class=" flex justify-between space-x-3">
        {{-- <div class=" p-5 shadow-lg w-1/2 rounded-2xl font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Unpaid Credit Sale: </span>
            <span class=" text-2xl" id="unpaidamt">{{ $unpaidamt }} </span>MMK
        </div> --}}
        <div class=" p-5 shadow-lg w-1/2 rounded-2xl font-semibold bg-gray-400 mb-10">
            <span class=" text-2xl">Estimate Capital Value: </span>
            <span class=" text-2xl" id="estimate"> </span>MMK
        </div>

    </div>


    <script>
        var purchasestring = document.getElementById("pur").innerText;
        var cashstring = document.getElementById("cash").innerText;
        var depositstring = document.getElementById("deposit").innerText;
        var expensestring = document.getElementById("exp").innerText;
        var incomestring = document.getElementById("income").innerText;
        var saleturnstring = document.getElementById('salereturn').innerText;
        var paidstring = document.getElementById('paid').innerText;
        var credit = document.getElementById("credit");
        var debit = document.getElementById("debit");
        var total = document.getElementById('balance');
        var grand_total_value = document.getElementById('grandtotalamt');
        var cih = document.getElementById('cashinhand');
        var bat = document.getElementById('bat');
        var warehouse = document.getElementById('warehousepur');
        var productsamt = document.getElementById('productsamt');
        var estimate = document.getElementById('estimate');


        var purchase = parseInt(purchasestring);
        var cash = parseInt(cashstring);
        var deposit = parseInt(depositstring);
        var expense = parseInt(expensestring);
        var income = parseInt(incomestring);
        var paid = parseInt(paidstring);

        var salereturn = parseInt(saleturnstring);
        var cashinhand = parseInt(cih.innerText);
        var cashinhandbat = parseInt(bat.innerText);
        var warehousepurchase = parseInt(warehouse.innerText);
        
 


        var creditSubtotal = purchase + expense + salereturn;
        var debitSubtotal = cash + deposit + income + paid ;
        var totalbal = debitSubtotal - creditSubtotal;
        grand_total_value.value = totalbal;
      

        credit.innerText = creditSubtotal.toLocaleString();
        debit.innerText = debitSubtotal.toLocaleString();
        total.innerText = totalbal.toLocaleString() + "Ks";
        cih.innerText = cashinhand.toLocaleString();
        bat.innerText = cashinhandbat.toLocaleString();
        warehouse.innerText = warehousepurchase.toLocaleString();

        var amt = sessionStorage.getItem("productamt");
        productsamt.innerText = parseInt(amt).toLocaleString();

       

        var capital = warehousepurchase + cashinhand + parseInt(amt);
        estimate.innerText = capital.toLocaleString();

    </script>

@endsection
