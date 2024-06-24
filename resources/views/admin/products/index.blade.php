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
                    <li>
                        <strong>商品名:</strong> {{ $product->name }} <br>
                        <strong>価格:</strong> {{ $product->price }} <br>
                        <strong>在庫数:</strong> {{ $product->stock }} <br>
                        @if($product->details)
                            @if($product->details->size)
                                <strong>サイズ:</strong> {{ $product->details->size->size }} <br>
                            @else
                                <em>サイズ未登録</em> <br>
                            @endif
                            @if($product->details->color)
                                <strong>カラー:</strong> {{ $product->details->color->color }} <br>
                            @else
                                <em>カラー未登録</em> <br>
                            @endif
                        @else
                            <em>商品詳細登録してません。</em>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    @else
        <p>商品登録してません。</p>
    @endif
    <a href="/admin/products/create">商品登録</a>
</body>
</html>
