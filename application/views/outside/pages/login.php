<div class="container">
	<div class="row top20">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xlg-6 center login_row">
		<form id="auth_form" method="POST" class="login_left_side ln_block">
			<h3>
				Вход в личный кабинет
			</h3>
			<b>Email</b><br />
			<input name="email" type="text" /><br />
			<b>Пароль</b><br />
			<input id="login-pass" name="password" type="password" /><br />
			<a class="forgot_pass" onclick="$('.c_p_row').toggle();$('.login_row').toggle();">Забыли пароль?</a><br />
			<p id="login_message" class="red"></p>
            <a id="login-ok" class="btn btn-success">Войти</a>
		</form>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xlg-6 center c_p_row" style="display:none;">
		<form id="auth_recovery_form" method="POST" class="">
			<h3>
				Восстановление пароля
			</h3>
			<b>Email</b>
			<input id="rec-email" name="recovery_email"type="text" /><br />
            <a id="instruction-ok" class="btn btn-primary top10 mb10">Выслать инструкции</a></br>
            <div id="recovery_message"></div>
			<a class="forgot_pass pass_cancel" onclick="$('.c_p_row').toggle();$('.login_row').toggle();">Отмена</a>
		</form>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xlg-6 center">

		<div class="register_block">
			<h3>
				Нет аккаунта? Зарегистрируйтесь!
			</h3>
			<form id="auth_reg_form" method="POST" class="register_block_inner">
				<b>Email</b><br />
				<input id="reg-email" name="r_email" type="text" /><br />
				<b>Пароль</b><br />
				<input id="reg-pass" name="r_password" type="password" /><br />
                <p id="register_message" class="red"></p>
				<a id="reg-ok" class="btn btn-success top10">Зарегистрироваться</a>
			</form>
			<div class="top10">
				<a class="btn btn-danger" rel="nofollow" href="https://accounts.google.com/o/oauth2/auth?redirect_uri=http://startup.ikiev.biz/auth_api/check_social_login/google/&response_type=code&client_id=611786825710-bau44ng2oig0tuaims4to4rteaa1hmuc.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile">Google Login</a>
				<a class="btn btn-primary" rel="nofollow" id="fb_login_a">Facebook Login</a>
			</div>
		</div>
		</div>
	</div>


</div>