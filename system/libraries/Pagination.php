<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class CI_Pagination {

    

    private $total_rows = 0;

    private $total_pages = 0;

    private $cur_page = 1;

    private $rows_per_page ;

    private $url = '';

    private $first_row;

    private $model;

    

    private $link_pages_list = '<ul class="pagination">...</ul>';

    private $link_page_item = '<li>...</li>';

    private $link_selected_page_item = '<li class="active">...</li>';

    private $link_previous_page = '<li class="previous">...</li>';

    private $link_previous_page_off = '<li class="previous-off">...</li>';

    private $link_next_page = '<li class="next">...</li>';

    private $link_next_page_off = '<li class="next-off">...</li>';

    

    function __construct() {

        $this->rows_per_page = defined('PAGINATION_ROWS_PER_PAGE') ? PAGINATION_ROWS_PER_PAGE : 10;

    }

    

    function __get($name) {

        

        if ($name == 'first_row') {

            $this->first_row = $this->rows_per_page * ($this->cur_page - 1);

        }

        

        return $this->{$name};

    }

    

    function __set($name, $value) {

        

        $properties = array('total_rows', 'cur_page', 'rows_per_page', 'url',

            'link_pages_list', 'link_page_item', 'link_selected_page_item',

            'link_previous_page', 'link_previous_page_off', 'link_next_page',

            'link_next_page_off');

        

        if (in_array($name, $properties)) {

            $this->{$name} = $value;

        }

        

        if ($name == 'cur_page') {

            $value = $value && (int)$value > 0 ? $value : 1;

            

            if ($this->total_pages && $value > $this->total_pages)

                $value = $this->total_pages;

            

            $this->cur_page = $value;

            

            if ($this->model && is_subclass_of($this->model, 'CI_Model')) {

                

                $this->model->setRowPos($this->__get('first_row') - 1);

                $this->model->setMaxFetch($this->first_row + $this->rows_per_page - 1);

                

            }

        }

        elseif ($name == 'total_rows') {

            $this->total_rows = $value && (int)$value > 0 ? $value : 0;

            $this->total_pages = ceil($this->total_rows / $this->rows_per_page);

        }

        

    }

    

    function setModel(&$model = null) {

        

        if ($model && is_subclass_of($model, 'CI_Model')) {

            

            $this->model =& $model;

            $this->__set('total_rows', $model->countRows());

            

        }

        

    }

    

    function create_links() {

        

        $link = "";

        

        $url = removeQueryString($this->url, PAGINATION_QUERY_STRING_SEGMENT);

        $url = appendQueryString($url, PAGINATION_QUERY_STRING_SEGMENT);

        

        //$url = strpos('?', $this->url) ? $this->url.'&amp;'.PAGINATION_QUERY_STRING_SEGMENT.'=' : $this->url.'?'.PAGINATION_QUERY_STRING_SEGMENT.'=';

        

        if ($this->total_pages > 1) {

            

            // Previous button

            if ($this->cur_page > 1) {

                $str = str_replace('...', '<a href="'.$url.($this->cur_page-1).'" title="'.lang('txt_previous_page').'">'.lang('txt_previous').'</a>', $this->link_previous_page);

                $link .= $str;

            }

            else {

                $str = str_replace('...', lang('txt_previous'), $this->link_previous_page_off);

                $link .= $str;

            }

            

            // First page

            if ($this->cur_page == 1)

                $str = str_replace('...', '1', $this->link_selected_page_item);

            else

                $str = str_replace('...', '<a href="'.$url.'1" title="'.lang('txt_page').' 1">1</a>', $this->link_page_item);

            

            $link .= $str;

                

            if($this->total_pages > 6){

            $pages_generated = PAGINATION_DIGIT_PAGES_DISPLAYED; // (All pages excepted first and last page)

            

            $min_page = $this->cur_page - ceil($pages_generated / 2);

            

            if ($min_page > 2)

                $link .= str_replace('...', '......', $this->link_page_item);

            else

                $min_page = 2;

            

            $max_page = $min_page + $pages_generated;

            

            if ($max_page >= $this->total_pages) {

                $max_page = $this->total_pages;

                $min_page = $max_page - $pages_generated;

            }

            

            // Pages

            for ($i = $min_page; $i < $max_page; $i++) {

                

                if ($this->cur_page == $i)

                    $str = str_replace('...', $i, $this->link_selected_page_item);

                else

                    $str = str_replace('...', '<a href="'.$url.$i.'" title="'.$i.'">'.$i.'</a>', $this->link_page_item);

                    

                $link .= $str;

                    

            }

            

            if ($max_page < $this->total_pages)

                $link .= str_replace('...', '......', $this->link_page_item);

            }

            else{

                for($i = 2; $i<$this->total_pages; $i++){

                    $str = str_replace('...', '<a href="'.$url.$i.'" title="'.$i.'">'.$i.'</a>', $this->link_page_item);                

                    if($this->cur_page == $i){

                    $str = str_replace('...', $i, $this->link_selected_page_item);

                    }

                    $link .=$str;

                }

                

            }

                        // Last page

            if ($this->cur_page == $this->total_pages)

                $str = str_replace('...', $this->total_pages, $this->link_selected_page_item);

            else

                $str = str_replace('...', '<a href="'.$url.$this->total_pages.'" title="'.lang('txt_page').' '.$this->total_pages.'">'.$this->total_pages.'</a>',  $this->link_page_item);

                

            $link .= $str;

                        // Next page

            if ($this->cur_page < $this->total_pages) {

                $str = str_replace('...', '<a href="'.$url.($this->cur_page + 1).'" title="'.lang('txt_next_page').'">'.lang('txt_next').'</a>', $this->link_next_page);

                $link .= $str;

            }

            else {

                $str = str_replace('...', lang('txt_next'), $this->link_next_page_off);

                $link .= $str;

            }

            $link = str_replace('...', $link, $this->link_pages_list);

        }

        

        

        return $link;

    }

    

}