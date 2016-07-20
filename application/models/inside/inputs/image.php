<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Image {


	public function input_form($input_array)
	{
		if ($input_array['make_type'] == 'copy') $input_array['value'] = '';
		return $this->input_file_img ($input_array['name'], $input_array['value'],$input_array['folder']);
	}

	// OLD Stable Function
	public function input_file_img($name, $row_img = NULL, $img_folder = NULL){
		$data='';
		if (isset($row_img)&&($row_img != ""))
		{  	if (isset($img_folder)) $link_folder = $img_folder."/";

			if ($row_img == "error_file") $data .= "<font color=\"darkred\">pics/".$link_folder.$row_img."</font>";
			else $data .= "<a href=\"/files/uploads/".$link_folder.$row_img."\" target=\"_blank\">files/pics/".$link_folder.$row_img."</a>";
			$data .= "
			<input name=\"del_img_".$name."\" type=\"checkbox\" value=\"1\">Del?
			<input name=\"".$name."\" type=\"hidden\" value=\"".$row_img."\">
			";

			if (isset($img_folder)) $data .= "<input name=\"".$name."_folder\" type=\"hidden\" value=\"".$img_folder."\">";
		}
		else
		{  	$data = "
		<input type=\"file\" name=\"".$name."\" id=\"".$name."\" class=\"input\" style=\"width:350px;\" value=\"".$row_img."\">
		";
			if (isset($img_folder)) $data .= "<input name=\"".$name."_folder\" type=\"hidden\" value=\"".$img_folder."\">";
		}
		return $data;
	}
	public function db_save($input_array)
	{
		$CI =& get_instance();
		$tmp_name = $input_array['name'];

		// echo $_FILES[$tmp_name]['name'];

		// Check folder change
		if (isset ($input_array['folder'])) $folder = $input_array['folder']."/";
		else $folder = "";
		// Update File System!
		if (isset($_POST['del_img_'.$tmp_name]))
		{
			$CI->inside_lib->c7_delete_image($_POST[$tmp_name], $folder);
			return '';
		}
		else if (isset($_FILES[$tmp_name]['name']))
		{
			$_FILES[$tmp_name]['name'] = $CI->inside_lib->C7_fs_file_upload ($_FILES[$tmp_name]['tmp_name'], $_FILES[$tmp_name]['name'], "/files/uploads/".$folder);



			if (isset($input_array['resize'])) {

				$CI->load->library('image_lib');

				$path_to_image = $_SERVER["DOCUMENT_ROOT"]."/files/uploads/".$folder.$_FILES[$tmp_name]['name'];
				list($width, $height) = getimagesize($path_to_image);

				echo $width." x ".$height." !!!";

				if (isset($input_array['new_width'])) $new_width = intval($input_array['new_width']);
				else $new_width = 200;

				if (isset($input_array['new_height'])) $new_height = intval($input_array['new_height']);
				else $new_height = 200;

				$config = Array();
				$config['height'] = $new_height;
				$config['width'] = $new_width;

				if (!empty($input_array['crop_center'])) {

					$config_by_width = Array();
					$config_by_width ['width'] = $new_width;
					$config_by_width ['height'] = '800';
					$config_by_width ['master_dim'] = 'width';
					$config_by_width ['y_axis'] = round(($height*$new_width/$width - $new_height)/2);
					$config_by_width ['x_axis'] = 0;

					$config_by_height = Array();
					$config_by_height['height'] = $new_height;
					$config_by_height['width'] = '800';
					$config_by_height['master_dim'] = 'height';
					$config_by_height['x_axis'] = round(($width*$new_height/$height - $new_width)/2);
					$config_by_height['y_axis'] = 0;


					$config = $config_by_width;
					$tmp_height = $height*$new_width/$width;
					if ($tmp_height < $new_height) $config = $config_by_height;


				}
				else {
					if (isset($input_array['resize_by_width'])) {
						$config['master_dim'] = 'width';
					}
					elseif (isset($input_array['resize_by_height'])) {
						$config['master_dim'] = 'height';
					}
					else {}
				}

				print_r($config);

				echo "Do Resize for: ".$path_to_image;
				$config['image_library'] = 'gd2';
				$config['source_image']	= $path_to_image;
				// $config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$CI->image_lib->initialize($config);
				if ( ! $CI->image_lib->resize())
				{
					echo $CI->image_lib->display_errors();
				}

				$config['maintain_ratio'] = FALSE;
				$config['width'] = $new_width;
				$config['height'] = $new_height;

				$CI->image_lib->initialize($config);

				if (isset($input_array['crop_center'])) { if ($input_array['crop_center']) {

					if ( ! $CI->image_lib->crop())
					{
						echo $CI->image_lib->display_errors();
					}

				} }
				$CI->image_lib->clear();
			}
			return $_FILES[$tmp_name]['name'];

		}
		else return $input_array['value'];
	}

}

?>
	