<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="product-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                            <a href="{{route("item.show",[$product->id])}}">
                                <div class="product-image-container">
                                    <p><img src="{{ url('storage/' . $product->img_path) }}" alt="Product Image"></p>
                                </div>
                                <div class="product-details">
                                    商品名：{{$product->name}}<br>
                                    価格：{{$product->price}}<br>
                                </div>
                            </a>
                    </div>
                @endforeach
            </div>
    </div>
</x-app-layout>
