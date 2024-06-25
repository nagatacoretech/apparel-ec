<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            画像：{{$product->img_path}}<br>
            商品名：{{$product->name}}<br>
            価格：{{$product->price}}<br>
        <form action ="{{route('add_cart')}}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}"/>
            数量：<input type="number" name="amount"><br>
            <button type="submit" class="btn btn-primary">カートに登録</button>
        </form>
    </div>

</x-app-layout>
