<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        DB::table('products')->insert([
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $data['img_path'],
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
        DB::table('products')->where('id', $id)->update([
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $data['img_path'],
            'company_id' => $data['company_id'],
        ]);
    }

    //商品の削除
    public function deleteProduct($id){
        DB::table('products')->where('id', $id)->delete();
    }
    
}
