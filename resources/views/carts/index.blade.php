<x-app-layout>
    {{-- @foreach($products->product as $product)
{{$product}}
    @endforeach --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between ">
            <table class="min-w-full bg-gray-100 border-gray-200 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">商品名</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">価格</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">画像</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">数量</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">合計</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if(!empty($carts->count()))
                        @foreach($carts as $cart_products)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{$cart_products->product->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$cart_products->product->price}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{$cart_products->product->img_path}}</td>
                            <td>{{$cart_detail->amount}}</td>
                            <td>{{$cart_products->product->price*$cart_detail->amount}}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.remove', $cart_products->product->id) }}" method="POST">
                                @csrf
                                <button type="submit">削除</button>
                                </form>
                            </td>
                        <tr>
                        @endforeach

                    @else
                        <p>カート内に商品はありません</p>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
