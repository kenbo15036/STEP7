<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    //商品一覧を取得
    public function getList(){
        $products = DB::table('products')->get();
        return $products;
    }

    //商品の新規登録
    public function registProduct($data){
        $imgPath = null;
        
        // 画像がアップロードされた場合の処理
        if (isset($data['img_path']) && $data['img_path']->isValid()) {
            try {
                $imgPath = $data['img_path']->store('products', 'public');
            } catch (\Exception $e) {
                throw new \Exception('画像のアップロードに失敗しました: ' . $e->getMessage());
            }
        }
        
        DB::table('products')->insert([
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $imgPath,
            'company_id' => $data['company_id'],
        ]);
    }

    //商品情報詳細を取得
    public function getProductDetail($id){
        $product = DB::table('products')->where('id', $id)->first();
        return $product;
    }

    //商品情報の更新
    public function updateProduct($data, $id){
        $updateData = [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'company_id' => $data['company_id'],
        ];
        
        // 新しい画像がアップロードされた場合の処理
        if (isset($data['img_path']) && $data['img_path']->isValid()) {
            try {
                // 古い画像を削除
                $oldProduct = DB::table('products')->where('id', $id)->first();
                if ($oldProduct && $oldProduct->img_path) {
                    Storage::disk('public')->delete($oldProduct->img_path);
                }
                
                // 新しい画像を保存
                $updateData['img_path'] = $data['img_path']->store('products', 'public');
            } catch (\Exception $e) {
                throw new \Exception('画像のアップロードに失敗しました: ' . $e->getMessage());
            }
        }
        
        DB::table('products')->where('id', $id)->update($updateData);
    }

    //商品の削除
    public function deleteProduct($id){
        DB::table('products')->where('id', $id)->delete();
    }

    //商品とメーカー情報を結合して取得（一覧用）
    public function getProductsWithCompany($keyword = null, $companyId = null){
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
        
        return $query->get();
    }

    //商品とメーカー情報を結合して取得（詳細用）
    public function getProductDetailWithCompany($id){
        return DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', $id)
            ->first();
    }
    
}
