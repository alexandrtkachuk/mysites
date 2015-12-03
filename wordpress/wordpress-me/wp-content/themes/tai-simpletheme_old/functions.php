<?php

require_once('inc/MyMenu.php');

/* set menu this theme */
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}


 
//hook for change custom class for menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


function special_nav_class($classes, $item ){
	
	if($item->current)
	{
		$classes[] = 'active';
	}
	
	return $classes;
}

//hook for processing sub-menu
add_filter('wp_nav_menu_objects', 'css_for_nav_parrent');

function css_for_nav_parrent( $items ){
	
	//var_dump($items);
	
	function hasSub( $menu_item_id, $items ){
		
		//var_dump($items);
		
		foreach ($items as $item) {
			if ($item->menu_item_parent && $item->menu_item_parent==$menu_item_id) {
	return true;
			}
		}
		return false;
	}

	foreach( $items as $item ){
		if( hasSub($item->ID, $items) ){
			$item->test ="dropdown-toggle ???";
			//$item->target= 'button';
			//var_dump($item);
			/*
			class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
			*/
			$item->class ="dropdown-toggle";
			$item->data_toggle="dropdown";
			$item->role="button";
			$item->aria_haspopup="true";
			$item->aria_expanded = 'false';
			$item->classes[] = 'dropdown'; // all elements  "classes" in menu, will unions on class HTML teg <li>
			$item->dropdown = '<span class="caret"></span>';
		}
	}
	
	return $items;   
}

register_sidebar( array(
    'id'          => 'footer-sidebar',
    'name'        => __( 'footer-sidebar', $text_domain ),
    'description' => __( 'This sidebar is located above the age logo.', $text_domain )
	,'description'   => ''
	,'class'         => ''
	,'before_widget' => '<li id="%1$s" class="widget %2$s">'
	,'after_widget'  => "</li>\n"
	,'before_title'  => '<h3 class="widgettitle">'
	,'after_title'   => "</h3>\n"
) );




