<?php
/*Самый главный класс
 * 
 * */

class Core {
    
    private $mod;
    public $start_time;
   
   
   
   
   
   
    public function __construct($start_time) {
		$this->start_time =$start_time;	
			
		$this->mod=new Model();
		/*
		//========================
		
		$this->mod->create_teables();
		//добавляем собщения
		
		for($i=1;$i<=150000;$i++){
			$this->mod->add_theme('Тема№'.$i);
			$time=time();
			//for($j=1;$j<2;$j++){
				$this->mod->add_message('Сообщение № 1Тема№'.$i ,$i,$time);
				$this->mod->add_message('Сообщение № 2Тема№'.$i ,$i,$time);
				$this->mod->add_message('Сообщение № 3Тема№'.$i ,$i,$time);
				$this->mod->add_message('Сообщение № 4Тема№'.$i ,$i,$time);
				$this->mod->add_message('Сообщение № 5Тема№'.$i ,$i,$time);
			//}
		} 
		*/
		
		
		$id=(int)filter_input(INPUT_GET, 'id');
		
		if(!filter_var($id, FILTER_VALIDATE_INT)){
			$id=0;
		} 
		//========================================
		$add= (int)filter_input(INPUT_POST, 'add');
		
		if(!filter_var($add, FILTER_VALIDATE_INT)){
			$add=0;
		} 
		//==========================================
		
		
		$search= filter_input(INPUT_GET, 'search');
		
		//==========================================
		$start=(int)filter_input(INPUT_GET, 'start');
		
		
		
		if(!filter_var($start, FILTER_VALIDATE_INT)){
			$start=0;
		} 
		//========================================
		
		if(is_numeric($id) && $id>0){
			//список сообщений темы

			
			$f=(int)filter_input(INPUT_GET, 'f');//первый переход на тему с главной
			if(!filter_var($f, FILTER_VALIDATE_INT)){
				$f=0;
			} 
			
			//echo $f;
			$theme=$this->info_theme($id,$start);
			
			if(is_array($theme)){			
				$this->messages($theme,null,$f);
			}
			
			else{
				$this->index();
			}
			//
		}
		elseif($add==1){
			$text= filter_input(INPUT_POST, 'text');
			
			//=============================================
			$start_p=(int)filter_input(INPUT_POST, 'start');
			if(!filter_var($start_p, FILTER_VALIDATE_INT)){
				$start_p=0;
			} 
			//==============================================
			$id= filter_input(INPUT_POST, 'idtheme');
			if(!filter_var($id, FILTER_VALIDATE_INT)){
				$id=0;
			} 
			//==============================================
			$r=$this->mod->theme_info($id);  	
			$rez=$this->result($r); //если id <=0 или нет такого то просто выдаст 0 
			
			
			
			
			
			if(is_array($rez)){			
				//$this->messages($theme,$text);
				//так как сначала нужно добавить а потом выводить
				$this->add_message($text,$id,$start_p);
				
			}
			else{
				$this->index();
			}
				
		}
		elseif(isset($search) && strlen($search)>0){
			$this->search($search,$start);
		}
		else{
			$this->index($start);
		}
		
		
		
       
    }//end constructor
    
    
    function search($search,$start){
		$page['title']='Поиск';
		
		$r=$this->mod->search($search,$start);
		
		$page['content']=$this->result($r);
		$page['idtheme']=0;
		
		$r=$this->mod->search_count($search);
		$rez=$this->result($r);
		
		$page['count']=$rez[0][0];
                
                if($start>$page['count'])$start=0;//
		
		$page['start']=$start;
		
		$page['search']=$search;
		
		$this->view($page,'search');
	}
    
    
   public  function index($start){
		
		//главня страница
		$page['title']='Добро пожаловать';
		
		
		
		//
		
		
		
		
		
		$r=$this->mod->get_themes($start);
		//if($r)
		
		$page['forum_thems']=$this->result($r);
		
		
		$r=$this->mod->get_count_themes();
		$rez=$this->result($r);
		$page['count']=$rez[0][0];//
		
		$r=$this->mod->info_all_themes($start);
		$page['thems_all_info']=$this->result_2($r);
		
                if($start>$page['count'])$start=0;//
		$page['start']=$start;
		
		$this->view($page);
	}
    
    
    function messages($theme, $text=null,$f=null){
		//$f говорит о том что первый раз перешли сюда

		$page['title']=$theme['name'];
		$page['content']=$theme['array'];
		$page['idtheme']=$theme['id'];
		$page['count']=$theme['count'];
                
                if($start>$page['count'])$start=0;//
                
		$page['start']=$theme['start'];
		
		if(is_null($text)){
			$this->view($page,'mess');
			
			//увеличиваем просмотры темы на 1 значение 
			if($f==1)
				$this->mod->add_view_theme($theme['id']);
			
				
		}
		else{
			
			//$this->add_message($text,$theme['id']);
			$this->view($page,'contmess');
		}
		
		
	}
    
    
    function add_message($info,$themeid,$start=0){
			if(strlen($info)>0){
                                $info=strip_tags($info);
				$this->mod->add_message($info,$themeid,time());
				$theme=$this->info_theme($themeid,$start);
				$this->messages($theme,1);
			}
			else {
				echo 'нельзя добавить пустое сообщение';
				}

	}
    
    
    
    
    //==============
    
    

    
     function  view($page,$file='front'){
        // $page - массив данных который нужно вывести
        //шаблон отображаеться и использует переменные этого класса и метода
        include DIR_PATH.'/view/'.$file.'.php';
    }
    
    
    
    
    
    function result_2($r){
            //
            
            if(mysql_num_rows($r) <1){
                    return 0;
            }
            
            $mass= array();
            
            
            while($t=mysql_fetch_row($r)){
                $mass[$t[0]]=$t;
           }     
            
            return  $mass;
        }
    
    
    
    
    
     function result($r){
            //
            
            if(mysql_num_rows($r) <1){
                    return 0;
            }
            
            $mass= array();
            
            
            while($t=mysql_fetch_row($r)){
                $mass[]=$t;
           }     
            
            return  $mass;
        }
    
		
	public function get_pagination($idtheme,$count){
	 //нужна для главной страници для вывода пагинаций
		$page['idtheme']=$idtheme;
		$page['count']=$count;
		$page['f']=1;
		$this->view($page,'nav');
	}	
		
		
		
	function info_theme($idtheme, $start=0){
		/*выводим информацию о теме
		 * количестко записей
		 * имя темы 
		 * 
		 * $start = откуда начинать
		 * 
		 */
		
		
		 
		 
		$r=$this->mod->theme_info($idtheme);  	
		$rez=$this->result($r);
		if($rez==0) return 0; // такой темы нет просто напросто
		
		$theme=array();
		$theme['id']=$idtheme;
		$theme['name']=$rez[0][1];//имя темы
		
		$rez=$this->result($this->mod->count_messages($idtheme));
		$theme['count']=$rez[0][0];
		
		
		
		$rez=$this->result($this->mod->get_messages($idtheme,$start));
		$theme['array']=$rez;
		
		
		
		$theme['start']=$start;
		
		return $theme;
	}	
    
    
}


