<template>
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
          <button class="form-control btn btn-primary" type="button" v-on:click="login" v-bind:class="{ 'is-invalid': errors.has('notification') || errors.has('regist_error'), 'd-none': user }">ログイン</button>
          <button class="btn btn-secondary" type="button" v-on:click="unregist" v-bind:class="{ 'd-none': !user }">ユーザ消去</button>
          <button class="form-control btn btn-primary" type="button" v-on:click="logout" v-bind:class="{ 'd-none': !user }">ログアウト</button>
          <span class="invalid-tooltip" v-show="errors.has('notification')">入力エラーがあります。</span>
          <span class="invalid-tooltip" v-show="errors.has('regist_error')">@{{ errors.first('regist_error') }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import js-cookie
import Cookies from 'js-cookie';
import { out_console } from '../axios/axios-errors';

export default {
  created() {
    // メッセージを日本語に設定する
    this.$validator.localize('ja');

    // Cookieに保存されていた情報を取得する
    this.email = Cookies.get("email");
    this.password = Cookies.get("password");
  },
  data: function() {
    return {
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      save: true,
      regist: false
    };
  },
  watch: {
    regist: function(_new, _old) {
      if (_new) {
        // 新規登録のとき

      }
    }
  },
  methods: {
    saveCookie: function() {
      if($('#save').is(':checked')) {
        // FIXME かり処理
        Cookies.set('email', this.email, { path: '/', expires: 365 });
        Cookies.set('password', this.password, { path: '/', expires: 365 });
      }
    },
    login: function() {
      // alert("email="+this.email+",password="+this.password+",save="+this.save+",regist="+this.regist);
      
      // バリデーションする
      this.$validator.errors.remove('notification');
      this.$validator.errors.remove('unmatch');
      this.$validator.errors.remove('unregist');

      this.$validator.validateAll().then((result) => {
        if ( this.regist && !result ) {
          // 新規登録で入力エラー
          this.$validator.errors.add({field: 'notification', msg: 'msg'});
          return false;
        } else if ( !this.regist && (this.$validator.errors.has('email') || this.$validator.errors.has('password')) ) {
          // ログインで入力エラー
          this.$validator.errors.add({field: 'notification', msg: 'msg'});
          return false;
        }
      });

      if (this.regist) {
        // ユーザ登録する
        axios.post('/api/register', { name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
          .then(function(response) {
            // alert(JSON.stringify(response.data));
            if(response.data.register) {
              $('#login-modal').modal('hide');
              this.$store.dispatch('setUser', response.data.user);
              this.saveCookie();
            } else {
              this.$validator.errors.add({field: 'unregist', msg: 'msg'});
            }
          }.bind(this))// thisを使う
          .catch(function(error) {
            out_console(error, 'user, register');

            // errorを展開する alert(error.response.data.errors.email[0]);
            Object.keys(error.response.data.errors).forEach(function(errorObjKey){
              error.response.data.errors[errorObjKey].forEach(function(errorObj, index, ar){
                this.$validator.errors.add({field: 'regist_error', msg: errorObj});
              }, this);
            }, this);
          }.bind(this));// thisを使う
      } else {
        // ユーザ認証する
        axios.post('/api/login', { email: this.email, password: this.password })
          .then(function(response) {
            //alert(JSON.stringify(response.data));
            if(response.data.auth) {
              $('#login-modal').modal('hide');
              this.$store.dispatch('setUser', response.data.user);
              this.$store.dispatch('setMarkdown', response.data.user.markdown);
              this.saveCookie();
            } else {
              this.$validator.errors.add({field: 'unmatch', msg: 'msg'});
            }
          }.bind(this))// thisを使う
          .catch(function(error) {
            out_console(error, 'user, login');
          }.bind(this));// thisを使う
      }
    },
    logout: function() {
      axios.post('/api/logout')
        .then(function(response) {
          //alert(JSON.stringify(response.data));
          if(response.data.check) {
            $('#login-modal').modal('hide');
            this.$store.dispatch('setUser', null);
          } else {
            this.$validator.errors.add({field: 'unmatch', msg: 'msg'});
          }
        }.bind(this))// thisを使う
        .catch(function(error) {
          out_console(error, 'user, logout');
        }.bind(this));// thisを使う
    },
    unregist: function() {
      axios.post('/api/unregister')
        .then(function(response) {
          //alert(JSON.stringify(response.data));
          if(response.data.unregister) {
            $('#login-modal').modal('hide');
            this.$store.dispatch('setUser', null);
          } else {
            this.$validator.errors.add({field: 'unmatch', msg: 'msg'});
          }
        }.bind(this))// thisを使う
        .catch(function(error) {
          out_console(error, 'user, unregister');
        }.bind(this));// thisを使う
    }
  },
  props: ['user'],
}
</script>

<style lang="stylus" scoped>

</style>