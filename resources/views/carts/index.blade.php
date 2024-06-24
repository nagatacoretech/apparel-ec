<x-app-layout>
    {{-- @foreach($products->product as $product)
{{$product}}
    @endforeach --}}
    @foreach($carts as $cart)
    {{$cart->product_id}}
    @endforeach
</x-app-layout>
