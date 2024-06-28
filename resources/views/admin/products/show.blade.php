<x-app-layout>
    <div id="show-product-container">
        <h1>商品詳細</h1>
        <div class="show-product-details">
            <div class="show-form-group">
                <strong>商品名:</strong>
                <p>{{ $product->name }}</p>
            </div>

            <div class="show-form-group">
                <strong>価格:</strong>
                <p>{{ $product->price }}</p>
            </div>

            <div class="show-form-group product-image-container">
                <strong>画像:</strong>
                <img src="{{ url('storage/' . $product->img_path) }}" alt="{{ $product->name }}" class="product-image">
            </div>

            <div class="show-form-group">
                <strong>在庫数:</strong>
                <p>{{ $product->productDetail->stock ?? '未登録' }}</p>
            </div>

            <div class="show-form-group">
                <strong>サイズ:</strong>
                <p>{{ $product->productDetail->size->size ?? '未登録' }}</p>
            </div>

            <div class="show-form-group">
                <strong>カラー:</strong>
                <p>{{ $product->productDetail->color->color ?? '未登録' }}</p>
            </div>
        </div>

        <div class="product-actions">
            <form action="{{ route('admin.products.edit', $product->id) }}" method="GET" class="action-form">
                @csrf
                <button type="submit" class="btn">編集</button>
            </form>
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" class="action-form">
                @csrf
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </div>

    </div>
</x-app-layout>
