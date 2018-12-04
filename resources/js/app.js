
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./halocontext/jquery.halocontext');
require('./sidebar/bootstrap-sidebar');

// import VeeValidate
import VeeValidate, { Validator } from'vee-validate';

//import Editor from 'tui-editor';
import Editor from 'tui-editor/dist/tui-editor-Editor-all.js';

// require Vue
window.Vue = require('vue');

// use VeeValidate
window.Vue.use(VeeValidate);

const axiosBase = require('axios');
const axios = axiosBase.create({
  baseURL: 'http://127.0.0.1:8000', // バックエンドB のURL:port を指定する
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  },
  responseType: 'json'
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  methods: {
    hello: function() {
      alert("Hello!");

      axios.get('/api/user')
        .then(function(response) {
          alert(JSON.stringify(response.data));
        })
        .catch(function(error) {
          console.log('ERROR!! occurred in Backend.')
        });
    }
  },
  mounted() {
    var editor = new Editor({
      el: document.querySelector('#editSection'),
      //viewer: true,
      initialEditType: 'markdown',
      useCommandShortcut: true,
      previewStyle: 'vertical',
      height: '100%',
      initialValue: '',
      language: 'ja',
      exts: ['scrollSync', 'colorSyntax', 'uml', 'chart', 'mark', 'table']
    });

    // const params = { path : 'welcome.md' };
    // const url = "http://"+this.backend+"/gdrive";

    // axios.get(url, { params })
    //   .then(response => { // thenで成功した場合の処理をかける
    //     console.log(response.data);        // レスポンスデータ
    //     console.log(response.status);      // ステータスコード
    //     console.log(response.statusText);  // ステータステキスト
    //     console.log(response.headers);     // レスポンスヘッダ
    //     console.log(response.config);      // コンフィグ
    //     editor.setMarkdown(response.data.value, false);
    //   })
    //   .catch(err => { // catchでエラー時の挙動を定義する
    //     this.results = err;
    //     console.log('err:', err);
    //   });
  }
});

const login = new Vue({
  el: '#login',
  data: {
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    save: true,
    regist: false
  },
  created() {
    // メッセージを日本語に設定する
    this.$validator.localize('ja');
  },
  watch: {
    regist: function(_new, _old) {
      if (_new) {
        // 新規登録のとき

      }
    }
  },
  methods: {
    login: function() {
      // alert("email="+this.email+",password="+this.password+",save="+this.save+",regist="+this.regist);
      
      // バリデーションする
      this.$validator.errors.remove('notification');
      this.$validator.validateAll().then((result) => {
        if ( this.regist && !result ) {
          // 新規登録で入力エラー
          this.$validator.errors.add({field: 'notification', msg: '入力エラーがあります...'});
          return false;
        } else if ( this.regist && (errors.has('email') || errors.has('password')) ) {
          // ログインで入力エラー
          this.$validator.errors.add({field: 'notification', msg: '入力エラーがあります...'});
          return false;
        }
      });

      if (this.regist) {
        // ユーザ登録する
        axios.post('/api/register', { name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
          .then(function(response) {
            alert(JSON.stringify(response.data));
          })
          .catch(function(error) {
            console.log('ERROR!! occurred in Backend.')
          });
      } else {
        // ユーザ認証する
        axios.post('/api/login', { email: this.email, password: this.password })
          .then(function(response) {
            alert(JSON.stringify(response.data));
          })
          .catch(function(error) {
            console.log('ERROR!! occurred in Backend.')
          });
      }
    }
  }
});

$(function(){
  // haloContext 右クリックメニューを表示 _pthisや_peで右クリックされた要素を特定
  $('#filetree li').haloContext({
    bindings : [
      { label : "Heart0", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('0:'+$(_pe.target).html()); } },
      { label : "Heart1", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('1:'+$(_pe.target).html()); } },
      { label : "Heart2", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('2:'+$(_pe.target).html()); } },
      { label : "Heart3", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('3:'+$(_pe.target).html()); } },
      { label : "Heart4", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('4:'+$(_pe.target).html()); } },
      { label : "Heart5", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('5:'+$(_pe.target).html()); } },
      { label : "Heart6", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('6:'+$(_pe.target).html()); } },
      { label : "Heart7", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('7:'+$(_pe.target).html()); } },
      { label : "Heart8", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('8:'+$(_pe.target).html()); } },
      { label : "Heart9", iconClassNames : "oi oi-heart", onclick : function(_e, _pthis, _pe) { alert('9:'+$(_pe.target).html()); } },
    ],
    options : {}
  });
});
