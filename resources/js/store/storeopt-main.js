
import * as types from './mutation-types';
import { out_console } from '../axios/axios-errors';

export default {
  state: {
    user: null,
    editor: null,
    authUrl: null,
    gtoken: null,
    viewDriveFileId: null,
  },
  // Storeに対するGetterを定義
  getters: {
    user(state) {
      return state.user;
    },
    gtoken(state, getters) {
      return state.gtoken;
    },
    editor(state) {
      return state.editor;
    },
    editorMarkdown(state) {
      return state.editor.getMarkdown();
    },
    authUrl(state) {
      return state.authUrl;
    },
  },
  // Storeに対するActionを定義
  actions: {
     // Actionは基本、mutationsを呼ぶ
    setUser (context, user) {
      context.commit(types.SET_USER, user);
      context.commit(types.SET_VIEW_DRIVE_FILE_ID, null);
      context.commit(types.SET_MARKDOWN, user ? user.markdown : "");
      context.commit(types.SET_GTOKEN, user ? user.gtoken : "");
    },
    setGtoken (context, gtoken) {
      context.commit(types.SET_GTOKEN, gtoken);
    },
    updateUser (context) {
      context.commit(types.UPDATE_USER);
    },
    setEditor (context, editor) {
      context.commit(types.SET_EDITOR, editor);
    },
    setMarkdown (context, markdown) {
      context.commit(types.SET_MARKDOWN, markdown);
    },
    updateMarkdown (context) {
      context.commit(types.UPDATE_MARKDOWN);
    },
    setAuthUrl (context, authUrl) {
      context.commit(types.SET_AUTH_URL, authUrl);
    },
    setViewDriveFileId (context, viewDriveFileId) {
      context.commit(types.SET_VIEW_DRIVE_FILE_ID, viewDriveFileId);
    },
  },
  mutations: {
    [types.SET_USER] (state, user) {
      state.user = user;
    },
    [types.SET_GTOKEN] (state, gtoken) {
      state.gtoken = gtoken;
    },
    [types.UPDATE_USER] (state) {
      if(state.user) {
        axios.post('/api/update', state.user)
          .then(function(response) {
            console.log(JSON.stringify(response.data));
            if(response.data.update) {
              console.log('markdown update ok.');
            } else {
              console.log('markdown update ng.');
            }
          }.bind(this))// thisを使う
          .catch(function(error) {
            console.log('ERROR!! occurred in Backend. (update user)');
            console.log(error);
          }.bind(this));// thisを使う
      }
    },
    [types.SET_EDITOR] (state, editor) {
      state.editor = editor;
    },
    [types.UPDATE_MARKDOWN] (state) {
      if (state.viewDriveFileId) {
        axios.put('/api/drive/'+state.viewDriveFileId, /*{
          params: */{
            fields: "id",
            data: state.editor.getMarkdown(),
            web: true }/*}*/ )
          .then(function(response) {
            //console.log(response);
            //alert(JSON.stringify(response.data));
        }.bind(this))// thisを使う
        .catch(function(error) {
          out_console(error, 'drive, drive/update/data');
        }.bind(this));// thisを使う
      } else if (state.user)
        state.user.markdown = state.editor.getMarkdown();
    },
    [types.SET_MARKDOWN] (state, markdown) {
      console.log(markdown);
      console.log(state.editor);
      state.editor.setMarkdown(markdown, false/*cursorToEndopt*/);
    },
    [types.SET_AUTH_URL] (state, authUrl) {
      state.authUrl = authUrl;
    },
    [types.SET_VIEW_DRIVE_FILE_ID] (state, viewDriveFileId) {
      state.viewDriveFileId = viewDriveFileId;
    },
  },
}
