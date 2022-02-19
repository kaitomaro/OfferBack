<style>
    *{
        color: black;
    }
</style>
こんにちは、{{$name}}さん
<br>
<br>
以下のリンクをタップしてEatapの利用を開始してください。
<br>
<br>
<a href="{{ url('/api/verify?id='.$id.'&token='.$token) }}" class="button" target="_blank">登録はこちら</a>
<br>

<br>
<br>


<br>
