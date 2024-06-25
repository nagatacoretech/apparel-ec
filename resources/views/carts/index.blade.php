<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between ">
                    @forelse($carts as $cart_products)
                        {{$cart_products->product_detail->product->name}}
                        {{$cart_products->product_detail->product}}
                        {{$cart_products->product_detail->product}}
                        {{-- <form action="{{ route('cart.remove', $cart_products->product_detail->product->id) }}" method="POST"><br>
                            @csrf
                            <button type="submit">削除</button>
                        </form> --}}
                    @empty
                    <p>商品はカート内にありません</p>
                    @endforelse

                    {{-- @forelse($cart_details as $detail)
                    {{$detail->amount}}<br>
                    {{$cart_products->product_detail->price*$detail->amount}}<br>
                    @empty
                    <p>商品はカート内にありません</p>
                    @endforelse --}}

                    {{-- @if(!empty($cart_products->product_detail->id) and !empty($detail))
                        <form method="POST" action="{{route('increase',$cart_products->product_detail->id)}}">
                                @csrf
                                <button type="submit">
                                    ➕
                                </button>
                        </form>
                        {{$detail->amount}}<br>
                        @if($detail->amount != 1)
                            <form method="POST" action="{{route('decrease',$cart_products->product_detail->id)}}">
                                @csrf
                                <button id="decrementButton" class="">➖</button>
                            </form>
                        @endif
                    @endif --}}

            <a href="/">商品一覧画面へ</a>
        </div>
    </div>
</x-app-layout>

