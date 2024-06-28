<x-app-layout>
    <div id="edit-product-container">
        <form action="{{ url('admin/products/show', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-edit-form">
            @csrf
            @method('PUT')

            <div class="edit-form-group">
                <label for="product_name"><strong>商品名:</strong></label>
                <textarea name="name" id="product_name">{{ old('name', $product->name) }}</textarea>
            </div>

            <div class="edit-form-group">
                <label for="price"><strong>価格:</strong></label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
            </div>

            <div class="edit-form-group">
                <label for="stock"><strong>在庫数:</strong></label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', optional($product->productDetail)->stock ?? '') }}">
            </div>

            <div class="edit-form-group">
                <label><strong>Visibility:</strong></label>
                <div>
                    <input type="radio" id="visible" name="visibility" value="1" {{ old('visibility', $product->visibility) == 1 ? 'checked' : '' }}>
                    <label for="visible">Visible</label>
                </div>
                <div>
                    <input type="radio" id="invisible" name="visibility" value="0" {{ old('visibility', $product->visibility) == 0 ? 'checked' : '' }}>
                    <label for="invisible">Invisible</label>
                </div>
            </div>

            <div class="edit-form-group">
                <label><strong>商品画像:</strong></label>
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->name }}" class="product-image" />
                <input type="file" name="img_path">
            </div>

            <div class="edit-form-group">
                <label for="size_id"><strong>サイズ:</strong></label>
                <select name="size_id" id="size_id">
                    <option value="" disabled selected>選択してください</option>
                    @foreach($sizes as $size)
                        <option value="{{ $size->id }}" {{ optional($product->productDetail)->size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}</option>
                    @endforeach
                </select>
            </div>

            <div class="edit-form-group">
                <label for="color_id"><strong>カラー:</strong></label>
                <select name="color_id" id="color_id">
                    <option value="" disabled selected>選択してください</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ optional($product->productDetail)->color_id == $color->id ? 'selected' : '' }}>{{ $color->color }}</option>
                    @endforeach
                </select>
            </div>

            <div class="edit-form-group" class="btn">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>
</x-app-layout>
