<x-app-layout>
<div class="container mt-5">
    <h1>商品登録</h1>
    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Product creation form -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">商品名 (Name)</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="child_category_id">カテゴリーID (Category ID)</label>
            <input type="number" class="form-control" id="child_category_id" name="child_category_id" value="{{ old('child_category_id') }}" required>
        </div>

        <div class="form-group">
            <label for="price">価格 (Price)</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="form-group">
            <label for="visibility">表示・非表示 (Visibility)</label>
            <select class="form-control" id="visibility" name="visibility" required>
                <option value="1" {{ old('visibility') == '1' ? 'selected' : '' }}>表示 (Visible)</option>
                <option value="0" {{ old('visibility') == '0' ? 'selected' : '' }}>非表示 (Not Visible)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="img_path">画像 (Image)</label>
            <input type="file" class="form-control" id="img_path" name="img_path">
        </div>

        <div class="form-group">
            <label for="stock">在庫 (Stock)</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div class="form-group">
            <label for="size_id">サイズ (Size)</label>
            <select class="form-control" id="size_id" name="size_id" required>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="color_id">カラー (Color)</label>
            <select class="form-control" id="color_id" name="color_id" required>
                @foreach($colors as $color)
                    <option value="{{ $color->id }}">{{ $color->color }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">商品登録</button>
    </form>
</div>
</x-app-layout>
