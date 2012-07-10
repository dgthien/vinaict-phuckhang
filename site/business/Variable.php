<?php

class Variable {
    // URL VARIABLES AND PAGING
    // SESSION VARIABLES
    function __construct() {
        
    }
    
    
    // SETTING MAILER AND HOST AND DOMAIN
    
    public function getDomainName(){
        return defined('DOMAIN_NAME') ? DOMAIN_NAME : base_url() . '/' . Variable::getDefaultPageString();
    }
    
    /***************************************************************/
    /******************** DEFAULT PAGE******************************/
    /***************************************************************/
    public function getDefaultPageString(){
        return defined('SITE_PAGE_DEFAULT_STRING') ? SITE_PAGE_DEFAULT_STRING : 'index';
    }
    
    
    /***************************************************************/
    /*******************VARRIABLE PAGES*****************************/
    /***************************************************************/
    
    
    // index page string route
    public function getIndexPageString(){
        return defined('SITE_PAGE_INDEX_STRING') ? SITE_PAGE_INDEX_STRING : 'index';
    }
    
    // page page string route
    public function getPagePageString(){
        return defined('SITE_PAGE_PAGE_STRING') ? SITE_PAGE_PAGE_STRING : 'page';
    }
    
    
    // product page string route
    public function getProductPageString(){
        return defined('SITE_PAGE_PRODUCT_STRING') ? SITE_PAGE_PRODUCT_STRING : 'products';
    }
    
    // product page string route
    public function getProductOrderPageString(){
        return defined('SITE_PAGE_PRODUCT_ORDER_STRING') ? SITE_PAGE_PRODUCT_ORDER_STRING : 'order';
    }
    
    //product contact
    public function getProductContactPageString(){
        return defined('SITE_PAGE_PRODUCT_CONTACT_STRING') ? SITE_PAGE_PRODUCT_CONTACT_STRING : 'contact-us';
    }
    
    // product list cart 
    public function getProductListCartPageString(){
        return defined('SITE_PAGE_PRODUCT_LIST_CART_STRING') ? SITE_PAGE_PRODUCT_LIST_CART_STRING : 'list-cart';
    }
    
    
    // product search string 
    public function getProductPageSearchString(){
        return defined('SITE_PAGE_PRODUCT__SEARCH_STRING') ? SITE_PAGE_PRODUCT__SEARCH_STRING : 'search';
    }
    
    
    /***************************************************************/
    /******************URL VARIABLES AND PAGING*********************/
    /***************************************************************/
    
    
    // get paging string url 
    // such as index.php?page=1, this function description for page
    public function getPaginationQueryString(){
        return defined('PAGINATION_QUERY_STRING_SEGMENT') ? PAGINATION_QUERY_STRING_SEGMENT : 'page';
    }
    
    
    // get how many record you want to display on screen
    public function getLimitRecordPerPage(){
        return 20;
    }
    
    
    
    
    
    // SESSION VARIABLES
    
    // session continue buy
    public function getSessionLinkContinueBuy(){
        return 'link_continue_buy';
    }
    
    // session shopping
    
    public function getSessionShopping(){
        return 'shopping';
    }
    
    
    
    
    /***************************************************************/
    /******************LINK*********************/
    /***************************************************************/
    
    
    // using for display list cart and when user click order at product detail
    public function getLinkShowListCart(){
        return base_url() . Variable::getProductListCartPageString();
    }
    
    // using for acceess when user want to contact or order product
    public function getLinkOrderContact(){
        return base_url()  . Variable::getProductOrderPageString();
    }
    
    // search link
    public function getLinkSearch(){
        return base_url()  . Variable::getProductPageString() . '/' . Variable::getProductPageSearchString();
    }
}

?>