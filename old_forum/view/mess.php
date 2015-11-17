<?php 


include 'header.php' 

?>
	 
     
		 
		         
       <div class="messages"  id="messages">
			 
		<?php include 'contmess.php' ?>
		 
		 </div>
        <hr />
        
        <div class="form">
			<p id="send_status"></p>
			<p><b>Добавить сообщение</b></p>
			<p><textarea id="text"></textarea></p>
			
			<p><button onclick="send(<?=$page['idtheme']?>)">Отправить</button></p>
			
        </div>
        
        
     

	<?php include 'footer.php' ?>
