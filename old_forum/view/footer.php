     
 <p style="text-align:center;">
 
 <?php
    $count_query=$this->mod->get_count();
    $time_query=$this->mod->get_time();
    $time = microtime(true) - $this->start_time;
    printf('TIME %.4F sec. |', $time);
	
	$sql=(int)(($time_query/$time)*100);
	$php=100-$sql;
	echo 'PHP: '.$php.'%  SQL: '.$sql.'% |';
	echo 'SQL запрсосов:'.$count_query.'|';
	printf('SQL time: %.4F sec.', $time_query);
	
	

 
?>
   </p>  
     </div>
 </body>
</html>
