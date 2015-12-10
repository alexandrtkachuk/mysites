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


          
	<?php comments_template(); ?> 



	  <nav>
	    <ul class="pager">
<?php
$args = array(
    'before'           => '<li>' . __('Pages:'),
    'after'            => '</li>',
    'link_before'      => '',
    'link_after'       => '',
    'next_or_number'   => 'number',
    'nextpagelink'     => __('Next page'),
    'previouspagelink' => __('Previous page'),
    'pagelink'         => '%',
    'echo'             => 1,
); 

wp_link_pages( $args );
?>
		    </ul>
	  </nav>

        </div><!-- /.blog-main -->

	

    <?php get_footer(); ?>
