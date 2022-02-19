<html>
    <head>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link href="{{ asset('/css/layout/layout.css') }}" rel="stylesheet">
        <style>
            .position_center{
                text-align: center;
                margin-top: 4rem;

            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="position_center">
                        <form action="/hello/start" method="post">
                            <h6>ボタンを押して利用を開始してください。</h6>
                            @csrf
                            <input type="hidden" name="email" value="{{$tmp_mail->email}}">
                            <input type="hidden" name="shop_id" value="{{$tmp_mail->shop_id}}">
                            <input type="hidden" name="token" value="{{$tmp_mail->token}}">
                            <input type="submit" class="btn btn-primary submit_buttton" value="利用開始">
                        </form>       
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

