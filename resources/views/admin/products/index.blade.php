<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @if($products->count())
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="/admin/products/show/{{$product->id}}" class="product-link">
                        <div class="product-image-container">
                            <img src="{{ url('storage/' . $product->img_path) }}" alt="Product Image" class="product-image">
                        </div>
                        <div class="product-details">
                            <strong>商品名:</strong> {{ $product->name }} <br>
                            <strong>価格:</strong> ¥{{ number_format($product->price) }} <br>
                            <strong>表示:</strong> {{ $product->visibility === 1 ? 'Yes' : 'No' }} <br>
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
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p>商品登録してません。</p>
    @endif
    <a href="/admin/products/create">商品登録</a>
</x-app-layout>
