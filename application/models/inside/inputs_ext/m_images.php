<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Images {


	public function input_form ($input_array)
	{
	$CI =& get_instance();
	ob_start();	
	
	
	$images = json_decode($input_array['value']);
	
	foreach ($images as $img) {
	?>
		<a href="/files/uploads/<?=$input_array['folder']?>/<?=$img?>" target="_blank">files/uploads/<?=$input_array['folder']?>/<?=$img?></a>
		<input name="del_img_m_images[]" type="checkbox" value="1">Del?
		<input name="m_images[]" type="hidden" value="<?=$img?>">
		<br/>
	<?php
	}
	
	?>
	<script type="text/javascript">
		$(function(){
		
	  		$(".add_files.btn").on('click', function(){
				$(".add_files_div .add_file:last").click();
			});
			
			$(".add_files_div").on('change', '.add_file:last', function(){
				$(".add_files_div .add_file_line").last().show();
				var img_line = ''+
	'			<div class="add_file_line" style="display:none; margin-top: 5px;">'+
	'			  <a class="btn btn-danger del_file"><i class="icon-remove icon-white"></i></a>'+
	'			  <input type="file" value="" name="add_file[]" class="add_file" placeholder=""/>'+
	'			</div>';
				$(".add_files_div").append(img_line);
			});
		
			$(".add_files_div").on('click', '.del_file', function(){
				$(this).parent().remove();
			});
		});
	</script>
	<a class="add_files btn">Add File</a>
	<div class="add_files_div">
		<div class="add_file_line" style="display:none; margin-top: 5px;">
		  <a class="btn btn-danger del_file"><i class="icon-remove icon-white"></i></a>
		  <input type="file" value="" name="add_file[]" class="add_file" placeholder=""/>
		</div>
	</div>
	
	<?php
	return ob_get_clean();
	}
	
	
	public function db_save($input_array)
	{
		$CI =& get_instance();	
		$files_arr = Array();
		
		$my_img_arr = $_POST['m_images'];
		$del_img_arr = $_POST['del_img_m_images'];
		
		for ($i=0; $i < count ($my_img_arr); $i++)
		{
			if ($del_img_arr[$i] == '1') $CI->inside_lib->c7_delete_image($my_img_arr[$i], $input_array['folder']."/");
			else $files_arr[] = $my_img_arr[$i];
		}
		
		
			
		$config['upload_path'] = './files/uploads/'.$input_array['folder'].'/';
		
		$config['allowed_types'] = 'zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|avi|mpeg|mp3|mp4|3gp|gif|jpg|jpeg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '800';
		$config['max_height']  = '600';
		
		$CI->load->library('upload', $config);
		
		$files = $_FILES;
		if (isset ($_FILES['add_file']))
		{
			$cpt = count($_FILES['add_file']['name']);
			for($i=0; $i<$cpt; $i++)
			{

				$_FILES['add_file']['name']= $files['add_file']['name'][$i];
				$_FILES['add_file']['type']= $files['add_file']['type'][$i];
				$_FILES['add_file']['tmp_name']= $files['add_file']['tmp_name'][$i];
				$_FILES['add_file']['error']= $files['add_file']['error'][$i];
				$_FILES['add_file']['size']= $files['add_file']['size'][$i];    



			$CI->upload->initialize($config);
			if ($CI->upload->do_upload("add_file"))
			{
			$img_data = $CI->upload->data();
			$files_arr[] = $img_data['file_name'];
			}
			else {$err = $CI->upload->display_errors();}
			}
			
			
			
		}
		return json_encode($files_arr);
	}
}	
	