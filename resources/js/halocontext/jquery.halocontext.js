/*
 * HaloContext - jQuery plugin for right-click halo context menus
 *
 * Author: Josh Hundley
 * Parts inspired by Chris Domigan
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */

(function($) {
	var active = false;
	var ua = navigator.userAgent;

	$.fn.haloContext = function(bindings) {
		$(this).bind(isMobile() ? "click" : "contextmenu", function(e) {
			if (active) hide();
			display(this, bindings, e);
			
			return false;
		}); 
		return this;
	};

	function display(trigger, binds, e) {
		active = true; // context active
		
		var x = e.pageX - 24;
		var y = e.pageY - 24;
		var c = binds.bindings.length; // bind count
		
		var r = (48 * (1 / (Math.tan(Math.PI / c))) / 2) + 60/*18*/; // fun math! 半径っぽい
		var ang = (360 / c);
		
		for (var i = 0; i < c; i++) {
			
			var binding = binds.bindings[i];
			
			var iconHtml = binding.iconClassNames ? '<i class="' + binding.iconClassNames + '"></i>' : "";
			var labelClassNames = binding.labelClassNames ? binding.labelClassNames : "hct bg-primary text-light shadow text-center";
			
			$('body').append('<div id="hb'+i+'" class="'+labelClassNames+'">'+iconHtml+binding.label+'</div>'); // change bootstrap style
			
			var left = x + Math.cos(((ang * i * Math.PI) / 180)) * r;
			var top  = y + Math.sin(((ang * i * Math.PI) / 180)) * r;
			var $temp = $('#hb'+i);
			
			$temp.click(function(_e) { return binding.onclick(_e, trigger, e); }).css("left", left).css("top", top);
			$temp.css("display", "block");
		}
		// all click hide.
		$('body').one("click", hide);
	}
	function hide() {
		$('div').remove('.hct'); 	
		active = false;
		return false;
	}
	function isSmartPhone() {
		return ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0;
	}
	function isTablet() {
		return ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0;
	}
	function isOther() {
		return !isSmartPhone() && !isTablet();
	}
	function isMobile() {
		return isSmartPhone() || isTablet();
	}

})(jQuery);
