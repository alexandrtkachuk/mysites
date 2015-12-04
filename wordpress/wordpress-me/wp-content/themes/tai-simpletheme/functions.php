<?php

require_once('inc/MyMenu.php');
require_once('custom_admin_menu.php');

/* set menu this theme */
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}


add_filter('wp_nav_menu_objects', 'css_for_nav_menu');

function css_for_nav_menu($items)
{
    #var_dump($items);
    
    foreach($items as $item)
    {
	if($item->menu_item_parent) continue;


	$item->class ="blog-nav-item";
	if($item->current)
	{
	    $item->class .= ' active';
	}
	
    }

    return $items;
}

function getMaimMenu()
{
    $menu = wp_nav_menu(array(
	'menu' => 'top-menu' 
	,'container'       => false
	,'items_wrap'        => '%3$s'
	,'container_class' => 'menu'
	,'echo' => false
	,'depth'           => 1
	,'before'          => ''
	,'after'           => ''
	,'walker' => new MyMenu
    ));

    return $menu;
}




register_sidebar( array(
    'id'          => 'footer-sidebar',
    'name'        => __( 'footer-sidebar', $text_domain ),
    'description' => __( 'This sidebar is located above the age logo.', $text_domain )
	,'class'         => 'dddd'
	,'before_widget' => '<div id="%1$s" class="sidebar-module %2$s">'
	,'after_widget'  => '</div>'
	,'before_title'  => '<h4>'
	,'after_title'   => "</h4>\n"
	,'classname'         => 'nav-list'
	,'echo' => false
) );


register_sidebar( array(
    'id'          => 'about-sidebar',
    'name'        => __( 'about-sidebar (for text)', $text_domain ),
    'description' => __( 'This sidebar is located above the age logo.', $text_domain )
	,'class'         => 'dddd'
	,'before_widget' => '<div id="%1$s" class="sidebar-module sidebar-module-inset %2$s">'
	,'after_widget'  => '</div>'
	,'before_title'  => '<h4>'
	,'after_title'   => "</h4>"
) );


