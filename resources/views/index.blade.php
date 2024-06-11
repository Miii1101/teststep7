@extends('layouts.app')

@section('content')
<div class="commodity_list">
    <h1>商品一覧画面</h1>

    <div class="search_form">
        <form id="search-form" action="{{ route('product.search') }}" method="get">
            <input type="text" name="key" id="search-key" placeholder="検索キーワード">

            <select name="companies" id="search-companies">
                <option value="">メーカーを選択</option>
                @foreach ($companies as $id => $company)
                <option value="{{ $company }}" {{ $selectedCompany == $company ? 'selected' : '' }}>{{ $company }}</option>
                @endforeach
            </select>

            <label for="price_min">価格（下限）:</label>
            <input type="number" name="price_min" id="price_min">

            <label for="price_max">価格（上限）:</label>
            <input type="number" name="price_max" id="price_max">

            <label for="stock_min">在庫数（下限）:</label>
            <input type="number" name="stock_min" id="stock_min">

            <label for="stock_max">在庫数（上限）:</label>
            <input type="number" name="stock_max" id="stock_max">

            <button type="submit" class="btn btn-primary">検索</button>
        </form>
        <div id="search-results">
        <!-- 検索結果を表示するエリア -->
        </div>
    </div>

    <form action="{{ route('product.create') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-success">新規登録</button>
    </form>
    

</div>

<table class="commodity-table table table-striped">
    <thead>
        <tr>
            <th>@sortablelink('id', 'ID')</th>
            <th>商品画像</th>
            <th>@sortablelink('product_name', '商品名')</th>
            <th>@sortablelink('price', '価格')</th>
            <th>@sortablelink('stock', '在庫数')</th>
            <th>@sortablelink('company.company_name', 'メーカー名')</th>
            <th>詳細</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="50" height="50"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}円</td>
            <td>{{ $product->stock }}本</td>
            <td>{{ $product->company->company_name }}</td>
            <td>
                <form action="{{ route('product.detail', $product->id) }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-info">詳細</button>
                </form>
            </td>
            <td>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger delete-button" data-id="{{ $product->id }}">削除</button>
            </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/delete.js') }}"></script>
@endsection

