@extends('layouts.hp_layout')
      @section('hp_content')
      <section class="what-is-eatap">
        <div class="what-is-eatap__text-container">
          <h2 class="what-is-eatap__heading">Eatapとは?</h2>
          <p class="what-is-eatap__p">
            お食事がお得になる会員制サービスです!<br />
            EatapはDP(ダイナミックプライシング)の考え方を用い、お店の混雑状況をクーポンに反映させる新しい仕組みを導入!
            来店時間で割引価格、対象メニューが変わるクーポンを実現しました。
          </p>
          <h3 class="what-is-eatap__sub-heading">なぜこんなにお得になるの?</h3>
          <p class="what-is-eatap__p">
            他サービスと比べ割引率の高いクーポンが利用可能！
            Eatapはいつでも使えるクーポンとは違い、発行する時間をお店が選択することができるため、このような割引率の高いクーポンが可能になっています。
          </p>
        </div>
        <img
          class="what-is-eatap__img"
          src="/img/hp_img/coupon_screen_1.png"
          alt="coupon screen"
        />
      </section>
      <section class="perks">
        <h2 class="perks__heading">会員特典</h2>
        <div class="perks__container">
          <div class="perk">
            <div class="perk__img-container">
              <img
                class="perk__img--map-search"
                src="/img/hp_img/map_search.png"
                alt="map search"
              />
            </div>
            <h3 class="perk__heading">
              近くのお店を<br />
              マップから簡単検索
            </h3>
            <p class="perk__p">
              マップ上に近くのお店のクーポン情報がリアルタイムで表示される!
              さらに、割引率に応じてピンが色分けされているためお得なお店が一目でわかる!
            </p>
          </div>
          <div class="perk">
            <div class="perk__img-container">
              <img
                class="perk__img--coupon-manytimes"
                src="/img/hp_img/coupon_manytimes.png"
                alt="coupon manytimes"
              />
            </div>
            <h3 class="perk__heading">
              割引率の高い多様なクーポンが<br />
              何度でも使える
            </h3>
            <p class="perk__p">
              他サービスと違い、お店がクーポンを利用できる時間を指定できるため、
              時間帯に合わせた多様なクーポンがご利用できます。
            </p>
          </div>
          <div class="perk">
            <div class="perk__img-container">
              <img
                class="perk__img"
                src="/img/hp_img/private_management.png"
                alt="private management"
              />
            </div>
            <h3 class="perk__heading">個人経営のお店も使える</h3>
            <p class="perk__p">
              クーポンといえばチェーン店で使えるイメージですが、
              Eatapは多数個人経営のお店を掲載しています!
            </p>
          </div>
        </div>
      </section>
      <section class="pricing">
        <h2 class="pricing__heading">料金</h2>
        <p class="pricing__p">Eatapは利用料が無料!</p>
      </section>
      <section class="how-to-use">
        <h2 class="how-to-use__heading">クーポンの利用方法</h2>
        <div class="step__container">
          <div class="step">
            <h3 class="step__heading">
              step
              <span class="step__number">01</span>
            </h3>
            <div class="step__img-container">
              <img
                class="step__img--easy-search"
                src="/img/hp_img/easy_search.png"
                alt="easy search"
              />
            </div>
            <p class="step__p">マップからお店を検索</p>
          </div>
          <div class="step">
            <h3 class="step__heading">
              step
              <span class="step__number">02</span>
            </h3>
            <div class="step__img-container">
              <img
                class="step__img--check-coupon"
                src="/img/hp_img/check_coupon.png"
                alt="check coupon"
              />
            </div>
            <p class="step__p">今使えるクーポンを確認</p>
          </div>
          <div class="step">
            <h3 class="step__heading">
              step
              <span class="step__number">03</span>
            </h3>
            <div class="step__img-container">
              <img class="step__img" src="/img/hp_img/QR.png" alt="qr" />
            </div>
            <p class="step__p">
              お店のQRコードを<br />
              読み取って完了!
            </p>
          </div>
        </div>
      </section>
      <section class="q-and-a">
        <h2 class="q-and-a__heading">よくある質問</h2>
        <div class="q-and-a__wrapper">
          <div class="q-and-a__row">
            <div class="q-and-a-container">
              <h3 class="question">Q1.クーポンを利用するには何が必要ですか?</h3>
              <p class="answer">
                A.まず会員登録が必要です。
                会員登録後、広告視聴一回につき1枚のクーポンが利用可能です。
              </p>
            </div>
            <div class="q-and-a-container">
              <h3 class="question">Q2.初回限定クーポンとはなんですか?</h3>
              <p class="answer">
                A.初回限定クーポンとは、初めて来店するお店で利用できるクーポンです。
                ただし、お店によって利用できるクーポン枚数を制限していますのでなくなり次第終了となります。
              </p>
            </div>
            <div class="q-and-a-container">
              <h3 class="question">Q3.非会員でも利用できますか?</h3>
              <p class="answer">
                A.非会員の方はクーポンの利用ができません。
                ただし、1グループ1枚まで利用可能ですと表記があるクーポンに関しましては、
                グループ内で1名でも会員がいればご利用できます。
              </p>
            </div>
          </div>
          <div class="q-and-a__row">
            <div class="q-and-a-container">
              <h3 class="question">Q4.予約は必要ですか?</h3>
              <p class="answer">
                A.店舗によって異なりますので、店舗のクーポンページをご確認下さい。
              </p>
            </div>
            <div class="q-and-a-container">
              <h3 class="question">
                Q5.「他のクーポン併用不可。送客・予約サービス併用不可」とは?
              </h3>
              <p class="answer">
                A.他のサイトやアプリで発行されているクーポンとの併用ができません。
                また、他の飲食店検索予約サイトやアプリ、
                街中でお店を案内してくれるサービスなどでの来店も不可です。
                (こういったサービスを使うと店舗にサービス使用料がかかる為)
              </p>
            </div>
          </div>
        </div>
      </section>
      @endsection