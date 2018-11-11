
# プロジェクト作成メモ

ossnoteの名前の由来は下記などなどです。
- online simple smart note
- open source software note
- open simple shared note

## 必要モジュールのインストールまたはアップグレード

今回、PHPはMacのデフォルトを使用、後はbrewで導入

パスの更新はターミナルの再起動が必要

```sh
# SQLite3
brew install sqlite
brew info sqlite  # 3.25.2
sqlite3 --version # 3.22.0 Mac内蔵が使われる
brew link sqlite3 --force # リンクを強制

# 警告メッセージの通り、zshのパスに入れる
echo 'export PATH="/usr/local/opt/sqlite/bin:$PATH"' >> ~/.zshrc
sqlite3 --version # 3.25.2

# uninstall npm
sudo npm uninstall -g npm

# yarn
brew install yarn
yarn -version # 1.10.1

# vue
yarn global add vue-cli
yarn global list vue-cli # 2.9.6
vue -V # 2.9.6

# composer
brew install composer
composer -V # 1.7.2

# php
php -v # 7.1.19
brew install php
php -v # 7.2.11 

# doctor
brew doctor # 警告を修正する
```

## プロジェクト作成＆関連モジュールのインストール

### プロジェクトを作成

- [クイックスタート](https://readouble.com/laravel/4.2/ja/quick.html)
- [Installation](https://laravel.com/docs/master/installation)
- [Configuration](https://laravel.com/docs/master/configuration)

```sh
composer global require laravel/installer # $HOME/.composer/vendor/binにインストール、.zshrcでPATHに追加
```

プロジェクトを作成する

```sh
laravel new ossnote
mv ossnote backend
cd backend
```

組み込みサーバを起動する

```sh
php artisan serve
php artisan serve --port=8080
```

### プロジェクトを初期設定

アプリケーションキーをランダムな文字列に設定する

```sh
php artisan key:generate
```

### Databaseを作成

DBを作成（テーブル作らないとDBが作られない。）

```sh
sqlite3 database/main.sqlite3 # DB作成＆接続する
sqlite> create table dummy(id integer, name text); # Table作成
sqlite> drop table dummy; # Table削除
sqlite> .exit
```

`backend/config/database.php`のデフォルトをSQLiteに修正し、main.sqliteに修正する

`backend/.env`の`DB_CONNECTION`と`DB_DATABASE`を`sqlite`と`main.sqlite3`に修正する（無くても、database.phpのデフォルトが優先）

マイグレーションファイルを作成、マイグレーションを実行

https://readouble.com/laravel/5.5/ja/migrations.html#creating-columns

マイグレーションファイルは既存のを流用した

```sh
php artisan make:migration create_users_table
php artisan migrate
```

モデルを作成する（app/User.phpに作られる）

```sh
php artisan make:model Models/User
```

初期データを登録するSeederを作成し、実行する

```sh
php artisan make:seeder UsersTableSeeder # 作成
php artisan db:seed --class=UsersTableSeeder # 実行
sqlite3 database/main.sqlite3
sqlite> select * from users; # 確認
1|kght6123|admin@kght6123.work||$2y$10$8/NOrDi2jrnG7pdipw8ssu8aMJqcXskClq5neKEe6ZqkyE6kPU58i||||2018-11-11 08:09:50|2018-11-11 08:09:50
```


### Google API Clientのインストール

`credentials.json`も置いた

```sh
composer require google/apiclient
```


### vue.js のプロジェクトを作成

```sh
yarn install
yarn run hot # run Build-in server (package.jsonに設定あり) http://localhost:8080/

yarn add vue-router
yarn add vuex vuex-router-sync

yarn add axios
yarn add tui-editor

yarn add jquery popper.js bootstrap
yarn add bootstrap-honoka

yarn run build

yarn run build && yarn run dev
```

`webpack.config.js`のpublicPathは`./dist/`に変更し、

index.htmlの`build.js`のパスも、`./dist/build.js`に変更します。

### backend 接続先の切り替え

webpack.EnvironmentPluginで切り替える

webpack.config.js の plugins に new webpack.EnvironmentPlugin を追加する。
指定がなかった時のために、デフォルト値を設定しておく。

package.json の scripts に、dev、build毎に変数を明示できる。


## ビルドインサーバ起動

composer.jsonのserveに、公式チュートリアルの`bin/app.php`を追記して

ドキュメントルートをpublicフォルダにしつつ、`bin/app.php`を起動する

公式その２ならば、ドキュメントルートの指定は不要な気がする。（Webと使い分けるために`public/index.php`を使う方が良い？）

```sh
# phpコマンドで起動
$ php -S 127.0.0.1:8080 bin/app.php # 公式JSON
$ php -dzend_extension=xdebug.so -S 127.0.0.1:8080 -t public bin/app.php # composer.jsonのデフォルト方式＋公式JSON
$ php -S 127.0.0.1:8080 public/index.php # 公式HTML(Twig)
```

```sh
# composerで起動(composer.jsonに設定)
$ composer serve # JSONサービス bin/app.php
$ composer webserve # Webサービス public/index.php
```

`bin/app.php`に、`*.php`ファイルの時に、Bear.Sundayを使わない様に追記

http://php.net/manual/ja/features.commandline.webserver.php

https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&client_id=762229899901-sl2amoosu9fnjtmphcqr97sugl8lu6iq.apps.googleusercontent.com&redirect_uri=localhost%3A18080%3A18080%2Fapi%2Fgoogle%2Flogin.php%3Fuserid%3Dkoga%26password%3Dkoga&state&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Ftasks&prompt=select_account%20consent

## テストロジック実行

composer.jsonのcoverageのphpunitのパスを`./vendor/bin/phpunit`に修正して

テストのカバレッジをテキストで取得して、HTMLで残す

```sh
$ ./vendor/bin/phpunit # 公式
$ php -dzend_extension=xdebug.so ./vendor/bin/phpunit --coverage-text --coverage-html=build/coverage # テスト実行 カバレッジをテキストで取得しHTMLで残す
$ composer cs # コーディング規約チェック
$ composer cs-fix # コーディング規約チェック＋自動修正
$ composer tests # コミット前向け phpunit＋phpcs＋phpmd＋phpstan
$ composer run test # phpunitだけ
```

## インストール

frontendは、`yarn run build`を実行し、index.htmlとdist配下をリリース先へコピーする。node_modulesとsrcは不要。

backendは、`composer run compile`を念の為に実行して、まるっとPHP対応のWebサーバに置く

## VueをHashモードからHistoryモードへ変更するか？

古いブラウザやHTTPサーバの設定変更無しで対応できるHashモードから、

HTML5のHistoryモードに変更するか？？？

Vue Router HTML5 History モード
https://router.vuejs.org/ja/guide/essentials/history-mode.html

Can I use history ?
https://caniuse.com/#search=history

HashモードはこんなURL「`http://localhost:8080/#/A`」

HistoryモードはこんなURL「`http://localhost:8080/A`」（IE11も対応）

上記のURLで、Hashモードは「Root」ページ内の「`#/A`」へ移動となり、ページ全体が更新されない（SPA）

Historyモードは「`/A`」のリンクへ移動となるが、HTML5 History モードでSPAを実現している。

ただし、HistoryモードはHTTPサーバの設定変更が必要（404エラーの場合、`index.html`に移動する）

## PHPの入力補完の設定（VSCode）

拡張機能の「PHP IntelliSense」を使う

settings.jsonに下記を追記

* PHPはbrewのパスを利用
* 組み込みPHPの検証を無効化
* PHPの検証の実行はキー押下時に変更（デフォルトは`onSave`）

```json
{
	"php.suggest.basic": false,
	"php.validate.executablePath": "/usr/local/bin/php",
	"php.validate.run": "onType",
}
```

composer.jsonに下記を追記

```json
{
    "minimum-stability": "dev",
    "prefer-stable": true,
}
```

`language-server`をインストールする

```sh
composer update # bear/resourceを1.11.4にアップデート
composer require felixfbecker/language-server
```

デフォルトで下の方にある出力タブを選択し、右側のセレクトボックスで「PHP Language Server」を選ぶと、PHPファイルのパースとキャッシュの進捗状況が見える。

下記のようなメッセージが出力されれば、完了。

```log
[Info  - 9:49:35 PM] All 15159 PHP files parsed in 130 seconds. 1032 MiB allocated.
```

Macの場合はキーバインドを変更する

基本設定のキーボードショートカットを開く、editor.action.triggerSuggestとtoggleSuggestionDetails、toggleSuggestionFocusのキーバインドを変更

順に、`Cmd+1`,`Cmd+2`, `Cmd+3`にした。（既存のマッピングは無念にも削除）
