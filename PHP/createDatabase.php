CREATE DATABASE money_4_memes;

CREATE TABLE users(id varchar(31) PRIMARY KEY, name varchar(255), password varchar (255), email varchar (255), popularMemes int (31), earnings double (15,2), admin int(2), bankingID varchar (255), cart varchar (2047));
INSERT INTO users VALUES ("0.nqjdr90iqi", 'Nathan', "9315", "nateroskelley@gmail.com",0,0,1,"","");

CREATE TABLE memes( id VARCHAR(31) PRIMARY KEY, title varchar(511), pointerID varchar (31), likes int(15), age int(255), score int (127),
	hasShirt tinyint, tags varchar (511), description varchar (255), fileType varchar (8), isPrivate tinyint);

CREATE TABLE comments(comment VARCHAR (255), userid VARCHAR (31), memeid VARCHAR (31), name varchar(1023));

CREATE TABLE likes(userid VARCHAR (31), memeid VARCHAR (31));

CREATE TABLE tags (tag VARCHAR (31) PRIMARY KEY);

/*add is private to memes*/
