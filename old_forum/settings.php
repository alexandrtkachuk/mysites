<?php

/* 
* Настройки к базе данных
* подключение библиотек и прочего 
*/



define('DIR_PATH', '.'); //путь к корню каталога 

#print  DIR_PATH;

#die();

setlocale(LC_ALL, 'ru_RU.UTF-8');
//подключаем все библиотеки
include DIR_PATH.'/core/core.php';//подключили библиотеку ядра
include DIR_PATH.'/core/model.php';


define('_db_host',      'localhost');
define('_db_user',      'test_forum');
define('_db_pass',      'passtest');
define('_db_name',      'db_test_forum');


