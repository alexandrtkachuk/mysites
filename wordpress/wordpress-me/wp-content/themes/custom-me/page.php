
<?php get_header(); ?>

    <div class="container">

      <div class="page-header">
        <h1><?php the_title(); ?></h1>
        
      </div>

     <?php if (have_posts()): while (have_posts()): the_post(); ?>
		<?php the_content(); ?>
	 <?php endwhile; endif; ?>

    </div> <!-- /container -->


  <?php get_footer(); ?>
