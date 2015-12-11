<?php


class ThemeSettings
{
    public function __construct()
    {
	add_action('admin_menu', array($this,'add_global_custom_options'));


	#$this->loadTheme();
    }

    protected  function loadTheme()
    {
	include_once(TEMPLATES.'/'.TEMPLATES_SETTING_THEME.'.php');    
	
    }

    public function add_global_custom_options()
    {
	add_theme_page('Custom theme settings', 
	    'Custom theme settings', 
	    'manage_options', 
	    'functions',array($this,'global_custom_options')); 
    }

    public function global_custom_options()
    { 
	$this->loadTheme();
    }


} 



