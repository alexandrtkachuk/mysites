<?php 


include 'header.php' ;

include 'nav.php' ;
?>
	 
     	
		 
		         
       <div class="messages"  id="messages">

	 
 
 <?php foreach($page['content'] as $item): ?>
		 
			
				<div class="mess">
					<div class="data"><?=$item[3];?></div>
					<div class="text"><?=$item[1];?></a></div>
				</div>
				
			
		 
<?php endforeach; ?>
		 
		</div>
        
        
        
     

	<?php include 'footer.php' ?>
