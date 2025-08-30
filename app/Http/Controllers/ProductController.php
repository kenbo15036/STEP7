<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //商品一覧の表示
    public function showList(Request $request){
        // 検索キーワードとメーカーIDを取得
        $keyword = $request->input('keyword');
        $companyId = $request->input('company_id');
        
        // 商品とメーカー情報を結合して取得
        $query = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name');
        
        // キーワードが存在する場合は検索条件を追加
        if ($keyword) {
            $query->where('products.product_name', 'LIKE', '%' . $keyword . '%');
        }
        
        // メーカーIDが選択されている場合は検索条件を追加
        if ($companyId) {
            $query->where('products.company_id', $companyId);
        }
        
        $products = $query->get();
        
        // メーカー一覧を取得（プルダウン用）
        $companies = DB::table('companies')->get();
        
        return view('list', [
            'products' => $products, 
            'keyword' => $keyword,
            'companyId' => $companyId,
            'companies' => $companies
        ]);
    }

    //商品の新規登録画面の表示
    public function registProduct(){
        // メーカー情報を取得
        $companies = DB::table('companies')->get();
        
        return view('new', ['companies' => $companies]);
    }

    //商品の新規登録処理
    public function registSubmit(Request $request){
        DB::beginTransaction();

        try{
        $model = new Product();
        $model->registProduct($request);
        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // エラーメッセージをセッションに渡してリダイレクト
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '登録に失敗しました。');
        }

        return redirect(route('list'))
            ->with('success', '1件登録しました。');

    }
    
    //商品情報詳細画面の表示
    public function productDetail($id){
        // 商品とメーカー情報を結合して取得
        $productdetail = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', $id)
            ->first();
        
        return view('detail',['productdetail' => $productdetail]);
    }

    //商品の削除
    public function deleteProduct($id){
        $model = new Product();
        $deleteProduct = $model->deleteProduct($id);

        return redirect(route('list'));
    }

    //商品情報編集画面の表示
    public function editProduct($id){
        $model = new Product();
        $product = $model->getProductDetail($id);
        
        // メーカー情報を取得
        $companies = DB::table('companies')->get();
        
        return view('edit', ['product' => $product, 'companies' => $companies]);
    }

    //商品情報の更新処理
    public function updateProduct(Request $request, $id){
        DB::beginTransaction();

        try{
            $model = new Product();
            $model->updateProduct($request, $id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '更新に失敗しました。');
        }

        return redirect(route('list'))
            ->with('success', '1件更新しました。');
    }
}