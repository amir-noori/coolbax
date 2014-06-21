CREATE TABLE http_session (
	id SERIAL PRIMARY KEY NOT NULL,
	ascii_session_id character varchar(32),
	logged_in boolean,
	user_name varchar(30),
	last_impression timestamp,
	created timestamp,
	user_agent character varchar(256)
);

CREATE TABLE user(
	userName varchar(30) PRIMARY KEY NOT NULL,
	password varchar(30) NOT NULL,
	firstName varchar(30) NOT NULL,
	lastName varchar(30) NOT NULL,
	email varchar(100) NOT NULL
);

CREATE TABLE session_variable (
	id SERIAL PRIMARY KEY NOT NULL,
	session_id int(4),
	variable_name character varchar(64),
	variable_value text
);


CREATE TABLE profile(
	id SERIAL PRIMARY KEY NOT NULL,
	userName varchar(30) NOT NULL,
	firstName varchar(30) NOT NULL,
	lastName varchar(30) NOT NULL,
	email varchar(100) NOT NULL,
	homeAddress varchar(200),
	phoneNumber int(15),
	about text
);

CREATE TABLE gallery(
	id SERIAL PRIMARY KEY NOT NULL,
	imagePath varchar(200),
	imageName varchar(30),
	isProfile boolean,
	userName varchar(30),
	FOREIGN KEY (userName) REFERENCES user(userName)
);


CREATE TABLE message(
	id SERIAL PRIMARY KEY NOT NULL,
	fromUser varchar(200),
	toUser varchar(30),
	subject varchar(50),
	readed boolean,
	messageText text,
	FOREIGN KEY (fromUser) REFERENCES user(userName),
	FOREIGN KEY (toUser) REFERENCES user(userName)
);

CREATE TABLE setting(
	id SERIAL PRIMARY KEY NOT NULL,
	userName varchar(200),
	searchableByFriends boolean,
	searchableByother boolean,
	accessImageGalleryByFriends boolean,
	accessImageGalleryByOthers boolean,
	FOREIGN KEY (userName) REFERENCES user(userName)
);

CREATE TABLE friend(
	userName varchar(30) NOT NULL,
	friendName varchar(30) NOT NULL,
	PRIMARY KEY (userName , friendName)
);


CREATE TABLE request(
	request varchar(30) NOT NULL,
	fromUserName varchar(30) NOT NULL,
	toUserName varchar(30) NOT NULL,
	created timestamp,
	PRIMARY KEY (fromUser , toUser)
);

CREATE TABLE chat(
	id SERIAL PRIMARY KEY NOT NULL,
	message text,
	sender varchar(30) NOT NULL,
	receiver varchar(30) NOT NULL,
	readed boolean
);

CREATE TABLE share(
	id SERIAL PRIMARY KEY NOT NULL,
	data text,
	whoShared varchar(30) NOT NULL,
	whozPerspective varchar(30) NOT NULL,
	imagePath varchar(200),
	created timestamp
);

CREATE TABLE info(
	userName varchar(30) PRIMARY KEY NOT NULL,
	whozPerspective varchar(30) NOT NULL
);