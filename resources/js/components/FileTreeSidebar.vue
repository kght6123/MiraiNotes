<template>
  <div class="w-100 mhp-100 hp-100">
    <!-- 新規ファイル名入力 モーダル -->
    <div id="new-file">
      <div class="dropdown-menu bg-dark text-light shadow p-3" style="width: 13em;z-index: 1024;">
        <div class="input-group">
          <input type="text" class="form-control bg-dark text-light" value="new_file.md" placeholder="新しいファイル名を入力してください">
          <div class="input-group-append">
            <button type="button" class="btn btn-success" v-on:click="newfile"><i class="oi oi-check"></i></button>
          </div>
        </div>
      </div>
    </div>
    <!-- 新規フォルダ名入力 モーダル -->
    <div id="new-folder">
      <div class="dropdown-menu bg-dark text-light shadow p-3" style="width: 12em;z-index: 1024;">
        <div class="input-group">
          <input type="text" class="form-control bg-dark text-light" value="new_folder" placeholder="新しいフォルダ名を入力してください">
          <div class="input-group-append">
            <button type="button" class="btn btn-success" v-on:click="newfolder"><i class="oi oi-check"></i></button>
          </div>
        </div>
      </div>
    </div>
    <!-- ツールバー -->
    <div class="sidebar-toolbar btn-group sticky-top text-light shadow w-100" role="group">
      <button class="btn btn-dark text-center align-middle" v-on:click="refresh">
        <i class="mdi mdi-refresh"></i>
      </button>
      <button class="btn btn-dark text-center align-middle" role="button" data-toggle="dropdown" data-target="#new-folder">
        <i class="mdi mdi-folder-outline"></i>
        <i class="mdi mdi-tr mdi-plus-circle  text-info font-weight-bold"></i>
      </button>
      <button class="btn btn-dark text-center align-middle" role="button" data-toggle="dropdown" data-target="#new-file">
        <i class="mdi mdi-file-outline"></i>
        <i class="mdi mdi-tr mdi-plus-circle  text-info font-weight-bold"></i>
      </button>
    </div>
    <!-- ファイルツリー -->
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
  </div>
</template>

<script>
export default {
  computed: {
    gtoken () {
      return this.$store.state.gtoken;
    },
  },
  methods: {
    newfile: function(event) {

    },
    newfolder: function(event) {

    },
    refresh: function(event) {
      $('#filetree .dropdown-toggle.open').click();// デフォルトで開く

      // DriveにQueryを実行する 
      axios.get('/api/drive', { 
        params: {
          //q: "'appDataFolder' in parents"/*"'root' in parents"*/,
          spaces: "appDataFolder",
          fields: "nextPageToken, files(id, name)",
          pageSize: 10,
          web: true }} )
        .then(function(response) {
          console.log(response);
          alert(JSON.stringify(response.data));

          // if(response.data.auth) {
          //   // レスポンス後に開き直す
          //   //alert("認証OK");
          //   this.$store.dispatch('setGtoken', response.data.gtoken);
          //   $('#auth-modal').modal('hide');
          // }

      }.bind(this))// thisを使う
      .catch(function(error) {
        console.error('ERROR!! occurred in Backend. (drive/query/)', error);
        //catch the error, check it has a response object with lodash 
        if(_.has(error, 'response')) {
          console.error("status : " + error.response.status);  
          console.error("data : " + JSON.stringify(error.response.data));
        } else {
          console.error("Most likely a server timeout or an internet connection error");
          console.error("error response property is undefined");
        }
      }.bind(this));// thisを使う

    }
  },
  props: ['user'/*,'gtoken'*/],
}
</script>

<style lang="stylus" scoped>

</style>