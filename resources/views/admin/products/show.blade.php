<!-- resources/views/admin/products/show.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Show Product</title>
</head>
<body>
    <h1>Product Detail</h1>
    <p><strong>商品名:</strong> {{ $product->name }}</p>
    <p><strong>価格:</strong> {{ $product->price }}</p>
    <p><img src="{{ url($product->img_path) }}" alt="{{ $product->name }}" /></p>
    <p><strong>在庫数:</strong> {{ $product->stock }}</p>
    <p>@if($product->ProductDetail->size)
        <strong>サイズ:</strong> {{ $product->ProductDetail->size->size }} <br>
    @else
        <em>サイズ未登録</em> <br>
    @endif</p>
    <p>@if($product->ProductDetail->color)
        <strong>カラー:</strong> {{ $product->ProductDetail->color->color }} <br>
    @else
        <em>カラー未登録</em> <br>
    @endif</p>

</body>
