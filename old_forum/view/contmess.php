
 <?php include 'nav.php' ; ?>
 
 
 <?php foreach($page['content'] as $item): ?>
		 
			
				<div class="mess">
					<div class="data"> Дата:
					<?php
					$time=$item[3];
					if(date('S d F, Y',$time)==date('S d F, Y',time())){
						echo 'Сегодня,';
					}
					else{
						echo strftime('%a %e %b, %G',$time);
					}
					
					echo date(' H:i',$time);
					?> </div>
					
					<div class="text"><?=$item[1];?></a></div>
				</div>
				
			
		 
<?php endforeach; ?>


