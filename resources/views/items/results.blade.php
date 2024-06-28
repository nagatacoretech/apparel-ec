<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <a href="{{route('item.show', [$product->id])}}" class="block hover:bg-gray-100 transition duration-200">
                        <img src="{{ url($product->img_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-900">{{$product->name}}</h2>
                            <p class="text-gray-600">価格：{{$product->price}}円</p>
                        </div>
                    </a>
                </div>
            @endforeach
            <a href="/"><button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">一覧画面へ</button></a>
        </div>
    </div>
</x-app-layout>
