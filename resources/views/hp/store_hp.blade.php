@extends('layouts.store_hp_layout')
@section('store_hp_content')
<header class="header">
  <div class="header__heading-container">
    <h1 class="header__heading">
      <span class="header__catch">Eatap</span>に登録して<br />
      スキマ時間活用しませんか？<br />
    </h1>
  </div>
</header>
<section class="what-is-eatap">
  <div class="what-is-eatap__text-container">
    <h2 class="what-is-eatap__heading">こんなお悩みありませんか?</h2>
    <p class="what-is-eatap__p">
      新規顧客の獲得方法に悩んでいる。<br />
      曜日天候などによって集客が少ないさいの効果的な集客方法がない。<br />
      集客したいがサイトへの広告料が高い、効果が薄い。
    </p>
    <h2 class="what-is-eatap__heading">Eatapは導入費や月額費が<br />無料の集客サービスです!</h2>
    <p class="what-is-eatap__p">
      クーポンが利用され、集客に成功した場合のみ手数料が発生する完全成果型です!導入費や月額費は不要で、その浮いた費用をクーポンで還元することで集客するという、仕組みのサービスです。<br />
      <br />
      お店の客数データを元に1時間ごとの割引率と掲載メニューが設定できるため、スキマ時間の来店を促します。(また、急な天候の変化によって減客した場合にも即座にクーポン内容を変更できる仕組みで集客をサポートします。)
    </p>
  </div>
  <img class="what-is-eatap__img" src="/img/hp_img/coupon_screen_1.png" alt="coupon screen" />
</section>
<section class="points">
  <h2 class="points__heading">POINTS</h2>
  <div class="points__wrapper">
    <div class="points__row">
      <div class="points__container">
        <h3 class="point">クーポン内容を自由に設定できる！</h3>
        <p class="point_detail">
          1.通常のクーポン (10円から設定可能なクーポン)<br />
          2.初回限定クーポン(新規顧客獲得を狙った割引率の高いクーポン)※枚数制限可<br />
          3.サービスクーポン (ワンドリンク無料、トッピング無料など) の三種類をご用意しています。
        </p>
      </div>
      <div class="points__container">
        <h3 class="point">同伴者(非会員)は通常料金!</h3>
        <p class="point_detail">
          非会員のお客様はクーポンの利用ができません。しかし、1画面で皆さまご利用いただけます。と表記があるクーポン(手数料:80円／枚)に関しましては、グループ内で1名でも会員がいればみなさまご利用いただけます。
        </p>
      </div>
    </div>
    <div class="points__row">
      <div class="points__container">
        <h3 class="point">時間別にクーポン内容を変更できる</h3>
        <p class="point_detail">
          クーポンの割引率、対象メニューを1時間ごとに変更できます! ランチタイムなどのピーク時にはクーポンを発行しないことも可能なため、無駄な割引が必要ありません。
        </p>
      </div>
      <div class="points__container">
        <h3 class="point">
          解約金など一切不要
        </h3>
        <p class="point_detail">
          契約、解約ともに一切費用は掛かりませんので、お気軽にお試しいただけます!
        </p>
      </div>
    </div>
  </div>
</section>
<section class="charge">
<h1 class="charge__heading">手数料</h1>
<div class="charge__wrapper">
  <div class="charge__row">
    <div class="charge__container">
      {{-- coupon_screen_1.png --}}
      <img id='coupon_yellow' src="/img/hp_img/coupon_yellow.png" width="380px">
      </img>
      <div id='title'>
        <h2><span id='yellow_text'>１画面1名のみ</span></h2>
        <h2>使えるクーポン</h2>
      </div>
      <h2 class="charge__price"><span id=number>30</span>円/枚</h2>
    </div>
  </div>
  <div class="charge__row">
    <div class="charge__container">
      <img id='coupon_orange' src="/img/hp_img/coupon_orange.png" width="380px"></img>
      <div id='title'>
        <h2><span id='yellow_text'>１画面でみなさま</span></h2>
        <h2>使えるクーポン</h2>
      </div>
      <h2 class="charge__price"><span id=number>80</span>円/枚</h2>
    </div>
  </div>
</div>
<h2 class="charge__heading">提供サービスについて</h2>
<p class="charge__p">
  会員に提供するサービスは10円から設定可能な会員限定クーポンです。<br />
  お店は通常のクーポン、 初回限定クーポン、サービスクーポンの三種類から発行するクーポンを自由に設定することができます。
</p>
</section>


<section class="q-and-a">
<h2 class="q-and-a__heading">よくある質問</h2>
<div class="q-and-a__wrapper">
  <div class="q-and-a__row">
    <div class="q-and-a-container">
      <h3 class="question">Q1.クーポン内容は店側が選べるの?</h3>
      <p class="answer">
        A.はい、用意している三種類のクーポンの中から、自由に設定することができます。もちろん複数のクーポンを掲載することも可能です。
      </p>
    </div>
    <div class="q-and-a-container">
      <h3 class="question">Q2.クーポンを掲載するのに抵抗がある。</h3>
      <p class="answer">
        A.
        私たちが提供するサービスEatapは従来の割引率の変わらないクーポンとは違い、客数に応じて割引率を変更できるため、無駄な割引はございません。空席が目立つ時間があるようでしたら空席にも費用がかかっていますので検討する価値があると思います。無駄な割引をなくし隙間時間を有効活用することができます。
      </p>
    </div>
    <div class="q-and-a-container">
      <h3 class="question">Q3.会員の予約方法は?</h3>
      <p class="answer">
        A.当サービスに予約システムはありませんので各店が自由に決められます。予約不要や、要電話予約などお店のオペレーションに合わせて設定できます。
      </p>
    </div>
  </div>
  <div class="q-and-a__row">
    <div class="q-and-a-container">
      <h3 class="question">Q4.グループで来店の場合はどうすればよいでしょうか?</h3>
      <p class="answer">
        A.非会員のお客様はクーポンの利用ができません。しかし、1画面で皆さまご利用いただけます。と表記があるクーポン(手数料:80円／枚)に関しましては、グループ内で1名でも会員がいればみなさまご利用いただけます。
      </p>
    </div>
    <div class="q-and-a-container">
      <h3 class="question">
        Q5.手数料の支払い方法は?
      </h3>
      <p class="answer">
        A.3ヶ月分の手数料をまとめて指定の口座にお振り込み頂きます。
      </p>
    </div>
  </div>
</div>
</section>

@endsection
