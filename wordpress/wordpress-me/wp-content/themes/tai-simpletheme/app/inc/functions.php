<?php

//create autoload
spl_autoload_register( 'load_class' );

function load_class($class)
{  
    if(file_exists(INC.'/'.$class.'.php'))
    {
	require_once(INC.'/'.$class.'.php' );
    }
    else
    {
	return false;
    } 

    return true;
}

