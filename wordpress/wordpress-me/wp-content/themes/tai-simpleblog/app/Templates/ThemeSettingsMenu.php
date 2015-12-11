<div class="wrap">
        <h2><?php _e( 'Customizer', 'default' ); ?> </h2>
        <form method="post" action="options.php">
<?php 
    $options =   get_option('theme_settings'); 
    
    if(!isset($options['arhiveview']))
    {
	$options['arhiveview'] = '0';
    }

    if(!isset($options['about']))
    {
	$options['about'] = '';
    }
    
    if(!isset($options['facebook']))
    {
	$options['facebook'] = '';
    }
    
    if(!isset($options['twitter']))
    {
	$options['twitter'] = '';
    }

    if(!isset($options['github']))
    {
	$options['github'] = '';
    }


?>
	    

	    <?php wp_nonce_field('update-options') ?>  

	    <p><strong>
	    <?php _e( 'Show', 'default'); ?> 
	    <?php _e( 'Archives', 'default' ); ?>
	    :( 1 = <?php _e( 'Yes', 'default' ); ?> , 0 = <?php _e( 'No', 'default' ); ?> )
	    </strong><br />
                <input type="text" name="theme_settings[arhiveview]" size="45" value="<?php echo $options['arhiveview']; ?>" />
	    </p>
  
	    <p><strong> Facebook: </strong><br />
                <input type="text" name="theme_settings[facebook]" size="45" value="<?php echo $options['facebook']; ?>" />
	    </p>
	    
	    <p><strong> Twitter: </strong><br />
                <input type="text" name="theme_settings[twitter]" size="45" value="<?php echo $options['twitter']; ?>" />
	    </p>

	   <p><strong> Github: </strong><br />
                <input type="text" name="theme_settings[github]" size="45" value="<?php echo $options['github']; ?>" />
	    </p>
 
	    <!-- -->
            <p><input type="submit" name="Submit" value="<?php _e( 'Save', 'default' ) ;?>" /></p>
	    
	    <input type="hidden" name="action" value="update" />
	    <input type="hidden" name="page_options" value="theme_settings" > 
	     
        </form>
    </div>

