<?php 


include 'header.php'; 

include 'nav.php' ; 
?>
    

   
    
		 <div class="category">
			 <div class="head_cat">
					<div class="image"></div>
					<div class="name">Название темы</div>
					<div class="views">Ответов(Просмотров)</div>
					<div class="lostmess">Последнее сообщение</div>
				</div>
			 
			 
			 
		 <?php 
		 
		 foreach($page['forum_thems'] as $item): ?>
					
			
				<div class="thems">
					<div class="image"></div>
					<div class="name">
						<a href="/?id=<?=$item[0];?>&f=1"><?=$item[1];?></a>
						
						<?php $this->get_pagination($item[0],$page['thems_all_info'][$item[0]][1]); ?>
						</div>
					
					
					<div class="views"><?=$page['thems_all_info'][$item[0]][1]?> (<?=$item[2]?>)</div>
					<div class="lostmess"><?php
					$time=$page['thems_all_info'][$item[0]][2];
					
					if(!isset($time)){ echo 'нет сообщений';   }
					elseif(date('S d F, Y',$time)==date('S d F, Y',time())){
						echo 'Сегодня,';
						echo date(' H:i',$time);
					}
					else{
						echo strftime('%a %e %b, %G',$time);
						echo date(' H:i',$time);
					}
					
					
					?> </div>
				</div>
				
		 <?php endforeach; ?>
		 
		 </div>
		 
        
     


<?php include 'footer.php' ?>
