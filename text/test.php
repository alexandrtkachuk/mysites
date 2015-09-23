<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
  "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Моя первая веб-страница</title>
 </head>
 <body>


<?php
/*
		2 функции для взаимодействия с API Text.ru посредством POST-запросов.
		Ответы с сервера приходят в формате JSON. 
	*/

	//-----------------------------------------------------------------------
	
	/**
	 * Добавление текста на проверку
	 *
	 * @param string $text - проверяемый текст
	 * @param string $user_key - пользовательский ключ
	 * @param string $exceptdomain - исключаемые домены
	 *
	 * @return string $text_uid - uid добавленного текста 
	 * @return int $error_code - код ошибки
	 * @return string $error_desc - описание ошибки
	 */
	function addPost()
	{
		$postQuery = array();
		$postQuery['text'] = "бла бла бла и все такое, домены разделяются пробелами либо запятыми. Данный параметр является необязательным. ";
		$postQuery['userkey'] = "dbb02b99372d4fecd0feaa070cfa55db";
		// домены разделяются пробелами либо запятыми. Данный параметр является необязательным.
		//$postQuery['exceptdomain'] = "site1.ru, site2.ru, site3.ru";
		// Раскомментируйте следующую строку, если вы хотите, чтобы результаты проверки текста были по-умолчанию доступны всем пользователям
		//$postQuery['visible'] = "vis_on";
		// Раскомментируйте следующую строку, если вы не хотите сохранять результаты проверки текста в своём архиве проверок
		//$postQuery['copying'] = "noadd";
		// Указывать параметр callback необязательно
		//$postQuery['callback'] = "Введите ваш URL-адрес, который примет наш запрос";

		$postQuery = http_build_query($postQuery, '', '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);
		
		//mb_convert_encoding($str, "SJIS");
		$me = json_decode($json);
		var_dump($me);
		
		var_dump($errno);
		// если произошла ошибка
		if (!$errno)
		{
			$resAdd = json_decode($json);
			if (isset($resAdd->text_uid))
			{
				$text_uid = $resAdd->text_uid;
				
			}
			else
			{
				$error_code = $resAdd->error_code;
				$error_desc = $resAdd->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
		}

		curl_close($ch);
	}

	/**
	 * Получение статуса и результатов проверки текста в формате json
	 *
	 * @param string $text_uid - uid проверяемого текста
	 * @param string $user_key - пользовательский ключ
	 *
	 * @return float $unique - уникальность текста (в процентах)
	 * @return string $result_json - результат проверки текста в формате json
	 * @return int $error_code - код ошибки
	 * @return string $error_desc - описание ошибки
	 */
	function getResultPost()
	{
		$postQuery = array();
		$postQuery['uid'] = "Введите уникальный идентификатор текста, полученный на предыдущем этапе";
		$postQuery['userkey'] = "Введите свой пользовательский секретный ключ";
		// Раскомментируйте следующую строку, если вы хотите получить более детальную информацию в результатах проверки текста на уникальность
		//$postQuery['jsonvisible'] = "detail";

		$postQuery = http_build_query($postQuery, '', '&');			 

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://api.text.ru/post');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postQuery);
		$json = curl_exec($ch);
		$errno = curl_errno($ch);

		if (!$errno)
		{
			$resCheck = json_decode($json);
			if (isset($resCheck->text_unique))
			{
				$text_unique = $resCheck->text_unique;
				$result_json = $resCheck->result_json;
			}
			else
			{
				$error_code = $resCheck->error_code;
				$error_desc = $resCheck->error_desc;
			}
		}
		else
		{
			$errmsg = curl_error($ch);
		}

		curl_close($ch);
	}
	
	
	/////////////////
	
	$res = addPost();
	
	var_dump($res);
?>

</body> </html>