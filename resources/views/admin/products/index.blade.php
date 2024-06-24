<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Products List</h1>
    @if($products->count())
        <ul>
            @foreach($products as $product)
                @if($product->visibility)
                    <li><a href="/admin/products/show/{{$product->id}}">
                        <img src="{{ url($product->img_path) }}" alt="Product Image" style="max-width: 200px; max-height: 200px;">
                        <strong>商品名:</strong> {{ $product->name }} <br>
                        <strong>価格:</strong> {{ $product->price }} <br>
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
                @endif
            @endforeach
        </ul>
    @else
        <p>商品登録してません。</p>
    @endif
    <a href="/admin/products/create">商品登録</a>
</body>
</html>
