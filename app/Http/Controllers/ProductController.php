<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Company;

class ProductController extends Controller
{
    // 商品一覧画面表示
    public function index() {
        $products = Product::all();
        $companies = Company::pluck('company_name', 'id')->toArray(); // メーカー名のリストを取得（キーが ID、値がメーカー名）
    
        // $selectedCompany 変数を初期化
        $selectedCompany = null;
    
        return view('index', [
            'products' => $products,
            'companies' => $companies,
            'selectedCompany' => $selectedCompany,
        ]);
    }
    
    // 商品検索処理
    public function search(Request $request) {
        $key = $request->input('key');
        $selectedCompany = $request->input('companies');
    
        $query = Product::query();
    
        if ($key) {
            $query->where(function ($query) use ($key) {
                $query->where('product_name', 'like', '%' . $key . '%')
                      ->orWhere('price', 'like', '%' . $key . '%')
                      ->orWhere('stock', 'like', '%' . $key . '%');
            });
        }
    
        if ($selectedCompany) {
            $companyId = Company::where('company_name', $selectedCompany)->value('id');
            $query->where('company_id', $companyId);
        }
    
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
    
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
    
        if ($request->filled('stock_min')) {
            $query->where('stock', '>=', $request->stock_min);
        }
    
        if ($request->filled('stock_max')) {
            $query->where('stock', '<=', $request->stock_max);
        }
    
        $products = $query->with('company')->sortable()->get();
        $companies = Company::pluck('company_name', 'id')->toArray();
    
        if ($request->ajax()) {
            return response()->json([
                'html' => view('index', [
                    'products' => $products,
                    'selectedCompany' => $selectedCompany,
                    'companies' => $companies,
                ])->render()
            ]);
        }
    
        return view('index', [
            'products' => $products,
            'selectedCompany' => $selectedCompany,
            'companies' => $companies,
        ]);
    }

   // 削除処理
    public function destroy($id) {
        try {
            // IDに対応する商品を取得し、削除する
            $product = Product::findOrFail($id);
            $product->delete();
        
            return redirect()->route('product.index');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // 商品が見つからない場合はエラーメッセージを表示し、商品一覧ページにリダイレクト
        return redirect()->route('product.index')->with('error', '指定された商品が見つかりませんでした');
    }
}

    // 商品登録
    public function create() {
        try {
    // 企業名とIDのリストを取得し、ビューに渡す
        $companies = Company::pluck('company_name', 'id')->all();
        return view('create', [
            'companies' => $companies,
        ]);
        } catch (\Exception $e) {
    // 例外が発生した場合はエラーページにリダイレクト
            return redirect()->route('error.page')->with('error', '企業名の取得に失敗しました');
        }
    }

    public function store(ProductRequest $request) {
        // フォームから商品データを取得
        $validatedData = $request->validated();

        // 企業名から企業IDを取得
        $companyName = $request->input('company_name');
        $companyId = DB::table('companies')->where('company_name', $companyName)->value('id');
    
        // 商品データに企業IDを追加
        $validatedData['company_id'] = $companyId;
    
        // 商品をデータベースに挿入
        Product::create($validatedData);
    
        // 商品一覧ページにリダイレクト
        return redirect()->route('product.index')->with('success', '商品を追加しました');
    }


    // 商品詳細画面表示
    public function show($id) {
        $product = Product::findOrFail($id);
        return view('detail', ['product' => $product]);
    }

    
    // 商品編集画面表示
    public function edit($id) {
        try {
            $product = Product::findOrFail($id);
            $companies = Company::all();
            return view('edit', compact('product', 'companies'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('product.index')->with('error', '商品が見つかりませんでした');
        }
    }
    
    // 商品更新処理
    public function update(ProductRequest $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->validated());
        return redirect(route('product.search'));
    }
}
