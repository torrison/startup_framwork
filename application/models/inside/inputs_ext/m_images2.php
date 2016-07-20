<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Images2 {


    public function input_form ($input_array)
    {

        if ($input_array['make_type'] == 'copy') $input_array['value'] = '';

        $CI =& get_instance();
        ob_start();

        if (@$input_array['value'] != '') {

            $images = json_decode($input_array['value']);

            foreach ($images as $img) {
                ?>
                <a href="/files/uploads/<?=$input_array['folder']?>/<?=$img?>" target="_blank">files/uploads/<?=$input_array['folder']?>/<?=$img?></a>
                <input name="del_img_m_images[]" type="checkbox" value="<?=$img?>">Del?
                <input name="m_images[]" type="hidden" value="<?=$img?>">
                <br/>
            <?php
            }
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

        $my_img_arr = @$_POST['m_images'];
        $del_img_arr = @$_POST['del_img_m_images'];

        print_r($my_img_arr);
        print_r($del_img_arr);

        for ($i=0; $i < count($my_img_arr); $i++)
        {
            $no_del = true;
            for ($j=0; $j < count($del_img_arr); $j++)
            {
                if ($del_img_arr[$j] == $my_img_arr[$i]) {
                    $CI->inside_lib->c7_delete_image($my_img_arr[$i], $input_array['folder']."/");
                    $no_del = false;
                }

            }
            if ($no_del) $files_arr[] = $my_img_arr[$i];



        }


        /*
        $config['upload_path'] = './files/uploads/'.$input_array['folder'].'/';

        $config['allowed_types'] = 'zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|avi|mpeg|mp3|mp4|3gp|gif|jpg|jpeg|png';
        $config['max_size']	= '500';
        $config['max_width']  = '800';
        $config['max_height']  = '600';

        $CI->load->library('upload', $config);
        */


        if (isset ($_FILES['add_file']))
        {
            $CI->load->library('image_lib');

            $cpt = count($_FILES['add_file']['name']);
            for($i=0; $i<$cpt; $i++)
            {


                $_FILES['add_file_now']['name']= $_FILES['add_file']['name'][$i];
                $_FILES['add_file_now']['type']= $_FILES['add_file']['type'][$i];
                $_FILES['add_file_now']['tmp_name']= $_FILES['add_file']['tmp_name'][$i];
                $_FILES['add_file_now']['error']= $_FILES['add_file']['error'][$i];
                $_FILES['add_file_now']['size']= $_FILES['add_file']['size'][$i];

                $folder = $input_array['folder'].'/';
                $tmp_name = 'add_file_now';
                $config = Array();
                $CI->image_lib->clear();


                $_FILES[$tmp_name]['name'] = $CI->inside_lib->C7_fs_file_upload ($_FILES[$tmp_name]['tmp_name'], $_FILES[$tmp_name]['name'], "/files/uploads/".$folder);


                if ($_FILES[$tmp_name]['name'])   $files_arr[] = $_FILES[$tmp_name]['name']; // Add File to Array


                print_r($_FILES['add_file_now']);

                if (isset($input_array['resize'])) {

                    $path_to_image = $_SERVER["DOCUMENT_ROOT"]."/files/uploads/".$folder.$_FILES[$tmp_name]['name'];
                    list($width, $height) = getimagesize($path_to_image);

                    echo $width." x ".$height." !!!";

                    if (isset($input_array['new_width'])) $new_width = intval($input_array['new_width']);
                    else $new_width = 200;

                    if (isset($input_array['new_height'])) $new_height = intval($input_array['new_height']);
                    else $new_height = 200;

                    $config['height'] = $new_height;
                    $config['width'] = $new_width;

                    if (!empty($input_array['crop_center'])) {

                        $config_by_width ['width'] = $new_width;
                        $config_by_width ['height'] = '800';
                        $config_by_width ['master_dim'] = 'width';
                        $config_by_width ['y_axis'] = round(($height*$new_width/$width - $new_height)/2);
                        $config_by_width ['x_axis'] = 0;

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
                        if (!empty($input_array['resize_by_width'])) {
                            $config['master_dim'] = 'width';
                        }
                        elseif (!empty($input_array['resize_by_height'])) {
                            $config['master_dim'] = 'height';
                        }
                        else {}
                    }



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


                }

            }
        }
        print_r($files_arr);
        return json_encode($files_arr);
    }
}
