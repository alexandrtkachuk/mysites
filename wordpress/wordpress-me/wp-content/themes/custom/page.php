<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
  <title>PAGE</title>
  
  <!-- основной файл стилей грузим -->
  <link rel='stylesheet' id='main-style'  href='<?php echo get_stylesheet_uri(); ?>' type='text/css' ' />
  
  
  <?php wp_head(); ?>
 </head>
 <body  <?php body_class(); ?> >

  <h1>Заголовок страницы</h1>
  <p>Основной текст.</p>
  
    <?php /*Выводим посты */ ?>
	<?php if ( have_posts() ): ?> 
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div>
				<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h3>
				<hr />
				<?php echo get_the_category_list(); ?>
				<?php echo get_the_tag_list('', ', ');?>
				
				<!--?php the_excerpt(); ?-->
				<?php the_content( __( 'Читатать дальше.. <span class="meta-nav">></span>') ); ?>
						
			</div>
		<?php endwhile; ?>
	<?php endif; // end if?>
  
  
  <?php wp_footer(); ?>
 </body>
</html>