@extends('layout.sidebarandnav')

@section('title', 'Product Details');
@section('body')
    <p class=" text-2xl">Product Details</p>
    <section class=" flex justify-around items-center">
    <section>
        <div class=" flex-col flex justify-center items-center ml-20 w-64 rounded-lg shadow-xl p-5">
            <div>
                <img class=" shadow-md" src="{{ $productDetail->p_one }}" alt="{{ $productDetail->product_name }}'s photo">
            </div>
            <div class="flex pt-2">
                <img class=" w-20 h-20" src="{{ $productDetail->p_two}}"  alt="{{ $productDetail->product_name }}'s photo">
                <img class=" w-20 h-20" src="{{ $productDetail->p_three }}" alt="{{ $productDetail->product_name }}'s photo">
                <img class=" w-20 h-20" src="{{ $productDetail->p_four }}" alt="{{ $productDetail->product_name }}'s photo">
            </div>
            <span class=" p-5 text-2xl font-bold">{{ $productDetail->product_name }}</span>
        </div>
        

    </section>
  
    <section class=" flex space-x-5">
        <div class="flex flex-col">
            <span>Product Name</span>
            <span>Main Category</span>
            <span>SubCategory</span>
            <span>Price</span>
            <span>Stock</span>
            <span>Description</span>
        </div>
        <div class=" flex flex-col">
            <span>-></span>
            <span>-></span>
            <span>-></span>
            <span>-></span>
            <span>-></span>
            <span>-></span>
        </div>
        <div class=" flex flex-col">
            <span>{{ $productDetail->product_name }}</span>
            <span>{{ $productDetail->c_name }}</span>
            <span>{{ $productDetail->sub_c_name }}</span>
            <span>{{ $productDetail->price }}Ks</span>
            <span>{{ $productDetail->quantity }}</span>
            <span>{{ $productDetail->description }}</span>
        </div>
    </section>
    </section>
@endsection
