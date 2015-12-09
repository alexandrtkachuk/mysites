<?php get_header(); ?>

  
    <div class="container">
    <?php if ( have_posts() ): ?>
      <div class="blog-header">
        <h1 class="blog-title"><?php echo get_the_title(); ?></h1>
        
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

	
	 
		
			<?php the_post(); ?>
			<div class="blog-post" >
				
				
				<p class="blog-post-meta"><?php the_date('F j ,Y');  ?>  
		    <?php echo str_replace(': %s', '', mb_strtolower(translate( 'By: %s'))); ?>  

<?php the_author_posts_link(); ?></p>
				
				<!--?php the_excerpt(); ?-->
				<?php the_content( null ); ?>
				    
			</div>
		
	<?php endif; // end if?>


          

          

          <nav>
	    <ul class="pager">
	      <li> <?php   previous_posts_link(translate('Back')); ?></li>
	      <li><?php  next_posts_link(translate('Next')); ?> </li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

	

    <?php get_footer(); ?>
