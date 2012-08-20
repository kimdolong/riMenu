<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kim
 * Date: 8/14/12
 * Time: 2:56 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php
use plugins\riPlugin\Plugin;
$menus_tree = Plugin::get('riMenu.Tree')->getTree();
$link_current = Plugin::get('riUtility.Uri')->getCurrent();
$found_active = false;
?>
<?php $riview->get('loader')->load(array('riMenu::frontend/style2/css/bootstrap.css', 'riMenu::frontend/style2/css/menu.css'));?>
<div id="header" class="wrapper-978">
    <div id="logo" class="pull-left">
        <?php echo riImage('riMenu::frontend/style2/img/logo.png')?>
    </div>
    <div id="nav-cart" class="pull-right">
        <span><a href="#">CHECKOUT</a></span>
        <span>|</span>
        <span><a href="#">CART</a></span>
        <span id="item-cart">(0 ITEMS)</span>
        <span><?php echo riImage('riMenu::frontend/style2/img/cart.png')?></span>
    </div>
</div> <!-- #header -->

<div class="navbar wrapper-978">
    <div class="navbar-inner">
        <div class="container">
            <!-- Everything you want hidden at 940px or less, place within here -->
            <div id="nav" class="nav-collapse">
            <!-- .nav, .navbar-search, .navbar-form, etc -->
                <ul class="nav pull-left">
                    <?php foreach($menus_tree[$menus_id]['sub_menus'] as $menu) { ?>
                    <?php
                        $link = zen_href_link($menus_tree[$menu]['menus_main_page'], $menus_tree[$menu]['menus_parameters']);
                        $_link = str_replace("&amp;", "&", $link);
                    ?>
                    <li
                        <?php if(!$found_active) {
                            if($this_is_home_page) { ?>
                                class="active"
                                <?php $found_active = true; } elseif (strpos($_link, $link_current) !== false) { ?>
                                    class="active"
                            <?php $found_active = true; } ?>
                        <?php } ?>
                        <?php if ($menus_tree[$menu]['has_children'] == 1) { ?>
                            class="parent"
                        <?php } ?>
                        >
                        <a href="<?php echo zen_href_link($menus_tree[$menu]['menus_main_page'], $menus_tree[$menu]['menus_parameters']); ?>"
                            <?php if ($menus_tree[$menu]['has_children'] == 1) { ?>
                           class="dropdown-toggle" data-toggle="dropdown"
                        <?php } ?>>
                            <?php echo $menus_tree[$menu]['menus_name']; ?>
                        </a>
                        <?php if ($menus_tree[$menu]['has_children'] == 1) { ?>
                            <div id="top">
                                <div id="mid">
                                    <ul class="dropdown-menu-hover">
                                        <?php foreach($menus_tree[$menu]['sub_menus'] as $sub_menu) { ?>
                                            <?php
                                            $sub_link = zen_href_link($menus_tree[$sub_menu]['menus_main_page'], $menus_tree[$sub_menu]['menus_parameters']);
                                            $_sub_link = str_replace("&amp;", "&", $sub_link);
                                            ?>
                                            <li><a
                                                <?php if(!$found_active) {
                                                        if (strpos($_sub_link, $link_current) !== false) { ?>
                                                            class="active"
                                                        <?php $found_active = true; } ?>
                                                <?php } ?>
                                                href="<?php echo zen_href_link($menus_tree[$sub_menu]['menus_main_page'], $menus_tree[$sub_menu]['menus_parameters']); ?>"><?php echo $menus_tree[$sub_menu]['menus_name']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <form class="form-search pull-right">
                    <input type="text" class="search-query" value="Search...">
                </form>
            </div>
        </div>
    </div>
</div>

<?php $riview->get("loader")->load(array('jquery.lib'));
$riview->get("loader")->startInline('js');
?>
<script type="text/javascript">
    $("#nav a.active").parentsUntil("#nav", ".parent").addClass("active");
</script>

<?php $riview->get("loader")->endInline();?>