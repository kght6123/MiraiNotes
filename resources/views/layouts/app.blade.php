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
      <nav class="sidebar bg-secondary simple always">
        <div class="sticky-top">
          <ul class="list-unstyled mt-5">
            <li>
              <a id="link-login" href="#" class="text-light" data-toggle="modal" data-target="#login-modal">
                <i class="oi oi-person"></i><i class="mdi mdi-tr mdi-close-circle text-danger font-weight-bold"></i>
                ログイン
              </a>
            </li>
            <li>
              <a id="link-login-google" href="#" class="text-light d-none" data-toggle="modal" data-target="#auth-modal">
                <i class="mdi mdi-google"></i><i class="mdi mdi-tr mdi-close-circle text-danger font-weight-bold"></i>
                Google
              </a>
            </li>
            <li>
              <a href="{{ url('/') }}" class="text-light active">
                <i class="oi oi-home"></i>
                ホーム
              </a>
            </li>
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
    <div tabindex="-1" class="modal fade" id="login-modal" role="dialog" aria-hidden="true" aria-labelledby="login-title" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-light shadow-lg">
          <div class="modal-header p-2 pl-3">
            <h4 class="modal-title" id="login-title">ログイン</h4>
            <button class="close" aria-label="Close" type="button" data-dismiss="modal" style="margin-top: -0.55em; margin-right: -0.25em;">
              <span class="text-light" aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2" v-bind:class="{ 'd-none': !regist }"><!-- registがfalseの時は、d-none(非表示) -->
              <label for="name">名前</label>
              <input type="text" class="form-control form-control-lg bg-dark text-light" id="name" name="name" placeholder="名前" v-model="name" v-bind:class="{ 'is-invalid': errors.has('name') }" v-validate="'required'" required>
              <div class="invalid-feedback" v-if="errors.has('name')">名前を入力してください。</div>
            </div>
            <div class="form-group mb-2">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control form-control-lg bg-dark text-light" id="email" name="email" placeholder="メールアドレス" aria-describedby="email-help" v-model="email" v-bind:class="{ 'is-invalid': errors.has('email') }" v-validate="'required|email'" required>
              <div class="invalid-feedback" v-if="errors.has('email')">登録したメールアドレスを入力してください。</div>
            </div>
            <div class="form-group mb-2">
              <label for="password">パスワード</label>
              <input type="password" class="form-control form-control-lg bg-dark text-light mb-1" id="password" name="password" placeholder="パスワード" aria-describedby="password-help" v-model="password" v-bind:class="{ 'is-invalid': errors.has('password') || errors.has('unmatch') }" v-validate="'required|min:8'" ref="password" required>
              <input type="password" class="form-control form-control-lg bg-dark text-light" id="password_confirmation" name="password_confirmation" placeholder="パスワードを再度、入力してください" aria-describedby="password-help" v-model="password_confirmation" v-bind:class="{ 'is-invalid': errors.has('password_confirmation') || errors.has('unmatch'), 'd-none': !regist }" v-validate="'required|min:8|confirmed:password'" data-vv-as="password" required><!-- registがfalseの時は、d-none(非表示) -->
              <div class="invalid-feedback" v-if="errors.has('password_confirmation') && regist">パスワードが一致しません。</div>
              <div class="invalid-feedback" v-if="errors.has('unmatch')">パスワード又はメールアドレスが誤っています。</div>
              <div class="invalid-feedback" v-if="errors.has('password')">パスワードは8文字以上で入力してください。</div>
              <div id="password-help" class="form-text text-muted" v-bind:class="{ 'd-none': regist }"><a href="#">パスワードを忘れた？？</a></div>
            </div>
            <div class="form-check custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save" v-model="save">
              <label class="custom-control-label" for="save">ログイン情報を保持</label>
            </div>
            <div class="form-check custom-control custom-checkbox"><!-- custom-control-inline -->
              <input type="checkbox" class="custom-control-input dropdown-toggle" id="regist" v-model="regist" v-bind:class="{ 'is-invalid': errors.has('unregist') }" role="button" data-toggle="collapse" aria-expanded="false">
              <label class="custom-control-label" for="regist">新規登録</label>
              <span class="invalid-tooltip">登録できませんでした、既に登録されている可能性があります。</span>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">閉じる</button>
            <button class="form-control btn btn-primary" type="button" v-on:click="login" v-bind:class="{ 'is-invalid': errors.has('notification') || errors.has('regist_error') }">ログイン</button>
            <span class="invalid-tooltip" v-show="errors.has('notification')">入力エラーがあります。</span>
            <span class="invalid-tooltip" v-show="errors.has('regist_error')">@{{ errors.first('regist_error') }}</span>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Modal Auth Floating Form -->
  <form id="auth">
    <div tabindex="-1" class="modal fade" id="auth-modal" role="dialog" aria-hidden="true" aria-labelledby="auth-title" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-light shadow-lg">
          <div class="modal-header p-2 pl-3">
            <h4 class="modal-title" id="auth-title">Google認証</h4>
            <button class="close" aria-label="Close" type="button" data-dismiss="modal" style="margin-top: -0.55em; margin-right: -0.25em;">
              <span class="text-light" aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-2">
              <label for="code">認証コード</label>
              <input type="text" class="form-control form-control-lg bg-dark text-light" id="code" name="code" placeholder="Google認証コードを入力してください。"  v-model="code" v-bind:class="{ 'is-invalid': errors.has('code') }" v-validate="'required'" required>
              <div class="invalid-feedback" v-if="errors.has('code')">Google認証後に表示される認証コードを入力してください。</div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">閉じる</button>
            <button class="form-control btn btn-primary" type="button" v-if="code" v-on:click="auth" v-bind:class="{ 'is-invalid': errors.has('code') }">認証コード入力</button>
            <button class="form-control btn btn-primary" type="button" v-if="!code" v-on:click="open">認証画面を開く</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <input type="hidden" id="delegate-markdown" />
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
