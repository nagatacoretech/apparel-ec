<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-100 h-screen flex items-center justify-center">
            <div class="bg-white shadow-md rounded-lg p-6">
                @foreach ($stockout_products as $product)
                    <div class="flex items-center justify-between border-b border-gray-200 py-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ url($product->img_path) }}" alt="{{ $product->name }}" class="h-30 w-40 rounded-lg">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">{{$product->name}}</h2>
                                <p class="text-gray-600">価格：{{$product->price}}円</p>
                                <p class="text-gray-600">サイズ：{{$product->size}}</p>
                                <p class="text-gray-600">カラー：{{$product->color}}</p>
                            </div>
                        </div>
                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                            <span class="relative">在庫切れ</span>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

