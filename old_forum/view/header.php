<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?=$page['title']?></title>
  
  <link rel="stylesheet" type="text/css" href="/styles.css">
   
   <script type="text/javascript">
   



 function send(idtheme){
		
		var http = new XMLHttpRequest();
		var url = "index.php";
		var params = "add=1&text="+document.getElementById('text').value+"&idtheme="+idtheme+"&start=<?=$page['start'];?>";
		
		
		http.open("POST", url, true);

		
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.setRequestHeader("Content-length", params.length);
		http.setRequestHeader("Connection", "close");

		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				//alert(http.responseText);
				document.getElementById('messages').innerHTML=http.responseText;
				
				document.getElementById('send_status').innerHTML="<b>Сообщение успешно отправлено</b>";
				
			}
			else
			{
				document.getElementById('send_status').innerHTML="<b>Ошибка</b>";	
			}
			
		}
		
		http.send(params);
}
   
 
   
   </script>


  
 </head>
 <body >
	 
	 
	 <div class="conteiner">
		 
	<div class="search"> 
	 <form action="">
		 <input type="text" name="search" placeholder="Поиск..">
		 <input type="submit">
		 
	 </form>
	 </div>	 
		 
	 <?php if(isset($page['idtheme'])):?>
		<div class="breadcrams"><a href="/">Список тем</a> ->  <?=$page['title'] ?></div>
	 <?php endif; ?>
	



