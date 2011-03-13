SET FOREIGN_KEY_CHECKS=0;


DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS forums;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS groups_roles;
DROP TABLE IF EXISTS options;
DROP TABLE IF EXISTS postcache;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS privatemessages;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS topics;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS users_privatemessages;

CREATE TABLE categories
(
	id INTEGER NOT NULL AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE forums
(
	id INTEGER NOT NULL AUTO_INCREMENT,
	title VARCHAR(100) NOT NULL,
	category_id INTEGER NOT NULL,
	description VARCHAR(255) NULL,
	topic_count BIGINT NULL,
	group_id BIGINT NULL,
	`order` DECIMAL(10,10) NULL,
	PRIMARY KEY (id),
	KEY (category_id),
	KEY (group_id)
) ENGINE=InnoDB;


CREATE TABLE groups
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	title VARCHAR(50) NULL,
	PRIMARY KEY (id)
) ;


CREATE TABLE groups_roles
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	role_id BIGINT NULL,
	group_id BIGINT NULL,
	PRIMARY KEY (id),
	KEY (group_id),
	KEY (role_id)
) ;


CREATE TABLE options
(
	id INTEGER NOT NULL,
	optionkey VARCHAR(50) NOT NULL,
	optionvalue VARCHAR(100) NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE postcache
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	topic_id BIGINT NOT NULL,
	post_id BIGINT NOT NULL,
	created DATETIME NOT NULL,
	PRIMARY KEY (id),
	KEY (post_id),
	KEY (topic_id),
	KEY (user_id)
) ENGINE=InnoDB;


CREATE TABLE posts
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	topic_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	title VARCHAR(100) NULL,
	post TEXT NOT NULL,
	created DATETIME NULL,
	modified DATETIME NULL,
	forum_id BIGINT NOT NULL,
	PRIMARY KEY (id),
	KEY (forum_id),
	KEY (topic_id),
	KEY (user_id)
) ENGINE=InnoDB;


CREATE TABLE privatemessages
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	title VARCHAR(100) NOT NULL,
	post TEXT NOT NULL,
	created DATETIME NULL,
	PRIMARY KEY (id),
	KEY (user_id)
) ENGINE=InnoDB;


CREATE TABLE roles
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	title VARCHAR(50) NULL,
	admin TINYINT NULL,
	PRIMARY KEY (id)
) ;


CREATE TABLE topics
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	forum_id INTEGER NOT NULL,
	user_id BIGINT NOT NULL,
	created DATETIME NULL,
	title VARCHAR(100) NOT NULL,
	locked BOOL NULL,
	isglobal BOOL NULL,
	topictype SMALLINT NULL,
	post_count BIGINT NULL,
	PRIMARY KEY (id),
	KEY (forum_id),
	KEY (user_id)
) ENGINE=InnoDB;


CREATE TABLE users
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	handle VARCHAR(50) NOT NULL,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	status BOOL NULL,
	created DATETIME NULL,
	role_id INTEGER NULL,
	post_count BIGINT NULL,
	topic_count BIGINT NULL,
	PRIMARY KEY (id),
	KEY (role_id)
) ENGINE=InnoDB;


CREATE TABLE users_privatemessages
(
	id BIGINT NOT NULL AUTO_INCREMENT,
	user_id BIGINT NOT NULL,
	privatemessage_id BIGINT NOT NULL,
	isread BOOL NULL,
	PRIMARY KEY (id),
	KEY (privatemessage_id),
	KEY (user_id)
) ENGINE=InnoDB;



SET FOREIGN_KEY_CHECKS=1;
