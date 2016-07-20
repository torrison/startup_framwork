<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class One2Many {


	public function input_form($input_array, $cell_id)
	{
		ob_start();
?>
<a href="<?php echo $input_array['link']."?".$input_array['rel_field_many']."=".$cell_id ?>" target="_blank">
	<?=$input_array['link_text']?>
</a>
<?php
		return ob_get_clean();
	}
	public function db_save($input_array, $cell_id)
	{
		return false;
	}
	public function db_add($input_array, $cell_id)
	{
		return false;
	}

}

?>