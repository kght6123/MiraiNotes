<template>
  <div class="sticky-top">
    <ul class="list-unstyled mt-5">
      <li>
        <a id="link-login" href="#" class="text-light" data-toggle="modal" data-target="#login-modal">
          <i class="oi oi-person"></i><i class="mdi mdi-tr font-weight-bold" v-bind:class="{ 'mdi-check-circle': user, 'text-success': user, 'mdi-close-circle': !user, 'text-danger': !user }"></i>
          ログイン
        </a>
      </li>
      <li>
        <a id="link-login-google" href="#" class="text-light" v-bind:class="{ 'd-none': !user }" data-toggle="modal" data-target="#auth-modal">
          <i class="mdi mdi-google"></i><i class="mdi mdi-tr font-weight-bold" v-bind:class="{ 'mdi-check-circle': gtoken, 'text-success': gtoken, 'mdi-close-circle': !gtoken, 'text-danger': !gtoken }"></i>
          Google
        </a>
      </li>
      <!--li>
        <a href="{{ url('/') }}" class="text-light active">
          <i class="oi oi-home"></i>
          ホーム
        </a>
      </li-->
      <li>
        <a href="#" class="text-light sidebar-toggle" v-bind:class="{ 'd-none': !gtoken, 'reserve active': gtoken }" data-target="#filetree">
          <i class="mdi mdi-folder-multiple-outline"></i>
          フォルダ
        </a>
      </li>
      <!--li>
        <a href="#" class="text-light sidebar-toggle" data-target="#headline">
          <i class="oi oi-list"></i>
          目次
        </a>
      </li-->
      <!--li>
        <a href="#" class="text-light sidebar-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="oi oi-question-mark"></i>
          問合せ
        </a>
        !- ドロップメニューの設定 -
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
        </div>!- /.dropdown-menu -
      </li-->
    </ul>
  </div>
</template>

<script>
export default {
  computed: {
    gtoken () {
      return this.$store.state.gtoken;
    },
  },
  props: ['user'/*,'gtoken'*/],
}
</script>

<style lang="stylus" scoped>

</style>