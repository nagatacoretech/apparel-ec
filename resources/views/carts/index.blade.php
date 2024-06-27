<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto p-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <table class="min-w-full bg-gray-100 border-gray-200 shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">商品名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">価格</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">数量</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">小計</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">削除</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($carts as $cart_products)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ url('storage/' . $cart_products->img_path) }}" alt="Product Image" alt="商品画像" class="object-contain h-50 w-20">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$cart_products->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">¥{{$cart_products->price}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            @if(!empty($cart_products->id))
                                <form method="POST" action="{{route('increase',$cart_products->product_detail_id)}}">
                                    @csrf
                                        <button class="py-4 whitespace-nowrap" type="submit">➕</button>
                                </form>
                            {{$cart_products->amount}}
                                @if($cart_products->amount != 1)
                                <form method="POST" action="{{route('decrease',$cart_products->product_detail_id)}}">
                                    @csrf
                                    <button id="decrementButton" class="py-4 whitespace-nowrap">➖</button>
                                </form>
                                @endif
                            @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">￥{{$cart_products->price*$cart_products->amount}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.remove', $cart_products->product_detail_id) }}" method="POST">
                                    @csrf
                                    <button class="text-red-600 hover:text-red-900">削除</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <p>商品はカート内にありません</p>
                        @endforelse
                        <tr>
                            <td colspan="4" class="text-right px-6 py-4 font-bold">合計金額:</td>
                            <td class="px-6 py-4">¥{{$total_price}}</td>
                        </tr>
                    </tbody>
                </table>
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
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">購入手続きへ</button>
                    </div>
                </form>


            </div>
    </div>
</x-app-layout>

