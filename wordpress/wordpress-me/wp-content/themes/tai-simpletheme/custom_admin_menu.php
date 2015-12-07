<?php


#add_menu_page('Page title', 'Top-level menu title', 8, 'test.php', 'my_magic_function');


#add menu admin
/*
add_action('admin_menu', 'add_global_custom_options');

function add_global_custom_options()
{
    add_menu_page('Global Custom Options', 'Global Custom Options', 'manage_options', 'functions','global_custom_options');
    #add_options_page('Global Custom Options', 'Global Custom Options', 'manage_options', 'functions','global_custom_options');
}

function global_custom_options()
{
?>
    <div class="wrap">
        <h2>Theme Options</h2>
        <form method="post" action="options.php">
	    
	    <?php wp_nonce_field('update-options') ?>

            <p><strong>Twitter ID:</strong><br />
                <input type="text" name="twitterid" size="45" value="<?php echo get_option('twitterid'); ?>" />
	    </p>

	    <p><strong>Arhive view(1 = view )</strong><br />
                <input type="text" name="arhiveview" size="45" value="<?php echo get_option('arhiveview'); ?>" />
	    </p>
  

            <p><input type="submit" name="Submit" value="Store Options" /></p>
	    
	    <input type="hidden" name="action" value="update" />
	    <input type="hidden" name="page_options" value="twitterid, arhiveview" /> 
	     
        </form>
    </div>
<?php
}
*/

##################

//Настройки панели администрирования
////Регистрация функции настроек
function theme_settings_init(){
  register_setting( 'theme_settings', 'theme_settings' );
  }
//
//  // Добавление настроек в меню страницы
  function add_settings_page() {
  add_menu_page( __( 'Theme Settings' ), __( 'Theme Settings' ), 'manage_options', 'settings', 'theme_settings_page');
  }


  //Добавление действий
  #add_action( 'admin_init', 'theme_settings_init' );
  add_action( 'admin_menu', 'add_settings_page' );
  //
  //

  function theme_settings_page() {

      if ( ! isset( $_REQUEST['updated'] ) )
	  $_REQUEST['updated'] = false;

?>

<div>

<div id="icon-options-general"></div>
<h2 id="title"><?php _e( 'Theme Settings' ) //your admin panel title ?></h2>

<?php
//вывод сообщения о том, что значение опции сохранено
      if ( false !== $_REQUEST['updated'] ) : ?>
	  <div><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
<?php endif; ?>

<form method="post" action="options.php">

<?php settings_fields( 'theme_settings' ); ?>
<?php $options = get_option( 'theme_settings' ); ?>


<table>

<!-- Пользовательский логотип -->
<tr valign="top">
<th scope="row"><?php _e( 'Custom Logo' ); ?></th>
<td><input id="theme_settings[custom_logo]" type="text" size="40" name="theme_settings[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
</td>
</tr>

<!-- Баннер 743 X 82 баннер -->
<tr valign="top">
<th scope="row"><?php _e( '743px X 82px banner' ); ?></th>
<td><textarea id="theme_settings[banner1]" rows="5" cols="36" name="theme_settings[banner1]"><?php esc_attr_e( $options['banner1'] ); ?></textarea></td>
</tr>

<!-- Баннер 268 X 268 баннер -->
<tr valign="top">
<th scope="row"><?php _e( '268px X 268px banner' ); ?></th>
<td><textarea id="theme_settings[banner2]" rows="5" cols="36" name="theme_settings[banner2]"><?php esc_attr_e( $options['banner2'] ); ?></textarea>
</td>
</tr>

<!-- Текст в футере -->
<tr valign="top">
<th scope="row"><?php _e( 'Footer Text' ); ?></th>
<td><input id="theme_settings[footer]" type="text" size="40" name="theme_settings[footer]" value="<?php esc_attr_e( $options['footer'] ); ?>" />
</td>
</tr>

<!-- Google Analytics -->
<tr valign="top">
<th scope="row"><?php _e( 'Google Analytics' ); ?></th>
<td>
<br />
<textarea id="theme_settings[tracking]" name="theme_settings[tracking]" rows="5" cols="36"><?php esc_attr_e( $options['tracking'] ); ?></textarea></td>
</tr>

</table>

<p><input name="submit" id="submit" value="Save Changes" type="submit"></p>
</form>

</div>

<?php
  }

//валидация
  function options_validate( $input ) 
  {
      global $select_options, $radio_options;
      if ( ! isset( $input['option1'] ) )
	  $input['option1'] = null;
      $input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
      $input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );
      if ( ! isset( $input['radioinput'] ) )
	  $input['radioinput'] = null;
      if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
	  $input['radioinput'] = null;
      $input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );
      return $input;
  }
