DROP TABLE IF EXISTS panelUsers ;

CREATE TABLE panelUsers (id SMALLINT(1) UNSIGNED NOT NULL AUTO_INCREMENT , 
	name VARCHAR(128) , 
    pass VARCHAR(128),

    PRIMARY KEY (id) );
	
/*-- Add user
*/
INSERT INTO panelUsers (name , pass ) VALUES ( 'me', MD5('me:welcome:test'));

DROP TABLE IF EXISTS panelUsers2Info ;
CREATE TABLE panelUsers2Info (
	idUser SMALLINT(1) UNSIGNED, 
    var VARCHAR(12),
	info VARCHAR(128)
	);

/*
posts: id, name, idUser, body, createTime, modTime
*/

DROP TABLE IF EXISTS panelPosts ;

CREATE TABLE panelPosts (
	id INT(1) UNSIGNED  NOT NULL AUTO_INCREMENT, 
    idUser SMALLINT(1) UNSIGNED, 
	name VARCHAR(64),
	body TEXT,
	createTime DATETIME, 
	modTime DATETIME,
	active BOOL,
	PRIMARY KEY (id));