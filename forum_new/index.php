<?php

require_once ('config.php');
require_once (LIBS.'/functions.php');

$start_time = microtime(true);

$post = Post::create();

$post->search('testQ');

$time = microtime(true) - $start_time;

print "time = $time \n";
