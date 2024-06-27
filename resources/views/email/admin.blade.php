<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Email</title>
</head>
<body>
    <h1>購入完了のお知らせ</h1>

    <p>ユーザが商品を購入しました</p>
    @php
        $total_price = 0;
    @endphp

    <ul>
        @foreach($orderItems as $item)
            <li>商品名： {{ $item['name'] }}</li>
            <li style="list-style: none;">サイズ： {{ $item['size'] }}</li>
            <li style="list-style: none;">カラー： {{ $item['color'] }}</li>
            <li style="list-style: none;">価格： {{ $item['price'] }}円</li>
            <li style="list-style: none;">数量： {{ $item['amount'] }}個</li>
            <li style="list-style: none;">小計：{{ $item['price']*$item['amount'] }}円</li>
            @php
                $total_price += $item['price']*$item['amount'];
            @endphp
            <br>
        @endforeach
        <hr>
        <br>
        最終合計金額：{{$total_price}}円
    </ul>
</body>
</html>
