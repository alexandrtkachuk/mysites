<?php get_header(); ?>

  
    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title"><?php bloginfo( 'name' ); ?></h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

	<?php /*Выводим посты */ ?>
	<?php if ( have_posts() ): ?> 
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div class="blog-post" >
				<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?></a></h2>
				
				<p class="blog-post-meta"><?php the_date('F j ,Y');  ?> by <?php the_author_posts_link(); ?></p>
				
				<!--?php the_excerpt(); ?-->
				<?php the_content( null ); ?>
				    
			</div>
		<?php endwhile; ?>
	<?php endif; // end if?>


          

          

          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

	

    <?php get_footer(); ?>
