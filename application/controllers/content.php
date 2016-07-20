<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends Controller_Base {
	
	public $__load_default = true;
	
	public function al($alias) {
		

		$this->load->model('pages');
		$this->load->model('categories');
		$page_row = $this->pages->get_page_row_by_alias($alias);
		$this->data['content_tags_arr'] = $this->pages->get_content_tags_arr();
		$this->data['content_categories_arr'] = $this->categories->get_content_categories_arr();
		
		$this->data['page_row'] = $page_row;
		
		$this->data['comments_arr'] = $this->db->query("SELECT it_comments.*, users.img as avatar, users.email, users.first_name, users.username FROM 
															it_comments 
															LEFT JOIN users ON users.id = it_comments.comments_user_id
															WHERE comments_invisible != 1 AND comments_source = 1 AND comments_source_id = ".intval($page_row['content_id'])."
															ORDER BY comments_datetime DESC
															")->result_array();
			
		$this->data['options_arr'] = $this->pages->get_content_options($this->data['page_row']['content_id']);
		
		$this->data['info_block_arr'] = $this->pages->get_content_info_blocks($this->data['page_row']['content_id']);
		$this->data['buy_block_arr'] = $this->pages->get_content_buy_blocks($this->data['page_row']['content_id']);
		$this->data['images_arr'] = $this->pages->get_content_images($this->data['page_row']['content_id']);
		$this->data['links_arr'] = $this->pages->get_content_links($this->data['page_row']['content_id']);
		
		$this->data['seo_block_html'] = $this->pages->get_content_seo_block();

        $this->data['similar_pages_arr'] = $this->pages->similar_pages_list($this->data['page_row']['content_id']);

		$this->data['page_center'] = 'page';
		
		$this->data['seo_title'] = $this->data['page_row']['content_name'];
		$this->data['seo_description'] = $this->data['page_row']['content_name'];
		$this->data['seo_keywords'] = $this->data['page_row']['content_name'];
		
		if ($this->data['page_row']['content_seo_title'] != '') $this->data['seo_title'] = $this->data['page_row']['content_seo_title'];
		if ($this->data['page_row']['content_seo_description'] != '') $this->data['seo_description'] = $this->data['page_row']['content_seo_description'];
		if ($this->data['page_row']['content_seo_keywords'] != '') $this->data['seo_keywords'] = $this->data['page_row']['content_seo_keywords'];
		
		
		$this->__render();
	}
	
	public function ajax_add_comment() {
		$insert_arr['comments_source'] = '1';
		$insert_arr['comments_source_id'] = $this->input->post('page_id', TRUE);
		$insert_arr['comments_text'] = $this->input->post('comment', TRUE);
		$insert_arr['comments_invisible'] = '1';
		$insert_arr['comments_user_id'] = $this->data['user']->id;
		$insert_arr['comments_link'] = $this->input->post('page_url', TRUE);
		$insert_arr['comments_datetime'] = time() + (3600 * 3);
		$this->db->insert('it_comments', $insert_arr);
		echo '{"status":"success", "message": "<strong>Комментарий сохранен, он будет опубликован после модерации!</strong>"}';
		mail(
				'cd99@mail.ru', 
				'Новый комментарий: Страница - '.$insert_arr['comments_link'].", на Vizitka.iKiev.biz", 
				"<b>Text:</b> ".$insert_arr['comments_text']."<br /><br />
				<b>Time:</b> ".date("Y-m-d H:i:s").
				'<br /><br /><b>Ссылка: </b><a href="'.$insert_arr['comments_link'].'">'.$insert_arr['comments_link'].'</a>',				
				'Content-type: text/html; charset=utf-8'
				);
	}
	
	public function plist($page = false) {
		
		if ($page == 1) redirect ('/content/plist/', 301);
		if (!$page) $page = 1;
		
		$this->load->model('pages');
		$this->load->model('categories');
		$this->load->library('pagination');
		
		$this->data['catalog_tree'] = $this->inside_lib->make_tree_view($this->categories->get_tree_categories_arr(), false);
		$this->data['tags_arr'] = $this->pages->get_tags_list();
		$this->data['content_tags_arr'] = $this->pages->get_content_tags_arr();
		$this->data['content_categories_arr'] = $this->categories->get_content_categories_arr();

		$config['base_url'] = '/content/plist/';
		$config['total_rows'] = $this->pages->pages_count();
		
		$config['uri_segment'] = 3;	
		$config['per_page'] = 3; 
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
		$config['next_link'] = ' &#8594;';
        $config['next_tag_open'] = '<div class="page-navigation">';
        $config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&#8592; ';
		$config['prev_tag_open'] = '<div class="page-navigation">';
		$config['prev_tag_close'] = '</div>';
		$config['num_tag_open'] = '<div class="page-navigation">';
		$config['num_tag_close'] = '</div>';
		$config['first_tag_open'] = '<div class="page-navigation">';
		$config['first_tag_close'] = '</div>';
		$config['last_tag_open'] = '<div class="page-navigation">';
		$config['last_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<div class="page-navigation active">';
        $config['cur_tag_close'] = '</div>';
		
		$this->pagination->initialize($config); 

		$this->data['pagination'] = $this->pagination->create_links();
		
		
		$this->data['pages_list_arr'] = $this->pages->pages_list($page);
		
		
		$this->data['page_center'] = 'pages_list';
		
		$this->data['seo_title'] = 'Статьи';
		$this->data['seo_description'] = 'Статьи';
		$this->data['seo_keywords'] = 'Статьи';
		
		$this->__render();
	}
	

	
	public function category_list($alias, $page = false) {
		
		if ($page == 1) redirect ('/content/category_list/'.$alias.'/', 301);
		if (!$page) $page = 1;
		
		$this->load->model('pages');
		$this->load->library('pagination');
		$this->load->model('categories');
		
		$this->data['catalog_tree'] = $this->inside_lib->make_tree_view($this->categories->get_tree_categories_arr(), false);
		$this->data['tags_arr'] = $this->pages->get_tags_list();
		$this->data['content_tags_arr'] = $this->pages->get_content_tags_arr();
		$this->data['content_categories_arr'] = $this->categories->get_content_categories_arr();
		
		$this->data['category_row'] = $this->categories->get_categories_row($alias);

		$config['base_url'] = '/content/category_list/'.$alias.'/';
		$config['total_rows'] = $this->pages->pages_count_category_filter($alias);
		$config['uri_segment'] = 4;	
		$config['per_page'] = 3; 
		$config['use_page_numbers'] = TRUE;		
		$config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
		$config['next_link'] = ' &#8594;';
        $config['next_tag_open'] = '<div class="page-navigation">';
        $config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&#8592; ';
		$config['prev_tag_open'] = '<div class="page-navigation">';
		$config['prev_tag_close'] = '</div>';
		$config['num_tag_open'] = '<div class="page-navigation">';
		$config['num_tag_close'] = '</div>';
		$config['first_tag_open'] = '<div class="page-navigation">';
		$config['first_tag_close'] = '</div>';
		$config['last_tag_open'] = '<div class="page-navigation">';
		$config['last_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<div class="page-navigation active">';
        $config['cur_tag_close'] = '</div>';
		
		$this->pagination->initialize($config); 

		$this->data['pagination'] = $this->pagination->create_links();
		
		$this->data['pages_list_arr'] = $this->pages->pages_list_category_filter($alias, $page);
		
		
		$this->data['page_center'] = 'pages_list';

		$this->data['seo_title'] = $this->data['category_row']['categories_name'];
		$this->data['seo_description'] = $this->data['category_row']['categories_name'];
		$this->data['seo_keywords'] = $this->data['category_row']['categories_name'];		
		
		$this->__render();
	}
	
	public function tag_list($tag, $page = false) {
		
		if ($page == 1) redirect ('/content/tags_list/'.$tag.'/', 301);
		if (!$page) $page = 1;
		
		$this->load->model('pages');
		$this->load->library('pagination');
		$this->load->model('categories');
		
		$this->data['catalog_tree'] = $this->inside_lib->make_tree_view($this->categories->get_tree_categories_arr(), false);
		$this->data['tags_arr'] = $this->pages->get_tags_list();
		$this->data['content_tags_arr'] = $this->pages->get_content_tags_arr();
		$this->data['content_categories_arr'] = $this->categories->get_content_categories_arr();

		$this->data['filter_tag'] = $tag;

		$res = $this->db->get_where('it_tags', array('tags_name' => urldecode($tag)))->result_array();
		$this->data['tag_row'] = $res[0];
		
		$config['base_url'] = '/content/tag_list/'.$tag.'/';
		$config['total_rows'] = $this->pages->pages_count_tags_filter($tag);
		$config['per_page'] = 3;

		$config['uri_segment'] = 4;			
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '';
        $config['full_tag_close'] = '';
		$config['next_link'] = ' &#8594;';
        $config['next_tag_open'] = '<div class="page-navigation">';
        $config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&#8592; ';
		$config['prev_tag_open'] = '<div class="page-navigation">';
		$config['prev_tag_close'] = '</div>';
		$config['num_tag_open'] = '<div class="page-navigation">';
		$config['num_tag_close'] = '</div>';
		$config['first_tag_open'] = '<div class="page-navigation">';
		$config['first_tag_close'] = '</div>';		
		$config['last_tag_open'] = '<div class="page-navigation">';
		$config['last_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<div class="page-navigation active">';
        $config['cur_tag_close'] = '</div>';
		
		$this->pagination->initialize($config); 

		$this->data['pagination'] = $this->pagination->create_links();
		
		$this->data['pages_list_arr'] = $this->pages->pages_list_tags_filter(urldecode($tag), $page);
		
		
		$this->data['page_center'] = 'pages_list';

		$this->data['seo_title'] = 'Тег - '.urldecode($tag);
		$this->data['seo_description'] = 'Тег - '.urldecode($tag);
		$this->data['seo_keywords'] = 'Тег - '.urldecode($tag);	
		
		$this->__render();
	}

}

?>