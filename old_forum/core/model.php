<?php

/*
 *класс для работы с БД
 */
class Model {
   
     private $db_connect; 
     private $q_count; //для подсчета количества запросов
     private $q_time;
     
      public function __construct( ) {
          $this->db_connect();
          $this->q_count=0;
          $this->q_time=0;
          
      }
     function db_connect(){
        
        // Соединяемся, выбираем базу данных
            $this->db_connect = mysql_connect(_db_host, _db_user, _db_pass)
            or die('Не удалось соединиться: ' . mysql_error());
           // echo 'Соединение успешно установлено';  
          
           
            mysql_query('SET NAMES utf8'); //указываем кодировку
            mysql_set_charset('utf8',$this->db_connect);
            mysql_select_db(_db_name) or die('Не удалось выбрать базу данных');
         
    }   
    
    
		public function theme_info($id){
			 settype($id, 'integer');
			$q= sprintf('SELECT * 
            FROM  `themes` 
            WHERE `id` = "%d"',$id);
           
           $r=$this->query($q);
           
           return $r;
		}
        
        
        
        
         public function get_count_themes(){
           //получит количество тем
           
			$q= 'SELECT count(*) 
            FROM  `themes` ';
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
       
         public function get_themes($start){
           //получит список тем
           settype($start, 'integer');
           
			$q= sprintf('SELECT * 
            FROM  `themes` 
            LIMIT 10
            OFFSET %d',$start);
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
        
            function info_all_themes($start){
		    settype($start, 'integer');
		   
			$q=sprintf('SELECT `idtheme`, COUNT(*) ,max(`timecreate`) 
			FROM `messages` 
			GROUP BY `idtheme` 
			LIMIT 10
            OFFSET %d',$start);

		    $r=$this->query($q);
           
           return $r;
		}
         
        
          public function get_messages($idtheme, $start=0){
           //получит список сообщений
           settype($idtheme, 'integer');
           settype($start, 'integer');
			$q= sprintf('SELECT * 
            FROM  `messages` 
            WHERE `idtheme` = "%d"
            ORDER BY `id` 
            LIMIT 10
            OFFSET %d',$idtheme,$start);
           
           
          
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
        
          public function search($search,$start=0){
           //поиск
            settype($start, 'integer');
			$q= sprintf('SELECT * 
            FROM  `messages` 
            WHERE  `info` LIKE  "%s%s%s"
            ORDER BY `id` 
            LIMIT 10
            OFFSET %d','%',
            mysql_real_escape_string($search),'%',$start);          
           
           
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
          public function search_count($search){
           //поиск
           
			$q= sprintf('SELECT  count(*) 
            FROM  `messages` 
            WHERE  `info` LIKE  "%s%s%s"
            ORDER BY `id`','%', mysql_real_escape_string($search),'%');          
           
           
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
        
        public function add_view_theme($id){
			    settype($id, 'integer');
				$q= sprintf('UPDATE  `themes` 
				SET `views` =  `views` + 1
				WHERE `id` = "%d"',$id);
           
           
          // echo $q;
           
           $this->query($q);
			
		}
        
         public function count_messages($idtheme){
           //получит количестко сообщений
           settype($idtheme, 'integer');
			$q= sprintf('SELECT  count(*) 
            FROM  `messages` 
            WHERE `idtheme` = "%d"',$idtheme);
           
           $r=$this->query($q);
           
           return $r;
         
        }
        
      

        
        
        public function add_theme($name){
           //создаем тему
			$q= sprintf('INSERT INTO  `themes` 
            SET `name`="%s",
            views = 0
            ',mysql_real_escape_string($name));   
           $this->query($q);
        }
        
        
        
          public function add_message($info,$idtheme, $time){
           //создаем сообщение
			settype($idtheme, 'integer');
            settype($time, 'integer');
                 
           $q=sprintf('INSERT INTO  `messages` 
				SET `info`="%s" ,
                `idtheme` = "%d" ,
                `timecreate` ="%d" ',
            mysql_real_escape_string($info),
            $idtheme,$time);    
                 
                  
           $this->query($q);
        }
        
        
        
        
        
       
	    public function create_teables(){
		   
				
			//таблица тем 	
			$q='CREATE TABLE IF NOT EXISTS themes (
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY(id),
				 name TEXT,
				 views INT
				)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';
			
				$this->query($q);
				
				
				
			//теперь таблицу сообщений
			$q='CREATE TABLE IF NOT EXISTS messages (
				id INT NOT NULL AUTO_INCREMENT, 
				PRIMARY KEY(id),
				 info TEXT,
				 idtheme INT,
				 timecreate INT
				)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';
			
				
				$this->query($q);
				
			
			
			}
		
      
		function query($q){
				 $start = microtime(true);
				 $r=mysql_query($q) or die('Err: ' . mysql_error());
				 $this->q_time+= microtime(true) - $start;
				 
				 $this->q_count++;
				 return $r;
			}
       
        public function get_count(){
				return $this->q_count;
			}
		public function get_time(){
				return $this->q_time;
			}
        
                
     function __destruct() {
         // Закрываем соединение
            mysql_close($this->db_connect);
   }
    
    
    
}
