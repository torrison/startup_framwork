<!DOCTYPE html>
<html lang="ru">
	<head>
		<title><?php echo $inside_title; ?></title>
		<meta charset="utf-8">

		
		<link rel="stylesheet" href="/files/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/files/bootstrap/css/datepicker.css">	
		<link rel="stylesheet" href="/files/chosen/chosen.css">		
		<link rel="stylesheet" href="/files/inside/css/inside_styles.css?v=<?php echo time(); ?>">
		
		<script src="/files/inside/js/jquery-1.9.1.min.js"></script>
		<script src="/files/chosen/chosen.jquery-0.9.14.js"></script>
		<script src="/files/chosen/chosen.ajaxaddition.jquery.js"></script>		
		<script src="/files/inside/js/jquery.form.js"></script>
		<script src="/files/bootstrap/js/bootstrap.js"></script>	
		<script src="/files/bootstrap/js/bootstrap-datepicker.js"></script>
		<script src="/files/inside/js/inside_framework.js"></script>			
		
<?php echo $head_scripts; ?>

	</head>
	<body>

<?php echo $top_menu; ?>
		<form id="control_form" method="post" action="/inside_pdg_ajax/"> <!-- action="" TO DEL -->
<?php echo $control_form; ?>
		</form>
		<div id="inside_terminal">
<?php echo $terminal; ?>
		</div>
	</body>
</html>