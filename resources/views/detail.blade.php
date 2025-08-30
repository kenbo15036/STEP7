@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('商品情報詳細画面') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('ID') }}</label>
                        <div class="col-md-6 d-flex align-items-center">
                          <a>{{ $productdetail->id }}</a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('商品画像') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>@if($productdetail->img_path)
                                            <img src="{{ asset('storage/' . $productdetail->img_path) }}">
                                        @else
                                            画像なし
                                        @endif
                                </a>
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('商品名') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>{{ $productdetail->product_name }}</a>
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('メーカー') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>{{ $productdetail->company_name }}</a>
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('価格') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>￥ {{ number_format($productdetail->price) }}</a>
                            </div>
                    </div>
                    <div class="row mb-3">  
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('在庫数') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>{{ number_format($productdetail->stock) }} 個</a>
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('コメント') }}</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <a>{{ $productdetail->comment }}</a>
                            </div>
                    </div>
                    <div class="d-flex justify-content-start gap-2 ms-3">
                            <a href="{{ route('edit', ['id' => $productdetail->id]) }}" class="btn btn-warning">編集</a>
                            <a href="{{ route('list') }}" class="btn btn-info">戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
