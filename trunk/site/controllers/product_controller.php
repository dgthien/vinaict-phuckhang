<?php

class Product_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $S = new ShoppingCart();
    }

    public function index() {
        redirect('index');
    }
    
    // function display a list products by page
    public function prod_list_by_category($url_cate = '', $url_page = 1) {
        if (!empty($url_cate)) {
            $Product = new Product();
            $info = $Product->getProductByCategory($url_cate, $url_page);
            $data['content'] = 'index';
            $data['product'] = $info['product'];
            $data['paging'] = $info['paging'];
            
            $array_menus = array();
            $filter = array();
            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);

            $data['array_menus'] = $array_menus;

            $this->load->view('temp', $data);
        } else {
            redirec('index');
        }
    }
    
    
    //
    //
    
    public function prod_search($page = 1){
        if ($this->input->post('bnt_search') != null){
            $name = $this->input->post('txt-search');
            $Product = new Product();
            $info = $Product->getProductByname($name, $page);
            
            $data['content'] = 'index';
            $data['product'] = $info['product'];
            $data['paging'] = $info['paging'];
            
            $array_menus = array();
            $filter = array();
            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);

            $data['array_menus'] = $array_menus;
            $this->load->view('temp', $data);
        }else{
            
            redirect('index');
        }
    }
    // function display detail a product
    public function prod_detail($url_link = null) {
        if (!empty($url_link)) { // neu link khong ton tai hay bi trong
            $Product = new Product();
            $Image = new Image();

            $Product_tmp = $Product->getProductByLink($url_link);
            $Product_tmp->fetchFirst();
            $data['product'] = $Product_tmp;
            if ($Product_tmp->countRows() > 0) {
                $data['image'] = $Image->getListImageByListId($Product_tmp->the_product_id_prod_image());
            } else {
                $data['image'] = '';
            }


            $data['content'] = 'prod_details';
            
            $array_menus = array();
            $filter = array();
            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);

            $data['array_menus'] = $array_menus;

            $this->load->view('temp', $data);
        } else {
            redirect('index');
        }
    }

    public function prod_list_cart() {
        $Shopping = new ShoppingCart();

        if ($this->input->post('click_access') != null && $this->input->post('click_access') == 'click_access') {
            $id_purchase_order = '';
            $id_product = $this->input->post('h_id');
            $code_product = $this->input->post('h_code');
            $name_product = $this->input->post('h_name');
            $price_product = $this->input->post('h_price');
            $currency_product = $this->input->post('h_curency');
            $description_product = $this->input->post('h_description');
            $image_product = $this->input->post('h_image');
            $number = 1;
            $is_deleted = 0;
            $link_product = $this->input->post('h_link');

            $Shopping->insert($id_purchase_order, $id_product, $code_product, $name_product, $price_product, $currency_product, $description_product, $image_product, $number, $is_deleted, $link_product);
        }


        $data['shopping'] = $Shopping->get_list();
        $data['content'] = 'order_list';
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
        
        $this->load->view('temp', $data);
    }
    
    
    public function prod_order_contact() {
        $result = '';
        $is_business = '';
        $gender = '0';
        $email = '';
        $phone = '';
        $billing_address = '';
        $shipping_address = '';
        $firstname = '';
        $lastname = '';
        $company = '';
        $contact_person = '';
        $website = '';
        $tax_code = '';
        $address = '';
        $yahoo = '';
        $skype = '';
        $career = '';
        $message = 'message';

        $not_buy = '1';
        $mucdich = '2';

        if ($this->input->post('ok-click') != null && $this->input->post('ok-click') == 'ok-click') {

            $mucdich = $this->input->post('mucdich');
            $not_buy = $this->input->post('not-buy');
            $is_business = $this->input->post('muacho');
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $billing_address = $this->input->post('billing_address');
            $shipping_address = $this->input->post('shipping_address');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $company = $this->input->post('company');
            $contact_person = $this->input->post('contact_person');
            $website = $this->input->post('website');
            $tax_code = $this->input->post('tax_code');
            $address = $this->input->post('address');
            $yahoo = $this->input->post('yahoo');
            $skype = $this->input->post('skype');
            $career = $this->input->post('career');
            $message = $this->input->post('message');
            if ($message == 'message'){
                $message = '';
            }

            if ($email != '') {

                $Shopping = new ShoppingCart();
                $list_cart = $Shopping->get_list();


                if (!empty($list_cart) || $mucdich == '1') {


                    $total = count($list_cart);
                    $Customer = new Customer();
                    $List_customer = $Customer->findByEmail($email);
                    $total_price = '';
                    for ($i = 0; $i < $total; $i++){
                        $total_price += $list_cart[$i]->get_price_product()*1;
                    }
                    // neu khach hang da ton tai

                    if ($List_customer->countRows() == 0 && $not_buy == '2') {
                        $result = 'Ban chua phai la khach hang. vui long chon khach hang binh thuong va dien day du thong tin';
                    } else {


                        if ($List_customer->countRows() > 0) {
                            // kiem tra danh sach thong so
                            $List_customer->fetchFirst();
                            if ($phone == '') {
                                $phone = $List_customer->work_phone;
                            }

                            if ($billing_address == '') {
                                $billing_address = $List_customer->billing_address;
                            }

                            if ($shipping_address == '') {
                                $shipping_address = $List_customer->shipping_address;
                            }

                            if ($firstname == '') {
                                $firstname = $List_customer->firstname;
                            }

                            if ($lastname == '') {
                                $lastname = $List_customer->lastname;
                            }

                            if ($company == '') {
                                $company = $List_customer->company;
                            }

                            if ($contact_person == '') {
                                $contact_person = $List_customer->contact_person;
                            }

                            if ($website == '') {
                                $website = $List_customer->website;
                            }

                            if ($tax_code == '') {
                                $tax_code = $List_customer->tax_code;
                            }

                            if ($address == '') {
                                $address = $List_customer->contact_address;
                            }

                            if ($yahoo == '') {
                                $yahoo = $List_customer->yahoo_id;
                            }

                            if ($skype == '') {
                                $skype = $List_customer->skype_id;
                            }

                            if ($career == '') {
                                $career = $List_customer->career;
                            }
                        }
                        $Cus_update = new Customer();

                        $Cus_update->gender = $gender;
                        $Cus_update->email = $email;
                        $Cus_update->work_phone = $phone;
                        $Cus_update->billing_address = $billing_address;
                        $Cus_update->shipping_address = $shipping_address;
                        $Cus_update->firstname = $firstname;
                        $Cus_update->is_business = $is_business;
                        $Cus_update->lastname = $lastname;
                        $Cus_update->company = $company;
                        $Cus_update->contact_person = $contact_person;
                        $Cus_update->website = $website;
                        $Cus_update->tax_code = $tax_code;
                        $Cus_update->contact_address = $address;
                        $Cus_update->id_yahoo = $yahoo;
                        $Cus_update->id_skype = $skype;
                        $Cus_update->$career = $career;
                        $Cus_update->description = $message;

                        if ($List_customer->countRows() > 0) {
                            $Cus_update->id = $List_customer->id;
                            $Cus_update->update();
                        } else {
                            $Cus_update->insert();
                        }

                        if ($Cus_update->id) {
                            // insert purchase order
                            $purchase = new PurchaseOrder();
                            $purchase->code = '';
                            $purchase->id_customer = $Cus_update->id;
                            $purchase->order_date = date('d/m/Y');
                            $purchase->creation_date = date('d/m/Y');
                            $purchase->amount = '';
                            $purchase->currency = '';
                            $purchase->status = '';
                            $purchase->amount = '';
                            $purchase->description = $message;
                            $purchase->billing_address = $billing_address;
                            $purchase->shipping_address = $shipping_address;
                            $purchase->insert();
                            $result = 'Câu hỏi của bạn đã được gửi đi';
                            
                            $text = '';
                            if (isset($purchase->id) && $Cus_update->id && $mucdich == '2') {
                                for ($i = 0; $i < $total; $i++) {
                                    
                                   $text = ' <td width="218" style="border-right:solid 1px #f5f5f5;">'.$list_cart[$i]->get_name_product().'</td>
                                    <td width="218" style="border-right:solid 1px #f5f5f5;">'.$list_cart[$i]->get_code_product().'</td>
                                    <td width="218" style="border-right:solid 1px #f5f5f5;">'.$list_cart[$i]->get_price_product().' ' . $list_cart[$i]->get_currency_product() .' </td>
                                    <td width="218" style="border-right:none;">'.$list_cart[$i]->get_number().'</td>
                                    </tr>';
                                    
                                    
                                    $details = new PurchaseOrderDetail();
                                    $details->id_purchase_order = $purchase->id;
                                    $details->id_product = $list_cart[$i]->get_id_product();
                                    $details->code_product = $list_cart[$i]->get_code_product();
                                    $details->name_product = $list_cart[$i]->get_name_product();
                                    $details->price_product = $list_cart[$i]->get_price_product();
                                    $details->currency_product = $list_cart[$i]->get_currency_product();
                                    $details->description_product = $list_cart[$i]->get_description_product();
                                    $details->image_product = $list_cart[$i]->get_image_product();
                                    $details->number = $list_cart[$i]->get_number();
                                    $details->is_deleted = 0;
                                    $details->insert();
                                }
                                $filter = array();
                                $filter['your_name'] = $firstname . ' ' . $lastname;
                                $filter['website'] = $website;
                                $filter['company'] = $company;
                                $filter['tax_code'] = $tax_code;
                                $filter['your_email'] = $email;
                                $filter['ym'] = $yahoo;
                                $filter['skype'] = $skype;
                                $filter['message'] = $message;
                                $filter['info_product'] = $text;
                                $filter['url_confirm'] = '';
                                $filter['shipping_address'] = $shipping_address;
                                $filter['billing_address'] = $billing_address;
                                $mail = new Mailer();
                                $mail->sendmail($filter);
                                $result = 'Đơn đặt hàng đã được lưu. vui lòng kiểm tra email đễ xác nhận thông tin đặt hàng';
                                $Shopping->clear_all();
                            }
                        }
                    }
                } else {
                    $result = '<span style="color: red;">Ban chua co mon hang nao<span>';
                }
            } else {
                $result = 'Email nhập không đúng hoặc bạn chưa nhập ';
            }
        }

        $filter = array();
        $filter['mucdich'] = $mucdich;
        $filter['not_buy'] = $not_buy;
        $filter['is_business'] = $is_business;
        $filter['gender'] = $gender;
        $filter['email'] = $email;
        $filter['phone'] = $phone;
        $filter['billing_address'] = $billing_address;
        $filter['shipping_address'] = $shipping_address;
        $filter['firstname'] = $firstname;
        $filter['lastname'] = $lastname;
        $filter['company'] = $company;
        $filter['contact_person'] = $contact_person;
        $filter['website'] = $website;
        $filter['tax_code'] = $tax_code;
        $filter['address'] = $address;
        $filter['yahoo'] = $yahoo;
        $filter['skype'] = $skype;
        $filter['career'] = $career;
        if ($message == ''){
            $filter['message'] = 'message';
        }else{
            $filter['message'] = $message;
        }
        
        $data['mess'] = $result;
        $data['filter'] = $filter;
        $data['content'] = 'order_form';
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
        
        $this->load->view('temp', $data);
    }
    public function update_shopping($id, $number){
        $Shopping = new ShoppingCart();
        $Shopping->update_number($id, $number);
    }
    public function delete_shopping($id){
        $Shopping = new ShoppingCart();
        $Shopping->delete($id);
    }
}
