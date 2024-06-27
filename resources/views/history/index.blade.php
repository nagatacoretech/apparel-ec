<x-app-layout>
    <h1>Order History</h1>
    @foreach ($orders as $order)
        <div>
            <p>-----------------------------------</p>
            <h2>Order #{{ $order->id }}</h2>
            <p>Total Price: {{ $order->total_price }}</p>
            <p>Ordered At: {{ $order->created_at }}</p>

            <ul>
                @foreach ($order->orderItems as $item)
                    <li>
                        Product Name: {{ $item->product->name}}<br>
                        {{-- @if ($item->productDetail && $item->product_detail->product) --}}
                        {{-- Product Name: {{ $item->product_detail->product->name }} --}}

                        {{-- @else
                        Product information not available.<br>
                        @endif --}}
                        Product ID: {{ $item->product_id }}<br>
                        Price: {{ $item->price }}<br>
                        Amount: {{ $item->amount }}<br>
                    </li>
                    <a href="/show/{{$item->product_id}}">詳細</a>
                @endforeach
            </ul>
            <p>-----------------------------------</p>
        </div>
    @endforeach
    <a href="/">商品一覧</a>
</x-app-layout>
