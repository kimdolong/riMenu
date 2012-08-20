<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kim
 * Date: 8/15/12
 * Time: 9:27 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php
use plugins\riPlugin\Plugin;
$menus_tree = Plugin::get('riMenu.Tree')->getTree();
$link_current = Plugin::get('riUtility.Uri')->getCurrent();
$found_active = false;
?>
<?php $riview->get('loader')->load(array('riMenu::frontend/style1/css/bootstrap.css', 'riMenu::frontend/style1/css/menu.css'));?>
<div id="header" class="wrapper-978">
    <div id="logo" class="pull-left">
        <?php echo riImage('riMenu::frontend/style1/img/logo.jpg')?>
    </div>
    <div id="nav-cart" class="pull-right">
        <span><a href="#">CHECKOUT</a></span>
        <span>|</span>
        <span><a href="#">CART</a></span>
        <span id="item-cart">(0 ITEMS)</span>
        <span><?php echo riImage('riMenu::frontend/style1/img/cart.png')?></span>
    </div>
</div> <!-- #header -->

<div class="navbar wrapper-978">
    <div class="navbar-inner">
        <div class="container">
        <!-- Everything you want hidden at 940px or less, place within here -->
            <div id="nav" class="nav-collapse">
              <!-- .nav, .navbar-search, .navbar-form, etc -->
                <ul class="nav pull-left">
                    <?php
                    Plugin::get('riMenu.Tree')->checkActive($menus_tree, $menus_id, $link_current);
                    ?>
                    <?php foreach($menus_tree[$menus_id]['sub_menus'] as $menu) { ?>
                    <?php
                        $class = '';
                        if($menus_tree[$menu]['is_active']){
                            $class = 'active';
                        }
                        if ($menus_tree[$menu]['has_children'] == 1){
                            $class .= ' parent';
                        }
                    ?>
                    <li class="<?php echo $class?>">
                        <a href="<?php echo $menus_tree[$menu]['link']; ?>"><?php echo $menus_tree[$menu]['menus_name']; ?></a>
                        <?php if ($menus_tree[$menu]['has_children'] == 1) { ?>
                            <ul>
                                <?php foreach($menus_tree[$menu]['sub_menus'] as $sub_menu) { ?>
                                <?php
                                    $class = '';
                                    if($menus_tree[$sub_menu]['is_active']){
                                        $class = 'active';
                                    }
                                ?>
                                <li class="<?php echo $class?>">
                                    <a href="<?php echo $menus_tree[$sub_menu]['link']; ?>"><?php echo $menus_tree[$sub_menu]['menus_name']; ?></a></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <div class="clr"></div>
                <form class="form-search pull-right">
                    <input type="text" class="search-query" value="Search" style="color: #b6b6b6;">
                    <button type="submit" class="button">GO</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $riview->get("loader")->load(array('jquery.lib'));
$riview->get("loader")->startInline('js');
?>
<script type="text/javascript">
    $("#nav li.active").parentsUntil("#nav", ".parent").addClass("active");
</script>

<?php $riview->get("loader")->endInline();?>