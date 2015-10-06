DROP TABLE IF EXISTS panelUsers ;

CREATE TABLE panelUsers (id SMALLINT(1) UNSIGNED NOT NULL AUTO_INCREMENT , 
	name VARCHAR(64) , 
    pass VARCHAR(128),
	url VARCHAR(64), /*site url*/
    PRIMARY KEY (id) );
	
/*-- Add user
*/
INSERT INTO panelUsers (name, pass, url ) VALUES ( 'me', MD5('me:welcome:test'), 'assembler.com.ua');

DROP TABLE IF EXISTS panelUsers2Info ;
CREATE TABLE panelUsers2Info (
	idUser SMALLINT(1) UNSIGNED, 
    var VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_bin,
	info VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_bin
	);

/*
posts: id, name, idUser, body, createTime, modTime
*/

DROP TABLE IF EXISTS panelPosts ;
/*
page need have image
*/
CREATE TABLE panelPosts (
	id INT(1) UNSIGNED  NOT NULL AUTO_INCREMENT, 
    idUser SMALLINT(1) UNSIGNED, 
	name VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_bin,
	image VARCHAR(128),
	body TEXT,
	createTime DATETIME, 
	modTime DATETIME,
	active BOOL,
	PRIMARY KEY (id));
	
/*
uu
*/
DROP TABLE IF EXISTS panelFiles ;

CREATE TABLE panelFiles (
	id INT(1) UNSIGNED  NOT NULL AUTO_INCREMENT, 
    body MEDIUMBLOB ,
	idUser SMALLINT(1) UNSIGNED,
	title VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_bin,
	info VARCHAR(256)  CHARACTER SET utf8 COLLATE utf8_bin,
	PRIMARY KEY (id));
	