<?php

class ProductsModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function lists($name, $page=false) {
        $sql2 = " select  count(p.id) as tong";
        $sql2 .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql2 .= " join product_category c on p.id_primary_prod_category = c.id ";
        $sql2 .= " where c.link = '" . $name . "'";
        $tongO = $this->Db->getObject($sql2);

        $current_page = $page;
        if (($page * 1) == 0) {
            $current_page = 1;
        }
        $limit = 24;
        $start = ( $current_page - 1 ) * $limit;
        

        $total_page = ceil($tongO->tong / $limit);

        $s = '';
        if ($total_page == 2) {
            $s .= '<a href="#">1</a>';
        } elseif ($total_page > 2) {
            $min = 1;
            $max = 2;
            $chia = $max / 2;
            if ($current_page <= $chia) {
                $min = $min;
                $max = $max;
            } else if ($current_page >= $total_page - $chia) {
                $min = $total_page - ($max - 1);
                $max = $total_page;
            } else {
                $min = $current_page - ($chia);
                $max = $current_page + ($chia) - 1;
            }

            if ($current_page > 1) {
                $s .='<a href="(*)/' . ($current_page - 1) . '">Prev</a>';
            }
            for ($i = $min; $i <= $max; $i++) {
                $s .='<a href="(*)/' . $i . '">' . $i . '</a>';
            }
            if ($current_page < $total_page) {
                $s .= '<a href="(*)/' . ($current_page + 1) . '">Next</a>';
            }
        }

        $sql = " select  p.name, p.id,  p.id_prod_image, i.file, c.link as clink, p.link as plink";
        $sql .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql .= " join product_category c on p.id_primary_prod_category = c.id ";
        $sql .= " where c.link = '" . $name . "' order by p.id DESC limit " . $start . ',' . $limit;

        $arr['paging'] = $s;
        $arr['list'] = $this->Db->getList($sql);
        return $arr;
    }

    public function listAll($start = 0) {
        $sql = " select  p.name, p.id,  p.id_prod_image, i.file, c.link as clink, p.link as plink";
        $sql .= " from product as p join image i on  p.id_def_image = i.id ";
        $sql .= " join product_category c on p.id_primary_prod_category = c.id order by p.id desc limit 0,20 ";
        return $this->Db->getList($sql);
    }

    public function detail($catename = false, $productname = false) {
        $sql1 = "select p.currency, p.id, p.name,  p.id_def_image, p.description, p.link, p.id_prod_image, p.price , p.currency, i.file, c.link as clink from product as p join image as i on p.id_def_image = i.id join product_category as c on c.id = p.id_primary_prod_category where c.link = '" . $catename . "' and p.link = '" . $productname . "'";
        $Object = $this->Db->getObject($sql1);
        $image = '';
        if ($Object != '' && $Object != null) {

            $listImage = $Object->id_prod_image;

            if ($listImage != null) {
                $sql2 = "select * from image where id in ('" . $listImage . "')";
                
                $image = $this->Db->getList($sql2);
            }
        }

        return array('object' => $Object, 'image' => $image);
    }

}