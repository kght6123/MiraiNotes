const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//mix.setPublicPath('./');

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css');

mix.sourceMaps(); // Enable sourcemaps
//mix.babelConfig({ sourceMaps: true }); // Merge extra Babel configuration (plugins, etc.) with Mix's default.

if (mix.inProduction()) {
  mix.version(); // Enable Versioning
}

// const CopyWebpackPlugin = require('copy-webpack-plugin')
// const WriteFilePlugin = require('write-file-webpack-plugin');

// function copyRevealJsFiles(pattern, outputDirectory = '') {
//   return {
//       from: `node_modules/reveal.js/${pattern}`,
//       to: outputDirectory,
//       transformPath(targetPath) {
//           return targetPath.replace('node_modules/reveal.js/', '');
//       }
//   }
// }

// mix.webpackConfig({
//   module: {
//     rules: [{
//       test: require.resolve('reveal.js'),
//       use: [{
//         loader: 'expose-loader',
//         options: 'Reveal'
//       }]
//     }]
//   },
  // plugins: [
  //   new CopyWebpackPlugin([
  //     copyRevealJsFiles('plugin/notes/*'),
  //     copyRevealJsFiles('plugin/markdown/*'),
  //     copyRevealJsFiles('css/reveal.css', 'css'),
  //     copyRevealJsFiles('css/theme/white.css', 'css/theme'),
  //     copyRevealJsFiles('lib/font/source-sans-pro/source-sans-pro.css', 'lib/font/source-sans-pro')
  //   ]),
  //   new WriteFilePlugin()
  // ]
// });

function copyRevealFiles(pattern) {
  mix.copy(`node_modules/reveal.js/${pattern}`, `public/${pattern}`).minify(`public/${pattern}`);
}

function copyRevealDirs(pattern) {
  mix.copyDirectory(`node_modules/reveal.js/${pattern}`, `public/${pattern}`);
}

copyRevealFiles('js/reveal.js');

copyRevealFiles('css/reveal.css');
copyRevealFiles('css/theme/black.css');
copyRevealFiles('css/print/paper.css');
copyRevealFiles('css/print/pdf.css');

copyRevealFiles('lib/css/zenburn.css');
copyRevealFiles('lib/js/classList.js');
copyRevealFiles('lib/js/head.min.js');

copyRevealDirs('lib/font/source-sans-pro');

copyRevealFiles('plugin/highlight/highlight.js');
copyRevealFiles('plugin/markdown/markdown.js');
copyRevealFiles('plugin/markdown/marked.js');
copyRevealFiles('plugin/math/math.js');
copyRevealFiles('plugin/multiplex/client.js');
copyRevealFiles('plugin/multiplex/index.js');
copyRevealFiles('plugin/multiplex/master.js');
copyRevealFiles('plugin/notes/notes.js');
copyRevealFiles('plugin/notes-server/client.js');
copyRevealFiles('plugin/notes-server/index.js');
copyRevealFiles('plugin/print-pdf/print-pdf.js');
copyRevealFiles('plugin/search/search.js');
copyRevealFiles('plugin/zoom-js/zoom.js');
