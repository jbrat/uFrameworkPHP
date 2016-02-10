drop table if exists statuses;

CREATE TABLE statuses
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user VARCHAR(100),
    message VARCHAR(400),
    date DATE
);

CREATE TABLE user
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	login VARCHAR(100),
	password VARCHAR(100)
);

INSERT INTO statuses(user,message,date) VALUES("jubrat","Sortie de php7 aleluja !",SYSDATE());
INSERT INTO statuses(user,message,date) VALUES("jubrat","PHP est le meilleur langage",SYSDATE());
INSERT INTO statuses(user,message,date) VALUES("panegroni","Le php c'est la vie !",SYSDATE());

