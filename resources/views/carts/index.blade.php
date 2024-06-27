<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- @forelse($carts as $cart_products)
                {{$cart_products->product_detail->product->img_path}}<br>
                {{$cart_products->product_detail->product->name}}<br>
                ￥{{$cart_products->product_detail->product->price}}<br>
                個計：{{$cart_products->product_detail->product->price*$cart_products->amount}}<br>
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
                <form action="{{ route('cart.remove', $cart_products->product_detail_id) }}" method="POST">
                    @csrf
                    <button type="submit">削除</button>
                </form>
                    @endif
                @empty
                <p>商品はカート内にありません</p>
            @endforelse --}}

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
            {{-- @csrf
            @forelse($carts as $index => $cart_products)
                <input type="hidden" name="total_price" value="{{$total_price}}">
                <input type="hidden" name="order_items[{{$index}}][product_id]" value="{{$cart_products->product_detail->id}}">
                <input type="hidden" name="order_items[{{$index}}][price]" value="{{$cart_products->product_detail->product->price}}">
                <input type="hidden" name="order_items[{{$index}}][amount]" value="{{$cart_products->amount}}">
            @empty
            @endforelse --}}
            @csrf
            @forelse($carts as $index => $cart_products)
                <input type="hidden" name="total_price" value="{{$total_price}}">
                <input type="hidden" name="order_items[{{$index}}][product_id]" value="{{$cart_products->product_detail_id}}">
                <input type="hidden" name="order_items[{{$index}}][price]" value="{{$cart_products->price}}">
                <input type="hidden" name="order_items[{{$index}}][amount]" value="{{$cart_products->amount}}">
            @empty
            @endforelse

            {{-- @forelse($carts as  $cart_products)
            <input type="hidden" name="total_price[]" value="{{$total_price}}">
            <input type="hidden" name="product_id[]" value="{{$cart_products->product_detail->id}}">
            <input type="hidden" name="price[]" value="{{$cart_products->product_detail->product->price}}">
            <input type="hidden" name="amount[]" value="{{$cart_products->amount}}">
            @empty
            @endforelse --}}

            <button type="submit" class="" >購入手続きへ</button>
            </form>


            </div>

        <a href="/">商品一覧画面へ</a>
    </div>
</x-app-layout>

