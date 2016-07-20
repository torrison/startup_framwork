<?php
if (!isset($color)) $color = 'red';
if (!isset($location)) $location = '/inside/login/';
if (!isset($time)) $time = '1000';
if (!isset($message)) $message = 'Error!';
?>
<font color="<?=$color?>"><?=$message?></font>

<script language="JavaScript" type="text/javascript">
<!-- 
function GoLogin(){ 
 location="<?=$location?>"; 
} 
setTimeout( 'GoLogin()', <?=$time?> ); 
//--> 
</script>