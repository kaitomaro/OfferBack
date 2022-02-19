@extends('layouts.store_hp_layout')
@section('store_hp_content')
<section class="mission">
    <h2 class="mission__heading">
        <span class="eatap_logo">Eatap</span> のミッション
    </h2>
    <div class="mission__sub-heading-container">
        <h3 class="mission__sub-heading">
            「空席」と「空腹」<span class="mission__sub-heading-br">を結ぶ</span><span class="mission__sub-heading-br">架け橋の創造</span>
            <img src="/img/hp_img/point.svg" class="mission__sub-heading-icon" width="50">
        </h3>
    </div>
    <div class="mission__container">
        <p class="mission__p">
            人々が集う場所として活気溢れる外食産業。<br/>
            しかし、その稼働率平均は60％前後。<br/>
            <span class="mission__br">つまり、一日を通して</span><span class="mission__br">約半分もの座席が空席なのだ。</span>
        </p>
        <p class="mission__p">
            この課題を解決するために<br/>
            食と身近な「私たち」のテクノロジー<br/>
            食を提供すつ「飲食店」の知恵<br/>
            これらを駆使し、Eatapは誕生した。
        </p>
        <p class="mission__p">
            「食」に関わる全ての人の幸せを願い、<br/>
            これからもサービス向上を目指す。
        </p>
    </div>
</section>

<section class="about">
    <div class="about__heading-container">
        <h2 class="about__heading">
            COMPANY
        </h2>
        <span class="about__heading-jp">企業情報</span>
    </div>
    <table class="about__table" height="40">
        <tr class="about__tr">
            <th class="about__th">会社名</th>
            <td class="about__td">株式会社 Eatap(Eatap, inc)</td>
        </tr>
        <tr class="about__tr">
            <th class="about__th">住所</th>
            <td class="about__td"><span class="about__br">〒278-0006</span> <span class="about__br">千葉県野田市柳沢 103-6</span></td>
        </tr>
        <tr class="about__tr">
            <th class="about__th">代表者</th>
            <td class="about__td">代表取締役　生田暁泰</td>
        </tr>
        <tr class="about__tr">
            <th class="about__th">設立</th>
            <td class="about__td">2020年12月24日</td>
        </tr>
        <tr class="about__tr">
            <th class="about__th">資本金</th>
            <td class="about__td">3,000,000円</td>
        </tr>
        <tr class="about__tr">
            <th class="about__th"><span class="about__br">事業</span><span class="about__br">内容</span></th>
            <td class="about__td">飲食店向けサービスの開発・販売</td>
        </tr>
    </table>
</section>
@endsection