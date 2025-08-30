@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('商品一覧画面') }}</div>

                <div class="card-body">
                <div row>
                    <form method="GET" action="{{ route('list') }}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="商品名を入力してください" value="{{ $keyword ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <select name="company_id" class="form-control">
                                    <option value="">メーカーを選択してください</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ ($companyId ?? '') == $company->id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">検索</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <table class="table table-striped">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>商品画像</th>
                                <th>商品名</th>
                                <th>価格</th>
                                <th>在庫数</th>
                                <th>メーカー</th>
                                <th class="text-center"><a href="{{ route('new') }}" class="btn btn-warning">新規登録</a></th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->img_path)
                                        <img src="{{ asset('storage/' . $product->img_path) }}">
                                    @else
                                        <span>画像なし</span>
                                    @endif
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>￥ {{ number_format($product->price) }}</td>
                                <td>{{ number_format($product->stock) }} 個</td>
                                <td>{{ $product->company_name }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('detail', ['id' => $product->id]) }}" class="btn btn-info">詳細</a>
                                        
                                        <form method="POST" action="{{ route('delete', $product->id) }}" onsubmit="return confirm('この商品を削除してもよろしいですか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">削除</button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                           @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

