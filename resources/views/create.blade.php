<!-- 新規登録画面 -->
<link rel="stylesheet" href="style.CSS">

@extends('layouts.app')

@section('content')
    <div class="add_product">
        <h1>商品新規登録画面</h1>
    
        <form action="{{ route('regist.product') }}" method="post">
            @csrf
            <!-- 商品名や価格、在庫数などのフォーム要素を追加 -->
            <div class="form-group">
                <label for="product_name">商品名*</label>
                <input  class="form-control" id="product_name" name="product_name" placeholder="NAME" value="{{ old('product_name') }}">
                @if($errors->has('product_name'))
                    <p>{{ $errors->first('product_name') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="company_name">メーカー名*</label>
                <select name="company_name" class="form-select">
                <option></option>
                @foreach ($companies as $company)
                <option value="{{ $company }}">{{ $company }}</option>
                @endforeach
                </select>
                @if($errors->has('company_name'))
                    <p>{{ $errors->first('company_name') }}</p>
                @endif
            </div>


            <div class="form-group">
                <label for="price">価格*</label>
                <input  class="form-control" id="price" name="price" placeholder="PRICE" value="{{ old('price') }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">在庫数*</label>
                <input  class="form-control" id="stock" name="stock" placeholder="STOCK" value="{{ old('stock') }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="comment">コメント</label>
                <textarea class="form-control" id="comment" name="comment" placeholder="COMMENT">{{ old('comment') }}</textarea>
            </div>

            <label for="img_path">商品画像</label>
            <input type="file" name="fileInput" enctype="multipart/form-data">

            
            <button type="submit" class="btn btn-toroku">新規登録</button>
        </form>
        
        <form action="{{ route('product.search') }}" method="get">
            @csrf
            <button type="submit" class="btn btn-back">戻る</button>
        </form>

    </div>

@endsection