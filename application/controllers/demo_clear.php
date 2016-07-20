<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demo_Clear extends CI_Controller
{

    public function test($id = 0)
    {

        $data['id'] = $id;
        $data['page_center'] = 'demo';

        $data['seo_title'] = 'Demo Page';
        $data['seo_description'] = 'SEO blocks';
        $data['seo_keywords'] = 'demo';

        $this->load->view('outside/pages/demo', $data);

    }

}
		
