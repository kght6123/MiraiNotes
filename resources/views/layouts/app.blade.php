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
<body data-spy="scroll" data-target=".floating-2" data-offset="60" class="of-hidden">
  <div class="sidebar-modal d-none">
    <div class="mwv-75 mhv-75 wv-75 hv-75">
      <div class="text-right"><i class="close mdi mdi-close text-light"></i></div>
      <iframe class="border-0 mw-100 w-100 mh-100 h-100 shadow-lg"></iframe>
    </div>
  </div>
  <!--div id="presentation" class="sidebar-modal" v-bind:class="{ 'd-none': dnone }">
    <div class="mwv-75 mhv-75 wv-75 hv-75">
      <div class="text-right"><i class="close mdi mdi-close text-light" v-on:click="dnone = true"></i></div>
      <div class="border-0 mw-100 w-100 mh-100 h-100 shadow-lg">
        <keep-alive>
          <md-presentation v-bind:title="title"></md-presentation>
        </keep-alive>
      </div>
    </div>
  </div-->
  <div class="sidebar-material-ctrl">
    <button type="button" class="btn btn-secondary shadow text-center align-middle m-0 p-0">
      <i class="oi oi-fullscreen-enter"></i>
      <i class="oi oi-fullscreen-exit"></i>
    </button>
  </div>
  <div class="sidebar-window-ctrl">
    <button type="button" class="btn text-center align-middle m-0 p-0 text-light bg-transparent">
      <i class="oi oi-fullscreen-enter text-dark"></i>
      <i class="oi oi-fullscreen-exit"></i>
    </button>
  </div>
  <div class="mw-100 w-100 mhv-100 hv-100 of-hidden d-flex flex-column">
    <div class="sidebar-wrapper">
      <!-- Sidebar1  -->
      <nav class="sidebar bg-secondary simple always" id="menu">
        <mirai-menu v-bind:user="user"></mirai-menu>
      </nav>
      <!-- Sidebar3  -->
      <nav class="sidebar bg-dark floating-2" id="filetree">
        <div class="sticky-top of-y-auto mhp-100 hp-100">
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
      <nav class="sidebar bg-dark none-toggle of-y-auto floating-2" id="headline">
        <div class="sticky-top of-y-auto mhp-100 hp-100">
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
      <!-- Page Content  -->
      <main class="sidebar-content of-hidden mhv-100 hv-100 mw-100 m-0 p-0">
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
        <div id="edit-section" class="m-0 mw-100" style="max-height: calc(100% - 16px);"></div>
      </main>
      <nav class="sidebar bg-light simple always mini">
        <div class="sticky-top">
          <ul class="list-unstyled">
            <li>
              <a class="text-dark" id="link-slide-mode" data-url="revealjs/revealjs.html">
                <i class="mdi mdi-presentation"></i>
                Slide Mode
              </a>
            </li>
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
    <div class="sidebar-fotter bg-info mw-100 w-100 d-flex flex-row justify-content-between">
      <div class="flex-shrink-0 text-left pl-2 text-light">{{ __('Welcome!!!') }}</div>
      <div class="flex-shrink-1 text-center pr-1 pl-1 text-light"></div>
      <div class="flex-shrink-0 text-right pr-2 text-light">{{ config('app.name', 'Laravel') }}&nbsp;{{ config('app.version', '1.0') }}</div>
    </div>
  </div>
  <!-- Modal Login Floating Form -->
  <form id="login">
    <mirai-login v-bind:user="user"></mirai-login>
  </form>
  <!-- Modal Auth Floating Form -->
  <form id="auth">
    <mirai-drive-auth v-bind:user="user" v-bind:auth-url="authUrl" v-bind:gtoken="gtoken"></mirai-drive-auth>
  </form>
  <input type="hidden" id="delegate-markdown" />
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
