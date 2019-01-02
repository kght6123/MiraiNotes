
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./halocontext/jquery.halocontext');
require('./sidebar/bootstrap-sidebar');

// import es6 promise
import 'es6-promise/auto';

// import VeeValidate
import VeeValidate, { Validator } from'vee-validate';

// import iziModal
//import iziModal from 'izimodal/js/iziModal';
//$.fn.iziModal = iziModal;

// require Vue
window.Vue = require('vue');

// import Vuex
import Vuex from 'vuex';
window.Vue.use(Vuex);

// use VeeValidate
window.Vue.use(VeeValidate);

// use axios
import { axios } from './axios-base';

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

const updateDelegateMarkdown = function() {
  $("#delegate-markdown").val(store.state.editor.getMarkdown());
}
const findDelegateMarkdown = function() {
  store.state.editor.setMarkdown($("#delegate-markdown").val(), false/*cursorToEndopt*/);
}

// use editor
import { editor } from './editor';

// use main store
import mainStore from './store/main';
export const store = new Vuex.Store(mainStore);

// set editor
store.dispatch('setEditor', editor);

// set editor event
editor.on("change", function() {
  store.dispatch('updateMarkdown');
});
editor.on("blur", function() {
  store.dispatch('updateUser');
});

// ログインユーザ情報の監視
store.watch(function(state, getter){
  return getter.user;
}, function(){
  const user = store.state.user;
  if(user) {
    if (user.api_token) {
      // auth update.
      window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.api_token;
    }
    // Google認証を実行する
    axios.post('/api/drive/auth', { web: true })
      .then(function(response) {
        //alert(JSON.stringify(response.data));
        if(response.data.authUrl) {
          store.dispatch('setAuthUrl', response.data.authUrl);
        }
      }.bind(this))// thisを使う
      .catch(function(error) {
        console.log('ERROR!! occurred in Backend. (login, drive/auth)', error);
      }.bind(this));// thisを使う
    
  } else {
    // auth clear.
    window.axios.defaults.headers.common['Authorization'] = null;
  }
}, {immediate: true, deep: true});

import miraiMenu from './components/MenuSidebar.vue';
const menu = new Vue({
  el: '#menu',
  store: store,
  computed: {
    user: {
      get () {
        return this.$store.state.user;
      },
      set (value) {
        this.$store.dispatch('setUser', value);
      }
    },
  },
  components: { miraiMenu },
});

import miraiLogin from './components/Login.vue';
const login = new Vue({
  el: '#login',
  store: store,
  computed: {
    user: {
      get () {
        return this.$store.state.user;
      },
      set (value) {
        this.$store.dispatch('setUser', value);
      }
    },
  },
  components: { miraiLogin },
});

import miraiDriveAuth from './components/DriveAuth.vue';
const auth = new Vue({
  el: '#auth',
  store: store,
  computed: {
    authUrl: {
      get () {
        return this.$store.state.authUrl;
      }
    },
    user: {
      get () {
        return this.$store.state.user;
      },
      set (value) {
        this.$store.dispatch('setUser', value);
      }
    },
    gtoken: {
      get () {
        return this.$store.getters.gtoken;
      }
    },
  },
  components: { miraiDriveAuth },
});

// import mdPresentation from './components/Presentation.vue';
// // const mdPresentation = Vue.component('md-presentation', require('./components/Presentation.vue')); //component name should be in camel-case

// const presentation = new Vue({
//   el: '#presentation',
//   store: store,
//   components: { mdPresentation },
//   data: {
//     dnone: false,
//     title: "title1-1",
//   },
// });

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
  $('.sidebar-modal .close').on('click', function(){
    $('.sidebar-modal').addClass('d-none');
    $('.sidebar-modal iframe').attr('src', null);
    findDelegateMarkdown();
  });
  $('#link-slide-mode').on('click', function(){
    updateDelegateMarkdown();
    $('.sidebar-modal').removeClass('d-none');
    $('.sidebar-modal iframe').attr('src', $(this).data("url"));
  });
});
