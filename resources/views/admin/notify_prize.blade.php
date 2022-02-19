@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <form action="/admin/notify_prize" method="POST">
                    @csrf 
                    <div class="form-group">
                        <label for="notice_title">タイトル</label>
                        <input type="text" name="title" class="form-control" id="notice_title" value="当選コードが届きました">
                    </div>
                    <div class="form-group">
                        <label for="notice_body">詳細</label>
                        <textarea class="form-control" name="body" id="notice_body" rows="3">当選おめでとうございます！&NewLine;&NewLine;以下のコードからギフト券を受け取ってください。&NewLine;&NewLine;xxxxxx?axa
                        </textarea>
                        <input type="hidden" name="user_id" value="{{$loto->user_id}}">
                        <input type="hidden" name="loto_id" value="{{$loto->id}}">
                    </div>
                    <div>
                        <button class="btn btn-primary">ID{{$loto->user_id}}に送信</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection