<?php

class Post
{
    protected static $me;
    protected static $connectDB;


    protected function   __construct() 
    {
	self::$connectDB = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME ,DB_USER, DB_PASS);
	self::$connectDB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    public static function create()
    {
	if(!isset(self::$me))
	{
	    self::$me = new self();
	    return self::$me;
	}
    }

    public function search($searchString)
    {
	/*
	 * if using FULLTEXT varible need more four simbols*/
	    /* 'SELECT * 
            FROM  `messages` 
            WHERE  `info` LIKE  "%?%"
            ORDER BY `id` 
	    LIMIT 10' */


	//
	//$t = self::$connectDB->prepare('SELECT id, info   FROM messages  WHERE  MATCH (info) AGAINST (?)  ORDER BY timecreate');
	//$searchString = "%$searchString%";

	$r_count = self::$connectDB->prepare('SELECT count(id) 
	    FROM  messages   
	    WHERE  MATCH (info) AGAINST ( ? ) ');
	
	$r_count->execute((array)$searchString);
	
	$count  = $r_count->fetchColumn();

	echo "count = $count ";

	$t = self::$connectDB->prepare('SELECT id, info 
	    FROM  messages   
	    WHERE  MATCH (info) AGAINST ( ? )  
	    ORDER BY id DESC  LIMIT  6000, 10');


	$t->execute((array)$searchString);
	
	print "\n";
	print_r($t->rowCount());
	print "\n";
	
		
	while($ob = $t->fetch())
	{	    
	    print_r($ob);
	    print "\n";
	    break;
	}

	

    }

    public function __distructor()
    {    
	$this->connectDB = NULL;	
    }
}
