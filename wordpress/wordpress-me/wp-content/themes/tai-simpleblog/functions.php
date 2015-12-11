<?php


require_once(get_template_directory().'/app/main.php');

#add_theme_support( 'custom-menu' );
add_theme_support( 'automatic-feed-links' );
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


add_action( 'widgets_init', 'theme_init_widgets' );


function theme_init_widgets()
{
    $args = array(
	'id'          => 'about-sidebar',
	'name'        => __( 'about-sidebar (for text)', 'default' ),
	'description' => __( 'This sidebar is located above the age logo.', 'default' )
	,'class'         => 'dddd'
	,'before_widget' => '<div id="%1$s" class="sidebar-module sidebar-module-inset %2$s">'
	,'after_widget'  => '</div>'
	,'before_title'  => '<h4>'
	,'after_title'   => "</h4>"
    );

    register_sidebar($args);
}




