

CREATE DATABASE `RG`
    CHARACTER SET 'utf8';

USE `RG`;



CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
)CHARSET=utf8;



CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
)CHARSET=utf8;



CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `sex` varchar(2) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `zodiac` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `verifystring` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
)CHARSET=utf8;



CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `description` text,
  `price` float(10,2) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `userid` (`userid`),
  KEY `categoryid` (`categoryid`),
  FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`)
)CHARSET=utf8;



CREATE TABLE `collect` (
  `productid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  KEY `productid` (`productid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`productid`) REFERENCES `product` (`id`),
  FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
)CHARSET=utf8;


CREATE TABLE `comment` (
  `productid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `message` text,
  `posttime` datetime DEFAULT NULL,
  KEY `productid` (`productid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`productid`) REFERENCES `product` (`id`),
  FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
)CHARSET=utf8;



CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `posttime` datetime DEFAULT NULL,
  `poster` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARSET=utf8;



CREATE TABLE `orders` (
  `productid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  KEY `productid` (`productid`),
  KEY `userid` (`userid`),
  FOREIGN KEY (`productid`) REFERENCES `product` (`id`),
  FOREIGN KEY (`userid`) REFERENCES `user` (`id`)
)CHARSET=utf8;

