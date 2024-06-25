<x-app-layout>
    <h1>商品詳細</h1>

    <form action="{{ url('admin/products/show', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p><strong>商品名:</strong>
            <textarea name="name" id="product_name">{{ old('name', $product->name) }}</textarea>
        </p>

        <p><strong>価格:</strong>
            <input type="number" name="price" value="{{ old('price', $product->price) }}">
        </p>

        <p><strong>在庫数:</strong>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
        </p>

        <p><strong>Visibility:</strong><br>
            <input type="radio" id="visible" name="visibility" value="1" {{ old('visibility', $product->visibility) == 1 ? 'checked' : '' }}>
            <label for="visible">Visible</label><br>
            <input type="radio" id="invisible" name="visibility" value="0" {{ old('visibility', $product->visibility) == 0 ? 'checked' : '' }}>
            <label for="invisible">Invisible</label>
        </p>

        <p><img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->name }}" /></p>
        <p><input type="file" name="img_path"></p>

        <p><strong>サイズ:</strong>
            <select name="size_id">
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}" {{ $product->productDetail->size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                @endforeach
            </select>
        </p>

        <p><strong>カラー:</strong>
            <select name="color_id">
                @foreach($colors as $color)
                    <option value="{{ $color->id }}" {{ $product->productDetail->color_id == $color->id ? 'selected' : '' }}>{{ $color->color }}</option>
                @endforeach
            </select>
        </p>

        <button type="submit">更新</button>
    </form>
</x-app-layout>
