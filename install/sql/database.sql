DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(40) NOT NULL,
  salt varchar(40) NOT NULL,
  role varchar(50) NOT NULL,
  date_created datetime NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO users (username, password, salt, role, date_created)
VALUES ('admin', SHA1('passwordce8d96d579d389e783f95b3772785783ea1a9854'), 'ce8d96d579d389e783f95b3772785783ea1a9854', 'administrator', NOW());