<link rel="stylesheet" href="style.CSS">

@extends('layouts.app')

@section('content')

<div class="commodity_edit">
    <h1>商品情報編集画面</h1>

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <p>ID: {{ $product->id }}</p>
        </div>

        <div class="form-group">
            <label for="product_name">商品名*</label>
            <input class="form-control" id="product_name" name="product_name" placeholder="NAME" value="{{ $product->product_name }}">
            @if($errors->has('product_name'))
            <p>{{ $errors->first('product_name') }}</p>
            @endif
        </div>

        <div class="form-group">
                <label for="company_name">メーカー名*</label>
                <select name="company_name" class="form-select">
                @foreach ($companies as $company)
                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                @endforeach
                </select>
                @if($errors->has('company_name'))
                <p>{{ $errors->first('company_name') }}</p>
                @endif
            </div>


        <div class="form-group">
            <label for="price">価格*</label>
            <input class="form-control" id="price" name="price" placeholder="PRICE" value="{{ $product->price }}">
            @if($errors->has('price'))
                <p>{{ $errors->first('price') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="stock">在庫数*</label>
            <input class="form-control" id="stock" name="stock" placeholder="STOCK" value="{{ $product->stock }}">
            @if($errors->has('stock'))
                <p>{{ $errors->first('stock') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="detial">コメント</label>
            <textarea class="form-control" id="detail" name="detail" placeholder="DETAIL">{{ $product->detail }}</textarea>
            @if($errors->has('detail'))
                <p>{{ $errors->first('detail') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="img_path">商品画像</label>
            <input type="file" name="fileInput">
        </div>

        <button type="submit" class="update_btn" onclick='return confirm("編集内容を更新します");'>更新</button>
    </form>
    <form action="{{ route('product.index') }}" method="get">
            @csrf
            <button type="submit" class="back_btn">戻る</button>
        </form>
</div>

@endsection