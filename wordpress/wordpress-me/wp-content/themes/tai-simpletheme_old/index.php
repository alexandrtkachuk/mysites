<?php get_header(); ?>
  
   <div class="container">
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
				<?php the_content( __( 'Читатать дальше.. <span class="meta-nav">→</span>') ); ?>
						
			</div>
		<?php endwhile; ?>
	<?php endif; // end if?>
  
  </div> <!-- /container -->
  
 <?php get_footer(); ?>