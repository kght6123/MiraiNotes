<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,maximum-scale=1.0,minimum-scale=0.5,user-scalable=yes,initial-scale=1.0,shrink-to-fit=no">
  <meta name="description" content="Mirai Note Homepage.">
  <meta name="author" content="kght6123">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- API Token -->
  @if (auth()->check())
  <meta name="api-token" content="{{ auth()->user()->api_token }}">
  @endif

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <!--link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet" type="text/css"-->

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target=".floating-2" data-offset="60" class="mw-100 w-100 mhv-100 hv-100 of-hidden">
  <div  class="sidebar-material-ctrl">
    <button type="button" class="btn btn-secondary shadow text-center align-middle m-0 p-0">
      <i class="oi oi-fullscreen-enter"></i>
      <i class="oi oi-fullscreen-exit"></i>
    </button>
  </div>
  <div  class="sidebar-window-ctrl">
    <button type="button" class="btn text-center align-middle m-0 p-0 text-light bg-transparent">
      <i class="oi oi-fullscreen-enter text-dark"></i>
      <i class="oi oi-fullscreen-exit"></i>
    </button>
  </div>
  <div class="sidebar-wrapper">
    <!-- Sidebar1  -->
    <nav class="sidebar bg-secondary simple always">
      <div class="sticky-top">
        <!--div class="sidebar-header text-light">
          <h3>ダブルサイドバー</h3>
          <img src="../image/illustrain10-doubutu20.png" />
        </div-->
        <ul class="list-unstyled mt-5">
          <li>
            <a href="#" class="text-light" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="oi oi-person"></i>
              ログイン
            </a>
          </li>
          <li>
            <a href="#" class="text-light active">
              <i class="oi oi-home"></i>
              ホーム
            </a>
          </li>
          <!--
          <li>
            <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="text-light dropdown-toggle">
              <i class="oi oi-list-rich"></i>
              分類１
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu1" data-parent=".sidebar">
              <li>
                <div class="btn-group dropright w-100">
                  <a href="#" class="text-light dropdown-toggle w-100" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-flip="false" data-offset="-21,-2">
                    小分類 1
                  </a>
                  <ul class="dropdown-menu bg-primary">
                    <li><a href="#" class="text-light">
                      <i class="oi oi-header"></i>
                      ページ 1
                    </a></li>
                    <li><a href="#" class="text-light">
                      <i class="oi oi-header"></i>
                      ページ 2
                    </a></li>
                    <li><a href="#" class="text-light">
                      <i class="oi oi-header"></i>
                      ページ 3
                    </a></li>
                    <li class="divider"></li>
                    <li><a href="#" class="text-light">
                      <i class="oi oi-header"></i>
                      ページ 9
                    </a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#" class="text-light">
                  小分類 2
                </a>
              </li>
              <li>
                <a href="#" class="text-light">
                  小分類 3
                </a>
              </li>
            </ul>
          </li>
          -->
          <li>
            <a href="#" class="text-light sidebar-toggle reverse active" data-target="#filetree">
              <i class="oi oi-list"></i>
              ツリー
            </a>
          </li>
          <li>
            <a href="#" class="text-light sidebar-toggle" data-target="#headline">
              <i class="oi oi-list"></i>
              目次
            </a>
          </li>
          <li>
            <a href="#" class="text-light sidebar-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="oi oi-question-mark"></i>
              問合せ
            </a>
            <!-- ドロップメニューの設定 -->
            <div class="dropdown-menu bg-dark text-light" style="min-width: 20em;">
              <form class="px-4 py-3">
                <div class="form-group">
                  <label for="exampleDropdownFormEmail1">タイトル</label>
                  <input type="text" class="form-control bg-dark text-light" placeholder="～について">
                </div>
                <div class="form-group">
                  <label for="exampleDropdownFormPassword1">本文</label>
                  <textarea class="form-control bg-dark text-light" rows="5" placeholder="お問合せ内容の詳細を入力してください。"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">送信</button>
              </form>
            </div><!-- /.dropdown-menu -->
          </li>
        </ul>
      </div>
    </nav>
    <!-- Sidebar3  -->
    <nav class="sidebar bg-dark" id="filetree">
      <div class="sticky-top of-y-auto mhv-100 hv-100">
        <ul class="list-unstyled list-tree">
          <li>
            <div class="btn-group dropdown w-100">
              <a href="#fileTree1" class="text-light dropdown-toggle dropdown-toggle-split open"
                role="button" data-toggle="collapse" aria-expanded="false"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-folder"></i>
                Dir
              </a>
            </div>
            <ul class="collapse list-unstyled" id="fileTree1" data-parent=".sidebar">
              <li>
                <div class="btn-group dropdown w-100">
                  <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                  <a href="#" class="nav-link text-light w-100">
                    <i class="oi oi-file"></i>
                    File.md
                  </a>
                </div>
              </li>
              <li>
                <div class="btn-group dropdown w-100">
                  <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                  <a href="#" class="nav-link text-light w-100">
                    <i class="oi oi-file"></i>
                    File.md
                  </a>
                </div>
              </li>
              <li>
                <div class="btn-group dropdown w-100">
                    <a href="#fileTree2" class="text-light dropdown-toggle dropdown-toggle-split open"
                      role="button" data-toggle="collapse" aria-expanded="false"></a>
                    <a href="#" class="nav-link text-light w-100">
                      <i class="oi oi-folder"></i>
                      Dir
                    </a>
                </div>
                <ul class="collapse list-unstyled" id="fileTree2" data-parent=".sidebar">
                  <li>
                    <div class="btn-group dropdown w-100">
                      <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                      <a href="#" class="nav-link text-light w-100">
                        <i class="oi oi-file"></i>
                        File.md
                      </a>
                    </div>
                  </li>
                  <li>
                    <div class="btn-group dropdown w-100">
                      <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                      <a href="#" class="nav-link text-light w-100">
                        <i class="oi oi-file"></i>
                        File.md
                      </a>
                    </div>
                  </li>
                  <li>
                    <div class="btn-group dropdown w-100">
                        <a href="#fileTree3" class="text-light dropdown-toggle dropdown-toggle-split open"
                          role="button" data-toggle="collapse" aria-expanded="false"></a>
                        <a href="#" class="nav-link text-light w-100">
                          <i class="oi oi-folder"></i>
                          Dir
                        </a>
                    </div>
                    <ul class="collapse list-unstyled" id="fileTree3" data-parent=".sidebar">
                      <li>
                        <div class="btn-group dropdown w-100">
                          <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                          <a href="#" class="nav-link text-light w-100">
                            <i class="oi oi-file"></i>
                            File.md
                          </a>
                        </div>
                      </li>
                      <li>
                        <div class="btn-group dropdown w-100">
                          <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                          <a href="#" class="nav-link text-light w-100">
                            <i class="oi oi-file"></i>
                            File.md
                          </a>
                        </div>
                      </li>
                      <li>
                        <div class="btn-group dropdown w-100">
                          <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                          <a href="#" class="nav-link text-light w-100">
                            <i class="oi oi-file"></i>
                            File.md
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li>
                <div class="btn-group dropdown w-100">
                  <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                  <a href="#" class="nav-link text-light w-100">
                    <i class="oi oi-file"></i>
                    File.md
                  </a>
                </div>
              </li>
              <li>
                <div class="btn-group dropdown w-100">
                  <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
                  <a href="#" class="nav-link text-light w-100">
                    <i class="oi oi-file"></i>
                    File.md
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
          <li>
            <div class="btn-group dropdown w-100">
              <a class="text-light dropdown-toggle dropdown-toggle-split file"></a>
              <a href="#" class="nav-link text-light w-100">
                <i class="oi oi-file"></i>
                File.md
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Sidebar2  -->
    <nav class="sidebar bg-dark none-toggle of-y-auto" id="headline">
      <div class="sticky-top of-y-auto mhv-100 hv-100">
        <ul class="list-unstyled">
          <li>
            <div class="btn-group dropdown w-100">
              <a href="#header1" class="nav-link text-light w-100">
                <i class="oi oi-header"></i>
                機能一覧
              </a>
              <a href="#pageSubmenu4" class="text-light dropdown-toggle dropdown-toggle-split open"
                role="button" data-toggle="collapse" aria-expanded="false"></a>
            </div>
            <ul class="collapse list-unstyled" id="pageSubmenu4" data-parent=".sidebar">
              <li><a href="#header1-1" class="nav-link text-light">
                <i class="oi oi-header"></i>
                積層サイドバー
              </a></li>
              <li><a href="#header1-2" class="nav-link text-light">
                <i class="oi oi-header"></i>
                簡略表示
              </a></li>
              <li><a href="#header1-3" class="nav-link text-light">
                <i class="oi oi-header"></i>
                常に表示
              </a></li>
              <li><a href="#header1-4" class="nav-link text-light">
                <i class="oi oi-header"></i>
                サブメニュー
              </a></li>
              <li>
                <div class="btn-group dropright w-100">
                  <a href="#header1-5" class="nav-link text-light w-100">
                    <i class="oi oi-header"></i>
                    表示切り替え
                  </a>
                  <a href="#" class="text-light dropdown-toggle dropdown-toggle-split"
                    role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" data-flip="false" data-offset="-21,-2"></a>
                  <ul class="dropdown-menu bg-dark" data-parent=".sidebar">
                    <li><a href="#header1-5-1" class="nav-link text-light">
                      <i class="oi oi-header"></i>
                      xs以上
                    </a></li>
                    <li><a href="#header1-5-2" class="nav-link text-light">
                      <i class="oi oi-header"></i>
                      xs未満
                    </a></li>
                  </ul>
                </div>
              </li>
              <li><a href="#header1-6" class="nav-link text-light">
                <i class="oi oi-header"></i>
                表示切り替え（xs以下）
              </a></li>
              <li><a href="#header1-7" class="nav-link text-light">
                <i class="oi oi-header"></i>
                パンくずリストは上部に固定
              </a></li>
            </ul>
          </li>
          <li>
            <a href="#header2" class="nav-link text-light">
              <i class="oi oi-header"></i>
              開発方針
            </a>
          </li>
          <li>
            <a href="#header3" class="nav-link text-light">
              <i class="oi oi-header"></i>
              ライブラリ
            </a>
          </li>
          <li>
            <a href="#header4" class="nav-link text-light">
              <i class="oi oi-header"></i>
              推奨環境
            </a>
          </li>
          <li>
            <a href="#header5" class="nav-link text-light">
              <i class="oi oi-header"></i>
              開発環境
            </a>
          </li>
          <li>
            <a href="#header6" class="nav-link text-light">
              <i class="oi oi-header"></i>
              今後の予定
            </a>
          </li>
          <li>
            <a href="#header7" class="nav-link text-light">
              <i class="oi oi-header"></i>
              連絡先
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Sidebar Button
    <div class="sidebar-ctrl">
      <div class="sidebar-btn sticky-top"></div>
    </div> -->
    <!-- Page Content  -->
    <main class="sidebar-content of-hidden mhv-100 hv-100 mw-100 m-0 p-0">
      <!-- Topに使うか？
        <div class="jumbotron-fluid bg-light mt-4">
          <h1 class="display-4">Title</h1>
          <p class="lead">simple explanation.</p>
          <hr class="my-4">
          <p>detail explanation.</p>
          <a class="btn btn-primary btn-lg" href="#" role="button">button</a>
        </div>
      -->
      <!-- デフォルトだと#appはvue.jsが有効 -->
      <div id="app" style="display: none;">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
          <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Left Side Of Navbar -->
              <ul class="navbar-nav mr-auto">
                  
              </ul>
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
                <!-- Top Links -->
                @if (Route::has('login'))
                    @auth
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('/home') }}">{{ __('Home') }}</a>
                      </li>
                    @else
                      <li class="nav-item">
                          <a class="nav-link" href="{{ url('/') }}">{{ __('Welcome') }}</a>
                      </li>
                    @endauth
                @endif
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                      @if (Route::has('register'))
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      @endif
                    </li>
                @else
                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
      </div>
      <div id="editSection" class="m-0 mw-100 mh-100"></div>
      <!--
      <h1>積層サイドバー</h1>
      <nav aria-label="Breadcrumbs" class="sticky-top" style="min-height: 40px;">
        <ol class="breadcrumb bg-light" style="opacity: 0.85;">
          <li class="breadcrumb-item"><a href="#" class="text-dark">分類１</a></li>
          <li class="breadcrumb-item"><a href="#" class="text-dark">小分類１</a></li>
          <li class="breadcrumb-item active" aria-current="page">ページ１</li>
        </ol>
      </nav>
      <p>PCとモバイルの両方で、メニューの拡張性、操作性・視認性の良さを重視しており、<br>
        機能数が多いの業務アプリや、ブログ、Github.ioのマニュアルページなど<br>
        様々な用途に広く使っていただけると考えて作成しました。</p>
      <p>今後、自らのブログやマニュアルページに活用予定であり、気づいた点は改良を加えていく予定です。</p>
      <h2 id="header1">機能一覧</h2>
      <p>簡単に主な機能を説明します。<br>
        少し慣れは必要ですが、モバイルでもPCでも使いやすさを心掛けています。</p>
      <h5 id="header1-1">積層サイドバー</h5>
      <p>左側に固定の積層サイドバーを表示し、どのスクロール位置でも多数のメニュー間の移動や操作が直感的に可能です。<br>
        また、今の位置がページのどの位置なのか分かりやすくしています。</p>
      <p>現在、2本のサイドバーを同時に表示でき、このページの様に1本目にメインメニュー、2本目にページの目次などの使い方が可能です。</p>
      <h5 id="header1-2">簡略表示</h5>
      <p>積層サイドバーは<code>simple</code>クラスを追加すると、アイコンベースの簡略表示になります。（このページの青いサイドバー）</p>
      <h5 id="header1-3">常に表示</h5>
      <p>積層サイドバーは<code>always</code>クラスを追加すると、画面サイズに関わらす常に表示になります。（このページの青いサイドバー）<br>
        alwaysクラスが無い場合、xsサイズ以下の時にサイドバーは非表示になります。</p>
      <h5 id="header1-4">サブメニュー</h5>
      <p>下と右側に展開するサブメニューを組み合わせて、最大２層のメニューを作成できます。<br>
        <code>open</code>クラスを追加すると開いた状態で表示されます。</p>
      <h5 id="header1-5">表示切り替え</h5>
      <p>サイドバーの右側にある空白をクリックまたはマウスオーバーする事で、サイドバーの表示が切り替わります。（このページの黒い目次のサイドバー）<br>
        表示はxs以上と未満で変わります。
        <ol>
          <li><h6 id="header1-5-1">xs以上</h6>
            クリックで、サイドバー全体の表示・非表示を切り替え</li>
          <li><h6 id="header1-5-2">xs未満</h6>
            クリックまたはマウスオーバーでサイドバーが半透明で表示<br>
            （<code>floating-1</code>または<code>floating-2</code>クラスの追加が必要）</li>
        </ol>
      </p>
      <h5 id="header1-6">表示切り替え（xs以下）</h5>
      <p>スマートフォンなど、画面が小さいxs以下でも画面が見やすいように、<br>
        右下のマテリアルボタンで、サイドバーの表示・非表示が切り替えられ、<br>
        メインコンテンツに集中しやすい表示になります。</p>

      <h5 id="header1-7">パンくずリスト</h5>
      <p>上部に固定のパンくずリストを表示し、どのスクロール位置でもページの位置の確認や移動ができます。</p>

      <h2 id="header2">開発方針</h2>
      <p>レスポンシブレイアウトでPCでもモバイルでもメニューの拡張性と操作性、一覧性を重視しました。<br>
        JavaScript(JQuery)の利用は最小限になるように考慮しています。</p>

      <h2 id="header3">ライブラリ</h2>
      <p>利用しているライブラリです。
        <ol>
          <li>「Bootstrap4」<br>
            基本的なデザインやレイアウトに使っています。<br>
            積層サイドバーはBootstrap4のナビゲーションバーを拡張したイメージです。</li>
          <li><a href="http://honokak.osaka/" target="_blank">「honoka」</a><br>
            日本語を多く使うことを考えているので使っています。<br>
            無くても大きな問題は無いと思います。</li>
          <li><a href="https://useiconic.com/open/" target="_blank">「Open Iconic」</a><br>
            アイコン類を自分で作る時間が無かったので使いました。<br>
            色々なアイコンがひと通り揃っているので、かなり重宝します。
          </li>
        </ol>
      </p>


      <h2 id="header4">推奨環境</h2>
      <p>Edge、Safari、Chromeで動きます。<br>
        IE11は一部の機能が制限されますが動きます。</p>
      <p>みんなでIEの互換モードを撲滅しましょう、、、障害が多すぎる。</p>


      <h2 id="header5">開発環境</h2>
      <p>主に「VSCode」と「Brackets」を利用しています。<br>
        メインのブラウザは「Safari」です。</p>
      <p>「VSCode」では「Live Serverプラグイン」を利用して、画面表示を確認しています。</p>


      <h2 id="header6">今後の予定</h2>
      <p>CSS・JSの外部化、「webpack」によるテンプレート化と、<br>
        レイアウトや機能の追加、微調整などを行なっていく予定です。</p>
      <p>また、Prettifyを使って、コードを綺麗に表示したいと思ってます。</p>

      <p>
        <h3>Prettifyの対応サンプル</h3>
        <p><code>hl:行番号</code>のクラスを追加すると、その行がハイライトされます。</p>
        <p>また、コードをクリックすると、クリップボードにコードがコピーされます。</p>
        <pre class="prettyprint lang-js linenums:4 hl:7 hl:5">// Hellow world!! <span class="nocode">This is not code</span>
console.log("Hellow world!!");
console.log("Hellow world!!");
console.log("Hellow world!!");
console.log("Hellow world!!");
console.log("Hellow world!!");</pre>

        <p>Prettifyはインラインでのコード表記（<code class="prettyprint lang-js">console.log("Hellow world!!");</code>）も対応できます。</p>

      </p>
      <h2 id="header7">連絡先</h2>
      <p>公開内容などなどについて、お気軽にお声かけください。
          <ul>
              <li><a href="https://twitter.com/kght6123" target="_blank">Twitter</a></li>
              <li><a href="https://kght6123.work/" target="_blank">ブログ</a></li>
          </ul>
      </p>
      -->
    </main>
    <nav class="sidebar bg-light simple always mini">
      <div class="sticky-top">
        <ul class="list-unstyled">
          <li>
            <a href="#" class="text-dark active">
              <i class="oi oi-heart"></i>
              Love
            </a>
          </li>
          <li>
            <a href="#" class="text-dark">
              <i class="oi oi-bold"></i>
              Bold
            </a>
          </li>
          <li>
            <a href="#" class="text-dark">
              <i class="oi oi-italic"></i>
              Italic
            </a>
          </li>
          <li>
            <a href="#" class="text-dark">
              <i class="oi oi-check"></i>
              Check
            </a>
          </li>
          <li>
            <a href="#" class="text-dark">
              <i class="oi oi-code"></i>
              Code
            </a>
          </li>
          <li>
            <a href="#" class="text-dark">
              <i class="oi oi-grid-three-up"></i>
              Grid
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- Modal Login Floating Form -->
  <form>
    <div tabindex="-1" class="modal fade" id="exampleModalCenter" role="dialog" aria-hidden="true" aria-labelledby="exampleModalCenterTitle" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-light shadow-lg">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalCenterTitle">ログイン</h4>
            <button class="close" aria-label="Close" type="button" data-dismiss="modal">
              <span class="text-light" aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control form-control-lg bg-dark text-light is-invalid" id="email" aria-describedby="email-help" placeholder="メールアドレス" required>
              <div class="invalid-feedback">登録したメールアドレスまたはユーザ名を入力してください。</div>
            </div>
            <div class="form-group">
              <label for="password">パスワード</label>
              <input type="password" class="form-control form-control-lg bg-dark text-light is-invalid" id="password" placeholder="パスワード" aria-describedby="password-help" required>
              <div class="invalid-feedback">パスワード又はメールアドレスが誤っています。</div>
              <div id="password-help" class="form-text text-muted"><a href="#">パスワードを忘れた？？</a></div>
            </div>
            <div class="form-check custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save">
              <label class="custom-control-label" for="save">ログイン情報を保持</label>
            </div>
            <div class="form-check custom-control custom-checkbox"><!-- custom-control-inline -->
              <input type="checkbox" class="custom-control-input is-invalid" id="regist">
              <label class="custom-control-label" for="regist">新規登録</label>
              <span class="invalid-tooltip">既に登録されています。</span>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">閉じる</button>
            <button class="btn btn-primary" type="submit">ログイン</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
