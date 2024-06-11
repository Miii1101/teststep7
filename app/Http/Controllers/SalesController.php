<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SalesController extends Controller
{
    public function sales(Request $request)
    {
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'

        ]);

        // リクエストから商品IDと購入数を取得
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        try {
            // 商品の在庫数を取得
            $product = Product::findOrFail($productId);
            $stock = $product->stock;

            // 在庫数が購入数以上かどうかをチェック
            if ($stock >= $quantity) {
                // 購入処理
                $sale = new Sale();
                $sale->product_id = $productId;
                $sale->quantity = $quantity;
                $sale->save();

                // 在庫数を減算
                $product->stock -= $quantity;
                $product->save();

                return response()->json(['status' => 'success', 'message' => 'Purchase successful.']);
            } else {
                // 在庫が不足している場合はエラーメッセージを返す
                return response()->json(['status' => 'error', 'message' => 'Insufficient stock.']);
            }
        } catch (\Exception $e) {
            // その他のエラーハンドリング
            return response()->json(['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
