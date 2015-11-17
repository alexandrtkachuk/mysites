<?php

/*
 * формируем навигацию */
?>

<p>
<?php
    //$id= $page['idtheme'];
   $g_vaible=''; 
    
   if(!isset($page['idtheme'])){
	   }
   elseif(isset($page['search'])){
	   $g_vaible='search='.$page['search'].'&';
	   }
   else{
	   $g_vaible='id='.$page['idtheme'].'&';
	   }
	   
	   if($page['f']==1){
		   $g_vaible.='f=1&';
		}
	   
$k=1;
for($i=0,$t=0;$i<$page['count'] ;$i+=10,$k++,$t++):
if($page['count']<=10)break;
if($t>5)break;
?> 
 
 
 <a href="?<?=$g_vaible?>start=<?=$i?>" > <?=$k?></a>
 
 <?php endfor; ?>
 
 <?php //echo $i; 

if(isset($page['start'])):
//выводим наше положение
	

	if($i==$page['start']){
		
		
		}	
	elseif($i+30<$page['start']){
		$i=$page['start']-20;;
		echo '...';
		
		}

	
	for($t=0;$i<$page['count'] ;$i+=10,$k++,$t++):
	if($page['count']<=10)break;
	if($t>5)break;
?> 
 
 
 <a href="?<?=$g_vaible?>start=<?=$i?>" > <?=(int)($i/10+1)?></a>
 
 <?php 
	endfor; 
endif;
 ?>
 
 <?php
 // и 5 последних 
 //echo $i; 
 
 $temp=$page['count']-$i;
 
	if($temp<=0){
	 $t='10';
	 }
	elseif($temp<=50){
		 //echo '...';
			//$i=$page['count']-$temp;
			$t=0;
		 
	}
	else{
		echo '...';
		$i=$page['count']-($page['count']%10);
		$i-=50;
		$t=0;
	 
		//echo 'count='.$page['count'].'%='.$page['count']%10;
	 }
 
 for(;$i<$page['count'] ;$i+=10,$k++,$t++):
	if($page['count']<=10)break;
	if($t>5)break;
?> 
 
 
 <a href="?<?=$g_vaible?>start=<?=$i?>" > <?=(int)($i/10+1)?></a>
 
 <?php 
	endfor; 
 
 ?>
 
 
 
 
 
 </p>


