<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        @foreach ($orders as $order)
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">注文履歴一覧</h2>
            <p class="text-gray-700 mb-4">前回注文日時: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>

            <ul class="space-y-4">
                @foreach ($order->orderItems as $item)
                    <li class="border-t pt-4">
                        @if ($item->product_detail && $item->product_detail->product)
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img src="{{ url($item->product_detail->product->img_path) }}" alt="{{ $item->product_detail->product->name }}" class="h-20 w-full rounded-lg">
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $item->product_detail->product->name }}</h3>
                                    <p class="text-gray-600">商品ID: {{ $item->product_id }}</p>
                                    <p class="text-gray-600">価格: ¥{{ number_format($item->price) }}</p>
                                    <p class="text-gray-600">個数: {{ $item->amount }}</p>
                                    <a href="{{ route('item.show', $item->product_detail->product->id) }}" class="text-blue-500 hover:underline">詳細</a>
                                </div>
                            </div>
                        @else
                            <p class="text-red-500">Product information not available.</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

    </div>
</x-app-layout>
