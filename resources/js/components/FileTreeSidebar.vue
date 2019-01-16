<template>
  <div class="w-100 mhp-100 hp-100">
    <!-- 新規ファイル名入力 モーダル -->
    <div id="new-file">
      <div class="dropdown-menu bg-dark text-light shadow p-3" style="width: 13em;z-index: 1024;">
        <div class="input-group">
          <input type="text" class="form-control bg-dark text-light" v-model="newFileName" placeholder="新しいファイル名を入力">
          <div class="input-group-append">
            <button type="button" class="btn btn-success" v-on:click="newfile"><i class="oi oi-check"></i></button>
          </div>
        </div>
        <div class="input-group">
          <textarea class="form-control bg-dark text-light" v-model="newFileMarkdownText" placeholder="マークダウンを入力（任意）"></textarea>
        </div>
      </div>
    </div>
    <!-- 新規フォルダ名入力 モーダル -->
    <div id="new-folder">
      <div class="dropdown-menu bg-dark text-light shadow p-3" style="width: 12em;z-index: 1024;">
        <div class="input-group">
          <input type="text" class="form-control bg-dark text-light" v-model="newFolderName" placeholder="新しいフォルダ名を入力">
          <div class="input-group-append">
            <button type="button" class="btn btn-success" v-on:click="newfolder"><i class="oi oi-check"></i></button>
          </div>
        </div>
      </div>
    </div>
    <!-- ツールバー -->
    <div class="sidebar-toolbar btn-group sticky-top text-light shadow w-100" role="group">
      <button class="btn btn-dark text-center align-middle" v-on:click="backHome" v-bind:class="{ 'disabled': isHome() }">
        <i class="mdi mdi-home-outline"></i>
      </button>
      <button class="btn btn-dark text-center align-middle" v-on:click="backFolder" v-bind:class="{ 'disabled': isHome() }">
        <i class="mdi mdi-keyboard-backspace"></i>
      </button>
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
    <div class="sticky-top of-y-auto mhp-100 hp-100 pl-3 pt-3 pb-3">
      <ul class="list-unstyled list-tree" v-if="listfiles.length">
        <!--li>
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
        </li-->
        <li>
          <div class="btn-group dropdown w-100">
            <!--a class="text-light dropdown-toggle dropdown-toggle-split file"></a--><!-- 上のclassのpl-3は暫定そち -->
            <a href="#" class="nav-link text-primary w-100" v-on:click="showUserFile" v-bind:class="{ 'active' : !viewDriveFileId }">
              <i class="oi oi-pin"></i>
              Quick.md
            </a>
          </div>
        </li>
        <li v-for="file in listfiles" v-bind:key="file.id">
          <div class="btn-group dropdown w-100" v-if="file.mimeType == folderMimeType || file.mimeType == markdownMimeType">
            <!--a class="text-light dropdown-toggle dropdown-toggle-split file"></a--><!-- 上のclassのpl-3は暫定そち -->
            <a href="#" class="nav-link text-light w-100" v-on:click="file.mimeType == folderMimeType ? showFolder($event, file.id) : showFile($event, file.id)" v-bind:class="{ 'active' : viewDriveFileId == file.id }">
              <i class="oi" v-bind:class="[file.mimeType == folderMimeType ? 'oi-folder' : 'oi-file' ]"></i>
              {{ file.name }}
            </a>
          </div>
        </li>
      </ul>
      <p v-else class="p-3 text-light">No files!!!</p>
    </div>
  </div>
</template>

<script>
import { out_console } from '../axios/axios-errors';

export default {
  data: function() {
    return {
      listfiles: [],
      nextPageToken: null,
      fieldNames: "id,name,parents,webContentLink,webViewLink,description,mimeType,kind,iconLink,size,thumbnailLink",
      folderMimeType: "application/vnd.google-apps.folder",
      markdownMimeType: "text/markdown",
      directories: ["root"],
      newFileName: "file.md",
      newFolderName: "folder",
      newFileMarkdownText: "",
    };
  },
  computed: {
    gtoken () {
      return this.$store.state.gtoken;
    },
    markdown () {
      return this.$store.state.user.markdown;
    },
    viewDriveFileId () {
      return this.$store.state.viewDriveFileId;
    },
  },
  watch: {
    gtoken: function (newGtoken, oldGtoken) {
      if(newGtoken) {
        // gtokenが有る時にrootの一覧を表示する
        this.refresh(null);
      } else {
        // gtokenが無い時に表示を元に戻す
        this.listfiles = [];
        this.initDir();
      }
    }
  },
  methods: {
    showUserFile: function() {
      this.$store.dispatch('setViewDriveFileId', null);
      this.$store.dispatch('setMarkdown', this.markdown);
    },
    isHome: function() {
      return this.directories.length < 2;
    },
    initDir: function() {
      while (!this.isHome()) { this.directories.pop(); }
    },
    backHome: function(event) {
      this.initDir();
      this.refresh(event);
    },
    backFolder: function(event) {
      this.directories.pop();
      this.refresh(event);
    },
    showFolder: function(event, id) {
      //alert(id);
      this.directories.push(id);
      this.refresh(event);
    },
    showFile: function(event, id) {
      // DriveのFileを取得する
      axios.get('/api/drive/'+id, {
        params: {
          fields: this.fieldNames,
          alt: "media",
          web: true }} )
        .then(function(response) {
          //console.log(response);
          //alert(JSON.stringify(response.data));
          this.$store.dispatch('setViewDriveFileId', id);
          this.$store.dispatch('setMarkdown', response.data);
      }.bind(this))// thisを使う
      .catch(function(error) {
        out_console(error, 'drive, drive/show/folder');
      }.bind(this));// thisを使う
    },
    newfile: function(event) {
      // DriveにCreate(File)を実行する
      axios.get('/api/drive/create', { 
        params: {
          name: this.newFileName,
          mimeType: this.markdownMimeType,
          parents: this.directories.slice(-1)[0],
          //parents: "appDataFolder",
          //spaces: "appDataFolder",
          description: "",
          fields: this.fieldNames,
          data: this.newFileMarkdownText,
          uploadType: "multipart",
          useContentAsIndexableText: true,
          web: true }} )
        .then(function(response) {
          //console.log(response);
          //alert(JSON.stringify(response.data));
          this.refresh(event);
      }.bind(this))// thisを使う
      .catch(function(error) {
        out_console(error, 'drive, drive/create/file');
      }.bind(this));// thisを使う
    },
    newfolder: function(event) {
      // DriveにCreate(File)を実行する
      axios.get('/api/drive/create', { 
        params: {
          name: this.newFolderName,
          mimeType: this.folderMimeType,
          parents: this.directories.slice(-1)[0],
          //parents: "appDataFolder",
          //spaces: "appDataFolder",
          description: "",
          fields: this.fieldNames,
          useContentAsIndexableText: true,
          web: true }} )
        .then(function(response) {
          //console.log(response);
          //alert(JSON.stringify(response.data));
          this.refresh(event);
      }.bind(this))// thisを使う
      .catch(function(error) {
        out_console(error, 'drive, drive/create/folder');
      }.bind(this));// thisを使う
    },
    refresh: function(event) {
      // $('#filetree .dropdown-toggle.open').click();// デフォルトで開く
      // DriveにQueryを実行する
      axios.get('/api/drive', { 
        params: {
          q: "'" + this.directories.slice(-1)[0] + "' in parents",
          //q: "'appDataFolder' in parents",
          //spaces: "appDataFolder",
          fields: "nextPageToken,files("+this.fieldNames+")",
          pageSize: 100,
          web: true }} )
        .then(function(response) {
          //console.log(response);
          //alert(JSON.stringify(response.data));
          if(response.data.listfiles) {
            this.listfiles = response.data.listfiles;
            this.nextPageToken = response.data.nextPageToken;
          }
      }.bind(this))// thisを使う
      .catch(function(error) {
        out_console(error, 'drive, drive/query');
      }.bind(this));// thisを使う
    }
  },
  props: ['user'/*,'gtoken'*/],
}
</script>

<style lang="stylus" scoped>

</style>