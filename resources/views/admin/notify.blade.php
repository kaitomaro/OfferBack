@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <form action="/admin/notify" method="POST">
                    @csrf 
                    <div class="form-group">
                        <label for="notice_title">タイトル</label>
                        <input type="text" name="title" class="form-control" id="notice_title">
                    </div>
                    <div class="form-group">
                        <label for="notice_body">詳細</label>
                        <textarea class="form-control" name="body" id="notice_body" rows="3"></textarea>
                    </div>
                    <div class="leave_notice_or_not">
                        <label for="leave_or_not">お知らせに残す</label>
                        <input type="checkbox" name="leave_or_not" id="leave_or_not">
                    </div>
                    <div>
                        <button class="btn btn-primary">全員にプッシュ通知を送信する</button>
                    </div>
                </form>
                <div class="not_payed_prize">
                    <h4>未払い当選</h4>
                    @foreach ($lotos as $loto)
                        <a href="/admin/prize_notify/{{$loto->id}}">{{ $loto->user_id}}: {{$loto->kind_of_prize }}等, {{$loto->amount_of_money }}円</a>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection