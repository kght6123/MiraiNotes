
const axiosBase = require('axios');
export const axios = axiosBase.create({
  baseURL: process.env.MIX_APP_URL,//'http://127.0.0.1:8000', // バックエンドB のURL:port を指定する
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  },
  responseType: 'json'
});
