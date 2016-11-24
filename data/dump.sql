CREATE DATABASE IF NOT EXISTS `ed_task` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ed_task`;

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  `text` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `observer` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  `event` INT(11),
  `order_num` INT(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO observer (name, event, order_num) VALUES ('CommentEditor', 1, 1), ('CommentLogger', 1, 2), ('CommentLogger', 2, 2);