<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-Type: application/json');

if(isset($pages)){
	//var_dump($pages);
	print json_encode($pages) ;
}