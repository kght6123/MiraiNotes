<template>
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
</template>

<script>
import * as types from '../store/mutation-types';

export default {
  created() {
    // メッセージを日本語に設定する
    this.$validator.localize('ja');
  },
  data: function() {
    return { code: null };
  },
  methods: {
    open: function() {
      // Google認証ウィンドウを開く
      window.open(this.authUrl, 'auth');
    },
    auth: function() {
      this.$validator.validateAll().then((result) => {
        if (!result ) return false;
      });
      // Google認証を実行する
      axios.post('/api/drive/auth', { code: this.code, web: true })
        .then(function(response) {
          //alert(JSON.stringify(response.data));
          if(response.data.auth) {
            // レスポンス後に開き直す
            //alert("認証OK");
            this.$store.dispatch('setGtoken', response.data.gtoken);
            $('#auth-modal').modal('hide');
          }
      }.bind(this))// thisを使う
      .catch(function(error) {
        console.log('ERROR!! occurred in Backend. (drive/auth)');
      }.bind(this));// thisを使う
    }
  },
  props: ['authUrl', 'user', 'gtoken'],
}
</script>

<style lang="stylus" scoped>

</style>