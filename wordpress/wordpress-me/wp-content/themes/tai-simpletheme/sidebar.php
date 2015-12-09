<div class="col-sm-3 col-sm-offset-1 blog-sidebar">

<?php
    dynamic_sidebar( 'about-sidebar' );
    $options =   get_option('theme_settings');
?>

       

<?php if ( 1 == $options['arhiveview'] ) : ?>

<div class="sidebar-module">
	    <h4><?php _e( 'Archives' ) ;?></h4>
   <ol class="list-unstyled" >

<?php 
   wp_get_archives( 'type=monthly' ); 
?>
    </ol></div> 
<?php endif; ?>




          <!--div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
	  </div>

          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
	  </div-->
<div class="sidebar-module">
 <h4><?php _e('Links') ?></h4> 	
<div class="row social">
    <?php if(isset($options['facebook']) && strlen($options['facebook']) > 5): ?>
	<div class="col-xs-2" >
	    <a href='<?php echo $options['facebook'] ?>'><img  src ="<?php echo get_template_directory_uri() ?>/images/facebook.jpg"></a>
	</div>
    <?php endif; ?>
    
    <?php if(isset($options['twitter']) && strlen($options['twitter']) > 5): ?>
	<div class="col-xs-2" >
	    <a href='<?php echo $options['twitter'] ?>'><img  src ="<?php echo get_template_directory_uri() ?>/images/Twitter.jpg"></a>
	</div>
    <?php endif; ?>

    <?php if(isset($options['github']) && strlen($options['github']) > 5): ?>
	<div class="col-xs-2" >
	    <a href='<?php echo $options['github'] ?>'><img  src ="<?php echo get_template_directory_uri() ?>/images/Github.jpg"></a>
	</div>
    <?php endif; ?>
    </div>
</div>
        </div><!-- /.blog-sidebar -->

