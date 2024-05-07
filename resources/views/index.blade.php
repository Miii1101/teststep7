<!-- 商品一覧画面 -->
<link rel="stylesheet" href="style.CSS">

@extends('layouts.app')

@section('content')

<div class="commodity_list">
    <h1>商品一覧画面</h1>

    <div class="search_form">
        <form action="{{ route('product.search') }}" method="get">
            <input type="text" name="key" placeholder="検索キーワード">

            <select name="companies">
                <option value="">メーカーを選択</option>
                @foreach ($companies as $id => $company)
                <option value="{{ $company }}" {{ $selectedCompany == $company ? 'selected' : '' }}>{{ $company }}</option>
                @endforeach
    </select>
        <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
    
    <form action="{{ route('product.create') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-success">新規登録</button>
    </form>

</div>

<table class="commodity-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->img_path) }}" alt="商品画像"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}円</td>
            <td>{{ $product->stock }}本</td>
            <td>{{ $product->company->company_name }}</td>
            
                
            <td><form action="{{ route('product.detail',$product->id) }}" method="get">
                @csrf
                <button type="submit" class="btn btn-info">詳細</button>
            </form></td>
            <td><form action="{{ route('product.destroy',$product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection