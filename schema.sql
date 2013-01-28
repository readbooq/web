-- Create: 
-- 

DROP DATABASE IF EXISTS booq;
CREATE DATABASE booq;

USE booq;

CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
	email varchar(100) COLLATE utf8_bin NOT NULL,
	password varchar(255) COLLATE utf8_bin NOT NULL,
	activated tinyint(1) NOT NULL DEFAULT '1',
	new_password_key varchar(50) COLLATE utf8_bin DEFAULT NULL,
	new_password_requested datetime DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE books (
	id int(11) NOT NULL AUTO_INCREMENT,
	bid varchar(6),
	eng_title varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
	thai_title varchar(100) COLLATE utf8_unicode_ci NOT NULL,
	lang varchar(8) NOT NULL,
	published date DEFAULT NULL,
	pages smallint NOT NULL DEFAULT 0,
	isbn varchar(17) DEFAULT NULL,
	sid int(11) DEFAULT NULL,
	description text NOT NULL DEFAULT '',
	font_cover varchar(100) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE annotations (
	id int(11) NOT NULL AUTO_INCREMENT,
	class varchar(10) NOT NULL,
	location smallint NOT NULL,
	length tinyint DEFAULT NULL,
	note varchar(255) DEFAULT NULL,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	cud varchar(1) DEFAULT 'c',
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE persons (
	id int(11) NOT NULL AUTO_INCREMENT,
	eng_name varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
	thai_name varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	wiki varchar(100) NOT NULL DEFAULT '',
	facebook varchar(100) DEFAULT '',
	twitter varchar(100) DEFAULT '',
	description text NOT NULL DEFAULT '',
	thumbnail varchar(100) NOT NULL DEFAULT '',
	thumbnail_source varchar(100) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE series (
	id int(11) NOT NULL AUTO_INCREMENT,
	eng_name varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
	thai_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE genres (
	id int(11) NOT NULL AUTO_INCREMENT,
	parent_id int(11),
	eng_name varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
	thai_name varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE publishers (
	id int(11) NOT NULL AUTO_INCREMENT,
	eng_name varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
	thai_name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE book_publisher (
	id int(11) NOT NULL AUTO_INCREMENT,
	book_id int(11) NOT NULL,
	publisher_id int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (book_id) REFERENCES books(id),
	FOREIGN KEY (publisher_id) REFERENCES publishers(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
	