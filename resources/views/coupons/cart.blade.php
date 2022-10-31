<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    @if(session()->has('success'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background-color: lightgreen;">
                        {{session('success')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('failure'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background-color: lightcoral;">
                        {{session('failure')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="price-row py-2">
                        <p class="left">Yearly subscription renewal</p>
                        <p class="right">300&nbsp;€</p>
                    </div>
                    <div class="price-row py-2">
                        <p class="left">"Pedo Pete" photo archive</p>
                        <p class="right">200&nbsp;€</p>
                    </div>
                    <div class="price-row py-2">
                        <p class="left">Blizzard ownership</p>
                        <p class="right">500&nbsp;€</p>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="price-row py-2">
                        <p class="left">Products</p>
                        <p class="right">{{ $sum }}&nbsp;€</p>
                    </div>
                    <div class="price-row py-2">
                        <p class="left">Discount</p>
                        <p class="right">{{ $discount }}&nbsp;%</p>
                    </div>
                    <div class="price-row py-2">
                        <p class="left"><b>Total</b></p>
                        <p class="right"><b>@if($discount == 0) {{ $sum }} @else {{ floor($sum * ((100 - $discount) / 100)) }} @endif&nbsp;€</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-gray-200" style="height:105px;">
                <div class="price-row py-2">
                    <form method="POST" action="">
                        @csrf
                        <div class="right">
                            <input type="text" name="code">
                            <button class="pl-3">Apply code</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
