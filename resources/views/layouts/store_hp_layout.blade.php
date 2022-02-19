<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/css/hp/store_hp.css" />
        <link rel="stylesheet" href="/css/hp/nav.css" />
        <link rel="stylesheet" href="/css/hp/profile.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="/img/logo.png">
        <title>Eatap</title>
    </head>
    <body>
        <div class="container">
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
                            <a href="/store" class="nav__link">加盟店ログイン</a>
                        </li>
                    </ul>
                </div>
                <div class="nav-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
            {{-- 内容 --}}
            @yield('store_hp_content')

            <section class="contact">
                <h2 class="contact__heading">お問い合わせ</h2>
                <form class="contact-form" action="">
                    <p class="contact_p">
                        お問合せは以下フォームよりお願いいたします。<br />内容を確認後、折り返しご連絡させて頂きます。
                    </p>
                    <label class="contact-form__label" for="shopname">店舗名</label>
                    <input class="contact-form__input" id="shopname" name="shopname" type="text" />
                    <label class="contact-form__label" for="companyname">会社名</label>
                    <input class="contact-form__input" id="companyname" name="companyname" type="text" />
                    <label class="contact-form__label" for="name">担当者氏名</label>
                    <input class="contact-form__input" id="name" name="name" type="text" />
                    <label class="contact-form__label" for="email">メールアドレス</label>
                    <input class="contact-form__input" id="email" name="email" type="email" />
                    <label class="contact-form__label" for="tel">電話番号</label>
                    <input class="contact-form__input" id="tel" name="tel" type="tel" />
                    <label class="contact-form__label" for="content">お問い合わせ内容</label>
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