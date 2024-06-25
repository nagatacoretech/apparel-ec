<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between ">
                    @forelse($carts as $cart_products)
                        {{$cart_products->product_detail->product->name}}<br>
                        {{$cart_products->product_detail->product->price}}<br>
                        {{$cart_products->product_detail->product->img_path}}<br>
                        {{$cart_products->amount}}<br>
                        {{$cart_products->product_detail->product->price*$cart_products->amount}}<br>
                        <form action="{{ route('cart.remove', $cart_products->product_detail_id) }}" method="POST"><br>
                            @csrf
                            <button type="submit">削除</button>
                        </form>
                        @if(!empty($cart_products->product_detail->id))
                        <form method="POST" action="{{route('increase',$cart_products->product_detail->id)}}">
                                @csrf
                                <button type="submit">
                                    ➕
                                </button>
                        </form>
                        {{$cart_products->amount}}<br>
                        @if($cart_products->amount != 1)
                            <form method="POST" action="{{route('decrease',$cart_products->product_detail->id)}}">
                                @csrf
                                <button id="decrementButton" class="">➖</button>
                            </form>
                        @endif
                    @endif
                    @empty
                    <p>商品はカート内にありません</p>
                    @endforelse
        </div>

        <div class="my-9">
        <p>合計金額：{{$total_price}}</p>
        <a href="/">商品一覧画面へ</a>
        </div>
    </div>
</x-app-layout>

