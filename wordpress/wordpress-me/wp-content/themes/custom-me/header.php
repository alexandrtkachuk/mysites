<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  
  
  
  
  <!-- основной файл стилей грузим -->
  <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css'  />
  <link rel='stylesheet' id='main-style'  href='<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css' type='text/css' ' />
  <link rel='stylesheet' id='main-style'  href='<?php echo get_template_directory_uri() ?>/css/non-responsive.css' type='text/css'  />
  
  
  <?php wp_head(); ?>
 </head>
 
 <body <?php body_class(); ?>  >
<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar">
          
			
			<?php  $str = wp_nav_menu(array(
				'menu' => 'top-menu' 
				,'menu_class' => 'nav navbar-nav'  
				,'container'       => ''
				//,'container_class' => 'nav??? navbar-nav'
				//,'items_wrap'        => '<ul  id="%1$s" class="%2$s">%3$s</ul>'
				//,'echo' => false
				,'walker' => new MyMenu
				)); 
			?>
          
		  
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control"  value="" name="s" id="s" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="wrap">