<?php

/* ������� ��� � ����� ���� ��� ���� */
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}


//������� ���� ��������� ������ ����� �������� ������ ���� 
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


function special_nav_class($classes, $item ){
	
	if($item->current)
	{
		$classes[] = 'active';
	}
	
	return $classes;
}


//�������� ���� ���������� ��� ����
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
			$item->classes[] = 'dropdown'; // ��� �������� ���� "classes" ����, ����� ��������� � �������� � ������� class HTML ���� <li>
			$item->dropdown = '<span class="caret"></span>';
		}
	}
	 
	
	
	return $items;   
	
}

//���� ��� ���� 
class themeslug_walker_nav_menu extends Walker_Nav_Menu
{
  
	  // add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'dropdown-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
			
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
  
	// add main/sub classes to li's and links
	 function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	  
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
	  
		// link attributes
		/*
			class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
		*/
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ! empty( $item->class )      ? ' class="'   . esc_attr( $item->class       ) .'"' : '';
		$attributes .= ! empty( $item->data_toggle )      ? ' data-toggle="'   . esc_attr( $item->data_toggle       ) .'"' : '';
		$attributes .= ! empty( $item->role )      ? ' role="'   . esc_attr( $item->role       ) .'"' : '';
		$attributes .= ! empty( $item->aria_haspopup )      ? ' aria-haspopup="'   . esc_attr( $item->aria_haspopup       ) .'"' : '';
		$attributes .= ! empty( $item->aria_expanded )      ? ' aria-expanded="'   . esc_attr( $item->aria_expanded       ) .'"' : '';
		//$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		if(empty($item->dropdown))
		{
			$item->dropdown = '';
		}
	  
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%7$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
			, $item->dropdown
		);
	  
	  
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
}




