<div class="wrap">
        <h2><?php _e( 'Customizer' ); ?> </h2>
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
	    <h1><?php _e('Elsewhere') ?></h1> 

	    <p><strong>
	    <?php _e( 'Show' ); ?> 
	    <?php _e( 'Archives' ); ?>
	    :( 1 = <?php _e( 'Yes' ); ?> , 0 = <?php _e( 'No' ); ?> )
	    </strong><br />
                <input type="text" name="theme_settings[arhiveview]" size="45" value="<?php esc_attr_e($options['arhiveview']); ?>" />
	    </p>
  
	    <p><strong> Facebook: </strong><br />
                <input type="text" name="theme_settings[facebook]" size="45" value="<?php esc_attr_e($options['facebook']); ?>" />
	    </p>
	    
	    <p><strong> Twitter: </strong><br />
                <input type="text" name="theme_settings[twitter]" size="45" value="<?php esc_attr_e($options['twitter']); ?>" />
	    </p>

	   <p><strong> Github: </strong><br />
                <input type="text" name="theme_settings[github]" size="45" value="<?php esc_attr_e($options['github']); ?>" />
	    </p>
 
	    <!-- -->
            <p><input type="submit" name="Submit" value="<?php _e( 'Save' ) ;?>" /></p>
	    
	    <input type="hidden" name="action" value="update" />
	    <input type="hidden" name="page_options" value="theme_settings" > 
	     
        </form>
    </div>

