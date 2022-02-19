@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="to_category_link_frame">
                <a href="/admin/notify">通知</a>
            </div>
            <div class="card">
                <div class="card-header">登録店舗一覧</div>
                <div class="card-body">
                    @foreach ($shops as $shop)
                        <a href="/admin/show/{{$shop->id}}"><li>{{ $shop->name }}</li></a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection