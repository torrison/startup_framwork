<!DOCTYPE html>
<html>
<head>

	<!--
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta http-equiv="Cache-Control" content="private, max-age=300, must-revalidate, proxy-revalidate" />
	-->

    <meta charset="utf-8">
    <title><?=$seo_title?></title>
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
    <meta name="description" content="<?=$seo_description?>">
	<meta name="keywords" content="<?=$seo_keywords?>">
    <meta name="author" content="IT.iKiev.biz">

	<link href="/files/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">

	<link href="/files/outside/css/core.css" rel="stylesheet">
	<link href="/files/outside/css/style.css" rel="stylesheet">

	<link rel="icon" href="favicon.ico">
  
<?php		
if (@file_exists(APPPATH."/views/outside/pages/" . $page_center."_head.php"))
{
   $this->load->view('outside/pages/' . $page_center."_head");
}
?>
  
</head>

<body>

	<script>
	// Place for Google Analytics Code
	</script>

	<div class="header">
		<div class="container">
			<a href="/" class="logo_holder">
				Startup
			</a>
			<a href="#" class="header_right menu_btn">
				<i class="glyphicon glyphicon-th"></i> <span class="menu_text">Menu</span>
			</a>
			<?php if ($user) { ?>
				<a href="/auth/profile" class="header_right register_btn">
					<i class="glyphicon glyphicon-user"></i> <span class="menu_text">Личный кабинет</span>
				</a>
			<?php } else { ?>
				<a href="/auth/login" class="header_right register_btn">
					<i class="glyphicon glyphicon-user"></i> <span class="menu_text">Вход/Регистрация</span>
				</a>
			<?php } ?>
		</div>
	</div>

	<div class="content">
	<?php $this->load->view('outside/pages/' . $page_center); ?>
	</div>


	<div class="footer">
		Startup.ikiev.biz. All rights reserved.
	</div>

    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/files/inside/js/jquery.form.js"></script>
	<script src="/files/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

	
<?php
if (@file_exists(APPPATH."/views/outside/pages/" . $page_center."_footer.php"))
{
   $this->load->view('outside/pages/' . $page_center."_footer");
}
?>
	
</body>
</html>