<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Content_Options_Ext {


	public function input_form($input_array, $cell_id)
	{
		$CI =& get_instance();
		if ($input_array['make_type'] == 'edit')
		{		
			$query = $CI->db->query("SELECT * from it_rel_content_options_ext WHERE content_id = ".intval($cell_id)." ORDER BY content_options_priority ASC");
			$options_arr = $query->result_array();
			
			$query = $CI->db->query("SELECT * from it_content_options ORDER BY options_priority, options_id ASC");
			$all_options_arr = $query->result_array();
			
			
			ob_start();
?>	
<div class="all_m_options" style="cursor:move;">
<?php foreach ($options_arr as $option) { ?>


	<div class="mfo_holder" style="margin-top:10px;">
		<select name="options_id[]" style="width: 260px;margin-bottom:0;">
		<?php foreach ($all_options_arr as $all_options) { ?>
		  <option value="<?=$all_options['options_id']?>"<?php if ($all_options['options_id'] == $option['options_id']) echo " selected"; ?>><?=$all_options['options_name']?></option>
		<?php } ?>
		</select>
		<input name="content_options_price[]" placeholder="Цена" style="width: 100px;margin-bottom:0;" type="text" value="<?=$option['content_options_price']?>">
		<input name="content_options_time[]" placeholder="Сроки" style="width: 100px;margin-bottom:0;" type="text" value="<?=$option['content_options_time']?>">
		<input name="content_options_info[]" placeholder="Инфо" style="width: 150px;margin-bottom:0;" type="text" value="<?=$option['content_options_info']?>">
		<a class="btn btn-danger white del_edit_rule" OnClick="$(this).parent().remove();">x</a>
		
	</div>

<?php } ?>

</div>

<br />
<input type="button" class="btn btn-success" OnClick="$('.all_m_options').append(date_input_line);" value="Add New Option">

<script>
	$(function(){
		$('.all_m_options').sortable();
	});
var date_input_line = ''+
'	<div class="mfo_holder" style="margin-top:10px;">'+
'		<select style="width: 280px;margin-bottom:0;" name="options_id[]">'+<?php foreach ($all_options_arr as $all_options) { ?>
'		  <option value="<?=$all_options['options_id']?>"><?=$all_options['options_name']?></option>'+<?php } ?>
'		</select>'+
'		<input name="content_options_price[]" placeholder="Цена" style="width: 100px;margin-bottom:0;" type="text" value="">'+
'		<input name="content_options_time[]" placeholder="Сроки" style="width: 100px;margin-bottom:0;" type="text" value="">'+
'		<input name="content_options_info[]" placeholder="Инфо" style="width: 150px;margin-bottom:0;" type="text" value="">'+
'		<a class="btn btn-danger white del_edit_rule" OnClick="$(this).parent().remove();">x</a>'+
'	</div>';
</script>

<?php		
			return ob_get_clean();
		}
		else return 'Please set Options after Add in Edit Window';
	}
	public function db_save($input_array, $cell_id)
	{
		$CI =& get_instance();
		$CI->db->query("DELETE FROM it_rel_content_options_ext WHERE content_id = ".intval($cell_id));			
		
		echo "SAVE !!!";
		
		if ( isset($_POST['options_id']) )
		{
			$i=0;
			foreach ($_POST['options_id'] as $item)
			{
			
			$data['content_id'] = intval($cell_id);
			$data['options_id'] = $_POST['options_id'][$i];
			$data['content_options_price'] = $_POST['content_options_price'][$i];
			$data['content_options_time'] = $_POST['content_options_time'][$i];
			$data['content_options_info'] = $_POST['content_options_info'][$i];
			$data['content_options_priority'] = $i;
			$CI->db->insert('it_rel_content_options_ext', $data); 
			
			print_r($data);
			
			$i++;
			}	
		}
	}

}

?>
	