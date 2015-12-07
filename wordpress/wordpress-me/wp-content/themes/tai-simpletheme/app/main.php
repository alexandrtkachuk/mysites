<?php 

require_once('config.php');
require_once(INC.'/functions.php');

function myroute($nameApp = null)
{
    

    $view =  new View();
    
	$arr = array('/%%TEMP%%/','/%%TEST%%/');

	$arr2 = array('my temp','my test');


    echo  $view->doStart('ThemeSettingsMenu', array($arr, $arr2));

    
     

}
