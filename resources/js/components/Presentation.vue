<template lang="pug">

div.d-flex.flex-column.flex-sm-column.flex-md-row.flex-lg-row.flex-xl-row.mw-100.w-100.mh-100.h-100
  div.reveal.mw-100.w-100.mh-100.h-100
    div.slides
      section(data-markdown="")
        textarea(data-template="") # {{ greeting }} World! {{ title }}
  
  div.markdown-input-area.full.form-group
    div.editmode-ctrl
      button.btn.btn-secondary.shadow.text-center.align-middle(type="button")
        i.oi.oi-pencil//- Normal
        i.oi.oi-fullscreen-enter//- Full
        i.oi.oi-layers//- Floating
    textarea.form-control.text-light.markdown-input(placeholder="Please Markdown input.")
  div#temp-slides(style={display: "none"})

</template>

<script>
// https://jp.vuejs.org/v2/guide/components.html

window.$ = window.jQuery = require('jquery');

import 'reveal.js/css/reveal.scss';
import 'reveal.js/css/theme/black.css';
import 'reveal.js/lib/css/zenburn.css';

// if(window.location.search.match(/print-pdf/gi))
//   import 'reveal.js/css/print/pdf.css';
// else
//   import 'reveal.js/css/print/paper.css';

// $.getScript("./script.js", function(){});

// require('reveal.js/lib/js/head.min.js');
// require('reveal.js/js/reveal.js');

import 'reveal.js/lib/js/head.min.js';

// import Reveal from 'reveal.js/js/reveal.js';
// window.Reveal = Reveal;

$.getScript("js/reveal.js", function(){
  var revealOptions = { separator: "\n---\n\n", verticalSeparator: "\n--\n\n", notesSeparator: "^Note:" };

  // 初期表示Markdown
  var initMarkdownText = ["## Page title 1",
    "",
    "A paragraph with some text and a [link](http://hakim.se).",
    "",
    "---",
    "",
    "## Page title 2-1",
    "",
    "A paragraph with some text and a [link](http://hakim.se).",
    "",
    "--",
    "",
    "## Page title 2-2",
    "",
    "A paragraph with some text and a [link](http://hakim.se)."
    ].join("\n");

  if (parent)
    initMarkdownText = $("#delegate-markdown", parent.document).val();

  // スライド毎にMarkdownを分割し、配列に格納する
  var separatorReg = new RegExp(revealOptions.separator, "gmy");
  var verticalSeparatorReg = new RegExp(revealOptions.verticalSeparator, "gmy");

  var initMarkdownSlides = $.map(initMarkdownText.split(separatorReg), function(sepVal, sepIdx) {
    
    if (sepVal.split) { /* $.isArray(sepVal) */
      var vSlides = $.map(sepVal.split(verticalSeparatorReg), function(vsepVal, vsepIdx) {
        return vsepVal;
      });
      return [vSlides];
    }
  });

  var getMarkdownText = function(){
    return $.map(initMarkdownSlides, function(sepVal, sepIdx) {
      return sepVal.join(revealOptions.verticalSeparator);
    }).join(revealOptions.separator);
  };

  var getMarkdownSlide = function(_indexh, _indexv) {
    
    if(initMarkdownSlides.length > _indexh)
      return initMarkdownSlides[_indexh][_indexv];
    else
      return null;
  };

  var setMarkdownSlide = function(_indexh, _indexv, _mdText) {
    
    if(initMarkdownSlides.length > _indexh)
      initMarkdownSlides[_indexh][_indexv] = _mdText;
  };

  console.log(initMarkdownSlides);

  // More info https://github.com/hakimel/reveal.js#configuration
  Reveal.initialize({
    
    // Options which are passed into marked
    // See https://github.com/chjj/marked#options-1
    width: "auto",
    height: "auto",
    margin: 0,
    minScale: 1,
    maxScale: 1,
    
    touch: true,
    keyboard: true,
    overview: true,
    
    controls: true,
    progress: true,
    history: true,
    center: true,
    embedded: false,
    mouseWheel: true,
    previewLinks: true,
    
    transition: 'slide', // none/fade/slide/convex/concave/zoom
    
    markdown: {smartLists: true, smartypants: true},

    // More info https://github.com/hakimel/reveal.js#dependencies
    dependencies: [
      {
        src: 'lib/js/classList.js',
        condition: function() { return !document.body.classList; }
      },
      {
        src: 'plugin/markdown/marked.js',
        condition: function() { return !!document.querySelector( '[data-markdown]' ); }
      },
      {
        src: 'plugin/markdown/markdown.min.js',
        condition: function() { return !!document.querySelector( '[data-markdown]' ); }
      },
      {
        src: 'plugin/highlight/highlight.min.js',
        async: true,
        callback: function() { hljs.initHighlightingOnLoad(); }
      },
      {
        src: 'plugin/search/search.min.js',
        async: true
      },
      {
        src: 'plugin/zoom-js/zoom.min.js',
        async: true
      },
      {
        src: 'plugin/notes/notes.min.js',
        async: true
      }
    ]
  });

  // Revealがレディになったときに実行
  Reveal.addEventListener( 'ready', function( event ) {
    // event.currentSlide, event.indexh, event.indexv
    
    // 状態を取得
    var state = Reveal.getState();
    
    // Markdown文字列を、section+script(md)のHTMLに変換する
    var section = RevealMarkdown.slidify( initMarkdownText, revealOptions );
    
    // section+script(md)のHTMLをスライド一覧の中に追加
    $(".slides").html(section);

    // スライド内のMarkdownをHTMLに変換
    RevealMarkdown.convertSlides();
    
    // 同期
    Reveal.sync();
    //Reveal.layout();
    
    // 状態を更新
    Reveal.setState(state);
    
    $(".markdown-input").val(getMarkdownSlide(0, 0));
  });

  // スライドを動かしたときに実行
  Reveal.addEventListener( 'slidechanged', function( event ) {
    // event.previousSlide, event.currentSlide, event.indexh, event.indexv
    
    // テキストエリアを更新
    $(".markdown-input").val(getMarkdownSlide(event.indexh, event.indexv));
  });

  $(".markdown-input").on("keyup",  function() {
    
    // 状態を取得
    var state = Reveal.getState();
    
    var mdText = $(".markdown-input").val();
    
    // Markdown文字列を、section+script(md)のHTMLに変換する
    var section = RevealMarkdown.slidify( mdText, revealOptions );
    
    // section+script(md)のHTMLをスライド一覧の中に追加
    $("#temp-slides").html(section);
    
    // スライド内のMarkdownをHTMLに変換
    RevealMarkdown.convertSlides();
    
    // セクション内のHTMLを取得
    var tempHtml = $("#temp-slides section").html();
    
    var $hsection = $(".slides > section:nth-child("+ (state.indexh + 1) +")");
    
    if ($hsection.length > 0) {
      var $vsections = $hsection.children("section");
      
      if($vsections.length > 0) {
        $("section:nth-child("+ (state.indexv + 1) +")", $hsection).html(tempHtml);
        
      } else {
        $hsection.html(tempHtml);
      }
    }
    // 同期
    setMarkdownSlide(state.indexh, state.indexv, mdText);

    if (parent)
      $("#delegate-markdown", parent.document).val(getMarkdownText());
  });

  $(".editmode-ctrl").on("click", function(){
    
    var $ia = $(".markdown-input-area");
    
    if($ia.hasClass("full")) {
      $ia.removeClass("full").addClass("floating");

    } else if($ia.hasClass("floating")) {
      $ia.removeClass("floating").addClass("edit");
      
    } else if($ia.hasClass("edit")) {
      $ia.removeClass("edit").addClass("full");
    }
    Reveal.sync();// 再計算させないと崩れる。
    
    console.log(getMarkdownText());// 逆変換テスト
  });
});

// import ClassList from 'reveal.js/lib/js/classList.js';
// document.body.classList = ClassList;

// import Marked from 'reveal.js/plugin/markdown/marked.js';
// window.marked = Marked;

// import MarkdownJs  from 'reveal.js/plugin/markdown/markdown.js';
// window.Markdown = MarkdownJs;

// Markdown.initialize();

// import hljs from 'reveal.js/plugin/highlight/highlight.js';
// window.hljs = hljs;

// import 'reveal.js/plugin/search/search.js';
// import 'reveal.js/plugin/zoom-js/zoom.js';
// import 'reveal.js/plugin/notes/notes.js';

import ExampleComponent from './ExampleComponent.vue';

export default {
  components: {
    ExampleComponent
  },
  methods: {
    hello: function() {
      alert("Hello!");
    }
  },
  data: function() {
    return { greeting: 'Hello' };
  },
  created() {

  },
  props: ['title'], 
}

</script>

<style lang="stylus" scoped>

div {
  z-index: 1500;
}
.reveal {
  font-size: calc(100vmin / 15);
}
.reveal .slides>section, .reveal .slides>section>section {
  padding: 20px;
}
.reveal dl, .reveal ol, .reveal ul {
  padding: 0 1em 0 1em;
  margin: 0 1em 0 1em;
}
.reveal.center .slides section {
  left: 0;
}

.markdown-input-area {
  margin-bottom: 0;
}
.markdown-input-area .markdown-input {
  background-color: rgba(0, 0, 0, 0.5);
  border: none;
}
.markdown-input-area .markdown-input {
  min-width: 12.5em;
  width: 12.5em;
  min-height: 100%;
  height: 100%;
}

.markdown-input-area.floating {
  position: relative;
}
.markdown-input-area.floating .markdown-input {
  position: fixed;
}
.markdown-input-area.floating .markdown-input {
  left: 0;
  top: 0;
}

@media (max-width: 767px) {/* 767px以下 md */
  .markdown-input-area .markdown-input {
    min-width: 100%;
    width: 100%;
    min-height: 12.5em;
    height: 12.5em;
  }
  .markdown-input-area.floating .markdown-input {
    left: 0;
    top: 0;
  }
}

.markdown-input-area.full .markdown-input {
  display: none;
}

.editmode-ctrl {
  position: fixed;
  left: 1em;
  bottom: 1em;
  z-index: 1023;/* sticky-top の z-index に + 3 */
}
.editmode-ctrl > .btn {
  max-width: 3em;
  min-width: 3em;
  max-height: 3em;
  min-height: 3em;
  border-radius: calc(3em / 2);
}

.markdown-input-area.edit     > .editmode-ctrl > .btn > :nth-child(1),
.markdown-input-area.full     > .editmode-ctrl > .btn > :nth-child(2),
.markdown-input-area.floating > .editmode-ctrl > .btn > :nth-child(3) {
  display: block;
}
.markdown-input-area.edit     > .editmode-ctrl > .btn > :nth-child(2),
.markdown-input-area.edit     > .editmode-ctrl > .btn > :nth-child(3),
.markdown-input-area.full     > .editmode-ctrl > .btn > :nth-child(1),
.markdown-input-area.full     > .editmode-ctrl > .btn > :nth-child(3),
.markdown-input-area.floating > .editmode-ctrl > .btn > :nth-child(1),
.markdown-input-area.floating > .editmode-ctrl > .btn > :nth-child(2) {
  display: none;
}
</style>