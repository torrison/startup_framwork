<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Date {


	public function input_form($input_array)
	{
		if ($input_array['value'] == "") $input_array['value'] = date ("Y-m-d");
		ob_start();
?>
		<script>
			$(function(){
				$(".inputDate").bootstrap_datepicker();
			});
		</script>
		<input data-date-format="yyyy-mm-dd" name="<?=$input_array['name']?>" class="inputDate" type="text" value="<?=$input_array['value']?>" />
<?php		
  		return ob_get_clean();
	}


}

?>
	