@extends('layout.sidebarandnav')

@section('title', 'Cash Sale');
@section('body')
    <p class=" text-2xl">Cash In Hand</p>
    <div class=" flex items-center space-x-2 mt-5">
        <p class=" font-bold">Start Date -</p>
        <input name="start_date" readonly class=" border-transparent" value="{{ $start_date }}" type="text">
        <p class=" font-bold">End Date</p>
        <input name="end_date" readonly class=" border-transparent" value="{{ $end_date }}" type="text">
    </div>
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
                            {{ $purchase }}
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

    
    <div class=" rounded-lg  my-5 p-4 text-right font-medium shadow-md bg-blue-500">
        <span class=" text-xl font-semibol mt-5">Today Balance: </span>
        <span id="balance" class="text-xl font-semibol mt-5"></span>
    </div>
   

    <script>
        var purchasestring = document.getElementById("pur").innerText;
        var cashstring = document.getElementById("cash").innerText;
        var depositstring = document.getElementById("deposit").innerText;
        var expensestring = document.getElementById("exp").innerText;
        var incomestring = document.getElementById("income").innerText;
        var saleturnstring = document.getElementById('salereturn').innerText;
        var credit = document.getElementById("credit");
        var debit = document.getElementById("debit");
        var total = document.getElementById('balance');

        var purchase = parseInt(purchasestring);
        var cash = parseInt(cashstring);
        var deposit = parseInt(depositstring);
        var expense = parseInt(expensestring);
        var income = parseInt(incomestring);
        var salereturn = parseInt(saleturnstring);

        var creditSubtotal = purchase + expense + salereturn ;
        var debitSubtotal = cash + deposit + income;
        var totalbal = debitSubtotal - creditSubtotal;


        credit.innerText = creditSubtotal.toLocaleString();
        debit.innerText = debitSubtotal.toLocaleString();
        total.innerText = totalbal.toLocaleString() + "Ks";
    </script>

@endsection
