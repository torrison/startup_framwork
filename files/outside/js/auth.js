$(function() {

	$('#fb_login_a').on('click', function () {
		$.get('/auth_api/fb_oauth_link', function(data) {
			location.href = data;
		});
	});

// ------------------------------------------ Login ----------------
		$('#login-ok').on('click', function() {
			
			var options = { 				
 				url: "/auth_api/check_login/",
 				success: function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success") {
						
						if (typeof(obj.redirect) != "undefined") {
							document.location = obj.redirect;
						} else {
							document.location.reload();
						}
					} else {
						$('#login-email').addClass('red_border');
						$('#login-pass').addClass('red_border');
						$('#login_message').html(obj.message);
					}
				}
 			};
 			// передаем опции в  ajaxSubmit
 			$("#auth_form").ajaxSubmit(options);						
		});
		

		// ---------------------------------------- Dublicate For KeyDown ---
		$('#login-pass').keyup(function (event) {
			if(event.keyCode=='13') {
				$('#login-ok').click();
			}
			
		});
		// ------------------------------------------ Reg ----------------
		$('#reg-ok').on('click', function() {
			
			var options = { 				
 				url: "/auth_api/check_reg/",
 				success: function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success") {
						
						if (typeof(obj.redirect) != "undefined") {
							document.location = obj.redirect;
						} else {
							document.location.reload();
						}
					} else {
						$('#reg-email').addClass('red_border');
						$('#reg-pass').addClass('red_border');
						$('#register_message').html(obj.message);
					}
				}
 			};
 			// передаем опции в  ajaxSubmit
 			$("#auth_reg_form").ajaxSubmit(options);
			
		});
		
			$('#fgot_pass').on('click', function() {
			$("#register").toggle()
			$("#recovery").toggle()
			
			});
			$('#cancel_recovery').on('click', function() {
			$("#recovery").hide()
			$("#register").show()
			
			});
			
			// ---------------------------------------- Dublicate For KeyDown ---
		$('#reg-pass').keyup(function (event) {
			if(event.keyCode=='13') {
				$('#reg-ok').click();
			}
			
		});
		
		// ------------------------------------------ Recovery ----------------
		$('#instruction-ok').on('click', function() {
			
			var options = { 				
 				url: "/auth_api/check_recovery/",
 				success: function(data) {
					var obj = jQuery.parseJSON(data);
					if (obj.status == "success") {						
						$('#recovery_message').html(obj.message);
						$('#instruction-ok').hide();
					} else {
						$('#rec-email').addClass('red_border');
						$('#recovery_message').html(obj.message);
					}
				}
 			};
 			// передаем опции в  ajaxSubmit
 			$("#auth_recovery_form").ajaxSubmit(options);						
		});
		

		// ---------------------------------------- Dublicate For KeyDown ---
		$('#rec-email').keyup(function (event) {
			if(event.keyCode=='13') {
				$('#instruction-ok').click();
			}
			
		});
		

	});
