<x-app-layout>
    <h1>Order History</h1>
    @foreach ($orders as $order)
        <div>
            <h2>Order #{{ $order->id }}</h2>
            <p>Total Price: {{ $order->total_price }}</p>
            <p>Ordered At: {{ $order->created_at }}</p>

            <ul>
                @foreach ($order->orderItems as $item)
                    <li><a href="/show/{{$item->product->id}}">
                            Product Name: {{ $item->product->name }}
                        </a><br>
                        Price: {{ $item->price }}<br>
                        Amount: {{ $item->amount }}<br>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
    <a href="/">商品一覧</a>
</x-app-layout>
