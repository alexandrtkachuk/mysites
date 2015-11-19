<?php

function __autoload($class )
{
    if(file_exists(LIBS.'/'.$class.'.php'))
    {
	require_once(LIBS.'/'.$class.'.php' );
    }
}
