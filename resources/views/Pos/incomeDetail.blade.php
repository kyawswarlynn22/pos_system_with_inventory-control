@extends('layout.sidebarandnav')

@section('title', 'Expense Details');
@section('body')

    <span class=" text-2xl font-bold">Income Details</span>
    <main class="my-8">

        <div class="container mx-auto px-6">
            <div class="md:flex flex justify-between md:items-center">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class=" rounded-md object-cover max-w-lg mx-auto" src="{{ $incomeDetail->photo }}" alt="Nike Air">
                </div>
                <div class=" flex flex-col ml-20 w-full space-y-10 justify-start">
                    <span class=" my-3 font-noto">Description -> {{ $incomeDetail->description }}</span>
                    <span class=" my-3">Category -> {{ $incomeDetail->e_c_name }}</span>
                    <span class=" my-3">Amount -> {{ $incomeDetail->amount }}Ks</span>
                </div>
            </div>

    </main>


    </div>

@endsection
