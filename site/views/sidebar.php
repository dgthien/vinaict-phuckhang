<script language="javascript">
    $(document).ready(function(){
        jQuery('#login' ).click(function(){
            var winW = 630, winH = 460;
            if (document.body && document.body.offsetWidth) {
                winW = document.body.offsetWidth;
                winH = document.body.offsetHeight;
            }
            if (document.compatMode=='CSS1Compat' &&
                document.documentElement &&
                document.documentElement.offsetWidth ) {
                winW = document.documentElement.offsetWidth;
                winH = document.documentElement.offsetHeight;
            }
            if (window.innerWidth && window.innerHeight) {
                winW = window.innerWidth;
                winH = window.innerHeight;
            }
            
            var left = (winW - 500)/2;
            var top = (winH - 500)/2;
            var new_window = window.open($(this).attr('href').replace('#', ''), 'Login Openid', 'height=500, width=500, scrollbars=yes, screenX='+left+', screenY='+top+'');
            return false;
        });
    });
    
</script>
<!--<style>
    .box-sidebar .box-title{
        height: 30px;
        line-height: 30px;
        margin-top: 10px;
        text-align: center;
    }
    .box-sidebar-content{
    }
    ul.list-customer li{
        width: 80px; height: 80px;
        float:left;
    }
</style>

<div class="box-sidebar">
    <h3 class="box-title">
        HỘP NGƯỜI THEO DÕI
    </h3>
    <hr/>
    <div class="box-sidebar-content">
        <span>Bạn có tài khoản rồi? <a id="login" href="#<?php echo base_url('login/load_form'); ?>">�?ăng Nhập</a></span>
            <ul class="list-customer">
                <li>
                    
                </li>
            </ul>
    </div>
    <div class="clear"></div>
</div>-->


<!--Link social network-->
<?php
$filter = Array(
    'is_social' => IS_SOCIAL
);

$social = SocialLink::getlist($filter);
if ($social) {
    ?>
    <div class="social-link-right">
        <?php while ($social->fetchNext()) { ?>
            <span id="social_link">
                <a href="<?php echo $social->url; ?>" target="_blank">
                    <img src="<?php echo direct_url(base_url(config_item('source_image') . 'social/' . str_replace(array('.jpg', '.png', '.gif', '.JPG', '.PNG', '.GIF'), array(BO_SOCIAL_LINK_IMG_SUFFIX . '.jpg', BO_SOCIAL_LINK_IMG_SUFFIX . '.png', BO_SOCIAL_LINK_IMG_SUFFIX . '.gif', BO_SOCIAL_LINK_IMG_SUFFIX . '.JPG', BO_SOCIAL_LINK_IMG_SUFFIX . '.PNG', BO_PROD_CATEGORY_IMG_SUFFIX . '.GIF'), $social->picture))) . '" alt="' . clean_html(getI18n($social->name)); ?>" />
                </a>
            </span>
        <?php } ?>
    </div>
<?php } ?>



<!--Shopping cart-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_shopping_cart'); ?></div>
    <div class="box-sidebar-content">
        <a class="shopping-cart" href="<?php echo base_url() . 'gio-hang.html'; ?>"><img src="<?php echo base_url() . 'images/site/shopping_cart.png'; ?>" /></a>
        <span class="number-product">
            <?php
            echo Variable::getTotalProductShopping() . ' ' . lang('txt_product');
            ?>
        </span>
    </div>
</div>

<!--Link
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_link'); ?></div>
    <div class="box-sidebar-content">
        <ul class="ul-sidebar">
<?php
$filterT = Array(
    'is_social' => IS_NOT_SOCIAL,
    'type_show' => TYPE_TEXT
);
$social = SocialLink::getList($filterT);
while ($social->fetchNext()) {
    ?>
                            <li><a href="<?php echo $social->url; ?>" target="_blank"><?php echo $social->getName(); ?></a></li>
<?php } ?>
        </ul>
    </div>
</div> -->

<!--News-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_hot_new'); ?></div>
    <div class="box-sidebar-content">
        <ul>
            <?php
            $filter = Array('limit' => '5');
            $article = Article::getList($filter);
            $count = 0;
            while ($article->fetchNext()) {
                ?>
                <li><a href="<?php echo base_url(); ?>news/detail/<?php echo $article->get_id(); ?>" title="<?php echo $article->get_title(); ?>">&raquo; &nbsp;<?php echo truncateString($article->get_title(), 100); ?></a></li>
                <?php
                $count++;
            }
            ?>
        </ul> 
        <?php if ($count > 0) { ?>
            <span class="more-news"><a href="<?php echo base_url(); ?>tin-tuc"><?php echo lang('view_more_other'); ?> &raquo;</a></span>
            <?php
        } else {
            ?>
            <h4 class="no-news"> <?php echo lang('txt_no_news'); ?>  </h4>
            <?php
        }
        ?>
    </div>
</div>

<!--Link Image-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_link'); ?></div>
    <div class="box-sidebar-content">
        <ul class="link-image">
            <?php
            $filter = Array(
                'is_social' => IS_NOT_SOCIAL,
                'type_show' => TYPE_IMAGE
            );
            $social = SocialLink::getList($filter);
            $count = 1;
            while ($social->fetchNext()) {
                ?>   
                <li>
                    <a href="<?php echo $social->url; ?>" target="_blank">
                        <img src="<?php echo direct_url(base_url(config_item('source_image') . 'social/' . str_replace(array('.jpg', '.png', '.gif', '.JPG', '.PNG', '.GIF'), array('_link.jpg', '_link.png', '_link.gif', '_link.JPG', '_link.PNG', '_link.GIF'), $social->picture))) . '" alt="' . clean_html(getI18n($social->name)); ?>" />
                    </a>
                </li>
                <?php
                $count++;
            }
            if ($count <= 1) {
                ?>
                <li><?php echo lang('txt_no_link'); ?></li>
            <?php } ?>
        </ul>
    </div>
</div>


<style type="text/css">
    .login h3{
        float:left;
        width: 20%;
    }
    .login div{
        float:right;
        width: 79%;
    }
</style>

<!--Member-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_member'); ?></div>
    <div class="box-sidebar-content" style="padding: 10px;">
        <div class="login">
            <?php $login = Customer::getSessionLogin(); ?>
            <?php if ($login): ?>
                <h3>
                    <img src="<?php echo $login['image']; ?>" width="40px" height="40px" />
                </h3>
                <div>
                    <span>
                        <?php
                        if (empty($login['username']))
                            echo str_replace(array('@yahoo.com', '@gmail.com'), array('', ''), $login['email']); else
                            echo $login['username'];
                        ?>
                    </span><br/>
                    <a style="color: yellowgreen;" href="<?php echo base_url('login/logout'); ?>"> >><?php echo lang('txt_cancal'); ?></a>
                </div>
            <?php else: ?>
                <span><?php echo lang('txt_have_account'); ?></span> <a id="login" href="#<?php echo base_url('login/load_form'); ?>"><?php echo lang('txt_login'); ?></a>
            <?php endif; ?>
        </div>
        <div class="clear"></div>

        <h5 style="padding: 10px;"><?php echo lang('txt_list_member'); ?></h5>
        <div style="padding: 0px 10px;">
            <ul id="list-member">
                <?php $customer = Customer::selectAll(array('limit' => 12, 'start' => 0)); ?>
                <?php while ($customer->fetchNext()): ?>
                    <?php if (!empty($customer->link_profile)): ?>
                        <li><a href="<?php echo $customer->link_profile; ?>"><img alt="" title="<?php
                if ($customer->username != '')
                    echo $customer->username; else
                    echo $customer->email;
                        ?>" width="30px" height="30px" src="<?php echo $customer->image; ?>"/></a></li>        
                        <?php else: ?>
                        <li><img alt="" title="<?php
                    if ($customer->username != '')
                        echo $customer->username; else
                        echo $customer->email;
                            ?>" width="30px" height="30px" src="<?php echo $customer->image; ?>"/></li>
                        <?php endif; ?>
                    <?php endwhile; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <?php if ($customer->countRows() > 24): ?>
            <div style="text-align: right; padding: 10px;">
                <a style="color: yellowgreen;" href="#">>><?php echo lang('view_more'); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>


<!--Counter-->
<div class="box-sidebar">
    <div class="box-sidebar-header"><?php echo lang('txt_counter'); ?></div>
    <div class="box-sidebar-content" style="padding: 10px 0px 0px 0px;">
        <div align="center"><img border="0" src="http://cc.amazingcounters.com/counter.php?i=3094423&c=9283582" alt="Web Site Counters"></div>
    </div>
</div>
