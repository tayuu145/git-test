<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</head>

<body>
    <header>
        <div id="head">
            <h1 class="head-title"><a href="/top"><img src="{{ asset('images/atlas.png') }}" width="100" height="40"></a></h1>
            <div id="migiyose" class="head-content">
                <div class="yokonarabi">
                    <p class="white">{{Auth::user()->username}}　さん</p>

                    <nav class="g-navi">
                        <div class="container nav-wrapper">
                            <!-- グローバルナビゲージョン -->
                            <ul>

                                <li class="nav-item"><a href="/top" class="a-b">
                                        <div class="nv-cot">HOME</div>
                                    </a></li>


                                <li class="nav-item"><a href="/profile" class="a-b">
                                        <div class="nv-cot">プロフィール編集</div>
                                    </a></li>


                                <li class="nav-item"><a href="/logout" class="a-b">
                                        <div class="nv-cot-b">ログアウト</div>
                                    </a></li>

                            </ul>
                        </div>
                    </nav>
                    <!-- SPグローバルナビゲージョン -->
                    <nav class="g-navi-sp">

                        <!-- ハンバーガーメニュー -->
                        <div class="menu-trigger">
                            <span></span>
                            <span></span>
                        </div>
                    </nav>

                    <!-- <ul>
                        <li>
                            <p><a class="syncer-acdn" data-target="syncer-acdn-01">^</a></p>
                            <ul id="syncer-acdn-01">
                                <li><a href="/top">ホーム</a></li>
                                <li><a href="/profile">プロフィール</a></li>
                                <li><a href="/logout">ログアウト</a></li>
                            </ul>
                        </li>
                    </ul> -->
                    <img src="{{ asset(Auth::user()->images) }}" class="icon-20 maru">
                </div>
            </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p class="p-top20">{{Auth::user()->username}}さんの</p>
                <div class="p-top20">
                    <p>フォロー数　　{{ Auth::user()->follows()->count() }}名</p>
                </div>
                <p class="btn-l"><a href="/follow-list" class="a-w">フォローリスト</a></p>
                <div class="p-top20">
                    <p>フォロワー数　{{ Auth::user()->followers()->count() }}名</p>
                </div>
                <p class="btn-l"><a href="/follower-list" class="a-w">フォロワーリスト</a></p>
            </div>
            <p class="btn-s"><a href="/search" class="a-w">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="/resources/assets/js/script.js"></script> -->
</body>

</html>
