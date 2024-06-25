<x-app-layout>
    <h1>商品一覧</h1>
    @if($products->count())
        <ul>
            @foreach($products as $product)
                    <li><a href="/admin/products/show/{{$product->id}}">
                        <p><img src="{{ url('storage/' . $product->img_path) }}" alt="Product Image"></p>
                        <strong>商品名:</strong> {{ $product->name }} <br>
                        <strong>価格:</strong> {{ $product->price }} <br>
                        @if ($product->visibility === 1)
                        <strong>表示:</strong> Yes <br>
                        @else
                        <strong>表示:</strong> No <br>
                        @endif
                        <strong>在庫数:</strong> {{ $product->stock }} <br>
                        @if($product->ProductDetail)
                            @if($product->ProductDetail->size)
                                <strong>サイズ:</strong> {{ $product->ProductDetail->size->size }} <br>
                            @else
                                <em>サイズ未登録</em> <br>
                            @endif
                            @if($product->ProductDetail->color)
                                <strong>カラー:</strong> {{ $product->ProductDetail->color->color }} <br>
                            @else
                                <em>カラー未登録</em> <br>
                            @endif
                        @else
                            <em>商品詳細登録してません。</em>
                        @endif
                    </li>
                </a>
            @endforeach
        </ul>
    @else
        <p>商品登録してません。</p>
    @endif
    <a href="/admin/products/create">商品登録</a>
</x-app-layout>
