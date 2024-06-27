<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @forelse($carts as $cart_products)
                {{-- @dd($cart_products) --}}
                {{$cart_products->img_path}}<br>
                商品名：{{$cart_products->name}}<br>
                サイズ：{{$cart_products->size}}<br>
                カラー：{{$cart_products->color}}<br>
                ￥{{$cart_products->price}}<br>
                個計：{{$cart_products->price*$cart_products->amount}}<br>
                @if(!empty($cart_products->id))
                    <form method="POST" action="{{route('increase',$cart_products->product_detail_id)}}">
                            @csrf
                            <button type="submit">
                                ➕
                            </button>
                    </form>
                    {{$cart_products->amount}}<br>
                    @if($cart_products->amount != 1)
                        <form method="POST" action="{{route('decrease',$cart_products->product_detail_id)}}">
                            @csrf
                            <button id="decrementButton" class="">➖</button>
                        </form>
                    @endif
                    {{-- @dd($cart_products->product_detail_id) --}}
                <form action="{{ route('cart.remove', $cart_products->product_detail_id) }}" method="POST">
                    @csrf
                    <button type="submit">削除</button>
                </form>
                    @endif
                @empty
                <p>商品はカート内にありません</p>
            @endforelse

            <div class="my-9">
                <p>合計金額：¥{{$total_price}}</p>
            </div>
            <div class="my-9">

            <form action="{{route('purchase')}}" method="POST">
            @csrf
            <input type="hidden" name="total_price" value="{{$total_price}}">
            @forelse($carts as $index => $cart_products)
                <input type="hidden" name="order_items[{{$index}}][product_id]" value="{{$cart_products->product_detail_id}}">
                <input type="hidden" name="order_items[{{$index}}][price]" value="{{$cart_products->price}}">
                <input type="hidden" name="order_items[{{$index}}][amount]" value="{{$cart_products->amount}}">
                <input type="hidden" name="order_items[{{$index}}][stock]" value="{{$cart_products->stock}}">

                <input type="hidden" name="stripe_items[{{$index}}][name]" value="{{$cart_products->name}}">
                <input type="hidden" name="stripe_items[{{$index}}][img]" value="{{$cart_products->img_path}}">
                <input type="hidden" name="stripe_items[{{$index}}][price]" value="{{$cart_products->price}}">
                <input type="hidden" name="stripe_items[{{$index}}][amount]" value="{{$cart_products->amount}}">
            @empty
            @endforelse

            <button type="submit" class="" >購入手続きへ</button>
            </form>


            </div>

        <a href="/">商品一覧画面へ</a>
    </div>
</x-app-layout>

