<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Demo extends Controller_Base
{

    public $__load_default = true;

    public function test($id = 0)
    {

        $this->data['id'] = $id;
        $this->data['page_center'] = 'demo';

        $this->data['seo_title'] = 'Demo Page';
        $this->data['seo_description'] = 'SEO blocks';
        $this->data['seo_keywords'] = 'demo';

        $this->__render();
    }

}
		
