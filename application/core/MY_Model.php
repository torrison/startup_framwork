<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

}

class Model_Base extends CI_Model {

    public $__load_default = false;

    public $config = array();

    public function __construct() {

        parent::__construct();

        if($this->__load_default){
            $this->__load_default();

        }

    }

    public function __load_default() {

        $this->config['table'] = "it_content";

        $this->config['id_column'] = "content_id";
        $this->config['name_column'] = "content_name";
        $this->config['desc_column'] = "content_desc";
        $this->config['img_column'] = "content_img";
        $this->config['invisible_column'] = "content_invisible";
        $this->config['priority_column'] = "content_priority";

        $this->config['ext_where'] = "AND content_type = 1";

        $this->config['img_files_folder'] = "/files/uploads/content_img/";

        $this->config['max_on_page'] = 10;

    }

    public function get_config() {
        return $this->config;
    }

    public function set_config_var($variable, $value) {
        $this->config[$variable] = $value;
    }

    public function get_array() {

        $max_on_page = $this->config['max_on_page'];
        $ext_where = $this->config['ext_where'];

        if (isset($_GET['list_page'])) $limit = " LIMIT ".$max_on_page*intval($_GET['list_page']).", ".$max_on_page;
        else $limit = '';

        $query = $this->db->query("SELECT *
									FROM ".$this->config['table']."
									WHERE ".$this->config['invisible_column']."  != 1
									{$ext_where}
									ORDER BY ".$this->config['priority_column']." ASC, ".$this->config['id_column']." DESC
									{$limit}
									");

        return $query->result_array();
    }

}