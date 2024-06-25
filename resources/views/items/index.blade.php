<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between ">

            @foreach ($products as $product)
                <div class="flex justify-between h-16">
                    <a href="{{route("show",[$product->id])}}">
                        画像：{{$product->img_path}}<br>
                        商品名：{{$product->name}}<br>
                        価格：{{$product->price}}<br>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
