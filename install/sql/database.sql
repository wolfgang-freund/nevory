DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(200) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  `role` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) );
  
  CREATE INDEX `id` ON `users` (`id`);