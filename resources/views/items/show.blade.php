<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto p-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex flex-wrap -mx-4">
                    <!-- 商品画像 -->
                    <div class="w-full md:w-1/2 px-4">
                        <img src="{{ url('storage/' . $product->img_path) }}" alt="商品画像" class="object-contain h-96 w-full rounded-lg shadow-md">
                    </div>
                    <!-- 商品詳細 -->
                    <div class="w-full md:w-1/2 px-4">
                        <h1 class="text-3xl font-bold mb-4">{{$product->name}}</h1>
                        <form action ="{{route('add_cart')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}"/>


                            <label for="size" class="mr-4 text-gray-700">サイズ：</label>
                            <select name="size" class="w-3/5 mt-2 border-gray-300 rounded-md shadow-sm">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->size_id }}">{{$size->size}}</option>
                                @endforeach
                            </select><br>

                            <label for="quantity" class="mr-4 text-gray-700">カラー：</label>
                            <select name="color" class="w-3/5 mt-2 border-gray-300 rounded-md shadow-sm">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->color_id }}">{{$color->color}}</option>
                                @endforeach
                            </select><br>

                            <div class="flex items-center mb-4">
                                <label for="quantity" class="mr-9 text-gray-700">数量：</label>
                                <input type="number" name="amount" min="1" max="1000" class="w-3/5 mt-2 border-gray-300 rounded-md shadow-sm">
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <p style="color: red;">{{ session('error') }}</p>
                                </div>
                            @endif

                            <div class="text-2xl font-bold text-gray-800 mb-4">￥{{$product->price}}</div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">カートに登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
