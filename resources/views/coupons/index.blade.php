<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coupons') }}
        </h2>
    </x-slot>

    @foreach($coupons as $coupon)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-gray-200">
                        <span>{{$coupon->discount}}% OFF! Discount can be applied until {{ $coupon->expired_at->format('d.m.Y') }}.</span>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <span>Coupon code: <b>{{$coupon->code}}</b></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
