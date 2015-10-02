<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	header("Access-Control-Allow-Origin: *");
	//header('Access-Control-Allow-Credentials: true');
	header('Content-Type: application/json');

	if(isset($pages)){
		//var_dump($pages);
		print json_encode(array(
		'pages' => $pages
		,'time' => $this->benchmark->elapsed_time()
		,'memory' => $this->benchmark->memory_usage()
		));
	}
	elseif(isset($info))
	{
		
		//var_dump($info);
		//!!!!!!!!!!!!!
		$temp = array(); 
		$count = count($info);
		for($i = 0; $i<$count; $i++)
		{
			$temp[$info[$i]->var] = $info[$i]->info;
		}
		
		print json_encode(array(
		'info' => $temp
		,'time' => $this->benchmark->elapsed_time()
		,'memory' => $this->benchmark->memory_usage()
		)) ;
		
	}
