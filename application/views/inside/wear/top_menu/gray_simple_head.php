		<link href="/files/inside/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />		
		<link href="/files/inside/dropdown/default.css" media="screen" rel="stylesheet" type="text/css" />	
		
		<script id="dropdown_touch_addon">
			$(function() {											
				var click_on_menu;
				$("ul.dropdown li").on("click", function(e) {
					$(this).addClass('hover');
					e.stopPropagation();
				});
				$(document).on("click", function() {
					$("ul.dropdown li").removeClass('hover');										
				});
			});
		</script>