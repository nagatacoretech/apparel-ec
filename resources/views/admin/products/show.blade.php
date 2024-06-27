<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p><strong>商品名:</strong> {{ $product->name }}</p>
        <p><strong>価格:</strong> {{ $product->price }}</p>
        <p><img src="{{ url('storage/' . $product->img_path) }}" alt="{{ $product->name }}" /></p>
        <p><strong>在庫数:</strong> {{ $product->stock }}</p>
        <p>@if($product->ProductDetail->size)
            <strong>サイズ:</strong> {{ $product->ProductDetail->size->size }} <br>
        @else
            <em>サイズ未登録</em> <br>
        @endif</p>
        <p>@if($product->ProductDetail->color)
            <strong>カラー:</strong> {{ $product->ProductDetail->color->color }} <br>
        @else
            <em>カラー未登録</em> <br>
        @endif</p>
        <form action="{{ route('admin.products.edit', $product->id) }}" method="GET">
            <a href="{{ route('admin.products.edit', $product->id)}}">編集</a>
            @csrf
        </form>
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
            <input type="submit"  name="destroy" value="削除">
            @csrf
        </form>
    </div>
</x-app-layout>
