<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-between ">
            @foreach ($stockout_products as $product)
                <div class="flex justify-between h-16">
                    {{-- <a href="{{ route("admin.edit",[$product->id]) }}"> --}}
                        画像：{{$product->img_path}}<br>
                        商品名：{{$product->name}}<br>
                        価格：{{$product->price}}<br>
                        サイズ{{$product->size}}<br>
                        カラー：{{$product->color}}<br>
                    {{-- </a> --}}
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

