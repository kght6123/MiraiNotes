$(function(){
  $('.dropdown-toggle.open').click();// デフォルトで開く
  // サイドバーの表示・非表示を切り替えるイベントを設定する
  $(".sidebar-ctrl,.sidebar-window-ctrl > .btn").on("click mouseover", function(_event) {
    if (window.matchMedia('(max-width:576px)').matches) {/* 576px以下 xs */
      $('.sidebar[class*=floating]').toggleClass('show');
    } else if (_event.type == "click") {
      $('.sidebar').toggleClass('none');
      $('.sidebar-btn').toggleClass('reverse');
      $(".sidebar-window-ctrl").toggleClass('full');
    }
  });
  // 浮いたサイドバーを非表示にするイベントを設定
  $(".sidebar-content,.sidebar:not([class*=floating])").on("mouseover", function() {
    if (window.matchMedia('(max-width:576px)').matches) {/* 576px以下 xs */
      $('.sidebar[class*=floating]').removeClass('show');
    }
  });
  // モバイル表示時にサイドバーを一時的に非表示にするイベントを設定
  $(".sidebar-material-ctrl > .btn").on("click", function(_event) {
    $(".sidebar-material-ctrl").toggleClass('full');
    $('.sidebar').toggleClass('none-xs');
  });
  // サイドバーの表示・非表示を切り替えるイベントを設定する
  $(".sidebar-toggle").on("click", function(_event) {
    var targetEl = this;
    if (window.matchMedia('(max-width:576px)').matches) {/* 576px以下 xs */
      // 他のサイドバーを非表示にする
      $(".sidebar-toggle").each(function(_i, _el) {
        if(_el != targetEl) {
          // イベントが発火したエレメント以外
          $($(_el).data("target")).addClass("none-toggle");
          $(_el).removeClass("reverse");
          $(_el).removeClass("active");
        }
      });
    }
    // 対象のサイドバーを表示
    $($(targetEl).data("target")).toggleClass("none-toggle");
    $(targetEl).toggleClass("reverse");
    $(targetEl).toggleClass("active");
  });
});