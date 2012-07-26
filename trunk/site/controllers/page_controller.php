<?php

class Page_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function the_page($link = '') {
        if ($link != '') {
            $Webpage = new WebPage();
            $info = $Webpage->getPage($link);
            if (empty($info) || $info->countRows() == 0) {
                redirect('index');
            }
            
            
            $info->fetchNext();
            $data['content'] = 'webpage';
            $data['page'] = $info->get_web_page_content();
            
            $data['title_page'] = $info->get_web_page_title();
            $data['description'] = $info->get_web_page_meta_description();
            $data['keywords'] = $info->get_web_page_keywords();
            
            $data['selected'] = $link;
            $filter = array();
            $array_menus = array();

            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);
            $data['array_menus'] = $array_menus;

            $this->load->view('temp', $data);
        } else {
            redirect(Variable::getDefaultPageString());
        }
    }

}
