DROP TABLE IF EXISTS panelUsers ;

CREATE TABLE panelUsers (id INT NOT NULL AUTO_INCREMENT , 
	name VARCHAR(128) , 
    pass VARCHAR(128),

    PRIMARY KEY (id) );
	
/*-- Add user
*/
INSERT INTO panelUsers (name , pass ) VALUES ( 'me', MD5('me:welcome:test'));

DROP TABLE IF EXISTS panelUsers2Info ;
CREATE TABLE panelUsers2Info (
	idUser int, 
    var VARCHAR(12),
	info VARCHAR(128)
	);
