CREATE DATABASE money_4_memes;

CREATE TABLE users(id varchar(31) PRIMARY KEY, name varchar(255), password varchar (255), email varchar (255), earnings double (15,2), admin int(2), bankingID varchar (255), fileType varchar (8));
INSERT INTO users VALUES ("0nqjdr90iqi", 'Nathan', "9315", "nateroskelley@gmail.com",0,1,"","");

CREATE TABLE memes( id VARCHAR(31) PRIMARY KEY, title varchar(255), pointerID varchar (31), bought int(15),
tags varchar (511), description varchar (511), age DATETIME(6));
ALTER TABLE memes ADD FULLTEXT (description);

CREATE TABLE comments(comment VARCHAR (255), userid VARCHAR (31), memeid VARCHAR (31), name varchar(1023));

CREATE TABLE tags (tag VARCHAR (31) PRIMARY KEY);

CREATE TABLE copyReports (memeid1 varchar(31), memeid2 varchar(31), submitterid varchar(31));

CREATE TABLE notifications(user VARCHAR(31), notification VARCHAR (255), date DATETIME(6));
