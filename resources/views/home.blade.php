@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 新規登録成功後に商品一覧画面に自動リダイレクト
    setTimeout(function() {
        window.location.href = "{{ route('list') }}";
    }, 3000); // 3秒後にリダイレクト
</script>
@endsection
