@extends('layouts.app')
@section('pageCss')
<link rel="stylesheet" href="/css/login/login.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card-body">
                <form method="POST" action="{{ route('store.login') }}">
                    @csrf
                    <div class="image_wrapper">
                        <img src="{{'/img/logo.png'}}" class="fix_logos">
                    </div>
                    <div class="form-group row mail_row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                        <div class="col-md-5">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                        <div class="col-md-5">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    パスワードを保存しますか?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-5 offset-md-4">
                            <button type="submit" class="btn btn-success login_btn">
                                ログイン
                            </button>
                        </div>
                    </div>
                </form>
                <div class="form-group row mb-0 forget_pass_link">
                    <div class="col-md-5 offset-md-4">
                        <a href="/store/password/reset">パスワードをお忘れですか？</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
