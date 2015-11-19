SELECT 'START';

DROP TABLE IF EXISTS messages;

DELIMITER //

create procedure fun1() 
begin
    set @p := 0;
    while @p<=650000 do 
	set @p:=@p+1;
	set @t:= HEX(FLOOR(RAND() * 25600000));
	set @test:= 100 *RAND();
	INSERT INTO messages ( info, idtheme, timecreate) 
	    VALUES ( CONCAT(md5(@t),' and ' , HEX(@p), ' and test', CHAR(@test) ) ,@p  ,now() + @p );

end while;

end;


//
DELIMITER ;


CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info` text,
  `idtheme` int(11) DEFAULT NULL,
  `timecreate` int(11) DEFAULT NULL,
  FULLTEXT(info),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

SELECT 'CALL FUN';
call fun1();

drop procedure  IF EXISTS fun1;

SELECT 'END SCRIPT';
