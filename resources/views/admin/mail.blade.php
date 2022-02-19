@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="to_category_link_frame">
                <h6>メールアドレス編集</h6>
            </div>
            <div class="card">
                <form action="/admin/show/{{"$shop->id"}}/mail" method="POST">
                    @csrf
                    <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="店名" value="{{$shop->name}}">
                    <input name="phone" type="text" class="form-control" id="exampleInputEmail1" placeholder="TEL" value="{{$shop->phone}}">
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{$shop->email}}">
                    <input name="zip_code" type="text" class="form-control" id="exampleInputEmail1" placeholder="171-0021" value="{{$shop->zip_code}}">
                    <input name="address" type="text" class="form-control" id="exampleInputEmail1" placeholder="東京都豊島区西池袋" value="{{$shop->address}}">
                    <input name="instagram" type="text" class="form-control" id="exampleInputEmail1" placeholder="instagram" value="{{$shop->instagram}}">
                    <input name="twitter" type="text" class="form-control" id="exampleInputEmail1" placeholder="twitter" value="{{$shop->twitter}}">
                    <input name="facebook" type="text" class="form-control" id="exampleInputEmail1" placeholder="facebook" value="{{$shop->facebook}}">
                    <input name="sns" type="text" class="form-control" id="exampleInputEmail1" placeholder="sns" value="{{$shop->sns}}">
                    <input name="holiday" type="text" class="form-control" id="exampleInputEmail1" placeholder="定休日" value="{{$shop->holiday}}">
                    <input name="lunch_estimated_bottom_price" type="text" class="" placeholder="昼の予算" value="{{$shop->lunch_estimated_bottom_price}}">
                     〜 
                    <input name="lunch_estimated_high_price" type="text" class="" placeholder="昼の予算" value="{{$shop->lunch_estimated_high_price}}">
                    <br>
                    <input name="dinner_estimated_bottom_price" type="text" class="" id="" placeholder="夜の予算" value="{{$shop->dinner_estimated_bottom_price}}">
                     〜 
                    <input name="dinner_estimated_high_price" type="text" class="" id="" placeholder="夜の予算" value="{{$shop->dinner_estimated_high_price}}">
                    <br>
                    <input name="latitude" type="text" class="" id="" placeholder="経度" value="{{$shop->latitude}}">
                     , 
                     <input name="longitude" type="text" class="" id="" placeholder="経度" value="{{$shop->longitude}}">
                    <div>
                        <button class="btn btn-primary">メールを変更する</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection