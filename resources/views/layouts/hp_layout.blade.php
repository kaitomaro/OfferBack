<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/css/hp/hp.css" />
    <link rel="stylesheet" href="/css/hp/nav.css" />
    <link rel="shortcut icon" href="/img/logo.png">
    <script data-ad-client="ca-pub-1712680873558822" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Eatap</title>
  </head>
  <body>
    <div class="container">
        <a class="download-now" href="https://itunes.apple.com/jp/app/id1565462664?mt=8">今すぐダウンロード</a>
        <nav class="nav">
            <h1 class="nav__title">Eatap</h1>
            <div class="nav__container">
                <ul class="nav__link-list">
                    <li class="nav__link-list-item">
                        <a href="/" class="nav__link">トップ</a>
                    </li>
                    <li class="nav__link-list-item">
                        <a href="/about" class="nav__link">会社概要</a>
                    </li>
                    <li class="nav__link-list-item">
                        <a href="/stores" class="nav__link">加盟を検討中の方へ</a>
                    </li>
                </ul>
            </div>
            <div class="nav-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    
        <header class="header">
            <div class="header__heading-container">
                <h1 class="header__heading">
                池袋ユーザーのあなた、<br />
                まだEatap使ってないの?<br />
                マップからワンタップで<br />
                使えるDPクーポンアプリ<br />
                <div class="header__catch-container">
                    <span class="header__catch">お得なクーポン多数!</span>
                </div>
                </h1>
            </div>
        </header>

        {{-- 中身 --}}
        @yield('hp_content')
        
        <section class="contact">
            <h2 class="contact__heading">お問い合わせ</h2>
            <form class="contact-form" action="/contact" method="POST">
                @csrf
                <label class="contact-form__label" for="name">お名前</label>
                <input
                class="contact-form__input"
                id="name"
                name="name"
                type="text"
                />
                <label class="contact-form__label" for="email">メールアドレス</label>
                <input
                class="contact-form__input"
                id="email"
                name="email"
                type="email"
                />
                <label class="contact-form__label" for="content"
                >お問い合わせ内容</label>
                <textarea class="contact-form__textarea" id="content" name="content"></textarea>
                <button class="contact-form__button" type="submit">確認</button>
            </form>
        </section>
        <footer class="footer">
            <a class="footer__link" href="/common/kiyaku.pdf">利用規約</a>
            <a class="footer__link" href="/common/policy.pdf">プライバシーポリシー</a>
            <a class="footer__link" href="/store">加盟店ログイン</a>
        </footer>
    </div>
    <script type="module">
      $(function() {
        $(document).on('click', function(e) {
            console.log($(e.target).closest('.nav-icon').length)
            if (!$(e.target).closest('.nav-icon').length) {
                if ($('.nav-icon').hasClass('active')) {
                    $('.nav-icon').toggleClass('active');
                    $('.nav__container').removeClass('active');
                    $('.nav__container').css('display', 'none');
                }
            } else {
                $('.nav-icon').toggleClass('active');
                if ($('.nav-icon').hasClass('active')) {
                    $('.nav__container').addClass('active');
                    $('.nav__container').css('display', 'block');
                } else {
                    $('.nav__container').removeClass('active');
                    $('.nav__container').css('display', 'none');
                }
            }
        })
      });
    </script>
  </body>
</html>
