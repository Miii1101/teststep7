<!-- 商品情報詳細画面 -->
<link rel="stylesheet" href="style.CSS">

@extends('layouts.app')

@section('content')

    <div class="detail_page">
        <h1>商品情報詳細画面</h1>

        <div class="commodity_detail">
            <p>ID: {{ $product->id }}</p>
            <p>商品画像: {{ $product->img_path }}</p>
            <p>商品名: {{ $product->product_name }}</p>
            <p>メーカー名: {{ $product->company->company_name }}</p>
            <p>価格: {{ $product->price }}円</p>
            <p>在庫数: {{ $product->stock }}本</p>
            <p>コメント: {{ $product->comment }}</p>
        </div>

        <div class="button-group">
            <form action="{{ route('product.index') }}" method="get">
                @csrf
                <button type="submit" class="btn btn-back">戻る</button>
            </form>
            <form action="{{ route('product.edit', $product->id) }}" method="get">
                @csrf
                <button type="submit" class="btn btn-hensyu">編集</button>
            </form>
        </div>
    </div>

@endsection