@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('商品情報編集画面') }}</div>

                <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
                    <form action="{{ route('update', ['id' => $product->id]) }}" method="post">
                    @csrf

                    <div class="row mb-3">
                    <label for="product_name" class="col-md-3 col-form-label text-md-end">{{ __('商品名') }}<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" autofocus>
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                    <label for="company_id" class="col-md-3 col-form-label text-md-end">{{ __('メーカー') }}<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select class="form-control" id="company_id" name="company_id">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label for="price" class="col-md-3 col-form-label text-md-end">{{ __('価格') }}<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label for="stock" class="col-md-3 col-form-label text-md-end">{{ __('在庫数') }}<span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label for="comment" class="col-md-3 col-form-label text-md-end">{{ __('コメント') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="comment" name="comment" value="{{ old('comment', $product->comment) }}">
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                    <label for="img_path" class="col-md-3 col-form-label text-md-end">{{ __('商品画像') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="img_path" name="img_path" value="{{ old('img_path', $product->img_path) }}">
                            @error('img_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-warning">更新</button>
                            <a href="{{ route('detail', ['id' => $product->id]) }}" class="btn btn-info">戻る</a>
                    </div>
                    </form>


                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
