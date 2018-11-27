
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./halocontext/jquery.halocontext');
require('./sidebar/bootstrap-sidebar');

window.Vue = require('vue');
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
