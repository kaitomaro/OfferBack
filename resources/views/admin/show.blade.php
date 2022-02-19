@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <h5>基本情報</h5>
                        <li><a href="/admin/show/{{$shop->id}}/bills">ご利用料金詳細画面へ</a></li>
                        <li>ID: {{$shop->id}}</li>
                        <li>店舗名: {{$shop->name}}</li>
                        <li>電話番号: {{$shop->phone}}</li>
                        <li>郵便番号: {{$shop->zip_code}}</li>
                        <li>住所: {{$shop->address}}</li>
                        <li><a href="/admin/show/{{$shop->id}}/mail">メールアドレス: {{$shop->email}}</a></li>
                        <li>ヘッダー画像: {{$shop->top_image}}</li>
                    </ul>
                    <ul>
                        <h5>営業時間紹介</h5>
                        @foreach ($times as $time)
                            <li>ID{{$time->id}}</li>
                            <li>start{{$time->start_time}}</li>
                            <li>end{{$time->end_time}}</li>
                            <li>月: {{$time->monday}}</li>
                            <li>火: {{$time->tsuesday}}</li>
                            <li>水: {{$time->wednesday}}</li>
                            <li>木: {{$time->thursday}}</li>
                            <li>金: {{$time->friday}}</li>
                            <li>土: {{$time->saturday}}</li>
                            <li>日: {{$time->sundday}}</li>
                            <li>時間: {{$time->time_type}}(昼夜昼夜)</li>
                            <br>
                        @endforeach
                    </ul>
                    <ul>
                        <h5>店舗紹介画像</h5>
                        @foreach ($images as $image)
                            <li>ID: {{$image->id}}</li>
                            <li>店舗ID: {{$image->shop_id}}</li>
                            <li>画像名 {{$image->image_name}}</li>
                            <li>順番: {{$image->sort_num}}</li>
                            <br>
                        @endforeach
                    </ul>  
                    <ul>
                        <h5>メニュー</h5>
                        @foreach ($menus as $menu)
                            <li>ID: {{$menu->id}}</li>
                            <li>メニュー名: {{$menu->name}}</li>
                            <li>ドリンクor食べ物: {{$menu->menu_type}}</li>
                            <li>価格： {{$menu->price}}</li>
                            <br>
                        @endforeach
                    </ul>   
                    <ul>
                        <h5>割引メニュー</h5>
                        @foreach ($services as $service)
                            <li>ID: {{$service->name}}</li>
                            <li>メニュー名: {{$service->name}}</li>
                            <li>割引の種類: {{$service->service_type}} (0~2)</li>
                            <li>価格: {{$service->price}}</li>
                            <li>画像: {{$service->image_path}}</li>
                            <br>
                        @endforeach
                    </ul>
                    <ul>
                        <h5>クーポン</h5>
                        @foreach ($coupons as $coupon)
                            <li>ID: {{$coupon->id}}</li>
                            <li>メニューID: {{$coupon->service_id}}</li>
                            <li>時間ID: {{$coupon->time_id}} 時〜</li>
                            <li>DISCOUNNT: {{$coupon->discount}} 円or%</li>
                            <li>クーポンが有効かどうか: {{$coupon->display}}</li>
                            <li>営業時間４つ（昼夜昼夜)のうちどれに属するか: {{$coupon->time_type}}</li>
                            <li>discount_type: {{$coupon->discount_type}} %か円</li>
                            <li>電話予約: {{$coupon->telephone_reservation}}</li>
                            <li>初回限定: {{$coupon->first_time_discount}}</li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection