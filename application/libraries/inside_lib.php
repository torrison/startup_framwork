<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Inside library
 *  
 * @author Alex Torrison
 */
class Inside_lib {

    /**
     * Constructor
     */
    public function __construct($config = array()) {
        log_message('debug', "Inside_lib Class Initialized");
    }

	// Input Model Loader
	public function make_input ($part, $input_array)
	{		
		if (isset($input_array['input_type']))
		{
			if (!isset($input_array['width'])) $input_array['width'] = 400;
			$type = $input_array['input_type'];
			$type = str_replace("-", "_", $type); // Fix Minus to C++ style
			$model_name = "make_input_".$type;
			$CI =& get_instance();
			
			if(file_exists(APPPATH.'models/inside/inputs/'.$type.'.php')){
				$CI->load->model('inside/inputs/'.$type, $model_name);
				
				if (method_exists($CI->$model_name, $part))	
					return $CI->$model_name->$part($input_array);
				else if ($part == "input_filter") {
					$input_array['width'] = 100;
					return $CI->$model_name->input_form($input_array)."<br />\n"; // Default input for form
				}
				else if ($part == "db_save") {
					return $input_array['value']; // Default value without changes
				}
				else if ($part == "crud_view") {
					return $input_array['value']; // Default value without changes
				}
			}
			elseif (file_exists(APPPATH.'models/inside/inputs_ext/'.$type.'.php')){
				$CI->load->model('inside/inputs_ext/'.$type, $model_name);
				if (method_exists($CI->$model_name, $part))	
					return $CI->$model_name->$part($input_array);
				else if ($part == "input_filter") {
					$input_array['width'] = 100;
					return $CI->$model_name->input_form($input_array)."<br />\n"; // Default input for form
				}
				else if ($part == "db_save") {
					return $input_array['value']; // Default value without changes
				}
				else if ($part == "crud_view") {
					return $input_array['value']; // Default value without changes
				}
			}
			else return "File not found: ".APPPATH.'models/inside/inputs/'.$type.'.php';
		}
	}
	
	// Input Model Loader
	public function make_rel_input ($part, $input_array, $cell_id)
	{		
		if (isset($input_array['input_type']))
		{
			if (!isset($input_array['width'])) $input_array['width'] = 500;
			$type = $input_array['input_type'];
			$type = str_replace("-", "_", $type); // Fix Minus to C++ style
			$model_name = "make_rel_input_".$type;
			$CI =& get_instance();
			
			if(file_exists(APPPATH.'models/inside/inputs_rel/'.$type.'.php')){
			$CI->load->model('inside/inputs_rel/'.$type, $model_name);
			return $CI->$model_name->$part($input_array, $cell_id);
			}
			elseif (file_exists(APPPATH.'models/inside/inputs_rel_ext/'.$type.'.php')){
			$CI->load->model('inside/inputs_rel_ext/'.$type, $model_name);
			return $CI->$model_name->$part($input_array, $cell_id);
			}
			else return "File not found: ".APPPATH.'models/inside/inputs_rel/'.$type.'.php';
		}
	}
	
	// ------------------------------------------------------------------------------ Defent Filter -------------	
	public function defend_filter ($defendtype, $data)
	{

	if ($defendtype == "1") {   // For Guest
	$data = str_replace ("&","&amp;",$data);
	$data = str_replace ("'","&#8217;",$data);
	$data = str_replace ("<","&lt;",$data);
	$data = str_replace (">","&gt;",$data);
	$data = str_replace ("\"","&quot;",$data);
	$data = str_replace (">","&gt;",$data);
	//$data = mysql_escape_string($data);
	//$data = str_replace ("\\\"","&quot;",$data);
	}


	if ($defendtype == "2") {   // For Admin
	$data = str_replace ("'","&#8217;",$data);
	//$data = mysql_escape_string($data);
	}

	if ($defendtype == "3") {   // For Forms
	$data = str_replace ("&","",$data);
	$data = str_replace ("<","",$data);
	$data = str_replace (">","",$data);
	$data = str_replace ("\"","",$data);
	$data = str_replace ("'","",$data);
	}

	if ($defendtype == "4") {   // For string, which works in filesystem functions
	$data = preg_replace("/[^a-z0-9_.]/i", "1", $data);
	}

	if ($defendtype == "5") {   // For integer
	$data = intval($data);
	}

	if ($defendtype == "6") {   // For Files
	$data = str_replace ("<","",$data);
	$data = str_replace (">","",$data);
	$data = str_replace ("\"","",$data);
	$data = str_replace ("\\","",$data);
	$data = str_replace ("/","",$data);
	$data = str_replace ("'","",$data);

	}

	if ($defendtype == "7") {   // For Developers
	$data = str_replace ("'","''",$data);
	}

	if ($defendtype == "8") {   // For Guest Chat
	$data = str_replace ("&","&amp;",$data);
	$data = str_replace ("'","&#8217;",$data);
	$data = str_replace ("<","&lt;",$data);
	$data = str_replace (">","&gt;",$data);
	$data = str_replace ("\n","<br />",$data);
	$data = mysql_escape_string($data);
	}
	
	if ($defendtype == "9") {   // For Integer
	$data = intval ($data);
	}
	
	if ($defendtype == "A") {   // No Filter
	$data = $data;
	}


	return $data;
	}
	
	// Defent Array [] {} etc. to string
	public function C7_defend_array ($defendtype, $array)
	{
    for ($i=0;$i<count($array); $i++)
		{
				$array[$i] = $this->defend_filter ($defendtype, $array[$i]);
		}
	return $array;
	}
	
	//------------------------------------------------------------------------------  File System Functions ---------------------
	
	public function C7_fs_file_upload($filetmp, $filename, $path)
	{

			if ($filetmp != "")
			{
			#DEBUG echo  "<script>alert('".$_FILES[$input_name]["name"]." ready!')</script>\n";
			$new_file_name = $this->C7_fs_is_exists_file ($filename, $path);
			#DEBUG echo  "<script>alert('".$new_file_name." готов!')</script>\n";
			move_uploaded_file($filetmp, $_SERVER["DOCUMENT_ROOT"].$path.$new_file_name);
			// if ($GLOBALS['debug_mode'] == true) echo  "<script>alert('".$_SERVER["DOCUMENT_ROOT"].$path.$new_file_name." saved!')</script>\n";
			#DEBUG echo  "<script>alert('".$_SERVER["DOCUMENT_ROOT"].$path.$new_file_name." saved!')</script>\n";
			#DEBUG echo  "<script>alert('".$_FILES[$input_name]["tmp_name"]." saved!')</script>\n";
				if ($this->C7_fs_file_check($new_file_name, $path)) return $new_file_name;
				else
				{
				rename ($_SERVER["DOCUMENT_ROOT"].$path.$new_file_name, $_SERVER["DOCUMENT_ROOT"].$path."error_file");
				return "error_file";
				}
			}

	}

	//Check file if exists and give new name if it is copy.
	public function C7_fs_is_exists_file ($filename, $path)
	{
		   $i = 0;
		   $new_file_name = $filename;
		   $unique_name_find = false;
		   while ($unique_name_find != true) {
			 if (file_exists($_SERVER["DOCUMENT_ROOT"].$path.$new_file_name))
			 {
			   $new_file_name = "copy".$i."_".$filename;
			 }
			 else {$unique_name_find = true;}
			 $i++;
		   }
		   return $new_file_name;
	}

	// Fast Write data to file
	public function write_in_file ($filename, $data)
	{
		$filename = $this->C7_fs_stripfilename($filename);
		if ( is_writeable($filename) ) :
		$fh = fopen($filename, "a+");
		fwrite($fh, $data);
		fclose($fh); else :
		print "Could not open $filename for writing";
		endif;
		return true;
	}

	// Files Defend Filter
	public function C7_fs_file_check ($new_file_name, $path)
	{
	  $file_ok = false;
	  if (preg_match("/.png/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.jpg/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.jpeg/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.bmp/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.gif/i",$new_file_name)) $file_ok = true;

	  if ( ($file_ok == true) && ($this->C7_fs_verify_image($_SERVER["DOCUMENT_ROOT"].$path.$new_file_name)) ) $file_ok = true;

	  if (preg_match("/.doc/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.xls/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.txt/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.docx/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.xlsx/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.psd/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.ppt/i",$new_file_name)) $file_ok = true;
	  if (preg_match("/.pptx/i",$new_file_name)) $file_ok = true;

	  if ($file_ok == true) return true;
	  else return false;
	}

	// Scan image files for malicious code
	public function C7_fs_verify_image($file) {
		$txt = file_get_contents($file);
		$image_safe = true;
		if (preg_match('#&(quot|lt|gt|nbsp|<?php);#i', $txt)) { $image_safe = false; }
		elseif (preg_match("#&\#x([0-9a-f]+);#i", $txt)) { $image_safe = false; }
		elseif (preg_match('#&\#([0-9]+);#i', $txt)) { $image_safe = false; }
		elseif (preg_match("#([a-z]*)=([\`\'\"]*)script:#iU", $txt)) { $image_safe = false; }
		elseif (preg_match("#([a-z]*)=([\`\'\"]*)javascript:#iU", $txt)) { $image_safe = false; }
		elseif (preg_match("#([a-z]*)=([\'\"]*)vbscript:#iU", $txt)) { $image_safe = false; }
		elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*expression\([^>]*>#iU", $txt)) { $image_safe = false; }
		elseif (preg_match("#(<[^>]+)style=([\`\'\"]*).*behaviour\([^>]*>#iU", $txt)) { $image_safe = false; }
		elseif (preg_match("#</*(applet|link|style|script|iframe|frame|frameset)[^>]*>#i", $txt)) { $image_safe = false; }
		return $image_safe;
	}

	// Strip file name
	public function C7_fs_stripfilename($filename) {
		$filename = strtolower(str_replace(" ", "_", $filename));
		$filename = preg_replace("/^\W/", "", $filename);
		$filename = preg_replace('/([_-])\1+/', '$1', $filename);
		$filename = str_replace ("//","_",$filename);
		if ($filename == "") { $filename = "emptyfile"; }

		return $filename;
	}

	// Delete File
	public function c7_delete_image($name, $folder = "", $access = true)
	{
	$name = $this->C7_defend_array("6", $name);
	if ($access)
	  {
	  if (isset($name))
		{
		unlink($_SERVER["DOCUMENT_ROOT"]."/files/uploads/".$folder.$name);
		}
	  }
	 //echo "<script>alert('".$_SERVER["DOCUMENT_ROOT"]."/files/uploads/".$folder.$name."111')</script>";
	}



	// Advanced: Get User Data
	public function get_user_info($user_id)
	{
		$CI =& get_instance();
		$array['id'] = $user_id;

		// Find User Name
		$query = $CI->db->query("SELECT * FROM users WHERE id = ".$user_id);
		$res = $query->result_array();	
		foreach ($res as $row) {$array['users'] = $row;}

		// Find Groups
		$query = $CI->db->query("SELECT * FROM users_groups LEFT JOIN groups ON users_groups.group_id = groups.id"." WHERE user_id = ".$user_id);	
		$array['groups'] = $query->result_array();
		return $array;
	}
	
	// Advanced: Get User Data
	public function make_tree_view($res, $columns = false, $lang_prefix = '', $ul_attr = '')
	{
		if (!$columns)
		{
			$id_column = 'categories_id';
			$pid_column = 'categories_pid';
			$name_column = 'categories_name';
			$haschild_column = 'categories_haschild';
			$invisible_column = 'categories_invisible';
			$url_column = 'categories_alias';
			$url_prefix = $lang_prefix.'/content/category_list/';
			$data_prefix = "- ";
		}
		else
		{
			$id_column = $columns['id_column'];
			$pid_column = $columns['pid_column'];
			$name_column = $columns['name_column'];
			$haschild_column = $columns['haschild_column'];
			$invisible_column = $columns['invisible_column'];
			$url_column = $columns['url_column'];
			$url_prefix = $lang_prefix.$columns['url_prefix'];
			$data_prefix = $columns['data_prefix'];
		}
		
		
		$prefix_count = 0;
		
		$data = "\n<div class=\"tree_container\"><ul".$ul_attr.">\n";

		$catalog_tree = $res;
		$count = count($catalog_tree);
		$i=0;                      // Reset $i
		#$limit = 0;			   // Defend counter for Debuging
		$parent_step = 0;          // Start in parent_id = 0
		$parent[$parent_step] = 0; // Parent to Child Step Array
		$now_output = array();     // Array for ouput printing data
		while ($i <= $count)
		{
		   #$data .= "{".$catalog_tree[$i]['parent_id']."<< = >>".$parent[$parent_step]."}"; #Debuging echo
		   $now_output_signal = false; #reset now output signal

		 if (@$catalog_tree[$i][$invisible_column] == 1)
		 {
		 array_push($now_output, $catalog_tree[$i][$id_column]);
		 $i++;
		 }
		 else
		 {

		   for ($j=0;$j<count($now_output);$j++)
		   {
			if (@$catalog_tree[$i][$id_column] == $now_output[$j]) {$now_output_signal = true; break;} #Check for ouput printing data
		   }

		  if ((@$catalog_tree[$i][$pid_column] == $parent[$parent_step])&&(@$catalog_tree[$i][$id_column] > 0)) #if id has parent_id in current parent level (start in 0)
		  {
			 if ($catalog_tree[$i][$haschild_column] == 1) #For HasChild Line
			 {
			 if ($now_output_signal == false) #if id has not printed
				{
					$parent_step++;
					$parent[$parent_step] = $catalog_tree[$i][$id_column];

				if ($catalog_tree[$i][$haschild_column] == 1)
					{
					$catalog_tree[$i][$id_column] = $catalog_tree[$i][$id_column]."p";
					}
				$data .= "<li>".str_repeat($data_prefix,$prefix_count)."<a href=\"".$url_prefix.$catalog_tree[$i][$url_column]."\" title=\"".$catalog_tree[$i][$name_column]."\">".$catalog_tree[$i][$name_column]."</a><ul>\n";

				array_push($now_output, $catalog_tree[$i][$id_column]);
				$i=0; #parent step+1, new parent has added, if not empty, data printed, prefix+1 "->" , array push printed id!. Start again.
				$prefix_count++;
				}
			 }
			 else
			 {
				if ($now_output_signal == false) #if id has not printed
				{
				$data .= "<li>".str_repeat($data_prefix,$prefix_count)."<a href=\"".$url_prefix.$catalog_tree[$i][$url_column]."\" title=\"".$catalog_tree[$i][$name_column]."\">".$catalog_tree[$i][$name_column]."</a>\n</li>";
				array_push($now_output, $catalog_tree[$i][$id_column]);
				}
			 }
		  }
		   if ($i == $count) {$i=0;$parent_step--; $prefix_count--; $data .= "</ul></li>";} #step left in prefix way in the end of data
		   $i++;
		   #$limit++; if ($limit == 260) $i = $tree_i+5; # Defend system for ulimited while
		   if (!isset($parent[$parent_step])) $i = $count+5; #The End Of While, Bacause Step = -1
		 }
		}

		$data = substr($data, 0, strlen($data)-10);
		$data .= "</ul></div>\n";
		return $data;
	}
	public function random_password()
	{
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";		
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {$n = rand(0, $alphaLength);$pass[] = $alphabet[$n];}
        return implode($pass);
	}
	
}
