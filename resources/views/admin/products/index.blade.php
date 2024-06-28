<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @if($products->count())
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <strong>表示:</strong> {{ $product->visibility === 1 ? '表示' : '非表示' }} <br>
                        </div>
                    </a>
                </div>
            @endforeach
    </div>
    </div>
    @else
        <p>商品登録してません。</p>
    @endif
</x-app-layout>
