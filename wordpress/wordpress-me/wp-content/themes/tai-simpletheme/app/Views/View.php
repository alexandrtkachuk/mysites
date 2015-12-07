<?php

class View
{
    
    protected $template;
    

    public function doStart($name,$repArr)
    {
	if (!$this->loadTemplate($name)) return false;

	$this->renderValue($repArr[0],$repArr[1]);

	return $this->template;	
    }
    
    protected function renderValue($patterns, $replacements)
    {
	$arr = array('/%%TEMP%%/','/%%TEST%%/');

	$arr2 = array('my temp','my test');

	$this->template = preg_replace_callback('/%%TEMP%%/', array($this, 'test'),$this->template);	
    }

    protected function loadTemplate($name)
    {
	$path = TEMPLATES.'/'.$name.'.html';
	
	if(file_exists($path))
	{	    
	    $this->template = file_get_contents($path); 

	    return true;
	}

	return false;
    }

    protected function test($var = null)
    {
	var_dump($var);
	#print "<h1>$var</h1>";

	return 1;
    }
}
