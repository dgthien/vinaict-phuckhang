
```

/* 28-06-2012: Pham Thanh Nam: Order Management */

DROP TABLE IF EXISTS `purchase_order`;

CREATE TABLE `purchase_order` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(12) COLLATE utf8_unicode_ci NOT NULL,
  `id_customer` BIGINT(20) UNSIGNED NOT NULL,
  `order_date` DATE DEFAULT NULL,
  `amount` FLOAT UNSIGNED NOT NULL,
  `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `status` TINYINT(2) UNSIGNED NOT NULL,
  `description` TEXT COLLATE utf8_unicode_ci,
  `shipping_address` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_date` DATE DEFAULT NULL,
  `payment_date` DATE DEFAULT NULL,
  `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_date` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/* 29-06-2012: Pham Thanh Nam: Order Management */

DROP TABLE IF EXISTS `purchase_order_detail`;

create table `purchase_order_detail`( 
   `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT , 
   `id_purchase_order` bigint UNSIGNED NOT NULL , 
   `id_product` bigint UNSIGNED NOT NULL , 
   `code_product` varchar(15) NOT NULL , 
   `name_product` varchar(250) NOT NULL , 
   `price_product` float NOT NULL , 
   `currency_product` varchar(3) NOT NULL , 
   `desciption_product` text , 
   `image_product` varchar(300) , 
   `number` bigint UNSIGNED NOT NULL , 
   `is_deleted` tinyint(1) UNSIGNED DEFAULT '0' , 
   PRIMARY KEY (`id`)
 )ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `purchase_order_status`;

CREATE TABLE `purchase_order_status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_order_status`
--

INSERT INTO `purchase_order_status` (`id`, `name`) VALUES
(1, '<en>Unactive</en><vi>Chưa kích hoạt</vi>'),
(2, '<en>Pending</en><vi>Đang đợi</vi>'),
(3, '<en>Shipping</en><vi>Đang vận chuyển</vi>'),
(4, '<en>Done</en><vi>Hoàn thành</vi>');

/* 30-06-2012 : Ly Vinh Truong : Order Management */

INSERT  INTO `parameter`(`id`,`name`,`code`,`value`,`category`,`status`,`creation_date`,`modification_date`,`id_user_created`,`id_user_modified`,`disabled`) VALUES (53,'Unaccepted order status','ORD_STT_UNACCEPTED','1',1,0,'2012-06-30 19:00:16',NULL,1,NULL,0),(54,'Pending order status','ORD_STT_PENDING','2',1,0,'2012-06-30 19:01:53',NULL,1,NULL,0),(55,'Shipping order status','ORD_STT_SHIPPING','3',1,0,'2012-06-30 19:02:40',NULL,1,NULL,0),(56,'Completed order status','ORD_STT_COMPLETED','4',1,0,'2012-06-30 19:04:16',NULL,1,NULL,0),(57,'System timezone name','SYSTEM_TIMEZONE','Asia/Ho_Chi_Minh',1,0,'2012-06-30 19:47:00',NULL,1,NULL,0);

/* 01-07-2012 21:26 - Ly Vinh Truong - Menu Management */

ALTER TABLE `menu` 
   ADD COLUMN `relation` VARCHAR(100) NULL AFTER `type`;

/* 02-07-2012 16:15 - Ly Vinh Truong - Settings */
ALTER TABLE `parameter` 
   CHANGE `category` `always_load` TINYINT(1) DEFAULT '0' NOT NULL;

/* 02-07-2012 - Pham Thanh Nam - Manager Order */
INSERT INTO `permission` (`id`, `uri`, `id_user`, `id_group`, `value`) VALUES
(117, 'order/delete', 0, 1, '1,2,3,4'),
(118, 'order/detail', 0, 1, '1,2,3,4'),
(119, 'order/status', 0, 1, '1,2,3,4'),
(120, 'order/deleteOrderDetail', 0, 1, '1,2,3,4');

/* 03-07-2012 23:30 - Ly Vinh Truong - Settings */
ALTER TABLE `parameter` 
   ADD COLUMN `data_type` TINYINT(1) DEFAULT '1' NOT NULL AFTER `disabled`,
   ADD COLUMN `data` TEXT AFTER `data_type`;

/* 04-07-2012 15:30 - Huynh Ba An - News_Category */
DROP TABLE IF EXISTS `news_category`;

CREATE TABLE `news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text,
  `id_parent` varchar(50) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `link` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `news_category`(`id`,`name`,`description`,`id_parent`,`keyword`,`link`) VALUES (1,'test','Test is test for me, but me I don\'t know....\r\n','1','test','test_news_category'),(2,'Code function for back end page','This is function test. I am ..............','2','code','news_category');

/* 04-07-2012 - Pham Thanh Nam - Manager user group */

RENAME TABLE `group` TO `usr_group`;
RENAME TABLE `user_group` TO `usr_group_user`;
ALTER TABLE `usr_group_user` 
   CHANGE `id_group` `id_usr_group` SMALLINT(5) UNSIGNED NOT NULL;
ALTER TABLE `permission` 
   CHANGE `id_group` `id_usr_group` SMALLINT(5) UNSIGNED DEFAULT '0' NULL ;

UPDATE `permission` SET `uri` = 'usr_group' WHERE `permission`.`id` =43;

INSERT INTO `permission` (`id`, `uri`, `id_user`, `id_usr_group`, `value`) VALUES
(121, 'usr_group/delete', 0, 1, '1,2,3,4'),
(122, 'usr_group/edit', 0, 1, '1,2,3,4'),
(123, 'usr_group/add', 0, 1, '1,2,3,4'),
(133, 'article', 0, 1, '1,2,3,4'),
(125, 'article/add', 0, 1, '1,2,3,4'),
(126, 'article/delete', 0, 1, '1,2,3,4'),
(127, 'article/edit', 0, 1, '1,2,3,4');

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES
(58, 'max length of the code', 'MAX_LENGTH_CODE', '10', 1, 0, '2012-07-04 11:59:59', NULL, 1, NULL, 0, 1, NULL),
(59, 'max length of the name group', 'MAX_LENGTH_NAME_GROUP', '200', 1, 0, '2012-07-05 12:05:02', NULL, 1, NULL, 0, 1, NULL);


/* 05-07-2012 - Pham Thanh Nam - Manager article */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_news_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`link`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert  into `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`,`relation`) values (42,'<en>Article</en><vi>Bài viết</vi>',2,'article','article_list',31,0,2,NULL);

/* 05-07-2012 12:00 - Ly Vinh Truong - Settings */

UPDATE `parameter` SET `data_type` = 12, `value` = '<en>Phuc Khang Gilding Store</en><vi>Cửa Hàng Dát Vàng Phúc Khang</vi>' WHERE `id` = 15;

/* 05-07-2012 - Pham Thanh Nam - User (add field lang) */

alter table `user` 
   add column `lang` varchar(5) DEFAULT 'vi' NOT NULL after `is_business`;

/* 06-07-2012 - Huynh Ba An - Manager News category*/
insert  into `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`,`relation`)values
(44,'<en>Categories</en><vi>Danh mục tin</vi>',1,'news_category','news_category',31,0,2,NULL);


/* 06-07-2012 - Phạm Thanh Nam - Manager Purchase_order*/
ALTER TABLE `purchase_order` CHANGE `status` `status` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '1';

alter table `purchase_order` 
   add column `currency` varchar(3) DEFAULT 'VND' NULL after `modification_date`;


/* 10-07-2012 - Phạm Thanh Nam - Load menu frontend*/
UPDATE `menu` SET `section` = 'interior' WHERE `menu`.`id` =26;


/* 10-07-2012 - Phạm Thanh Nam - Manager News Category*/
alter table `news_category` 
   add column `is_deleted` tinyint(1) DEFAULT '0' NOT NULL after `link`;

INSERT INTO `permission` (`id` ,`uri` ,`id_user` ,`id_usr_group` ,`value`)VALUES ('134', 'news_category', '0', '1', '1,2,3,4') ,('135' , 'news_category/add', '0', '1', '1,2,3,4'),('136', 'news_category/edit', '0', '1', '1,2,3,4'),('137', 'news_category/delete', '0', '1', '1,2,3,4');

/* 10-07-2012 - Nguyễn Văn Cường - Manager site paramter*/

SET NAMES utf8;

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sign` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `rate` float unsigned NOT NULL DEFAULT '1',
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `currency` */

insert  into `currency`(`id`,`code`,`name`,`sign`,`rate`,`is_default`,`is_deleted`) values (1,'VND','<en>Vietnam Dong</en><vi>Đồng Việt Nam</vi>','đ',22000,0,0),(2,'USD','<en>US Dollar</en><vi>Đô la Mỹ</vi>','$',1,1,0);

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'M:Male|F:Female',
  `birthdate` date DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yahoo_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `id_user` int(10) unsigned DEFAULT NULL,
  `is_business` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tax_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `career` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `customer` */

insert  into `customer`(`id`,`email`,`firstname`,`lastname`,`company`,`gender`,`birthdate`,`billing_address`,`shipping_address`,`contact_address`,`home_phone`,`work_phone`,`mobile_phone`,`website`,`yahoo_id`,`skype_id`,`is_deleted`,`id_user`,`is_business`,`tax_code`,`fax`,`career`,`contact_person`,`position`) values (1,'truong.ly@gmail.com','Vĩnh Trường','Lý','Vina ICT','M','0000-00-00','170/46 Lê Đức Thọ, P.6, Q. Gò Vấp','170/46 Lê Đức Thọ, P.6, Q. Gò Vấp','170/46 Lê Đức Thọ, P.6, Q. Gò Vấp','','','','www.vinaICT.com','','',0,NULL,0,'123456',NULL,NULL,NULL,NULL),(2,'test@gmail.com','Văn A','Nguyễn','Test','M','0000-00-00','123 AAA','123 AAA','123456 ABC DEF','08123456','08654321','090123456','www.test.com','testym','testskype',0,NULL,0,'',NULL,NULL,NULL,NULL),(4,'test@abcdef.com','','','Test','M','0000-00-00','test','y=test','test','','','','','','',0,4,1,'123456789',NULL,'','Tester',NULL),(5,'truong@rubygraphic.com','','','Test Công ty','M','0000-00-00','123 ABC','123 ABC','123 ABD','','','','','','',0,5,1,'123456767',NULL,'','Tester',NULL);

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex2` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `group` */

insert  into `group`(`id`,`code`,`name`,`disabled`) values (15,'CUS','<en>Customers</en><vi>Khách hàng</vi>',0),(1,'ADM','<en>Administrators</en><vi>Quản trị hệ thống</vi>',0);

/*Table structure for table `image` */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `id_image_group` tinyint(2) DEFAULT NULL,
  `file` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `image` */

insert  into `image`(`id`,`code`,`name`,`description`,`id_image_group`,`file`,`creation_date`) values (1,'6579eb365589b2865b50ad48e919d5f5','22-06-2012 12:22:24','',NULL,'6579eb365589b2865b50ad48e919d5f5.jpg','2012-06-22 05:22:24'),(2,'44c5734f0f5500060d33754a5a499cf1','22-06-2012 12:24:15','',1,'44c5734f0f5500060d33754a5a499cf1.jpg','2012-06-22 05:24:15'),(3,'6f2fac9034d38833f18b1143904eae5c','22-06-2012 12:24:15','',1,'6f2fac9034d38833f18b1143904eae5c.jpg','2012-06-22 05:24:15'),(4,'ec1c17c4c26f8ce37a591931d679618c','22-06-2012 12:28:46','',3,'ec1c17c4c26f8ce37a591931d679618c.jpg','2012-06-22 05:28:46'),(5,'7bf07246187acbcc0797ef2da1762d9e','22-06-2012 12:32:02','',NULL,'7bf07246187acbcc0797ef2da1762d9e.jpg','2012-06-22 05:32:02'),(6,'22c75ea0e7f4ac6faca6ccd255bd1fd4','22-06-2012 12:32:02','',NULL,'22c75ea0e7f4ac6faca6ccd255bd1fd4.jpg','2012-06-22 05:32:02'),(7,'5b4b986af1ccdc8e7d7e5c57ea672c22','22-06-2012 12:32:40','',3,'5b4b986af1ccdc8e7d7e5c57ea672c22.jpg','2012-06-22 05:32:40'),(8,'eb43590e24d16f960b24b2448bbaeef4','22-06-2012 12:32:40','',3,'eb43590e24d16f960b24b2448bbaeef4.jpg','2012-06-22 05:32:40'),(11,'76c5d4555fc2626a506d31e9c87d1641','25-06-2012 23:03:22','',1,'76c5d4555fc2626a506d31e9c87d1641.jpg','2012-06-25 16:03:22'),(12,'6a6580727c7b62210eecf4a59e5351eb','25-06-2012 23:03:22','',1,'6a6580727c7b62210eecf4a59e5351eb.jpg','2012-06-25 16:03:22'),(13,'4b8f10453fc50d370187a3f2a9c4d416','A','Quà Lưu Niệm',3,'4b8f10453fc50d370187a3f2a9c4d416.jpg','2012-06-26 07:26:23'),(15,'cc0e02d5c1874e256f6893cfd649de37','B','Nội Thất - Tượng',3,'cc0e02d5c1874e256f6893cfd649de37.jpg','2012-06-26 07:37:19'),(17,'e578c888b137770542d67b7d3288447b','C','Phụ Liệu Spa',3,'e578c888b137770542d67b7d3288447b.jpg','2012-06-26 07:40:53'),(27,'2be9bf1e613dd70efbb4361c18fe50be','C1','Mặt nạ dát vàng',3,'2be9bf1e613dd70efbb4361c18fe50be.jpg','2012-06-26 08:21:07'),(28,'a4ba494f9a864271a3173cabaf7755b8','A1','Quà Tặng Cao Cấp',3,'a4ba494f9a864271a3173cabaf7755b8.jpg','2012-06-26 08:21:24'),(29,'433cc242d62b3757d0d2f604dc6fcf05','A2','Quà Tặng Giáng Sinh',3,'433cc242d62b3757d0d2f604dc6fcf05.jpg','2012-06-26 08:21:40'),(30,'17edebe4b2eff1e18aae3fa1ffbadfdc','A3','Khung Hình Dát Vàng',3,'17edebe4b2eff1e18aae3fa1ffbadfdc.jpg','2012-06-26 08:21:58'),(31,'5e390328a3bc149c9041fd8609a2448f','A4','Vật Để Bàn',3,'5e390328a3bc149c9041fd8609a2448f.jpg','2012-06-26 08:22:33'),(32,'39f10ea06d6719e8fdc316ca7668a1e2','A5','Khay trà, rượu',3,'39f10ea06d6719e8fdc316ca7668a1e2.jpg','2012-06-26 08:25:16'),(33,'48b4ff68025bb57daaa9c406c9e8d304','B1','Bàn trang điểm',3,'48b4ff68025bb57daaa9c406c9e8d304.jpg','2012-06-26 08:26:46'),(34,'6f3ec2e641548361a37e03f25ff85bd7','B2','Ghế Cao Cấp',3,'6f3ec2e641548361a37e03f25ff85bd7.jpg','2012-06-26 08:30:19'),(35,'369f999adca9bcd79487cfa15f6154dc','B3','Kệ Tivi',3,'369f999adca9bcd79487cfa15f6154dc.jpg','2012-06-26 08:34:48'),(36,'9e49c4f647977524b8dc170883e62ab1','B4','Khung Gương',3,'9e49c4f647977524b8dc170883e62ab1.jpg','2012-06-26 08:37:34'),(37,'1f34e38a54b38d4ae7d6c8f9f482860a','B5','Tượng Dát Vàng',3,'1f34e38a54b38d4ae7d6c8f9f482860a.jpg','2012-06-26 08:38:16'),(44,'a5674c963f14a501fd40a0211b2605fe','A100002','Bàn dát vàng',1,'a5674c963f14a501fd40a0211b2605fe.jpg','2012-06-26 10:11:13'),(45,'92d7ce7b639fef483acef47fbbe2a97e','A100002','Bàn dát vàng',1,'92d7ce7b639fef483acef47fbbe2a97e.jpg','2012-06-26 10:17:07'),(46,'fe2a8f1b19b5f192b6af344a12476961','A100002','Bàn dát vàng',1,'fe2a8f1b19b5f192b6af344a12476961.jpg','2012-06-26 10:18:04'),(48,'774d1cc1a28549253f5d39b6da41c51e','A100002','Bàn dát vàng',1,'774d1cc1a28549253f5d39b6da41c51e.jpg','2012-06-26 10:45:09'),(50,'f080966187782b34194f0c8065314b09','A100002','Bàn dát vàng',1,'f080966187782b34194f0c8065314b09.jpg','2012-06-26 10:48:58'),(51,'4445d15a135186337abc5b6b26f30205','27-06-2012 13:36:59','',NULL,'4445d15a135186337abc5b6b26f30205.jpg','2012-06-27 06:36:59');

/*Table structure for table `image_group` */

DROP TABLE IF EXISTS `image_group`;

CREATE TABLE `image_group` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `id_image_size` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `use_wm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `image_group` */

insert  into `image_group`(`id`,`code`,`name`,`id_image_size`,`use_wm`) values (1,'prod','Product Images','1,2,5',1),(2,'article','Article','1,3',0),(3,'prod_category','Product Category','3',0);

/*Table structure for table `image_size` */

DROP TABLE IF EXISTS `image_size`;

CREATE TABLE `image_size` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `image_size` */

insert  into `image_size`(`id`,`code`,`name`,`value`) values (1,'thumb','Thumbnail','200x200'),(2,'avatar','Avatar','100x100'),(3,'small','Small','150x150'),(4,'medium','Medium','300x300'),(5,'large','Large','800x800'),(6,'tiny','Tiny','50x50');

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `language` */

insert  into `language`(`id`,`code`,`name`,`is_disabled`,`is_deleted`) values (1,'en','English',0,0),(2,'vi','Tiếng Việt',0,0);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(2) NOT NULL DEFAULT '0',
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'type=1: front_office; type=2: back_office',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`) values (1,'<en>Dashboard</en><vi>Bảng điều khiển</vi>',1,'dashboard','dashboard',0,0,2),(2,'<en>Products</en><vi>Sản phẩm</vi>',2,'product','product',0,0,2),(3,'<en>System</en><vi>Hệ thống</vi>',10,'system','system',0,0,2),(4,'<en>Users</en><vi>Người dùng</vi>',9,'user','user',0,0,2),(5,'<en>Settings</en><vi>Cài đặt</vi>',1,'setting','setting',3,0,2),(6,'<en>Menu</en><vi>Menu</vi>',2,'menu','menu',3,0,2),(7,'<en>Users Groups</en><vi>Nhóm người dùng</vi>',1,'group','group_list',4,0,2),(8,'<en>Users</en><vi>Người dùng</vi>',2,'user','user_list',4,0,2),(23,'<en>Product Categories</en><vi>Nhóm sản phẩm</vi>',1,'prod_category','prod_category',2,0,2),(24,'<en>Home</en><vi>Trang chủ</vi>',1,'index.html','home',0,0,1),(25,'<en>About Us</en><vi>Giới thiệu</vi>',2,'about.html','about',0,0,1),(26,'<en>Interiors</en><vi>Nội thất - Tượng</vi>',4,'products/interior','products',0,0,1),(27,'<en>Souvenirs</en><vi>Quà lưu niệm</vi>',3,'products/souvenirs','souvenirs',0,0,1),(28,'<en>Spa</en><vi>Phụ liệu Spa</vi>',5,'products/spa','spa',0,0,1),(29,'<en>CMS</en><vi>Quản trị nội dung</vi>',5,'','cms',0,0,2),(30,'<en>Web page</en><vi>Trang web</vi>',1,'webpage','webpage',29,0,2),(31,'<en>News</en><vi>Tin tức</vi>',2,'news','news',29,0,2),(32,'<en>32_Just test&lt;/&gt;&lt;test&gt;&lt;/test&gt;</en><vi>32_Thử nghiệm thôi&lt;/&gt;&lt;thử nghiệm&gt;&lt;/thử nghiệm&gt;</vi>',6,'test','test',0,1,1),(33,'<en>Customers</en><vi>Khách hàng</vi>',4,'customer','customer',0,0,2),(34,'<en>Orders</en><vi>Đơn đặt hàng</vi>',3,'order','order',0,0,2),(35,'<en>Images gallery</en><vi>Thư viện ảnh</vi>',6,'image_gallery','image_gallery',0,0,2),(36,'<en>36_Languages</en><vi>36_Ngôn ngữ</vi>',2,'language','language',3,1,2),(37,'<en>37_Currencies</en><vi>37_Tiền tệ</vi>',2,'currency','currency',3,1,2),(38,'<en>38_24k Gilding Products</en><vi>38_Sản Phẩm Dát Vàng 24k</vi>',3,'24k-gilding-products','products',0,1,1),(39,'<en>News</en><vi>Tin Tức</vi>',6,'news','news',0,0,1),(40,'<en>Contact Us</en><vi>Liên Hệ</vi>',7,'contact-us.html','contact',0,0,1);

/*Table structure for table `param_group` */

DROP TABLE IF EXISTS `param_group`;

CREATE TABLE `param_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `disabled` tinyint(1) unsigned NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user_created` int(10) unsigned NOT NULL,
  `modification_date` datetime DEFAULT NULL,
  `id_user_modified` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `param_group_code_idx` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `param_group` */

/*Table structure for table `param_group_parameter` */

DROP TABLE IF EXISTS `param_group_parameter`;

CREATE TABLE `param_group_parameter` (
  `id_parameter` int(10) unsigned NOT NULL,
  `id_param_group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_parameter`,`id_param_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `param_group_parameter` */

/*Table structure for table `parameter` */

DROP TABLE IF EXISTS `parameter`;

CREATE TABLE `parameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `category` tinyint(2) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_date` datetime DEFAULT NULL,
  `id_user_created` int(11) NOT NULL,
  `id_user_modified` int(11) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

/*Data for the table `parameter` */

insert  into `parameter`(`id`,`name`,`code`,`value`,`category`,`status`,`creation_date`,`modification_date`,`id_user_created`,`id_user_modified`,`disabled`) values (1,'Allow admin access project','ALLOW_ADMIN','1',1,0,'2012-03-24 21:36:58',NULL,0,NULL,0),(2,'Allow access login ittempts','ALLOWED_LOGIN_ATTEMPTS','5',1,0,'2012-03-24 21:36:59',NULL,0,NULL,0),(3,'Allow admin support access project','ALLOW_ADMIN_SUPPORT','1',1,0,'2012-03-24 21:37:00',NULL,0,NULL,0),(4,'Allow manager access project','ALLOW_MANAGER','1',1,0,'2012-03-24 21:37:00',NULL,0,NULL,0),(5,'Number of items per page in pagination','PAGINATION_ROWS_PER_PAGE','5',1,0,'2012-04-01 22:19:40',NULL,0,NULL,0),(6,'Query string segment used as current page parameter','PAGINATION_QUERY_STRING_SEGMENT','page',1,0,'2012-03-24 21:36:56',NULL,0,NULL,0),(7,'Number of &quotes;digit&quotes; pages displayed on pages bar','PAGINATION_DIGIT_PAGES_DISPLAYED','4',1,0,'2012-03-27 08:42:17',NULL,0,NULL,0),(8,'Max length of the name','MAX_LENGTH_NAME','50',1,0,'2012-03-31 16:30:04',NULL,0,NULL,0),(9,'Max length of password','MAX_LENGTH_PASSWORD','20',1,0,'2012-03-31 16:39:08',NULL,0,NULL,0),(10,'Min length of password','MIN_LENGTH_PASSWORD','6',1,0,'2012-04-01 16:39:44',NULL,0,NULL,0),(11,'Allow viewing','PERM_VIEW','1',1,0,'2012-04-12 14:35:57',NULL,0,NULL,0),(12,'Allow to add','PERM_ADD','2',1,0,'2012-04-12 14:37:30',NULL,0,NULL,0),(13,'Allow to modify','PERM_EDIT','3',1,0,'2012-04-12 14:37:31',NULL,0,NULL,0),(14,'Allow to delete','PERM_DELETE','4',1,0,'2012-04-12 14:37:31',NULL,0,NULL,0),(15,'Site name','SITE_NAME','Phuc Khang Gilding Store',1,0,'2012-04-14 11:11:00',NULL,0,NULL,0),(16,'Back Office','BO','2',1,0,'2012-04-27 23:43:23',NULL,1,NULL,0),(17,'Front Office','FO','1',1,0,'2012-04-27 23:43:43',NULL,1,NULL,0),(18,'Upload image URL','UPLOAD_IMAGE_URL','../uploads/images/',1,0,'2012-06-01 01:12:34',NULL,1,NULL,0),(19,'Image suffix for product list in BO','BO_PROD_IMG_SUFFIX','_avatar',1,0,'2012-06-01 16:20:57',NULL,1,NULL,0),(20,'Image suffix for product list in FO Gallery','FO_PROD_GALLERY_IMG_SUFFIX','_thumb',1,0,'2012-06-01 16:23:21',NULL,1,NULL,0),(21,'Image suffix for product in shopping cart of FO','FO_PROD_CART_IMG_SUFFIX','_small',1,0,'2012-06-01 16:24:52',NULL,1,NULL,0),(22,'Image suffix for product detail in BO','BO_PROD_DETAIL_IMG_SUFFIX','_thumb',1,0,'2012-06-01 16:28:38',NULL,1,NULL,0),(23,'Image suffix for product category list in BO','BO_PROD_CATEGORY_IMG_SUFFIX','_small',1,0,'2012-06-03 15:55:14',NULL,1,NULL,0),(24,'Image product code','IMG_PRODUCT_CODE','prod',1,0,'2012-06-03 17:52:47',NULL,1,NULL,0),(25,'Image product category code','IMG_PRODUCT_CATEGORY_CODE','prod_category',1,0,'2012-06-03 17:53:38',NULL,1,NULL,0),(26,'Male','MALE','M',1,0,'2012-06-08 15:35:40',NULL,1,NULL,0),(27,'Female','FEMALE','F',1,0,'2012-06-08 15:35:54',NULL,1,NULL,0),(28,'Age to be allowed to access website','ALLOWED_AGE','18',1,0,'2012-06-08 16:24:43',NULL,1,NULL,0),(29,'Admin\'s email','ADMIN_EMAIL','truong@vinaict.com',1,0,'2012-06-13 12:31:34',NULL,1,NULL,0),(30,'Watermark enabled','WM_ENABLED','1',1,0,'2012-06-20 10:25:46',NULL,1,NULL,0),(31,'Watermark type','WM_TYPE','overlay',1,0,'2012-06-20 10:26:28',NULL,1,NULL,0),(32,'Watermark text','WM_TEXT','Phuc Khang Gilding Store',1,0,'2012-06-20 10:28:54',NULL,1,NULL,0),(33,'Vertical alignment for the watermark image','WM_VRT_ALIGNMENT','middle',1,0,'2012-06-20 10:32:54',NULL,1,NULL,0),(34,'Horizontal alignment for the watermark image','WM_HOR_ALIGNMENT','center',1,0,'2012-06-20 10:33:50',NULL,1,NULL,0),(35,'Path of image to use as your watermark','WM_OVERLAY_PATH','../uploads/images/icon/watermark.png',1,0,'2012-06-20 10:36:27',NULL,1,NULL,0),(36,'Watermark opacity','WM_OPACITY','70',1,0,'2012-06-20 11:34:43',NULL,1,NULL,0),(37,'The server path to the True Type Font to use for wartermark','WM_FONT_PATH','../uploads/fonts/',1,0,'2012-06-20 11:36:52',NULL,1,NULL,0),(38,'Watermark font size','WM_FONT_SIZE','16',1,0,'2012-06-20 11:37:31',NULL,1,NULL,0),(39,'Watermark font color','WM_FONT_COLOR','ffffff',1,0,'2012-06-20 11:38:00',NULL,1,NULL,0),(40,'Watermark shadow color','WM_SHADOW_COLOR','None',1,0,'2012-06-20 11:39:28',NULL,1,NULL,0),(41,'The distance (in pixels) from the font that the drop shadow should appear','WM_SHADOW_DISTANCE','3',1,0,'2012-06-20 11:42:33',NULL,1,NULL,0),(42,'URI pattern','URI_PATTERN','([A-Za-z0-9]+)((\\/|-)([A-Za-z0-9]+))*',1,0,'2012-06-22 17:44:38',NULL,1,NULL,0),(43,'Product category URI prefix','PROD_CATEGORY_URI_PREFIX','products',1,0,'2012-06-22 17:45:58',NULL,1,NULL,0),(47,'News URI prefix','NEWS_URI_PREFIX','news',1,0,'2012-06-22 19:38:53',NULL,1,NULL,0),(46,'Product category URI suffix','PROD_CATEGORY_URI_SUFFIX','/',1,0,'2012-06-22 19:37:07',NULL,1,NULL,0),(44,'Product URI prefix','PRODUCT_URI_PREFIX','products',1,0,'2012-06-22 19:30:22',NULL,1,NULL,0),(45,'Product URI suffix','PRODUCT_URI_SUFFIX','.html',1,0,'2012-06-22 19:31:03',NULL,1,NULL,0),(48,'News post URI suffix','NEWS_POST_URI_SUFFIX','.html',1,0,'2012-06-22 19:43:10',NULL,1,NULL,0),(49,'News category URI suffix','NEWS_CATEGORY_URI_SUFFIX','/',1,0,'2012-06-22 19:44:26',NULL,1,NULL,0),(50,'Page URI suffix','PAGE_URI_SUFFIX','.html',1,0,'2012-06-23 21:20:30',NULL,1,NULL,0),(51,'Protocol for sending email','MAIL_PROTOCOL','sendmail',1,0,'2012-06-27 12:47:45',NULL,1,NULL,0),(52,'	The server path to Sendmail.','MAIL_PATH','/usr/sbin/sendmail',1,0,'2012-06-27 12:49:28',NULL,1,NULL,0);

/*Table structure for table `permission` */

DROP TABLE IF EXISTS `permission`;

CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(10) unsigned DEFAULT '0',
  `id_group` smallint(5) unsigned DEFAULT '0',
  `value` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission` */

insert  into `permission`(`id`,`uri`,`id_user`,`id_group`,`value`) values (1,'dashboard',0,1,'1,2,3'),(66,'menu/edit',0,1,'1,2,3,4'),(54,'user',0,1,'1,2,3,4'),(88,'product/deleteImage',0,1,'1,2,3,4'),(70,'home',0,1,'1,2,3,4'),(69,'product',0,1,'1,2,3,4'),(81,'webpage/edit',0,1,'1,2,3,4'),(80,'webpage/add',0,1,'1,2,3,4'),(79,'webpage',0,1,'1,2,3,4'),(78,'test',0,1,'1,2,3,4'),(77,'news',0,1,'1,2,3,4'),(68,'prod_category',0,1,'1,2,3,4'),(67,'menu/delete',0,1,'1,2,3,4'),(58,'user/change_password',0,1,'1,2,3,4'),(87,'image/process',0,1,'1,2,3,4'),(86,'product/detail',0,1,'1,2,3,4'),(85,'product/edit',0,1,'1,2,3,4'),(84,'product/add',0,1,'1,2,3,4'),(83,'webpage/toggleStatus',0,1,'1,2,3,4'),(82,'webpage/delete',0,1,'1,2,3,4'),(76,'webpage',0,1,'1,2,3,4'),(75,'cms',0,1,'1,2,3,4'),(74,'spa-accessories',0,1,'1,2,3,4'),(73,'souvenirs',0,1,'1,2,3,4'),(72,'interior',0,1,'1,2,3,4'),(71,'about-us',0,1,'1,2,3,4'),(43,'group',0,1,'1,2,3,4'),(65,'menu/add',0,1,'1,2,3,4'),(64,'system',0,1,'1,2,3,4'),(63,'menu',0,1,'1,2,3,4'),(62,'menu/delete',0,1,'1,2,3,4'),(61,'menu/edit',0,1,'1,2,3,4'),(60,'menu/add',0,1,'1,2,3,4'),(59,'menu',0,1,'1,2,3,4'),(55,'user/add',0,1,'1,2,3,4'),(56,'user/edit',0,1,'1,2,3,4'),(57,'user/delete',0,1,'1,2,3,4'),(89,'product/setDefaultImage',0,1,'1,2,3,4'),(90,'product/recreateImage',0,1,'1,2,3,4'),(91,'prod_category/add',0,1,'1,2,3,4'),(92,'prod_category/edit',0,1,'1,2,3,4'),(93,'prod_category/delete',0,1,'1,2,3,4'),(94,'prod_category/recreateImage',0,1,'1,2,3,4'),(95,'prod_category/deleteImage',0,1,'1,2,3,4'),(101,'customer',0,1,'1,2,3,4'),(97,'customer/add',0,1,'1,2,3,4'),(98,'customer/edit',0,1,'1,2,3,4'),(99,'customer/delete',0,1,'1,2,3,4'),(100,'customer',0,15,'1,2,3,4'),(102,'order',0,15,'1,2,3,4'),(103,'order',0,1,'1,2,3,4'),(104,'image_gallery',0,15,'1,2,3,4'),(105,'image_gallery',0,1,'1,2,3,4'),(106,'setting',0,1,'1,2,3,4'),(107,'language',0,15,'1,2,3,4'),(108,'language',0,1,'1,2,3,4'),(109,'currency',0,15,'1,2,3,4'),(110,'currency',0,1,'1,2,3,4'),(111,'san-pham-dat-vang-24k',0,15,'1,2,3,4'),(112,'san-pham-dat-vang-24k',0,1,'1,2,3,4'),(113,'tin-tuc',0,15,'1,2,3,4'),(114,'tin-tuc',0,1,'1,2,3,4'),(115,'contact-us',0,15,'1,2,3,4'),(116,'contact-us',0,1,'1,2,3,4');

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` tinytext COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `price` float unsigned DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_def_image` int(11) DEFAULT NULL,
  `is_disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `id_prod_category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `id_prod_image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_primary_prod_category` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product` */

insert  into `product`(`id`,`code`,`name`,`short_description`,`description`,`price`,`currency`,`link`,`id_def_image`,`is_disabled`,`id_prod_category`,`is_deleted`,`keywords`,`is_featured`,`id_prod_image`,`id_primary_prod_category`) values (1,'D00004','<en>Product 1</en><vi>Sản Phẩm 1</vi>','<en>Short description of Product 1</en><vi>Mô tả ngắn gọn sản phẩm 1</vi>','<en>&lt;p&gt; Long description of Product 1&lt;/p&gt;</en><vi>&lt;p&gt; Mô tả chi tiết sản phẩm 1&lt;/p&gt;</vi>',0,'VND','san-pham-1',NULL,0,NULL,0,'san pham 1, product 1',1,NULL,3),(2,'A100002','<en>Gilding table</en><vi>Bàn dát vàng</vi>','<en>This is gilding table</en><vi>Đây là bàn dát vàng</vi>','<en>&lt;h3 style=&quot;color:red;&quot;&gt; This is the best gilding table&lt;/h3&gt;</en><vi>&lt;h3 style=&quot;color:blue;&quot;&gt; Đây là bàn dát vàng đẹp nhất&lt;/h3&gt;</vi>',1000,'USD','san-pham-2',0,0,'2',0,'gilding table, ban dat vang',1,'44,45,46,48,50',2),(3,'A200003','<en>Gilding chair</en><vi>Ghế dát vàng</vi>','<en>This is a gilding chair</en><vi>Đây là ghế dát vàng</vi>','<en>&lt;h3 style=&quot;color:blue;&quot;&gt; This is the luxury gilding chair&lt;/h3&gt;</en><vi>&lt;h3 style=&quot;color:red;&quot;&gt; Đây là ghế dát vàng sang trọng&lt;/h3&gt;</vi>',10500000,'VND','san-pham-3',NULL,0,NULL,0,'gilding chair, ghe dat vang',1,NULL,3),(4,'A00004','<en>Gilding cabinet</en><vi>Tủ dát vàng</vi>','<en>This is a gilding cabinet</en><vi>Đây là cái tủ dát vàng</vi>','<en>&lt;p&gt; &lt;span style=&quot;background-color:yellow;&quot;&gt;Detail information about gilding cabinet&lt;/span&gt;&lt;/p&gt;</en><vi>&lt;p&gt; &lt;span style=&quot;background-color:lime;&quot;&gt;Thông tin chi tiết về cái tủ dát vàng&lt;/span&gt;&lt;/p&gt;</vi>',0,'VND','san-pham-4',NULL,0,NULL,0,'',1,'24',3),(5,'A###','<en>test</en><vi>no pro</vi>',NULL,NULL,22,'VND','sanpham5',NULL,0,NULL,0,NULL,0,NULL,3);

/*Table structure for table `product_category` */

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `id_parent` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `keywords` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_image` int(11) DEFAULT NULL,
  `link` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_category` */

insert  into `product_category`(`id`,`code`,`name`,`is_deleted`,`id_parent`,`description`,`keywords`,`id_image`,`link`) values (2,'A','<en>Souvenirs</en><vi>Quà Lưu Niệm</vi>',0,NULL,'','',13,'products/qua-luu-niem'),(3,'C','<en>Spa</en><vi>Phụ Liệu Spa</vi>',0,NULL,'','',17,'products/spa'),(4,'B','<en>Interiors</en><vi>Nội Thất - Tượng</vi>',0,NULL,'','',15,'products/noi-that'),(22,'C1','<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>',0,'3','','',27,'products/spa/mat-na-dat-vang'),(12,'A1','<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>',0,'2','','',28,'products/qua-luu-niem/qua-tang-cao-cap'),(13,'A2','<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>',0,'2','','',29,'products/qua-luu-niem/qua-giang-sinh'),(14,'A3','<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>',0,'2','','',30,'products/qua-luu-niem/khung-hinh'),(15,'A4','<en>Things On Table</en><vi>Vật Để Bàn</vi>',0,'2','','',31,'products/qua-luu-niem/vat-de-ban'),(16,'A5','<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>',0,'2','','',32,'products/qua-luu-niem/khay-tra-ruou'),(17,'B1','<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>',0,'4','','',33,'products/noi-that/ban-trang-diem'),(18,'B2','<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>',0,'4','','',34,'products/noi-that/ghe-cao-cap'),(19,'B3','<en>TV Shelf</en><vi>Kệ Tivi</vi>',0,'4','','',35,'products/noi-that/ke-tivi'),(20,'B4','<en>Mirror Frame</en><vi>Khung Gương</vi>',0,'4','','',36,'products/noi-that/khung-guong'),(21,'B5','<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>',0,'4','','',37,'products/noi-that/tuong-dat-vang');

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `session` */

insert  into `session`(`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) values ('27338cfa34b5ef2f38b878e34042be56','0.0.0.0','Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/201001',1337165699,'a:4:{s:13:\"last_login_id\";b:0;s:6:\"userID\";s:1:\"1\";s:12:\"logged_email\";s:18:\"truong@vinaict.com\";s:10:\"stored_url\";s:48:\"http://localhost/phuckhang/application/dashboard\";}'),('babf3604cba09eaf0c8b79ca275b42ec','0.0.0.0','Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/201001',1337234289,'a:4:{s:13:\"last_login_id\";b:0;s:6:\"userID\";s:1:\"1\";s:12:\"logged_email\";s:18:\"truong@vinaict.com\";s:10:\"stored_url\";s:46:\"http://localhost/phuckhang/application/webpage\";}'),('bcdd248e8af61161a4339ea9dc5d573e','0.0.0.0','Mozilla/5.0 (Windows NT 6.1; rv:12.0) Gecko/201001',1337095068,'a:4:{s:13:\"last_login_id\";b:0;s:6:\"userID\";s:1:\"1\";s:12:\"logged_email\";s:18:\"truong@vinaict.com\";s:10:\"stored_url\";s:46:\"http://localhost/phuckhang/application/webpage\";}');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT '0',
  `login_attempts` smallint(3) DEFAULT '0',
  `deactived` tinyint(1) DEFAULT '0',
  `is_controller` tinyint(1) NOT NULL DEFAULT '0',
  `home_phone` varchar(15) DEFAULT NULL,
  `work_phone` varchar(15) DEFAULT NULL,
  `mobile_phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_business` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`email`,`pass`,`date_last_login`,`last_name`,`first_name`,`disabled`,`login_attempts`,`deactived`,`is_controller`,`home_phone`,`work_phone`,`mobile_phone`,`address`,`name`,`is_business`) values (1,'truong@vinaict.com','1c84eef95efa8cfe106394a660da8a12929b18f0','2012-07-04 08:30:25','Lý','Vĩnh Trường',0,0,0,0,'','','0908 080 656',NULL,NULL,0),(5,'phamthanhnam@vinaict.com','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'Pham','Thanh Nam',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0),(4,'nguyenvancuong@vinaict.com','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'Nguyen','van Cuong',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0),(3,'lehoangchanh@vinaict.com','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'Le','Hoang Chanh',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0),(2,'huynhbaan@vinaict.com','7c4a8d09ca3762af61e59520943dc26494f8941b',NULL,'Huynh','Ba An',0,0,0,0,'','','','',NULL,0);

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `id_user` int(10) unsigned NOT NULL,
  `id_group` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_user`,`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user_group` */

insert  into `user_group`(`id_user`,`id_group`) values (1,1),(2,1),(3,1),(4,1),(5,1);

/*Table structure for table `web_page` */

DROP TABLE IF EXISTS `web_page`;

CREATE TABLE `web_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `id_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`link`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `web_page` */

insert  into `web_page`(`id`,`title`,`content`,`link`,`keywords`,`is_disabled`,`id_parent`) values (2,'<en>About Us</en><vi>Giới thiệu</vi>','<en>&lt;p&gt; &lt;strong&gt;- Grand Home was established with a goal to providing customer with high quality interior product. Grand Home’s product are combinations of culture and art with sophisticated shapes, luxurious designs and modern designing ideas.&lt;/strong&gt;&lt;/p&gt;&lt;div&gt; &lt;em&gt;- With continuous attempts and with the strength of, we have created the most sophistcated and best quality product for all customers.&lt;/em&gt;&lt;/div&gt;&lt;div&gt; &lt;em&gt;- The message Grand Home would like to send to the customers is “with all respects, Grand Home commits to provide customers best products and services”.&lt;/em&gt;&lt;/div&gt;&lt;div&gt; - We are proud and strive restlessly to make Grand Home’s saff experts on their fields. Whith a team of and professionlly trained decorators, artists and skillful workers Grand Home surely satify all customers.&lt;/div&gt;</en><vi>&lt;p align=&quot;justify&quot;&gt; &lt;big&gt;Được thành lập từ năm 2000, sau hơn một thập kỷ ra đời và phát triển, GrandHome chính thức trở thành một trong những nhà thiết kế và trang trí nội thất hàng đầu tại Việt Nam. Hiện GrandHome có trụ sở chính đặt tại 81 Hồ Văn Huê - Phường 9 - Quận Phú Nhuận - TP.Hồ Chí Minh. Trong hơn một thập kỷ qua, chúng tôi đã không ngừng cố gắng để vượt qua sự mong đợi của Quý khách hàng với phương châm “Sự hài lòng của khách hàng là thành công của chúng tôi”.&lt;/big&gt;&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; Thế mạnh của GrandHome là mang đến cho Quý khách hàng những sản phẩm nội thất cổ điển cao cấp mang hơi thở của thời gian. Những sản phẩm được các nhà thiết kế, họa sỹ và công nhân lành nghề thổi hồn vào thông qua những đôi tay chuyên nghiệp. Không chỉ chăm chút vẻ đẹp bên ngoài, sản phẩm của GrandHome còn đa dạng về thiết kế nhờ sự hết hợp tinh tế giữa văn hóa và nghệ thuật của các nước Ý, Pháp, Nga...&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; Với bản lĩnh của người tiên phong trong lĩnh vực thiết kế và trang trí nội thất cổ điển tại Việt Nam. Đội ngũ chuyên gia và công nhân của GrandHome không ngừng sáng tạo, không chỉ cho ra đời những sản phẩm tốt nhất cho khách hàng mà còn biến mỗi thiết kế là một phong cách riêng cho từng ngôi nhà của Quý khách.&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; “Nhìn sản phẩm nhớ đến GrandHome” – đó là mục tiêu chúng tôi luôn hướng đến.&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; &amp;nbsp;&lt;/p&gt;&lt;h3 align=&quot;justify&quot; style=&quot;color:red;&quot;&gt; &lt;strong&gt;CAM KẾT CỦA CHÚNG TÔI&lt;/strong&gt;&lt;/h3&gt;&lt;p align=&quot;justify&quot;&gt; &lt;u&gt;Không ngừng tạo ra những sản phẩm mới, độc đáo, riêng biệt.&lt;/u&gt;&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; Chất lượng luôn cao hơn giá thành.&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; Lấy sự hài lòng của khách hàng làm thước đo cho sự phát triển của công ty.&lt;/p&gt;&lt;p align=&quot;justify&quot;&gt; Đồng hành cùng Quý khách hàng trên từng sản phẩm.&lt;/p&gt;</vi>','about','about, gioi thieu',0,NULL);

/* 28-06-2012: Pham Thanh Nam: Order Management */

DROP TABLE IF EXISTS `purchase_order`;

CREATE TABLE `purchase_order` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(12) COLLATE utf8_unicode_ci NOT NULL,
  `id_customer` BIGINT(20) UNSIGNED NOT NULL,
  `order_date` DATE DEFAULT NULL,
  `amount` FLOAT UNSIGNED NOT NULL,
  `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `status` TINYINT(2) UNSIGNED NOT NULL,
  `description` TEXT COLLATE utf8_unicode_ci,
  `shipping_address` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_date` DATE DEFAULT NULL,
  `payment_date` DATE DEFAULT NULL,
  `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modification_date` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/* 29-06-2012: Pham Thanh Nam: Order Management */

DROP TABLE IF EXISTS `purchase_order_detail`;

create table `purchase_order_detail`( 
   `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT , 
   `id_purchase_order` bigint UNSIGNED NOT NULL , 
   `id_product` bigint UNSIGNED NOT NULL , 
   `code_product` varchar(15) NOT NULL , 
   `name_product` varchar(250) NOT NULL , 
   `price_product` float NOT NULL , 
   `currency_product` varchar(3) NOT NULL , 
   `desciption_product` text , 
   `image_product` varchar(300) , 
   `number` bigint UNSIGNED NOT NULL , 
   `is_deleted` tinyint(1) UNSIGNED DEFAULT '0' , 
   PRIMARY KEY (`id`)
 )ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `purchase_order_status`;

CREATE TABLE `purchase_order_status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_order_status`
--

INSERT INTO `purchase_order_status` (`id`, `name`) VALUES
(1, '<en>Unactive</en><vi>Chưa kích hoạt</vi>'),
(2, '<en>Pending</en><vi>Đang đợi</vi>'),
(3, '<en>Shipping</en><vi>Đang vận chuyển</vi>'),
(4, '<en>Done</en><vi>Hoàn thành</vi>');

/* 30-06-2012 : Ly Vinh Truong : Order Management */

INSERT  INTO `parameter`(`id`,`name`,`code`,`value`,`category`,`status`,`creation_date`,`modification_date`,`id_user_created`,`id_user_modified`,`disabled`) VALUES (53,'Unaccepted order status','ORD_STT_UNACCEPTED','1',1,0,'2012-06-30 19:00:16',NULL,1,NULL,0),(54,'Pending order status','ORD_STT_PENDING','2',1,0,'2012-06-30 19:01:53',NULL,1,NULL,0),(55,'Shipping order status','ORD_STT_SHIPPING','3',1,0,'2012-06-30 19:02:40',NULL,1,NULL,0),(56,'Completed order status','ORD_STT_COMPLETED','4',1,0,'2012-06-30 19:04:16',NULL,1,NULL,0),(57,'System timezone name','SYSTEM_TIMEZONE','Asia/Ho_Chi_Minh',1,0,'2012-06-30 19:47:00',NULL,1,NULL,0);

/* 01-07-2012 21:26 - Ly Vinh Truong - Menu Management */

ALTER TABLE `menu` 
   ADD COLUMN `relation` VARCHAR(100) NULL AFTER `type`;

/* 02-07-2012 16:15 - Ly Vinh Truong - Settings */
ALTER TABLE `parameter` 
   CHANGE `category` `always_load` TINYINT(1) DEFAULT '0' NOT NULL;

/* 02-07-2012 - Pham Thanh Nam - Manager Order */
INSERT INTO `permission` (`id`, `uri`, `id_user`, `id_group`, `value`) VALUES
(117, 'order/delete', 0, 1, '1,2,3,4'),
(118, 'order/detail', 0, 1, '1,2,3,4'),
(119, 'order/status', 0, 1, '1,2,3,4'),
(120, 'order/deleteOrderDetail', 0, 1, '1,2,3,4');

/* 03-07-2012 23:30 - Ly Vinh Truong - Settings */
ALTER TABLE `parameter` 
   ADD COLUMN `data_type` TINYINT(1) DEFAULT '1' NOT NULL AFTER `disabled`,
   ADD COLUMN `data` TEXT AFTER `data_type`;

/* 04-07-2012 15:30 - Huynh Ba An - News_Category */
DROP TABLE IF EXISTS `news_category`;

CREATE TABLE `news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `description` text,
  `id_parent` varchar(50) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `link` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `news_category`(`id`,`name`,`description`,`id_parent`,`keyword`,`link`) VALUES (1,'test','Test is test for me, but me I don\'t know....\r\n','1','test','test_news_category'),(2,'Code function for back end page','This is function test. I am ..............','2','code','news_category');

/* 04-07-2012 - Pham Thanh Nam - Manager user group */

RENAME TABLE `group` TO `usr_group`;
RENAME TABLE `user_group` TO `usr_group_user`;
ALTER TABLE `usr_group_user` 
   CHANGE `id_group` `id_usr_group` SMALLINT(5) UNSIGNED NOT NULL;
ALTER TABLE `permission` 
   CHANGE `id_group` `id_usr_group` SMALLINT(5) UNSIGNED DEFAULT '0' NULL ;

UPDATE `permission` SET `uri` = 'usr_group' WHERE `permission`.`id` =43;

INSERT INTO `permission` (`id`, `uri`, `id_user`, `id_usr_group`, `value`) VALUES
(121, 'usr_group/delete', 0, 1, '1,2,3,4'),
(122, 'usr_group/edit', 0, 1, '1,2,3,4'),
(123, 'usr_group/add', 0, 1, '1,2,3,4'),
(133, 'article', 0, 1, '1,2,3,4'),
(125, 'article/add', 0, 1, '1,2,3,4'),
(126, 'article/delete', 0, 1, '1,2,3,4'),
(127, 'article/edit', 0, 1, '1,2,3,4');

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES
(58, 'max length of the code', 'MAX_LENGTH_CODE', '10', 1, 0, '2012-07-04 11:59:59', NULL, 1, NULL, 0, 1, NULL),
(59, 'max length of the name group', 'MAX_LENGTH_NAME_GROUP', '200', 1, 0, '2012-07-05 12:05:02', NULL, 1, NULL, 0, 1, NULL);


/* 05-07-2012 - Pham Thanh Nam - Manager article */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_news_category` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`link`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

insert  into `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`,`relation`) values (42,'<en>Article</en><vi>Bài viết</vi>',2,'article','article_list',31,0,2,NULL);

/* 05-07-2012 12:00 - Ly Vinh Truong - Settings */

UPDATE `parameter` SET `data_type` = 12, `value` = '<en>Phuc Khang Gilding Store</en><vi>Cửa Hàng Dát Vàng Phúc Khang</vi>' WHERE `id` = 15;

/* 05-07-2012 - Pham Thanh Nam - User (add field lang) */

alter table `user` 
   add column `lang` varchar(5) DEFAULT 'vi' NOT NULL after `is_business`;

/* 06-07-2012 - Huynh Ba An - Manager News category*/
insert  into `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`,`relation`)values
(44,'<en>Categories</en><vi>Danh mục tin</vi>',1,'news_category','news_category',31,0,2,NULL);


/* 06-07-2012 - Phạm Thanh Nam - Manager Purchase_order*/
ALTER TABLE `purchase_order` CHANGE `status` `status` TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '1';

alter table `purchase_order` 
   add column `currency` varchar(3) DEFAULT 'VND' NULL after `modification_date`;


/* 10-07-2012 - Phạm Thanh Nam - Load menu frontend*/
UPDATE `menu` SET `section` = 'interior' WHERE `menu`.`id` =26;


/* 10-07-2012 - Phạm Thanh Nam - Manager News Category*/
alter table `news_category` 
   add column `is_deleted` tinyint(1) DEFAULT '0' NOT NULL after `link`;

INSERT INTO `permission` (`id` ,`uri` ,`id_user` ,`id_usr_group` ,`value`)VALUES ('134', 'news_category', '0', '1', '1,2,3,4') ,('135' , 'news_category/add', '0', '1', '1,2,3,4'),('136', 'news_category/edit', '0', '1', '1,2,3,4'),('137', 'news_category/delete', '0', '1', '1,2,3,4');


/* 10-07-2012 - Nguyễn Văn Cường - Manager site paramter*/
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('60','default page when loaded','SITE_PAGE_DEFAULT_STRING','index','1','0','2012-07-10 17:41:39',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('61','Active Shopping Cart URI ','SITE_PAGE_ACTIVE_SHOP_STRING','active.html','1','0','2012-07-10 17:42:39',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('63','Prefix of Page Controller URI','SITE_PAGE_PAGE_STRING','page','1','0','2012-07-10 17:53:16',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('64','Prefix of Product Controller URI','SITE_PAGE_PRODUCT_STRING','products','1','0','2012-07-10 17:53:49',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('65','Prefix of Product Order page URI','SITE_PAGE_PRODUCT_ORDER_STRING','order','1','0','2012-07-10 17:54:23',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('66','Prefix of Product Contact Page URI','SITE_PAGE_PRODUCT_CONTACT_STRING','contact','1','0','2012-07-10 17:54:45',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('67','Prefix of List of Shoppin Cart Page URI','SITE_PAGE_PRODUCT_LIST_CART_STRING','list-cart','1','0','2012-07-10 17:55:20',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('68','Prefix of Search Page  URI','SITE_PAGE_PRODUCT__SEARCH_STRING','search','1','0','2012-07-10 17:56:19',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('69','How many Record want to display in Site','SITE_LIMIT_RECORD','20','1','0','2012-07-10 17:57:39',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('70','Domain Name','DOMAIN_NAME','www.DatVangNgheThuat.com','1','0','2012-07-10 17:57:57',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('71','Company Name','COMPANY_NAME','Công ty TNHH Dát Vàng Phúc Khang','1','0','2012-07-10 17:59:04',NULL,'1','0','0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('72','Company Address','COMPANY_ADDRESS','207 Huỳnh Văn Nghệ, P.12, Q. Gò Vấp','1','0','2012-07-10 17:59:49',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('73','Company Phone','COMPANY_PHONE','(08)66806108','1','0','2012-07-10 18:00:08',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('74','Company Hotline','COMPANY_HOTLINE','0973513579','1','0','2012-07-10 18:00:25',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('75','Company Fax','COMPANY_FAX','(08)66806108','1','0','2012-07-10 18:00:48',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('76','Company Email','COMPANY_MAIL','TheHalfHeart@gmail.com','1','0','2012-07-10 18:01:18',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('77','Object\'s Title Email','OBJECT_NAME_EMAIL','<vi>Đơn đăt hàng của bạn</vi><en>your order</en>','1','0','2012-07-10 18:02:14',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('78','Message when user active ','COMPANY_TITLE_EMAIL','<e>Verify order information</en><vi>Xác nhận thông tin đặt hàng</vi>','1','0','2012-07-10 18:03:17',NULL,'1',NULL,'0','1',NULL);


/* 11-07-2012 - Nguyễn Văn Cường - Manager Email and Support online yahoo*/

insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('79','Mailer Protocal','MAILER_PROTOCOL','smtp','1','0','2012-07-11 08:39:07','0000-00-00 00:00:00','1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('80','Mailer smtp host ','MAILER_SMTP_HOST','ssl://smtp.gmail.com','1','0','2012-07-11 08:39:33',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('81','Mailer smtp port','MAILER_SMTP_PORT','465','1','0','2012-07-11 08:40:02',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('82','Mailer smtp timeout','MAILER_SMTP_TIME_OUT','7','1','0','2012-07-11 08:40:29',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('83','Mailer smtp user email','MAILER_SMTP_USER_EMAIL','thehalfheart@gmail.com','1','0','2012-07-11 08:41:12',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('84','Mailer smtp pass email','MAILER_SMTP_PASS_EMAIL','vancuong','1','0','2012-07-11 08:41:40',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('85','Mailer smtp charset ','MAILER_SMTP_CHARSET','UTF-8','1','0','2012-07-11 08:42:12',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('86','Yahoo Support online','YAHOO_SUPPORT_ONLINE','ngvancuong_thienduongmangtenem','1','0','2012-07-11 08:45:04',NULL,'1',NULL,'0','1',NULL);

/* 11-07-2012 - Nguyễn Văn Cường - udpate value of image-size */
UPDATE `image_size` SET `value` = '350x350' WHERE `id` = 4;
UPDATE `image_group` SET `id_image_size` = '2,3,4' WHERE `id` = 1;


/* 12-07-2012 - Phạm Thanh Nam - counter */
DROP TABLE IF EXISTS `counter`;

CREATE TABLE `counter` (`id` INT NOT NULL AUTO_INCREMENT ,`count` INT NOT NULL , PRIMARY KEY ( `id` )) ENGINE = MYISAM ;

/* 14-07-2012 - Ly Vinh Truong - Product Management */

INSERT  INTO `permission`(`id`,`uri`,`id_user`,`id_usr_group`,`value`) VALUES (138,'product/delete',0,1,'1,2,3,4');

/* 15-07-2012 - Ly Vinh Truong - Image Size */
ALTER TABLE `image_group` 
   CHANGE `id_image_size` `id_image_size` VARCHAR(100);
   
UPDATE `image_group` SET `id_image_size` = '1,2,3,4' WHERE `id` = 1;

/* 16-07-2-12 - Huynh Ba An - Menu Management */
UPDATE `menu` SET `link` = 'contact' WHERE `menu`.`id` =40;

/* 18-07-2012 - Ly Vinh Truong - Product Image */
UPDATE `image_group` SET `id_image_size` = '1,2,3,4' WHERE `id` = 1;

/* 18-07-2012 - Ly Vinh Truong - Parameter */
INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES ('87','Skype Support','SKYPE_SUPPORT','truong_ly','1','0','2012-07-18 19:30:00','0000-00-00 00:00:00','1',NULL,'0','1',NULL);

/* 20-07-2012 - Phạm Thanh Nam - Page News */
ALTER TABLE `article` ADD `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

/* 23-07-2012 - Phạm Thanh Nam - Social Link */
INSERT INTO `image_size` (`id`, `code`, `name`, `value`) VALUES ('7', 'icon_32', 'Icon_32', '32x32');
INSERT INTO `image_group` (`id`, `code`, `name`, `id_image_size`, `use_wm`) VALUES ('4', 'social', 'Social', '7', '0');
CREATE TABLE `social_link` (
`id` INT NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 255 ) NOT NULL ,
`url` VARCHAR( 255 ) NOT NULL ,
`id_image` INT  NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;

INSERT INTO `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) VALUES (45, '<en>Link</en><vi>Liên kết</vi>', 9, 'social_link', 'social_link', 0, 0, 2, NULL);

INSERT INTO `permission` (`id`, `uri`, `id_user`, `id_usr_group`, `value`) VALUES
(139, 'social_link', 0, 15, '1,2,3,4'),
(140, 'social_link', 0, 1, '1,2,3,4'),
(141, 'social_link/add', 0, 1, '1,2,3,4'),
(142, 'social_link/delete', 0, 1, '1,2,3,4'),
(143, 'social_link/edit', 0, 1, '1,2,3,4');

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES ('89', 'image social link code', 'IMG_SOCIAL_LINK_CODE', 'social', '1', '0', CURRENT_TIMESTAMP, NULL, '', 1, '0', '1', NULL);

/* 23-07-2012 - Huynh Ba An - alter table add column meta_description */

ALTER TABLE `web_page` 
   ADD COLUMN `meta_description` TEXT NULL AFTER `id_parent`;

ALTER TABLE `article` 
   ADD COLUMN `meta_description` TEXT NULL AFTER `date`;

/* 26-07-2012 - Nguyen VanCuong - alter table product_category */
ALTER TABLE product_category 
   ADD COLUMN meta_description TEXT NULL AFTER `link`;



/* 26-07-2012 - Nguyen VanCuong - truncate and insert data into table product_category */

TRUNCATE TABLE product_category;
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('2','A','<en>Souvenirs</en><vi>Quà Lưu Niệm</vi>','0',NULL,'','qua, qua luu niem, luu niem','13','qua-luu-niem','<en></en><vi>Quà luu niem</vi>');
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('3','C','<en>Spa</en><vi>Phụ Liệu Spa</vi>','0',NULL,'','','17','spa',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('4','B','<en>Interiors</en><vi>Nội Thất - Tượng</vi>','0',NULL,'','','15','noi-that',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('22','C1','<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>','0','3','','','27','mat-na-dat-vang',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('12','A1','<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>','0','2','','','28','qua-tang-cao-cap',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('13','A2','<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>','0','2','','','29','qua-giang-sinh',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('14','A3','<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>','0','2','','','30','khung-hinh',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('15','A4','<en>Things On Table</en><vi>Vật Để Bàn</vi>','0','2','','','31','vat-de-ban',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('16','A5','<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>','0','2','','','32','khay-tra-ruou',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('17','B1','<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>','0','4','','','33','ban-trang-diem',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('18','B2','<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>','0','4','','','34','ghe-cao-cap',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('19','B3','<en>TV Shelf</en><vi>Kệ Tivi</vi>','0','4','','','35','ke-tivi',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('20','B4','<en>Mirror Frame</en><vi>Khung Gương</vi>','0','4','','','36','khung-guong',NULL);
INSERT INTO `product_category` (`id`, `code`, `name`, `is_deleted`, `id_parent`, `description`, `keywords`, `id_image`, `link`, `meta_description`) VALUES('21','B5','<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>','0','4','','','37','tuong-dat-vang',NULL);


/* 26-07-2012 - Nguyen VanCuong - truncate and insert data into table product */

TRUNCATE TABLE product;

INSERT INTO `product` (`id`, `code`, `name`, `short_description`, `description`, `price`, `currency`, `link`, `id_def_image`, `is_disabled`, `id_prod_category`, `is_deleted`, `keywords`, `is_featured`, `id_prod_image`, `id_primary_prod_category`) VALUES('1','D00004','<en>Product 1</en><vi>Sản Phẩm 1</vi>','<en>Short description of Product 1</en><vi>Mô tả ngắn gọn sản phẩm 1</vi>','<en>&lt;p&gt; Long description of Product 1&lt;/p&gt;</en><vi>&lt;p&gt; Mô tả chi tiết sản phẩm 1&lt;/p&gt;</vi>','0','VND','san-pham-1',NULL,'0','2','0','san pham 1, product 1','1',NULL,'2');
INSERT INTO `product` (`id`, `code`, `name`, `short_description`, `description`, `price`, `currency`, `link`, `id_def_image`, `is_disabled`, `id_prod_category`, `is_deleted`, `keywords`, `is_featured`, `id_prod_image`, `id_primary_prod_category`) VALUES('2','A100002','<en>Gilding table</en><vi>Bàn dát vàng</vi>','<en>This is gilding table</en><vi>Đây là bàn dát vàng</vi>','<en>&lt;h3 style=&quot;color:red;&quot;&gt; This is the best gilding table&lt;/h3&gt;</en><vi>&lt;h3 style=&quot;color:blue;&quot;&gt; Đây là bàn dát vàng đẹp nhất&lt;/h3&gt;</vi>','1000','USD','san-pham-2','0','0','2','0','gilding table, ban dat vang','1','44,45,46,48,50','2');
INSERT INTO `product` (`id`, `code`, `name`, `short_description`, `description`, `price`, `currency`, `link`, `id_def_image`, `is_disabled`, `id_prod_category`, `is_deleted`, `keywords`, `is_featured`, `id_prod_image`, `id_primary_prod_category`) VALUES('3','A200003','<en>Gilding chair</en><vi>Ghế dát vàng</vi>','<en>This is a gilding chair</en><vi>Đây là ghế dát vàng</vi>','<en>&lt;h3 style=&quot;color:blue;&quot;&gt; This is the luxury gilding chair&lt;/h3&gt;</en><vi>&lt;h3 style=&quot;color:red;&quot;&gt; Đây là ghế dát vàng sang trọng&lt;/h3&gt;</vi>','1.05e+007','VND','san-pham-3',NULL,'0','2','0','gilding chair, ghe dat vang','1',NULL,'2');
INSERT INTO `product` (`id`, `code`, `name`, `short_description`, `description`, `price`, `currency`, `link`, `id_def_image`, `is_disabled`, `id_prod_category`, `is_deleted`, `keywords`, `is_featured`, `id_prod_image`, `id_primary_prod_category`) VALUES('4','A00004','<en>Gilding cabinet</en><vi>Tủ dát vàng</vi>','<en>This is a gilding cabinet</en><vi>Đây là cái tủ dát vàng</vi>','<en>&lt;p&gt; &lt;span style=&quot;background-color:yellow;&quot;&gt;Detail information about gilding cabinet&lt;/span&gt;&lt;/p&gt;</en><vi>&lt;p&gt; &lt;span style=&quot;background-color:lime;&quot;&gt;Thông tin chi tiết về cái tủ dát vàng&lt;/span&gt;&lt;/p&gt;</vi>','0','VND','san-pham-4',NULL,'0','2','0','','1','24','2');
INSERT INTO `product` (`id`, `code`, `name`, `short_description`, `description`, `price`, `currency`, `link`, `id_def_image`, `is_disabled`, `id_prod_category`, `is_deleted`, `keywords`, `is_featured`, `id_prod_image`, `id_primary_prod_category`) VALUES('5','A###','<en>test</en><vi>no pro</vi>',NULL,NULL,'22','VND','sanpham5',NULL,'0','2','0',NULL,'0',NULL,'2');



/* 26-07-2012 - Nguyen VanCuong - truncate and insert data into table menu */

TRUNCATE TABLE menu;
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('1','<en>Dashboard</en><vi>Bảng điều khiển</vi>','1','dashboard','dashboard','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('2','<en>Products</en><vi>Sản phẩm</vi>','2','product','product','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('3','<en>System</en><vi>Hệ thống</vi>','10','system','system','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('4','<en>Users</en><vi>Người dùng</vi>','9','user','user','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('5','<en>Settings</en><vi>Cài đặt</vi>','1','setting','setting','3','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('6','<en>Menu</en><vi>Menu</vi>','2','menu','menu','3','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('7','<en>Users Groups</en><vi>Nhóm người dùng</vi>','1','group','group_list','4','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('8','<en>Users</en><vi>Người dùng</vi>','2','user','user_list','4','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('23','<en>Product Categories</en><vi>Nhóm sản phẩm</vi>','1','prod_category','prod_category','2','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('24','<en>Home</en><vi>Trang chủ</vi>','1','index.html','home','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('25','<en>About Us</en><vi>Giới thiệu</vi>','2','about.html','about','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('26','<en>Interiors</en><vi>Nội thất - Tượng</vi>','4','products/noi-that','noi-that','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('27','<en>Souvenirs</en><vi>Quà lưu niệm</vi>','3','products/qua-luu-niem','qua-luu-niem','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('28','<en>Spa</en><vi>Phụ liệu Spa</vi>','5','products/spa','spa','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('29','<en>CMS</en><vi>Quản trị nội dung</vi>','5','','cms','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('30','<en>Web page</en><vi>Trang web</vi>','1','webpage','webpage','29','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('31','<en>News</en><vi>Tin tức</vi>','2','news','news','29','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('32','<en>32_Just test&lt;/&gt;&lt;test&gt;&lt;/test&gt;</en><vi>32_Thử nghiệm thôi&lt;/&gt;&lt;thử nghiệm&gt;&lt;/thử nghiệm&gt;</vi>','6','test','test','0','1','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('33','<en>Customers</en><vi>Khách hàng</vi>','4','customer','customer','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('34','<en>Orders</en><vi>Đơn đặt hàng</vi>','3','order','order','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('35','<en>Images gallery</en><vi>Thư viện ảnh</vi>','6','image_gallery','image_gallery','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('36','<en>36_Languages</en><vi>36_Ngôn ngữ</vi>','2','language','language','3','1','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('37','<en>37_Currencies</en><vi>37_Tiền tệ</vi>','2','currency','currency','3','1','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('38','<en>38_24k Gilding Products</en><vi>38_Sản Phẩm Dát Vàng 24k</vi>','3','24k-gilding-products','products','0','1','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('39','<en>News</en><vi>Tin Tức</vi>','6','news','news','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('40','<en>Contact Us</en><vi>Liên Hệ</vi>','7','contact','contact','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('42','<en>Article</en><vi>Bài viết</vi>','2','article','article_list','31','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('44','<en>Categories</en><vi>Danh mục tin</vi>','1','news_category','news_category','31','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('45','<en>Link</en><vi>Liên kết</vi>','9','social_link','social_link','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('46','<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>','1','products/spa/mat-na-dat-vang','mat-na-vang','28','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('47','<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>','1','products/qua-luu-niem/qua-tang-cao-cap','qua-tang-cao-cap','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('48','<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>','2','products/qua-luu-niem/qua-giang-sinh','qua-giang-sinh','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('49','<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>','3','products/qua-luu-niem/khung-hinh','khung-hinh','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('50','<en>Things On Table</en><vi>Vật Để Bàn</vi>','4','products/qua-luu-niem/vat-de-ban','vat-de-ban','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('51','<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>','5','products/qua-luu-niem/khay-tra-ruou','khay-tra-ruou','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('52','<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>','1','products/noi-that/ban-trang-diem','ban-trang-diem','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('53','<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>','2','products/noi-that/ghe-cao-cap','ghe-cao-cap','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('54','<en>TV Shelf</en><vi>Kệ Tivi</vi>','3','products/noi-that/ke-tivi','ke-tivi','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('55','<en>Mirror Frame</en><vi>Khung Gương</vi>','4','products/noi-that/khung-guong','khung-guong','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('56','<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>','5','products/noi-that/tuong-dat-vang','tuong-dat-vang','26','0','1',NULL);

UPDATE `menu` SET `section` = 'mat-na-dat-vang'	WHERE `id` = 46;
UPDATE `menu` SET `link` = 'contact.html'	WHERE `id` = 40;

/* 2012-07-26 - Ly Vinh Truong - Social Links */

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES ('92', 'Social link image suffix', 'BO_SOCIAL_LINK_IMG_SUFFIX', '_icon_32', '1', '0', '2012-06-23 21:20:30', NULL, '', 1, '0', '1', NULL);

/* 2012-07-26 - Ly Vinh Truong - META information in Homepage */

INSERT  INTO `parameter`(`id`,`name`,`code`,`value`,`always_load`,`status`,`creation_date`,`modification_date`,`id_user_created`,`id_user_modified`,`disabled`,`data_type`,`data`) VALUES 
(90,'Meta description in Front Office','FO_META_DESCRIPTION','<en>Come to Phuc Khang to own the best gilded items such as gilded frames, gilded souvenirs, the luxury gilded furnitures and the high quality gilded statues.</en><vi>Hãy đến với Phúc Khang để sở hữu những vật phẩm dát vàng đẳng cấp và tuyệt vời nhất như: Khung hình, quà lưu niệm dát vàng độc đáo, đồ nội thất dát vàng sang trọng và tượng dát vàng cao cấp</vi>',1,0,'2012-07-25 23:40:07','2012-07-25 17:04:46',1,1,0,12,NULL),
(91,'Meta keywords in Front Office','FO_META_KEYWORDS','dat vang, ma vang, khung hinh, khung hinh dat vang, qua luu niem, qua luu niem dat vang, noi that, noi that dat vang, tuong, tuong dat vang, gilded, gilded frame, gilded souvenir, gilded interior, gilded furniture, gilded statue',1,0,'2012-07-26 00:13:19',NULL,1,NULL,0,1,NULL);

/*29/07/2012 Nguyen Van Cuong - Update Menu*/

TRUNCATE TABLE menu;


insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('1','<en>Dashboard</en><vi>Bảng điều khiển</vi>','1','dashboard','dashboard','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('2','<en>Products</en><vi>Sản phẩm</vi>','2','product','product','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('3','<en>System</en><vi>Hệ thống</vi>','10','system','system','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('4','<en>Users</en><vi>Người dùng</vi>','9','user','user','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('5','<en>Settings</en><vi>Cài đặt</vi>','1','setting','setting','3','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('6','<en>Menu</en><vi>Menu</vi>','2','menu','menu','3','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('7','<en>Users Groups</en><vi>Nhóm người dùng</vi>','1','group','group_list','4','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('8','<en>Users</en><vi>Người dùng</vi>','2','user','user_list','4','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('23','<en>Product Categories</en><vi>Nhóm sản phẩm</vi>','1','prod_category','prod_category','2','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('24','<en>Home</en><vi>Trang chủ</vi>','1','index.html','home','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('25','<en>About Us</en><vi>Giới thiệu</vi>','2','about.html','about','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('26','<en>Interiors</en><vi>Nội thất - Tượng</vi>','4','san-pham/noi-that','noi-that','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('27','<en>Souvenirs</en><vi>Quà lưu niệm</vi>','3','san-pham/qua-luu-niem','qua-luu-niem','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('28','<en>Spa</en><vi>Phụ liệu Spa</vi>','5','san-pham/spa','spa','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('29','<en>CMS</en><vi>Quản trị nội dung</vi>','5','','cms','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('30','<en>Web page</en><vi>Trang web</vi>','1','webpage','webpage','29','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('31','<en>News</en><vi>Tin tức</vi>','2','news','news','29','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('32','<en>32_Just test&lt;/&gt;&lt;test&gt;&lt;/test&gt;</en><vi>32_Thử nghiệm thôi&lt;/&gt;&lt;thử nghiệm&gt;&lt;/thử nghiệm&gt;</vi>','6','test','test','0','1','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('33','<en>Customers</en><vi>Khách hàng</vi>','4','customer','customer','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('34','<en>Orders</en><vi>Đơn đặt hàng</vi>','3','order','order','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('35','<en>Images gallery</en><vi>Thư viện ảnh</vi>','6','image_gallery','image_gallery','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('36','<en>36_Languages</en><vi>36_Ngôn ngữ</vi>','2','language','language','3','1','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('37','<en>37_Currencies</en><vi>37_Tiền tệ</vi>','2','currency','currency','3','1','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('38','<en>38_24k Gilding Products</en><vi>38_Sản Phẩm Dát Vàng 24k</vi>','3','24k-gilding-products','products','0','1','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('39','<en>News</en><vi>Tin Tức</vi>','6','news','news','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('40','<en>Contact Us</en><vi>Liên Hệ</vi>','7','contact.html','contact','0','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('42','<en>Article</en><vi>Bài viết</vi>','2','article','article_list','31','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('44','<en>Categories</en><vi>Danh mục tin</vi>','1','news_category','news_category','31','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('45','<en>Link</en><vi>Liên kết</vi>','9','social_link','social_link','0','0','2',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('46','<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>','1','san-pham/spa/mat-na-dat-vang','mat-na-dat-vang','28','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('47','<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>','1','san-pham/qua-luu-niem/qua-tang-cao-cap','qua-tang-cao-cap','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('48','<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>','2','san-pham/qua-luu-niem/qua-giang-sinh','qua-giang-sinh','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('49','<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>','3','san-pham/qua-luu-niem/khung-hinh','khung-hinh','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('50','<en>Things On Table</en><vi>Vật Để Bàn</vi>','4','san-pham/qua-luu-niem/vat-de-ban','vat-de-ban','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('51','<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>','5','san-pham/qua-luu-niem/khay-tra-ruou','khay-tra-ruou','27','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('52','<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>','1','san-pham/noi-that/ban-trang-diem','ban-trang-diem','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('53','<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>','2','san-pham/noi-that/ghe-cao-cap','ghe-cao-cap','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('54','<en>TV Shelf</en><vi>Kệ Tivi</vi>','3','san-pham/noi-that/ke-tivi','ke-tivi','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('55','<en>Mirror Frame</en><vi>Khung Gương</vi>','4','san-pham/noi-that/khung-guong','khung-guong','26','0','1',NULL);
insert into `menu` (`id`, `name`, `position`, `link`, `section`, `id_parent`, `disabled`, `type`, `relation`) values('56','<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>','5','san-pham/noi-that/tuong-dat-vang','tuong-dat-vang','26','0','1',NULL);

UPDATE `parameter` SET `value` =  'san-pham' WHERE `id` = 64;

UPDATE `parameter` SET `value` = 'gio-hang.html' WHERE `id` = 67


/* 27/07/2012 - Nguyen Van Cuong - add parameter */
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('93','Chars percent word','CHARS_PER_WORD','10','1','0','2012-07-27 17:18:18',NULL,'1','1','0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('94','Max length short description meta','MAX_LENGTH_SHORT_DESC','50','1','0','2012-07-27 17:20:22',NULL,'1',NULL,'0','1',NULL);
insert into `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) values('95','Max length title','MAX_LENGTH_TITLE','12','1','0','2012-07-27 17:21:03',NULL,'1',NULL,'0','1',NULL);

/* 27-07-2012 - Ly Vinh Truong - Update data of Menu, Product Category, Product, Image from Server */

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` VARCHAR(400) COLLATE utf8_unicode_ci NOT NULL,
  `description` TEXT COLLATE utf8_unicode_ci,
  `id_image_group` TINYINT(2) DEFAULT NULL,
  `file` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=193 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `image` */

INSERT  INTO `image`(`id`,`code`,`name`,`description`,`id_image_group`,`file`,`creation_date`) VALUES (1,'6579eb365589b2865b50ad48e919d5f5','22-06-2012 12:22:24','',NULL,'6579eb365589b2865b50ad48e919d5f5.jpg','2012-06-22 05:22:24'),(2,'44c5734f0f5500060d33754a5a499cf1','22-06-2012 12:24:15','',1,'44c5734f0f5500060d33754a5a499cf1.jpg','2012-06-22 05:24:15'),(3,'6f2fac9034d38833f18b1143904eae5c','22-06-2012 12:24:15','',1,'6f2fac9034d38833f18b1143904eae5c.jpg','2012-06-22 05:24:15'),(4,'ec1c17c4c26f8ce37a591931d679618c','22-06-2012 12:28:46','',3,'ec1c17c4c26f8ce37a591931d679618c.jpg','2012-06-22 05:28:46'),(5,'7bf07246187acbcc0797ef2da1762d9e','22-06-2012 12:32:02','',NULL,'7bf07246187acbcc0797ef2da1762d9e.jpg','2012-06-22 05:32:02'),(6,'22c75ea0e7f4ac6faca6ccd255bd1fd4','22-06-2012 12:32:02','',NULL,'22c75ea0e7f4ac6faca6ccd255bd1fd4.jpg','2012-06-22 05:32:02'),(7,'5b4b986af1ccdc8e7d7e5c57ea672c22','22-06-2012 12:32:40','',3,'5b4b986af1ccdc8e7d7e5c57ea672c22.jpg','2012-06-22 05:32:40'),(8,'eb43590e24d16f960b24b2448bbaeef4','22-06-2012 12:32:40','',3,'eb43590e24d16f960b24b2448bbaeef4.jpg','2012-06-22 05:32:40'),(11,'76c5d4555fc2626a506d31e9c87d1641','25-06-2012 23:03:22','',1,'76c5d4555fc2626a506d31e9c87d1641.jpg','2012-06-25 16:03:22'),(12,'6a6580727c7b62210eecf4a59e5351eb','25-06-2012 23:03:22','',1,'6a6580727c7b62210eecf4a59e5351eb.jpg','2012-06-25 16:03:22'),(13,'4b8f10453fc50d370187a3f2a9c4d416','A','Quà Lưu Niệm',3,'4b8f10453fc50d370187a3f2a9c4d416.jpg','2012-06-26 07:26:23'),(15,'cc0e02d5c1874e256f6893cfd649de37','B','Nội Thất - Tượng',3,'cc0e02d5c1874e256f6893cfd649de37.jpg','2012-06-26 07:37:19'),(17,'e578c888b137770542d67b7d3288447b','C','Phụ Liệu Spa',3,'e578c888b137770542d67b7d3288447b.jpg','2012-06-26 07:40:53'),(27,'2be9bf1e613dd70efbb4361c18fe50be','C1','Mặt nạ dát vàng',3,'2be9bf1e613dd70efbb4361c18fe50be.jpg','2012-06-26 08:21:07'),(28,'a4ba494f9a864271a3173cabaf7755b8','A1','Quà Tặng Cao Cấp',3,'a4ba494f9a864271a3173cabaf7755b8.jpg','2012-06-26 08:21:24'),(29,'433cc242d62b3757d0d2f604dc6fcf05','A2','Quà Tặng Giáng Sinh',3,'433cc242d62b3757d0d2f604dc6fcf05.jpg','2012-06-26 08:21:40'),(30,'17edebe4b2eff1e18aae3fa1ffbadfdc','A3','Khung Hình Dát Vàng',3,'17edebe4b2eff1e18aae3fa1ffbadfdc.jpg','2012-06-26 08:21:58'),(31,'5e390328a3bc149c9041fd8609a2448f','A4','Vật Để Bàn',3,'5e390328a3bc149c9041fd8609a2448f.jpg','2012-06-26 08:22:33'),(32,'39f10ea06d6719e8fdc316ca7668a1e2','A5','Khay trà, rượu',3,'39f10ea06d6719e8fdc316ca7668a1e2.jpg','2012-06-26 08:25:16'),(33,'48b4ff68025bb57daaa9c406c9e8d304','B1','Bàn trang điểm',3,'48b4ff68025bb57daaa9c406c9e8d304.jpg','2012-06-26 08:26:46'),(34,'6f3ec2e641548361a37e03f25ff85bd7','B2','Ghế Cao Cấp',3,'6f3ec2e641548361a37e03f25ff85bd7.jpg','2012-06-26 08:30:19'),(35,'369f999adca9bcd79487cfa15f6154dc','B3','Kệ Tivi',3,'369f999adca9bcd79487cfa15f6154dc.jpg','2012-06-26 08:34:48'),(36,'9e49c4f647977524b8dc170883e62ab1','B4','Khung Gương',3,'9e49c4f647977524b8dc170883e62ab1.jpg','2012-06-26 08:37:34'),(37,'1f34e38a54b38d4ae7d6c8f9f482860a','B5','Tượng Dát Vàng',3,'1f34e38a54b38d4ae7d6c8f9f482860a.jpg','2012-06-26 08:38:16'),(44,'a5674c963f14a501fd40a0211b2605fe','A100002','Bàn dát vàng',1,'a5674c963f14a501fd40a0211b2605fe.jpg','2012-06-26 10:11:13'),(45,'92d7ce7b639fef483acef47fbbe2a97e','A100002','Bàn dát vàng',1,'92d7ce7b639fef483acef47fbbe2a97e.jpg','2012-06-26 10:17:07'),(46,'fe2a8f1b19b5f192b6af344a12476961','A100002','Bàn dát vàng',1,'fe2a8f1b19b5f192b6af344a12476961.jpg','2012-06-26 10:18:04'),(48,'774d1cc1a28549253f5d39b6da41c51e','A100002','Bàn dát vàng',1,'774d1cc1a28549253f5d39b6da41c51e.jpg','2012-06-26 10:45:09'),(50,'f080966187782b34194f0c8065314b09','A100002','Bàn dát vàng',1,'f080966187782b34194f0c8065314b09.jpg','2012-06-26 10:48:58'),(51,'4445d15a135186337abc5b6b26f30205','27-06-2012 13:36:59','',NULL,'4445d15a135186337abc5b6b26f30205.jpg','2012-06-27 06:36:59'),(52,'cf2da4738253b3af7db649e3a79f42fa','A###','no pro',1,'cf2da4738253b3af7db649e3a79f42fa.jpg','2012-07-15 04:49:32'),(55,'f03a09438ffa8c3cec0a53e0a809ecbe','A100001','Ngựa dát vàng',1,'f03a09438ffa8c3cec0a53e0a809ecbe.jpg','2012-07-19 19:51:25'),(56,'dcb531613be68d47eb155072a14fd47c','A100002','Hoa Dát Vàng',1,'dcb531613be68d47eb155072a14fd47c.jpg','2012-07-20 07:16:10'),(57,'3b903fdd2d8aa2c639d7bfb4aaef795d','B600003','Bàn làm việc 1',1,'3b903fdd2d8aa2c639d7bfb4aaef795d.jpg','2012-07-20 07:26:42'),(58,'a76c58aa1a0d5586ad8e92838a4d0486','B00004','Tượng Tỳ Hưu Dát Vàng',1,'a76c58aa1a0d5586ad8e92838a4d0486.jpg','2012-07-20 07:50:37'),(59,'890b1893d02bcc42b6f2713ab0f15391','B00004','Tượng Tỳ Hưu Dát Vàng',1,'890b1893d02bcc42b6f2713ab0f15391.jpg','2012-07-20 07:50:40'),(60,'b17589dbbb181913df0fe270b8c6c205','B00004','Tượng Tỳ Hưu Dát Vàng',1,'b17589dbbb181913df0fe270b8c6c205.jpg','2012-07-20 07:50:40'),(61,'7183bc48fae8d5cc743a8ef0d352bbb3','B500005','Tượng Phật Dát Vàng',1,'7183bc48fae8d5cc743a8ef0d352bbb3.jpg','2012-07-20 08:02:24'),(62,'4243bdccb2d91d016085302a1439fc45','B500005','Tượng Phật Dát Vàng',1,'4243bdccb2d91d016085302a1439fc45.jpg','2012-07-20 08:02:40'),(63,'edd33f9b98bac95110aec23d86d1dd1c','B500005','Tượng Phật Dát Vàng',1,'edd33f9b98bac95110aec23d86d1dd1c.jpg','2012-07-20 08:02:41'),(64,'b05994980314a4af8749d03007093090','B500005','Tượng Phật Dát Vàng',1,'b05994980314a4af8749d03007093090.jpg','2012-07-20 08:02:43'),(65,'454ddc0ff7d9e28bd7c61d7d44d563bd','B500005','Tượng Phật Dát Vàng',1,'454ddc0ff7d9e28bd7c61d7d44d563bd.jpg','2012-07-20 08:02:50'),(66,'9b2a6de787be37d0e0f7783cfac1db36','B500005','Tượng Phật Dát Vàng',1,'9b2a6de787be37d0e0f7783cfac1db36.jpg','2012-07-20 08:02:53'),(67,'32d6e76ef5d18fb46516ddb5ab5138b0','B500005','Tượng Phật Dát Vàng',1,'32d6e76ef5d18fb46516ddb5ab5138b0.jpg','2012-07-20 08:02:58'),(68,'bf5b5e1c1a7101b63676bc5d468237ea','B500005','Tượng Phật Dát Vàng',1,'bf5b5e1c1a7101b63676bc5d468237ea.jpg','2012-07-20 08:02:59'),(69,'030ceb4801bde46a483dc92ee2f6ded0','B500005','Tượng Phật Dát Vàng',1,'030ceb4801bde46a483dc92ee2f6ded0.jpg','2012-07-20 08:02:59'),(70,'cc425ffdb8565cf7052e1f44eb77a50d','B500005','Tượng Phật Dát Vàng',1,'cc425ffdb8565cf7052e1f44eb77a50d.jpg','2012-07-20 08:03:07'),(77,'66a94569da009711d9f99594e07ad6db','NT0100006','Bàn Ăn Dát Vàng 1',1,'66a94569da009711d9f99594e07ad6db.jpg','2012-07-20 08:27:39'),(95,'1ba5a73eb824f5021a4c3769663d61cc','B600007','Bàn Làm Việc Dát Vàng',1,'1ba5a73eb824f5021a4c3769663d61cc.png','2012-07-20 08:47:41'),(96,'1c757d79dbd79e5b8d215f725ee34e98','B100008','Bàn Trang Điểm Kiểu 1 Dát Vàng',1,'1c757d79dbd79e5b8d215f725ee34e98.jpg','2012-07-20 09:02:59'),(98,'75880591069e0779648ccc10e0a7410d','B100009','Bàn Trang Điểm Dát Vàng Kiểu 2',1,'75880591069e0779648ccc10e0a7410d.jpg','2012-07-20 09:13:36'),(99,'f3a279af673cdb97006ffa06fed0d36d','B100010','Bàn Trang Điểm Dát Vàng Kiểu 3',1,'f3a279af673cdb97006ffa06fed0d36d.jpg','2012-07-20 09:16:02'),(100,'1cae8f4d40c5373aa570c203f192eb87','B100011','Bàn Trang Điểm Dát Vàng Kiểu 4',1,'1cae8f4d40c5373aa570c203f192eb87.jpg','2012-07-20 09:18:56'),(101,'d3a4b66088922b5e4128ab950528c9d7','B100012','Bàn Trang Điểm Dát Vàng Kiểu 5',1,'d3a4b66088922b5e4128ab950528c9d7.jpg','2012-07-20 09:21:13'),(102,'34fbb99431660192dedbbf08db0eac96','B100013','Bàn Trang Điểm Dát Vàng Kiểu 6',1,'34fbb99431660192dedbbf08db0eac96.jpg','2012-07-20 09:23:11'),(103,'44a7595b35d3decf3c61286da61124d8','B100014','Bàn Trang Điểm Dát Vàng Kiểu 7',1,'44a7595b35d3decf3c61286da61124d8.jpg','2012-07-20 09:24:55'),(104,'921be387ed4d5e794eac65cfb41e9cff','B100015','Bàn Trang Điểm Dát Vàng Kiểu 8',1,'921be387ed4d5e794eac65cfb41e9cff.jpg','2012-07-20 09:26:56'),(105,'bca60771e0135131e3db040a944abe03','B100016','Bàn Trang Điểm Dát Vàng Kiểu 9',1,'bca60771e0135131e3db040a944abe03.png','2012-07-20 09:28:27'),(106,'ec3c81a2d194d10f96d2592375586808','B100017','Bàn Trang Điểm Dát Vàng Kiểu 10',1,'ec3c81a2d194d10f96d2592375586808.png','2012-07-20 09:30:02'),(107,'f82ab3da9210129c551eafef6769210e','B100018','Bàn Trang Điểm Dát Vàng Kiểu 11',1,'f82ab3da9210129c551eafef6769210e.jpg','2012-07-20 09:31:19'),(108,'7a34c49ff88b206c6391e13dda0bbe71','B100019','Bàn Trang Điểm Dát Vàng Kiểu 12',1,'7a34c49ff88b206c6391e13dda0bbe71.jpg','2012-07-20 09:32:38'),(109,'33254a12b03fc6b52d72dccba556771e','B200021','Ghế Dát Vàng Kiểu 1',1,'33254a12b03fc6b52d72dccba556771e.jpg','2012-07-21 00:06:07'),(110,'4ddb0cbf8759cf2222778b9fa672564b','B200022','Ghế Dát Vàng Kiểu 2',1,'4ddb0cbf8759cf2222778b9fa672564b.jpg','2012-07-21 00:07:46'),(111,'460a844cfbd7ac12a14d0bea68fedee5','B200023','Ghế Dát Vàng Kiểu 3',1,'460a844cfbd7ac12a14d0bea68fedee5.jpg','2012-07-21 00:09:06'),(112,'ce574f68c3528ed059c41c39a8eb4d1a','B200024','Ghế Dát Vàng Kiểu 4',1,'ce574f68c3528ed059c41c39a8eb4d1a.jpg','2012-07-21 00:14:16'),(113,'db03934ce4d8ba084f144304573a0b5c','B200025','Ghế Dát Vàng Kiểu 5',1,'db03934ce4d8ba084f144304573a0b5c.jpg','2012-07-21 00:15:39'),(114,'4f6dfdbf3a00fa87f787c0d92bf55ce1','B200026','Ghế Dát Vàng Kiểu 6',1,'4f6dfdbf3a00fa87f787c0d92bf55ce1.jpg','2012-07-21 00:17:09'),(115,'d32536af27c0a73913b8b8fb2d99a574','B200027','Ghế Dát Vàng Kiểu 7',1,'d32536af27c0a73913b8b8fb2d99a574.jpg','2012-07-21 00:18:15'),(116,'813da637014e6a6da7c6f02df3f4f475','B200028','Ghế Dát Vàng Kiểu 8',1,'813da637014e6a6da7c6f02df3f4f475.jpg','2012-07-21 00:19:30'),(117,'85be3de222302589ee400cdc1f544138','B200029','Ghế Dát Vàng Kiểu 9',1,'85be3de222302589ee400cdc1f544138.jpg','2012-07-21 00:20:53'),(118,'475005f928005bbbec032f8e81ab02ee','B200030','Ghế Dát Vàng Kiểu 10',1,'475005f928005bbbec032f8e81ab02ee.jpg','2012-07-21 00:22:23'),(119,'7f1ebd87d5e3d6f0ca89aa7c658941a8','B200031','Ghế Dát Vàng Kiểu 11',1,'7f1ebd87d5e3d6f0ca89aa7c658941a8.jpg','2012-07-21 00:23:33'),(120,'41945eb999a3a6533f5cc60aa86f96e9','B200032','Ghế Dát Vàng Kiểu 12',1,'41945eb999a3a6533f5cc60aa86f96e9.jpg','2012-07-21 00:24:45'),(121,'0988ee4a54abf296aac3b67a805efe8a','B200033','Ghế Dát Vàng Kiểu 13',1,'0988ee4a54abf296aac3b67a805efe8a.jpg','2012-07-21 00:25:50'),(122,'8de8e3e2dfa22df49dc756ea8d9a5d2f','B200034','Ghế Dát Vàng Kiểu 14',1,'8de8e3e2dfa22df49dc756ea8d9a5d2f.jpg','2012-07-21 00:27:49'),(123,'c150a76df9af5b6fabaca3d853361232','B200035','Ghế Dát Vàng Kiểu 15',1,'c150a76df9af5b6fabaca3d853361232.jpg','2012-07-21 00:29:12'),(124,'0c6788ced13fb430a463d2ed5a75b1b6','B200036','Ghế Dát Vàng Kiểu 16',1,'0c6788ced13fb430a463d2ed5a75b1b6.jpg','2012-07-21 00:30:37'),(125,'b02d9fc6e8f53e9524eaf1fa13eec89c','B200037','Ghế Dát Vàng Kiểu 17',1,'b02d9fc6e8f53e9524eaf1fa13eec89c.jpg','2012-07-21 00:31:47'),(126,'1a40077640282e1a1d82c7cfd61cb92d','B200038','Ghế Dát Vàng Kiểu 18',1,'1a40077640282e1a1d82c7cfd61cb92d.jpg','2012-07-21 00:33:11'),(128,'a93679160be776e0aa2b7830d76f8774','B200039','Ghế Dát Vàng Kiểu 19',1,'a93679160be776e0aa2b7830d76f8774.jpg','2012-07-21 00:34:44'),(129,'e6592067e465299204c45a6ed9941536','B200040','Ghế Dát Vàng Kiểu 20',1,'e6592067e465299204c45a6ed9941536.jpg','2012-07-21 00:36:15'),(130,'6327325022c7c43fb9bded7a42c2410c','B200041','Ghế Dát Vàng Kiểu 21',1,'6327325022c7c43fb9bded7a42c2410c.jpg','2012-07-21 00:37:47'),(131,'66b5e3d89d648f94f3dfb15d4be5d749','B200044','Ghế Dát Vàng Kiểu 24',1,'66b5e3d89d648f94f3dfb15d4be5d749.jpg','2012-07-21 00:46:55'),(132,'ab3cda2441c387625578001642d892a8','B200043','Ghế Dát Vàng Kiểu 23',1,'ab3cda2441c387625578001642d892a8.jpg','2012-07-21 00:47:41'),(133,'3ec6cc8727366767b30c0b4cbcc91927','B400045','Khung Gương Dát Vàng Kiểu 1',1,'3ec6cc8727366767b30c0b4cbcc91927.jpg','2012-07-21 00:54:29'),(134,'aa3a91f285da6bd0a4b4e71b2f58b66c','B400046','Khung Gương Dát Vàng Kiểu 2',1,'aa3a91f285da6bd0a4b4e71b2f58b66c.jpg','2012-07-21 00:56:25'),(135,'9d1ca73094185655dffd4fa7fd607724','B400047','Khung Gương Dát Vàng Kiểu 3',1,'9d1ca73094185655dffd4fa7fd607724.jpg','2012-07-21 00:58:31'),(136,'de99aeeb3727185be28737e751bfd73c','B400048','Khung Gương Dát Vàng Kiểu 4',1,'de99aeeb3727185be28737e751bfd73c.jpg','2012-07-21 01:04:27'),(137,'7748402f00920c3776058ad83b91b77b','B400049','Khung Gương Dát Vàng Kiểu 5',1,'7748402f00920c3776058ad83b91b77b.jpg','2012-07-21 01:05:52'),(139,'ce5b896bd1afdac9627b3de49ea35ad9','B400050','Khung Gương Dát Vàng Kiểu 6',1,'ce5b896bd1afdac9627b3de49ea35ad9.png','2012-07-21 01:13:06'),(140,'fd7767d2cb063f53512dc696a66c6486','B400051','Khung Gương Dát Vàng Kiểu 7',1,'fd7767d2cb063f53512dc696a66c6486.png','2012-07-21 01:15:03'),(141,'a003d0a2d7cae933aae46067aa6ccdc2','B400052','Khung Gương Dát Vàng Kiểu 8',1,'a003d0a2d7cae933aae46067aa6ccdc2.jpg','2012-07-21 01:16:51'),(142,'9157baa9d9b4afb4f35bd3d1f5c169e8','B400053','Khung Gương Dát Vàng Kiểu 9',1,'9157baa9d9b4afb4f35bd3d1f5c169e8.jpg','2012-07-21 01:18:09'),(143,'f2728319f38514e2ef420284ad7e2db9','B400054','Khung Gương Dát Vàng Kiểu 10',1,'f2728319f38514e2ef420284ad7e2db9.jpg','2012-07-21 01:19:29'),(144,'af835b86a5f6e53e1bd1d44988cc2b66','B400055','Khung Gương Dát Vàng Kiểu 11',1,'af835b86a5f6e53e1bd1d44988cc2b66.jpg','2012-07-21 01:23:21'),(145,'d025175236e497e74c5ccffc306cda96','B400056','Khung Gương Dát Vàng Kiểu 12',1,'d025175236e497e74c5ccffc306cda96.jpg','2012-07-21 01:28:11'),(146,'a6a3c1565cc33a62a45d85915f6ba7f5','B400057','Khung Gương Dát Vàng Kiểu 13',1,'a6a3c1565cc33a62a45d85915f6ba7f5.jpg','2012-07-21 01:30:54'),(147,'8b3088ce06e8ef7f442d646114c54327','B400058','Khung Gương Dát Vàng Kiểu 14',1,'8b3088ce06e8ef7f442d646114c54327.gif','2012-07-21 01:32:11'),(148,'9d67e184f495de5ec1fc31fe412b864d','B400059','Khung Gương Dát Vàng Kiểu 15',1,'9d67e184f495de5ec1fc31fe412b864d.jpg','2012-07-21 01:35:21'),(149,'eb78b0bd7dab53626317c3cb7228345c','B400060','Khung Gương Dát Vàng Kiểu 16',1,'eb78b0bd7dab53626317c3cb7228345c.jpg','2012-07-21 01:36:33'),(150,'c2646c07b5e746615bd8c7be1b089100','B400061','Khung Gương Dát Vàng Kiểu 17',1,'c2646c07b5e746615bd8c7be1b089100.jpg','2012-07-21 01:38:04'),(151,'5113100047a3de61fbed844efae7784a','B400062','Khung Gương Dát Vàng Kiểu 18',1,'5113100047a3de61fbed844efae7784a.jpg','2012-07-21 01:39:19'),(152,'12e6784f46c30cd56c6a4216c4f019f1','B400063','Khung Gương Dát Vàng Kiểu 19',1,'12e6784f46c30cd56c6a4216c4f019f1.jpg','2012-07-21 01:40:46'),(153,'5520ac4748feb1392d468ac0961bc03a','B400064','Khung Gương Dát Vàng Kiểu 20',1,'5520ac4748feb1392d468ac0961bc03a.jpg','2012-07-21 01:42:09'),(154,'ca85dc4f3517504bfe38315c6a7c65e0','B400065','Khung Gương Dát Vàng Kiểu 21',1,'ca85dc4f3517504bfe38315c6a7c65e0.jpg','2012-07-21 01:43:21'),(155,'8ba7809c6ad246f4088ee442ce92c53c','B400066','Khung Gương Dát Vàng Kiểu 23',1,'8ba7809c6ad246f4088ee442ce92c53c.jpg','2012-07-21 01:44:30'),(156,'131e38e19716bb66b76d68c8ee653d42','B400067','Khung Gương Dát Vàng Kiểu 24',1,'131e38e19716bb66b76d68c8ee653d42.jpg','2012-07-21 01:46:28'),(157,'d22d6210c20c2f00d7d6e26950979d42','B400068','Khung Gương Dát Vàng Kiểu 25',1,'d22d6210c20c2f00d7d6e26950979d42.jpg','2012-07-21 01:47:57'),(158,'e8c878703e6a459d1b682a157928965f','B400070','Khung Gương Dát Vàng Kiểu 27',1,'e8c878703e6a459d1b682a157928965f.jpg','2012-07-21 01:55:19'),(159,'8e3eee76294da1273f023bc6df6835b8','B400071','Khung Gương Dát Vàng Kiểu 28',1,'8e3eee76294da1273f023bc6df6835b8.jpg','2012-07-21 01:57:05'),(160,'54fd7a3f2e58f19856c977fe8e76e6d1','A100072','Hình Cao Cấp 1',1,'54fd7a3f2e58f19856c977fe8e76e6d1.jpg','2012-07-21 02:18:17'),(161,'2808ab8b6cb3173493d4caebb94db4f4','A100072','Hình Cao Cấp 1',1,'2808ab8b6cb3173493d4caebb94db4f4.jpg','2012-07-21 02:20:34'),(162,'06fe30d8f0f70aeb1d9d301b4ace0ed4','A100072','Hình Cao Cấp 1',1,'06fe30d8f0f70aeb1d9d301b4ace0ed4.jpg','2012-07-21 02:20:42'),(163,'08259af3e48ad3c9e2cd71d1abd43ba4','A100072','Hình Cao Cấp 1',1,'08259af3e48ad3c9e2cd71d1abd43ba4.jpg','2012-07-21 02:20:48'),(164,'164646912c229221bdcd509ff3604dd0','A100072','Hình Cao Cấp 1',1,'164646912c229221bdcd509ff3604dd0.jpg','2012-07-21 02:20:58'),(165,'bc12601afbe14341878e22317155d1e5','B700076','Bàn Ăn Dát Vàng Kiểu 2',1,'bc12601afbe14341878e22317155d1e5.jpg','2012-07-23 02:04:45'),(166,'cd0dea3f4bb85378bdb94b0997e63770','B700077','Bàn Ăn Dát Vàng Kiểu 3',1,'cd0dea3f4bb85378bdb94b0997e63770.jpg','2012-07-23 02:06:36'),(167,'bb41ed9c34b1b2eacbd7ed699b386136','B700078','Bàn Ăn Dát Vàng Kiểu 4',1,'bb41ed9c34b1b2eacbd7ed699b386136.jpg','2012-07-23 02:08:06'),(168,'32f4141e56e5e80c2db55382610242c4','B700079','Bàn Ăn Dát Vàng Kiểu 5',1,'32f4141e56e5e80c2db55382610242c4.jpg','2012-07-23 02:09:33'),(169,'664ab37c0a92057d56925c46ca265d9f','B700080','Bàn Ăn Dát Vàng Kiểu 6',1,'664ab37c0a92057d56925c46ca265d9f.jpg','2012-07-23 02:10:40'),(170,'17c614c8e4ab4a9b30a61a79c272864a','B700081','Bàn Ăn Dát Vàng Kiểu 7',1,'17c614c8e4ab4a9b30a61a79c272864a.jpg','2012-07-23 02:11:50'),(171,'ff1f75e2c5e3606428aad78ad128b7f7','B700082','Bàn Ăn Dát Vàng Kiểu 8',1,'ff1f75e2c5e3606428aad78ad128b7f7.jpg','2012-07-23 02:14:12'),(172,'dd660ed3240ef07082e80293955588b3','B700083','Bàn Ăn Dát Vàng Kiểu 9',1,'dd660ed3240ef07082e80293955588b3.jpg','2012-07-23 02:16:56'),(173,'e7c560aea6982710d9fd4dd042316b15','B700084','Bàn Ăn Dát Vàng Kiểu 10',1,'e7c560aea6982710d9fd4dd042316b15.jpg','2012-07-23 02:20:44'),(174,'3e1cf415255aa253b01ea26af43e2d79','B700085','Bàn Ăn Dát Vàng Kiểu 11',1,'3e1cf415255aa253b01ea26af43e2d79.jpg','2012-07-23 02:24:19'),(175,'b337e6614126050b3835df01d2851de3','B700086','Bàn Ăn Dát Vàng Kiểu 12',1,'b337e6614126050b3835df01d2851de3.jpg','2012-07-23 02:28:52'),(176,'2eaff500412d784ebe4243d2a834ceea','B700087','Bàn Ăn Dát Vàng Kiểu 13',1,'2eaff500412d784ebe4243d2a834ceea.jpg','2012-07-23 02:31:27'),(177,'caa779c96ce1ee2af5cb426f409e5a9a','B700088','Bàn Ăn Dát Vàng Kiểu 14',1,'caa779c96ce1ee2af5cb426f409e5a9a.jpg','2012-07-23 02:34:52'),(178,'7938dd98cc9af91ab3c8f6049a81c873','B700089','Bàn Ăn Dát Vàng Kiểu 15',1,'7938dd98cc9af91ab3c8f6049a81c873.jpg','2012-07-23 02:36:23'),(179,'d2bb327aa27e3f53252a07f04653c81f','B700090','Bàn Ăn Dát Vàng Kiểu 16',1,'d2bb327aa27e3f53252a07f04653c81f.jpg','2012-07-23 02:39:21'),(180,'ee51192ab1c0e64e171b412f0031b6d0','B700091','Bàn Ăn Dát Vàng Kiểu 17',1,'ee51192ab1c0e64e171b412f0031b6d0.jpg','2012-07-23 02:41:06'),(181,'86058c39768da1ef14c9d306bfd814b2','B700092','Bàn Ăn Dát Vàng Kiểu 18',1,'86058c39768da1ef14c9d306bfd814b2.jpg','2012-07-23 02:43:11'),(182,'4d86adfa9630ab438b09407e9203b579','B700093','Bàn Ăn Dát Vàng Kiểu 19',1,'4d86adfa9630ab438b09407e9203b579.jpg','2012-07-23 02:44:39'),(183,'9d3af5982e73f7da3f45b10c9075e79f','B600094','Bàn Làm Việc Dát Vàng Kiểu 2',1,'9d3af5982e73f7da3f45b10c9075e79f.jpg','2012-07-25 01:47:47'),(184,'97d4a6ef99ed6306b78d9dde9ddb2360','B600095','Bàn Làm Việc Dát Vàng Kiểu 2',1,'97d4a6ef99ed6306b78d9dde9ddb2360.jpg','2012-07-25 01:49:46'),(185,'55f6c9d9ffd5977ac63591a340318e32','B600096','Bàn Làm Việc Dát Vàng Kiểu 4',1,'55f6c9d9ffd5977ac63591a340318e32.jpg','2012-07-25 01:53:41'),(186,'8322a32a390b934bad867202f94b402d','B600097','Bàn Làm Việc Dát Vàng Kiểu 5',1,'8322a32a390b934bad867202f94b402d.jpg','2012-07-25 01:56:37'),(187,'e0d9e78229cc75662c9abff965b5d1cd','B600098','Bàn Làm Việc Dát Vàng Kiểu 6',1,'e0d9e78229cc75662c9abff965b5d1cd.jpg','2012-07-25 01:58:15'),(188,'7b7bcfc940b963a992c145d2f762f0d7','B600099','Bàn Làm Việc Dát Vàng Kiểu 7',1,'7b7bcfc940b963a992c145d2f762f0d7.png','2012-07-25 02:00:59'),(189,'4216b2ab575fac86e153390b97081a19','B600100','Bàn Làm Việc Dát Vàng Kiểu 8',1,'4216b2ab575fac86e153390b97081a19.jpg','2012-07-25 02:05:09'),(190,'5f9084d09c7aa10f500f245f5b4c144e','B600101','Bàn Làm Việc Dát Vàng Kiểu 9',1,'5f9084d09c7aa10f500f245f5b4c144e.jpg','2012-07-25 02:07:04'),(191,'43649a7860f57656bd4f10e2edca62e4','B600102','Bàn Làm Việc Dát Vàng Kiểu 10',1,'43649a7860f57656bd4f10e2edca62e4.jpg','2012-07-25 02:08:30'),(192,'d82d56d0523a5bb1fc0daea04b6053da','B600103','Bàn Làm Việc Dát Vàng Kiểu 11',1,'d82d56d0523a5bb1fc0daea04b6053da.jpg','2012-07-25 02:10:15');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` INT(2) NOT NULL DEFAULT '0',
  `link` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` INT(11) NOT NULL DEFAULT '0',
  `disabled` TINYINT(1) NOT NULL DEFAULT '0',
  `type` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'type=1: front_office; type=2: back_office',
  `relation` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `menu` */

INSERT  INTO `menu`(`id`,`name`,`position`,`link`,`section`,`id_parent`,`disabled`,`type`,`relation`) VALUES (1,'<en>Dashboard</en><vi>Bảng điều khiển</vi>',1,'dashboard','dashboard',0,0,2,NULL),(2,'<en>Products</en><vi>Sản phẩm</vi>',2,'product','product',0,0,2,NULL),(3,'<en>System</en><vi>Hệ thống</vi>',10,'system','system',0,0,2,NULL),(4,'<en>Users</en><vi>Người dùng</vi>',9,'user','user',0,0,2,NULL),(5,'<en>Settings</en><vi>Cài đặt</vi>',1,'setting','setting',3,0,2,NULL),(6,'<en>Menu</en><vi>Menu</vi>',2,'menu','menu',3,0,2,NULL),(7,'<en>Users Groups</en><vi>Nhóm người dùng</vi>',1,'group','group_list',4,0,2,NULL),(8,'<en>Users</en><vi>Người dùng</vi>',2,'user','user_list',4,0,2,NULL),(23,'<en>Product Categories</en><vi>Nhóm sản phẩm</vi>',1,'prod_category','prod_category',2,0,2,NULL),(24,'<en>Home</en><vi>Trang chủ</vi>',1,'index.html','home',0,0,1,NULL),(25,'<en>About Us</en><vi>Giới thiệu</vi>',2,'about.html','about',0,0,1,NULL),(26,'<en>Interiors</en><vi>Nội thất - Tượng</vi>',2,'san-pham/noi-that','noi-that',57,0,1,NULL),(27,'<en>Souvenirs</en><vi>Quà lưu niệm</vi>',1,'san-pham/qua-luu-niem','qua-luu-niem',57,0,1,NULL),(28,'<en>Spa</en><vi>Phụ liệu Spa</vi>',3,'san-pham/spa','spa',57,0,1,NULL),(29,'<en>CMS</en><vi>Quản trị nội dung</vi>',5,'','cms',0,0,2,NULL),(30,'<en>Web page</en><vi>Trang web</vi>',1,'webpage','webpage',29,0,2,NULL),(31,'<en>News</en><vi>Tin tức</vi>',2,'news','news',29,0,2,NULL),(32,'<en>32_Just test&lt;/&gt;&lt;test&gt;&lt;/test&gt;</en><vi>32_Thử nghiệm thôi&lt;/&gt;&lt;thử nghiệm&gt;&lt;/thử nghiệm&gt;</vi>',6,'test','test',0,1,1,NULL),(33,'<en>Customers</en><vi>Khách hàng</vi>',4,'customer','customer',0,0,2,NULL),(34,'<en>Orders</en><vi>Đơn đặt hàng</vi>',3,'order','order',0,0,2,NULL),(35,'<en>Images gallery</en><vi>Thư viện ảnh</vi>',6,'image_gallery','image_gallery',0,0,2,NULL),(36,'<en>36_Languages</en><vi>36_Ngôn ngữ</vi>',2,'language','language',3,1,2,NULL),(37,'<en>37_Currencies</en><vi>37_Tiền tệ</vi>',2,'currency','currency',3,1,2,NULL),(38,'<en>38_24k Gilding Products</en><vi>38_Sản Phẩm Dát Vàng 24k</vi>',3,'24k-gilding-products','products',0,1,1,NULL),(39,'<en>News</en><vi>Tin Tức</vi>',4,'news','news',0,0,1,NULL),(40,'<en>Contact Us</en><vi>Liên Hệ</vi>',6,'contact.html','contact',0,0,1,NULL),(42,'<en>Article</en><vi>Bài viết</vi>',2,'article','article_list',31,0,2,NULL),(44,'<en>Categories</en><vi>Danh mục tin</vi>',1,'news_category','news_category',31,0,2,NULL),(45,'<en>Link</en><vi>Liên kết</vi>',9,'social_link','social_link',0,0,2,NULL),(46,'<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>',1,'san-pham/spa/mat-na-dat-vang','mat-na-dat-vang',28,0,1,NULL),(47,'<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>',1,'san-pham/qua-luu-niem/qua-tang-cao-cap','qua-tang-cao-cap',27,0,1,NULL),(48,'<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>',2,'san-pham/qua-luu-niem/qua-giang-sinh','qua-giang-sinh',27,0,1,NULL),(49,'<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>',3,'san-pham/qua-luu-niem/khung-hinh','khung-hinh',27,0,1,NULL),(50,'<en>Things On Table</en><vi>Vật Để Bàn</vi>',4,'san-pham/qua-luu-niem/vat-de-ban','vat-de-ban',27,0,1,NULL),(51,'<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>',5,'san-pham/qua-luu-niem/khay-tra-ruou','khay-tra-ruou',27,0,1,NULL),(52,'<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>',1,'san-pham/noi-that/ban-trang-diem','ban-trang-diem',26,0,1,NULL),(53,'<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>',2,'san-pham/noi-that/ghe-cao-cap','ghe-cao-cap',26,0,1,NULL),(54,'<en>TV Shelf</en><vi>Kệ Tivi</vi>',3,'san-pham/noi-that/ke-tivi','ke-tivi',26,0,1,NULL),(55,'<en>Mirror Frame</en><vi>Khung Gương</vi>',4,'san-pham/noi-that/khung-guong','khung-guong',26,0,1,NULL),(56,'<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>',5,'san-pham/noi-that/tuong-dat-vang','tuong-dat-vang',26,0,1,NULL),(57,'<en>Gilded Products</en><vi>Sản phẩm dát vàng</vi>',3,'#','san-pham-dat-vang',0,0,1,NULL),(58,'<en>Pictures</en><vi>Thư viện ảnh</vi>',5,'thu-vien-anh','thu-vien-anh',0,0,1,NULL);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` VARCHAR(250) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` TINYTEXT COLLATE utf8_unicode_ci,
  `description` TEXT COLLATE utf8_unicode_ci,
  `price` FLOAT UNSIGNED DEFAULT NULL,
  `currency` VARCHAR(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_def_image` INT(11) DEFAULT NULL,
  `is_disabled` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `id_prod_category` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `id_prod_image` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_primary_prod_category` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MYISAM AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product` */

INSERT  INTO `product`(`id`,`code`,`name`,`short_description`,`description`,`price`,`currency`,`link`,`id_def_image`,`is_disabled`,`id_prod_category`,`is_deleted`,`keywords`,`is_featured`,`id_prod_image`,`id_primary_prod_category`) VALUES (1,'A100001','<en>Gilded Horse</en><vi>Ngựa dát vàng</vi>','','<en>&lt;p&gt; Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;</en><vi>&lt;p&gt; Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;</vi>',0,'VND','ngua-dat-vang',55,0,'2,12',0,'quà lưu niệm, quà tặng, ngựa dát vàng',1,'55',12),(2,'A100002','<en>Gilded Flower</en><vi>Hoa Dát Vàng</vi>','','',0,'VND','hoa-dat-vang',56,0,'2,12',0,'qua luu niem, hoa dat vang, quà lưu niệm, hoa dát vàng',0,'56',12),(3,'B600003','<en>Gilded Desk Type 1</en><vi>Bàn Làm Việc Dát Vàng Kiểu 1</vi>','','',0,'VND','desk-1',57,0,'4,23',0,'noi that, ban lam viec, nội thất, bàn làm việc',1,'57',23),(4,'B00004','<en>Gilded Pixao</en><vi>Tượng Tỳ Hưu Dát Vàng</vi>','','',0,'VND','ty-huu-dat-vang',58,0,'4',0,'tỳ hưu dát vàng, tỳ hưu, ty huu, ty huu dat vang',0,'58,59,60',4),(5,'B500005','<en>The Gilded Buddha</en><vi>Tượng Phật Dát Vàng</vi>','','',0,'VND','tuong-phat-dat-vang',68,0,'4,21',0,'phat dat vang, tuong phat, tượng phật dát vàng, phật dát vàng, tượng phật',0,'61,62,63,64,65,66,67,68,69,70',21),(6,'B700021','<en>Gilded Table</en><vi>Bàn Ăn Dát Vàng 1</vi>','','',0,'VND','ban-an-dat-vang',77,0,'4,24',0,'',1,'77',24),(76,'B700076','<en>Gilded Table Type 2</en><vi>Bàn Ăn Dát Vàng Kiểu 2</vi>','','',0,'VND','ban-an-dat-vang-1',165,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 1, bàn ăn',0,'165',24),(7,'B600007','<en>Gilded Desk</en><vi>Bàn Làm Việc Dát Vàng</vi>','','',0,'VND','ban-lam-viec',95,0,'4,23',0,'',1,'95',23),(8,'B100008','<en>Gilded Make-up Table 1</en><vi>Bàn Trang Điểm Kiểu 1 Dát Vàng</vi>','','',0,'VND','ban-trang-diem',96,0,'4,17',0,'ban trang diem 1, bàn trang điểm 1',0,'96',17),(9,'B100009','<en>Gilded Make-up Table 2</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 2</vi>','','',0,'VND','ban-trang-diem',98,0,'4,17',0,'ban trang diem 2, bàn trang điểm',0,'98',17),(10,'B100010','<en>Gilded Make-up Table 3</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 3</vi>','','',0,'VND','ban-trang-diem',99,0,'4,17',0,'ban trang diem 3, bàn trang điểm',1,'99',17),(11,'B100011','<en>Gilded Make-up Table 4</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 4</vi>','','',0,'VND','ban-trang-diem',100,0,'4,17',0,'ban trang diem 4, bàn trang điểm 4, ban trang diem',0,'100',17),(12,'B100012','<en>Gilded Make-up Table 5</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 5</vi>','','',0,'VND','ban-trang-diem-5',101,0,'4,17',0,'ban trang diem 5, bàn trang điểm 5, ban trang diem',0,'101',17),(13,'B100013','<en>Gilded Make-up Table 6</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 6</vi>','','',0,'VND','ban-trang-diem-6',102,0,'4,17',0,'ban trang diem 6, bàn trang điểm 6, ban trang diem',0,'102',17),(14,'B100014','<en>Gilded Make-up Table 7</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 7</vi>','','',0,'VND','ban-trang-diem-7',103,0,'4,17',0,'ban trang diem 7, bàn trang điểm 7, ban trang diem',0,'103',17),(15,'B100015','<en>Gilded Make-up Table 8</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 8</vi>','','',0,'VND','ban-trang-diem-8',104,0,'4,17',0,'ban trang diem 8, bàn trang điểm 8, ban trang diem',0,'104',17),(16,'B100016','<en>Gilded Make-up Table 9</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 9</vi>','','',0,'VND','ban-trang-diem-9',105,0,'4,17',0,'ban trang diem 9, bàn trang điểm 9, ban trang diem',0,'105',17),(17,'B100017','<en>Gilded Make-up Table 10</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 10</vi>','','',0,'VND','ban-trang-diem-10',106,0,'4,17',0,'ban trang diem 10, bàn trang điểm 10, ban trang diem',0,'106',17),(18,'B100018','<en>Gilded Make-up Table 11</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 11</vi>','','',0,'VND','ban-trang-diem-11',107,0,'4,17',0,'ban trang diem 11, bàn trang điểm 11, ban trang diem',0,'107',17),(19,'B100019','<en>Gilded Make-up Table 12</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 12</vi>','','',0,'VND','ban-trang-diem-12',108,0,'4,17',0,'ban trang diem 12, bàn trang điểm 12, ban trang diem',0,'108',17),(20,'B100020','<en>Gilded Make-up Table 13</en><vi>Bàn Trang Điểm Dát Vàng Kiểu 13</vi>','','',0,'VND','ban-trang-diem-13',NULL,0,'4,17',0,'ban trang diem 13, bàn trang điểm 13, ban trang diem',0,NULL,17),(21,'B200021','<en>Gilded Chair Type 1</en><vi>Ghế Dát Vàng Kiểu 1</vi>','','',0,'VND','ghe-dat-vang',109,0,'4,18',0,'Ghế Dát Vàng Kiểu 1, ghe dat vang',0,'109',18),(22,'B200022','<en>Gilded Chair Type 2</en><vi>Ghế Dát Vàng Kiểu 2</vi>','','',0,'VND','ghe-dat-vang-2',110,0,'4,18',0,'Ghế Dát Vàng Kiểu 2, ghe dat vang',0,'110',18),(23,'B200023','<en>Gilded Chair Type 3</en><vi>Ghế Dát Vàng Kiểu 3</vi>','','',0,'VND','ghe-dat-vang-3',111,0,'4,18',0,'Ghế Dát Vàng Kiểu 3, ghe dat vang',0,'111',18),(24,'B200024','<en>Gilded Chair Type 4</en><vi>Ghế Dát Vàng Kiểu 4</vi>','','',0,'VND','ghe-dat-vang-4',112,0,'4,18',0,'Ghế Dát Vàng Kiểu 4, ghe dat vang',0,'112',18),(25,'B200025','<en>Gilded Chair Type 5</en><vi>Ghế Dát Vàng Kiểu 5</vi>','','',0,'VND','ghe-dat-vang-5',113,0,'4,18',0,'Ghế Dát Vàng Kiểu 5, ghe dat vang',0,'113',18),(26,'B200026','<en>Gilded Chair Type 6</en><vi>Ghế Dát Vàng Kiểu 6</vi>','','',0,'VND','ghe-dat-vang-6',114,0,'4,18',0,'Ghế Dát Vàng Kiểu 6, ghe dat vang',0,'114',18),(27,'B200027','<en>Gilded Chair Type 7</en><vi>Ghế Dát Vàng Kiểu 7</vi>','','',0,'VND','ghe-dat-vang-7',115,0,'4,18',0,'',0,'115',18),(28,'B200028','<en>Gilded Chair Type 8</en><vi>Ghế Dát Vàng Kiểu 8</vi>','','',0,'VND','ghe-dat-vang-8',116,0,'4,18',0,'Ghế Dát Vàng Kiểu 8, ghe dat vang',0,'116',18),(29,'B200029','<en>Gilded Chair Type 9</en><vi>Ghế Dát Vàng Kiểu 9</vi>','','',0,'VND','ghe-dat-vang-9',117,0,'4,18',0,'Ghế Dát Vàng Kiểu 9, ghe dat vang',0,'117',18),(30,'B200030','<en>Gilded Chair Type 10</en><vi>Ghế Dát Vàng Kiểu 10</vi>','','',0,'VND','ghe-dat-vang-10',118,0,'4,18',0,'Ghế Dát Vàng Kiểu 10, ghe dat vang',0,'118',18),(31,'B200031','<en>Gilded Chair Type 11</en><vi>Ghế Dát Vàng Kiểu 11</vi>','','',0,'VND','ghe-dat-vang-11',119,0,'4,18',0,'Ghế Dát Vàng Kiểu 11, ghe dat vang',0,'119',18),(32,'B200032','<en>Gilded Chair Type 12</en><vi>Ghế Dát Vàng Kiểu 12</vi>','','',0,'VND','ghe-dat-vang-12',120,0,'4,18',0,'Ghế Dát Vàng Kiểu 12, ghe dat vang',0,'120',18),(33,'B200033','<en>Gilded Chair Type 13</en><vi>Ghế Dát Vàng Kiểu 13</vi>','','',0,'VND','ghe-dat-vang-13',121,0,'4,18',0,'Ghế Dát Vàng Kiểu 13, ghe dat vang',0,'121',18),(34,'B200034','<en>Gilded Chair Type 14</en><vi>Ghế Dát Vàng Kiểu 14</vi>','','',0,'VND','ghe-dat-vang-14',122,0,'4,18',0,'Ghế Dát Vàng Kiểu 14, ghe dat vang',0,'122',18),(35,'B200035','<en>Gilded Chair Type 15</en><vi>Ghế Dát Vàng Kiểu 15</vi>','','',0,'VND','ghe-dat-vang-15',123,0,'4,18',0,'Ghế Dát Vàng Kiểu 15, ghe dat vang',0,'123',18),(36,'B200036','<en>Gilded Chair Type 16</en><vi>Ghế Dát Vàng Kiểu 16</vi>','','',0,'VND','ghe-dat-vang-16',124,0,'4,18',0,'Ghế Dát Vàng Kiểu 16, ghe dat vang',0,'124',18),(37,'B200037','<en>Gilded Chair Type 17</en><vi>Ghế Dát Vàng Kiểu 17</vi>','','',0,'VND','ghe-dat-vang-17',125,0,'4,18',0,'Ghế Dát Vàng Kiểu 17, ghe dat vang',0,'125',18),(38,'B200038','<en>Gilded Chair Type 18</en><vi>Ghế Dát Vàng Kiểu 18</vi>','','',0,'VND','ghe-dat-vang-18',126,0,'4,18',0,'Ghế Dát Vàng Kiểu 18, ghe dat vang',0,'126',18),(39,'B200039','<en>Gilded Chair Type 19</en><vi>Ghế Dát Vàng Kiểu 19</vi>','','',0,'VND','ghe-dat-vang-19',128,0,'4,18',0,'Ghế Dát Vàng Kiểu 19, ghe dat vang',0,'128',18),(40,'B200040','<en>Gilded Chair Type 20</en><vi>Ghế Dát Vàng Kiểu 20</vi>','','',0,'VND','ghe-dat-vang-20',129,0,'4,18',0,'Ghế Dát Vàng Kiểu 20, ghe dat vang',0,'129',18),(41,'B200041','<en>Gilded Chair Type 21</en><vi>Ghế Dát Vàng Kiểu 21</vi>','','',0,'VND','ghe-dat-vang-21',130,0,'4,18',0,'Ghế Dát Vàng Kiểu 21, ghe dat vang',0,'130',18),(42,'B200042','<en>Gilded Chair Type 22</en><vi>Ghế Dát Vàng Kiểu 22</vi>','','',0,'VND','ghe-dat-vang-22',NULL,0,'4,18',0,'Ghế Dát Vàng Kiểu 22, ghe dat vang',0,NULL,18),(43,'B200043','<en>Gilded Chair Type 23</en><vi>Ghế Dát Vàng Kiểu 23</vi>','','',0,'VND','ghe-dat-vang-23',132,0,'4,18',0,'Ghế Dát Vàng Kiểu 23, ghe dat vang',0,'132',18),(44,'B200044','<en>Gilded Chair Type 24</en><vi>Ghế Dát Vàng Kiểu 24</vi>','','',0,'VND','ghe-dat-vang-24',131,0,'4,18',0,'Ghế Dát Vàng Kiểu 24, ghe dat vang',0,'131',18),(45,'B400045','<en>Gilded Frame Mirror Type 1</en><vi>Khung Gương Dát Vàng Kiểu 1</vi>','','',0,'VND','khung-guong-1',133,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng',1,'133',20),(46,'B400046','<en>Gilded Frame Mirror Type 2</en><vi>Khung Gương Dát Vàng Kiểu 2</vi>','','',0,'VND','khung-guong-2',134,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 1',0,'134',20),(47,'B400047','<en>Gilded Frame Mirror Type 3</en><vi>Khung Gương Dát Vàng Kiểu 3</vi>','','',0,'VND','khung-guong-3',135,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 3',0,'135',20),(48,'B400048','<en>Gilded Frame Mirror Type 4</en><vi>Khung Gương Dát Vàng Kiểu 4</vi>','','',0,'VND','khung-guong-4',136,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 4',0,'136',20),(49,'B400049','<en>Gilded Frame Mirror Type 5</en><vi>Khung Gương Dát Vàng Kiểu 5</vi>','','',0,'VND','khung-guong-5',137,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 5',0,'137',20),(50,'B400050','<en>Gilded Frame Mirror Type 6</en><vi>Khung Gương Dát Vàng Kiểu 6</vi>','','',0,'VND','khung-guong-6',139,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 6',0,'139',20),(51,'B400051','<en>Gilded Frame Mirror Type 7</en><vi>Khung Gương Dát Vàng Kiểu 7</vi>','','',0,'VND','khung-guong-7',140,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 7',0,'140',20),(52,'B400052','<en>Gilded Frame Mirror Type 8</en><vi>Khung Gương Dát Vàng Kiểu 8</vi>','','',0,'VND','khung-guong-8',141,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 8',0,'141',20),(53,'B400053','<en>Gilded Frame Mirror Type 9</en><vi>Khung Gương Dát Vàng Kiểu 9</vi>','','',0,'VND','khung-guong-9',142,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 9',0,'142',20),(54,'B400054','<en>Gilded Frame Mirror Type 10</en><vi>Khung Gương Dát Vàng Kiểu 10</vi>','','',0,'VND','khung-guong-10',143,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 10',0,'143',20),(55,'B400055','<en>Gilded Frame Mirror Type 11</en><vi>Khung Gương Dát Vàng Kiểu 11</vi>','','',0,'VND','khung-guong-11',144,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 11',0,'144',20),(56,'B400056','<en>Gilded Frame Mirror Type 12</en><vi>Khung Gương Dát Vàng Kiểu 12</vi>','','',0,'VND','khung-guong-12',145,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 12',0,'145',20),(57,'B400057','<en>Gilded Frame Mirror Type 13</en><vi>Khung Gương Dát Vàng Kiểu 13</vi>','','',0,'VND','khung-guong-13',146,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 13',0,'146',20),(58,'B400058','<en>Gilded Frame Mirror Type 14</en><vi>Khung Gương Dát Vàng Kiểu 14</vi>','','',0,'VND','khung-guong-14',147,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 14',0,'147',20),(59,'B400059','<en>Gilded Frame Mirror Type 15</en><vi>Khung Gương Dát Vàng Kiểu 15</vi>','','',0,'VND','khung-guong-15',148,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 15',0,'148',20),(60,'B400060','<en>Gilded Frame Mirror Type 16</en><vi>Khung Gương Dát Vàng Kiểu 16</vi>','','',0,'VND','khung-guong-16',149,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 16',0,'149',20),(61,'B400061','<en>Gilded Frame Mirror Type 17</en><vi>Khung Gương Dát Vàng Kiểu 17</vi>','','',0,'VND','khung-guong-17',150,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 17',0,'150',20),(62,'B400062','<en>Gilded Frame Mirror Type 18</en><vi>Khung Gương Dát Vàng Kiểu 18</vi>','','',0,'VND','khung-guong-18',151,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 18',0,'151',20),(63,'B400063','<en>Gilded Frame Mirror Type 19</en><vi>Khung Gương Dát Vàng Kiểu 19</vi>','','',0,'VND','khung-guong-19',152,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 19',0,'152',20),(64,'B400064','<en>Gilded Frame Mirror Type 20</en><vi>Khung Gương Dát Vàng Kiểu 20</vi>','','',0,'VND','khung-guong-20',153,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 20',0,'153',20),(65,'B400065','<en>Gilded Frame Mirror Type 21</en><vi>Khung Gương Dát Vàng Kiểu 21</vi>','','',0,'VND','khung-guong-21',154,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 21',0,'154',20),(66,'B400066','<en>Gilded Frame Mirror Type 22</en><vi>Khung Gương Dát Vàng Kiểu 23</vi>','','',0,'VND','khung-guong-23',155,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 23',0,'155',20),(67,'B400067','<en>Gilded Frame Mirror Type 24</en><vi>Khung Gương Dát Vàng Kiểu 24</vi>','','',0,'VND','khung-guong-24',156,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 24',0,'156',20),(68,'B400068','<en>Gilded Frame Mirror Type 25</en><vi>Khung Gương Dát Vàng Kiểu 25</vi>','','',0,'VND','khung-guong-25',157,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 25',0,'157',20),(69,'B400069','<en>Gilded Frame Mirror Type 26</en><vi>Khung Gương Dát Vàng Kiểu 26</vi>','','',0,'VND','khung-guong-26',NULL,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 26',0,NULL,20),(70,'B400070','<en>Gilded Frame Mirror Type 27</en><vi>Khung Gương Dát Vàng Kiểu 27</vi>','','',0,'VND','khung-guong-27',158,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 27',1,'158',20),(71,'B400071','<en>Gilded Frame Mirror Type 28</en><vi>Khung Gương Dát Vàng Kiểu 28</vi>','','',0,'VND','khung-guong-28',159,0,'4,20',0,'khung guong, guong dat vang, khung gương, khung gương dát vàng 28',0,'159',20),(72,'A100072','<en>Gilded Image 1</en><vi>Hình Cao Cấp 1</vi>','','',0,'VND','hinh-cao-cap-1',160,0,'2,12',0,'hình cao cấp, hinh cao cap 1',1,'160,161,162,163,164',12),(73,'A300073','<en>Gilded Frame Image 1</en><vi>Khung Hình Dát Vàng Kiểu 1</vi>','','',0,'VND','khung-hinh-1',NULL,0,'2,14',0,'khung hình dát vàng, khung hinh 1',0,NULL,14),(74,'A300074','<en>Gilded Frame Image 2</en><vi>Khung Hình Dát Vàng Kiểu 2</vi>','','',0,'VND','khung-hinh-2',NULL,0,'2,14',0,'khung hình dát vàng, khung hinh 2',1,NULL,14),(75,'A400075','<en>Gilded Flower</en><vi>Hoa Sen Dát Vàng</vi>','','',0,'VND','hoa-dat-vang',NULL,0,'2,15',0,'vat de ban, hoa dat vang',1,NULL,15),(77,'B700077','<en>Gilded Table Type 3</en><vi>Bàn Ăn Dát Vàng Kiểu 3</vi>','','',0,'VND','ban-an-dat-vang-3',166,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 3, bàn ăn',0,'166',24),(78,'B700078','<en>Gilded Table Type 4</en><vi>Bàn Ăn Dát Vàng Kiểu 4</vi>','','',0,'VND','ban-an-dat-vang-4',167,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 4, bàn ăn',0,'167',24),(79,'B700079','<en>Gilded Table Type 5</en><vi>Bàn Ăn Dát Vàng Kiểu 5</vi>','','',0,'VND','ban-an-dat-vang-5',168,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 5, bàn ăn',0,'168',24),(80,'B700080','<en>Gilded Table Type 6</en><vi>Bàn Ăn Dát Vàng Kiểu 6</vi>','','',0,'VND','ban-an-dat-vang-6',169,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 6, bàn ăn',0,'169',24),(81,'B700081','<en>Gilded Table Type 7</en><vi>Bàn Ăn Dát Vàng Kiểu 7</vi>','','',0,'VND','ban-an-dat-vang-7',170,0,'4,24',0,'',0,'170',24),(82,'B700082','<en>Gilded Table Type 8</en><vi>Bàn Ăn Dát Vàng Kiểu 8</vi>','','',0,'VND','ban-an-dat-vang-8',171,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 8, bàn ăn',0,'171',24),(83,'B700083','<en>Gilded Table Type 9</en><vi>Bàn Ăn Dát Vàng Kiểu 9</vi>','','',0,'VND','ban-an-dat-vang-9',172,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 9, bàn ăn',0,'172',24),(84,'B700084','<en>Gilded Table Type 10</en><vi>Bàn Ăn Dát Vàng Kiểu 10</vi>','','',0,'VND','ban-an-dat-vang-10',173,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 10, bàn ăn',0,'173',24),(85,'B700085','<en>Gilded Table Type 11</en><vi>Bàn Ăn Dát Vàng Kiểu 11</vi>','','',0,'VND','ban-an-dat-vang-11',174,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 11, bàn ăn',0,'174',24),(86,'B700086','<en>Gilded Table Type 12</en><vi>Bàn Ăn Dát Vàng Kiểu 12</vi>','','',0,'VND','ban-an-dat-vang-12',175,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 12, bàn ăn',0,'175',24),(87,'B700087','<en>Gilded Table Type 13</en><vi>Bàn Ăn Dát Vàng Kiểu 13</vi>','','',0,'VND','ban-an-dat-vang-13',176,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 13, bàn ăn',0,'176',24),(88,'B700088','<en>Gilded Table Type 14</en><vi>Bàn Ăn Dát Vàng Kiểu 14</vi>','','',0,'VND','ban-an-dat-vang-14',177,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 14, bàn ăn',0,'177',24),(89,'B700089','<en>Gilded Table Type 15</en><vi>Bàn Ăn Dát Vàng Kiểu 15</vi>','','',0,'VND','ban-an-dat-vang-15',178,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 15, bàn ăn',0,'178',24),(90,'B700090','<en>Gilded Table Type 16</en><vi>Bàn Ăn Dát Vàng Kiểu 16</vi>','','',0,'VND','ban-an-dat-vang-16',NULL,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 16, bàn ăn',0,'179',24),(91,'B700091','<en>Gilded Table Type 17</en><vi>Bàn Ăn Dát Vàng Kiểu 17</vi>','','',0,'VND','ban-an-dat-vang-17',180,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 17, bàn ăn',0,'180',24),(92,'B700092','<en>Gilded Table Type 18</en><vi>Bàn Ăn Dát Vàng Kiểu 18</vi>','','',0,'VND','ban-an-dat-vang-18',181,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 18, bàn ăn',0,'181',24),(93,'B700093','<en>Gilded Table Type 19</en><vi>Bàn Ăn Dát Vàng Kiểu 19</vi>','','',0,'VND','ban-an-dat-vang-19',182,0,'4,24',0,'ban an, bàn ăn dát vàng kiểu 19, bàn ăn',0,'182',24),(94,'B600094','<en>Gilded Desk Type 2</en><vi>Bàn Làm Việc Dát Vàng Kiểu 2</vi>','','',0,'VND','desk-2',183,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 1, ban lam viec, gilded desk',0,'183',23),(95,'B600095','<en>Gilded Desk Type 3</en><vi>Bàn Làm Việc Dát Vàng Kiểu 2</vi>','','',0,'VND','desk-3',184,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 2, ban lam viec, gilded desk',0,'184',23),(96,'B600096','<en>Gilded Desk Type 4</en><vi>Bàn Làm Việc Dát Vàng Kiểu 4</vi>','','',0,'VND','desk-4',185,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 4, ban lam viec, gilded desk',0,'185',23),(97,'B600097','<en>Gilded Desk Type 5</en><vi>Bàn Làm Việc Dát Vàng Kiểu 5</vi>','','',0,'VND','desk-5',186,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 5, ban lam viec, gilded desk',0,'186',23),(98,'B600098','<en>Gilded Desk Type 6</en><vi>Bàn Làm Việc Dát Vàng Kiểu 6</vi>','','',0,'VND','desk-6',187,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 6, ban lam viec, gilded desk',0,'187',23),(99,'B600099','<en>Gilded Desk Type 7</en><vi>Bàn Làm Việc Dát Vàng Kiểu 7</vi>','','',0,'VND','desk-7',188,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 7, ban lam viec, gilded desk',0,'188',23),(100,'B600100','<en>Gilded Desk Type 8</en><vi>Bàn Làm Việc Dát Vàng Kiểu 8</vi>','','',0,'VND','desk-8',189,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 8, ban lam viec, gilded desk',0,'189',23),(101,'B600101','<en>Gilded Desk Type 9</en><vi>Bàn Làm Việc Dát Vàng Kiểu 9</vi>','','',0,'VND','desk-9',190,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 9, ban lam viec, gilded desk',0,'190',23),(102,'B600102','<en>Gilded Desk Type 10</en><vi>Bàn Làm Việc Dát Vàng Kiểu 10</vi>','','',0,'VND','desk-10',191,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 10, ban lam viec, gilded desk',0,'191',23),(103,'B600103','<en>Gilded Desk Type 11</en><vi>Bàn Làm Việc Dát Vàng Kiểu 11</vi>','','',0,'VND','desk-11',192,0,'4,23',0,'ban lam viec dat vang, bàn làm việc dát vàng kiểu 11, ban lam viec, gilded desk',0,'192',23);

/*Table structure for table `product_category` */

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` VARCHAR(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `id_parent` VARCHAR(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` TEXT COLLATE utf8_unicode_ci,
  `keywords` VARCHAR(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_image` INT(11) DEFAULT NULL,
  `link` VARCHAR(400) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` TEXT COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NewIndex1` (`code`)
) ENGINE=MYISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `product_category` */

INSERT  INTO `product_category`(`id`,`code`,`name`,`is_deleted`,`id_parent`,`description`,`keywords`,`id_image`,`link`,`meta_description`) VALUES (2,'A','<en>Souvenirs</en><vi>Quà Lưu Niệm</vi>',0,'0','<en>Khang Phuc offers gilded souvenirs with 100% quality of 24k gold such as gilded frames, objects on tables, exhibits, gifts, Christmas gifts, ...</en><vi>Phúc Khang cung cấp các sản phẩm quà lưu niệm dát vàng độc đáo với 100% chất lượng vàng 24k như khung hình, vật để bàn, vật trưng bày, quà tặng, quà Giáng Sinh,...</vi>','qua luu niem dat vang, khung hinh dat vang, vat de ban, vat trang tri, vat trung bay, qua tang, qua giang sinh',13,'san-pham/qua-luu-niem',NULL),(3,'C','<en>Spa</en><vi>Phụ Liệu Spa</vi>',0,'0','','',17,'san-pham/spa',NULL),(4,'B','<en>Interiors</en><vi>Nội Thất - Tượng</vi>',0,'0','','',15,'san-pham/noi-that',NULL),(22,'C1','<en>Gilding Mask</en><vi>Mặt nạ dát vàng</vi>',0,'2','','',27,'san-pham/qua-luu-niem/mat-na-dat-vang',NULL),(12,'A1','<en>Luxury Gifts</en><vi>Quà Tặng Cao Cấp</vi>',0,'2','','',28,'san-pham/qua-luu-niem/qua-tang-cao-cap',NULL),(13,'A2','<en>Christmas Gifts</en><vi>Quà Tặng Giáng Sinh</vi>',0,'2','','',29,'san-pham/qua-luu-niem/qua-giang-sinh',NULL),(14,'A3','<en>Gilding Picture Frame</en><vi>Khung Hình Dát Vàng</vi>',0,'2','','',30,'san-pham/qua-luu-niem/khung-hinh',NULL),(15,'A4','<en>Things On Table</en><vi>Vật Để Bàn</vi>',0,'2','','',31,'san-pham/qua-luu-niem/vat-de-ban',NULL),(16,'A5','<en>Tray of tea, wine</en><vi>Khay trà, rượu</vi>',0,'2','','',32,'san-pham/qua-luu-niem/khay-tra-ruou',NULL),(17,'B1','<en>Bàn trang điểm</en><vi>Bàn trang điểm</vi>',0,'4','','',33,'san-pham/noi-that/ban-trang-diem',NULL),(18,'B2','<en>Special Chairs</en><vi>Ghế Cao Cấp</vi>',0,'4','','',34,'san-pham/noi-that/ghe-cao-cap',NULL),(19,'B3','<en>TV Shelf</en><vi>Kệ Tivi</vi>',0,'4','','',35,'san-pham/noi-that/ke-tivi',NULL),(20,'B4','<en>Mirror Frame</en><vi>Khung Gương</vi>',0,'4','','',36,'san-pham/noi-that/khung-guong',NULL),(21,'B5','<en>Gilding Statues</en><vi>Tượng Dát Vàng</vi>',0,'4','','',37,'san-pham/noi-that/tuong-dat-vang',NULL),(23,'B6','<en>Desks</en><vi>Bàn làm việc</vi>',0,'4','','noi that, ban lam viec, nội thất, bàn làm việc',NULL,'san-pham/noi-that/ban-lam-viec',NULL),(24,'B7','<en>Table</en><vi>Bàn ăn</vi>',0,'4','','ban an, bàn ăn',NULL,'san-pham/noi-that/ban-an',NULL);

TRUNCATE TABLE `web_page`;

INSERT  INTO `web_page`(`id`,`title`,`content`,`link`,`keywords`,`is_disabled`,`id_parent`,`meta_description`) VALUES (2,'<en>About Us</en><vi>Giới thiệu</vi>','<en>&lt;h3&gt; The standard Lorem Ipsum passage, used since the 1500s&lt;/h3&gt;&lt;p&gt; &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/p&gt;&lt;h3&gt; Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC&lt;/h3&gt;&lt;p&gt; &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;&lt;/p&gt;</en><vi>&lt;h3&gt; The standard Lorem Ipsum passage, used since the 1500s&lt;/h3&gt;&lt;p&gt; &quot;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;&lt;/p&gt;&lt;h3&gt; Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC&lt;/h3&gt;&lt;p&gt; &quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;&lt;/p&gt;</vi>','about-us','about, gioi thieu',0,NULL,NULL);

UPDATE `menu` SET `link` = '/' WHERE `id` = 24;
UPDATE `menu` SET `link` = 'gioi-thieu.html', `section` = 'gioi-thieu' WHERE `id` = 25;
UPDATE `menu` SET `link` = 'tin-tuc', `section` = 'tin-tuc' WHERE `id` = 39;
UPDATE `menu` SET `link` = 'lien-he.html', `section` = 'lien-he' WHERE `id` = 40;

/* 27-07-2012 - Ly Vinh Truong - Parameter */
ALTER TABLE `parameter` 
   CHANGE `value` `value` TEXT NOT NULL;

UPDATE `parameter` SET `value` = '<en>Come to Phuc Khang to own the best gilded items such as gilded frames, gilded souvenirs, the luxury gilded furnitures and the high quality gilded statues.</en><vi>Hãy đến với Phúc Khang để sở hữu những vật phẩm dát vàng đẳng cấp và tuyệt vời nhất như: Khung hình, quà lưu niệm dát vàng độc đáo, đồ nội thất dát vàng sang trọng và tượng dát vàng cao cấp</vi>' WHERE `id` = 90;

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES
(96, 'Overall Meta Title', 'FO_META_OVERALL_TITLE', '<en>Gilding, Gilded Frames, Gilded Souvenirs, Gilded Furniture, Gilded Statues</en><vi>Dát Vàng, Quà Lưu Niệm, Đồ Nội Thất, Tượng Dát Vàng</vi>', 1, 0, '2012-07-27 19:27:20', NULL, 1, NULL, 0, 12, NULL);

UPDATE `parameter` SET `value` = 'dat-hang.html' WHERE `id` = 65;
UPDATE `parameter` SET `value` = 'lien-he.html' WHERE `id` = 66;
UPDATE `parameter` SET `value` = 'gio-hang.html' WHERE `id` = 67;

/* 28-07-2012 - Nguyen van cuong - Update webpage*/
UPDATE web_page SET link = 'gioi-thieu' WHERE id = 2;

/* 01-08-2012 - Pham Thanh Nam - add image article*/
ALTER TABLE `article` ADD `id_image` VARCHAR( 255 ) NULL AFTER `keywords`;
INSERT INTO `image_group` (`id`, `code`, `name`, `id_image_size`, `use_wm`) VALUES ('5', 'article', 'Article', '6', '0');

/* 03/08/2012 - Nguyen Van Cuong alter table customer */
ALTER TABLE `customer` ADD COLUMN `image` VARCHAR(250) AFTER POSITION;
ALTER TABLE `customer` ADD COLUMN `username` VARCHAR(50) AFTER POSITION;
ALTER TABLE `customer` ADD COLUMN `link_profile` VARCHAR(250) AFTER POSITION;

/* 06-08-2012 - Pham Thanh Nam - limit 5 product */
UPDATE `parameter` SET `value` = '5' WHERE `parameter`.`id` =69;

ALTER TABLE `social_link` ADD `is_social` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES
(97, 'Is social link', 'IS_SOCIAL', '1', 1, 0, '2012-08-06 16:22:15', NULL, 1, NULL, 0, 1, NULL),
(98, 'Is not social link', 'IS_NOT_SOCIAL', '0', 1, 0, '2012-08-06 16:24:23', NULL, 1, NULL, 0, 1, NULL);

/* 07/08/2012 - Nguyen Van Cuong - add image and customer */
ALTER TABLE `image` ADD `is_display_front_end` INT( 1 ) NOT NULL AFTER `creation_date` ;
ALTER TABLE `customer` CHANGE `email` `email` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;
ALTER TABLE `customer` CHANGE `billing_address` `billing_address` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;
ALTER TABLE `customer` CHANGE `shipping_address` `shipping_address` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;
ALTER TABLE `customer` CHANGE `contact_address` `contact_address` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;
ALTER TABLE `customer` ADD `type_connect` INT( 2 ) NOT NULL;
ALTER TABLE `image` CHANGE `is_display_front_end` `is_display_front_end` INT( 1 ) NOT NULL DEFAULT '1';
INSERT INTO `parameter` (
`id` ,
`name` ,
`code` ,
`value` ,
`always_load` ,
`status` ,
`creation_date` ,
`modification_date` ,
`id_user_created` ,
`id_user_modified` ,
`disabled` ,
`data_type` ,
`data`
)
VALUES (
102, 'Number of images display on front end', 'LIMIT_PICTURE', '21', '1', '1',
CURRENT_TIMESTAMP , NULL , '1', NULL , '0', '1', NULL
);
UPDATE `parameter` SET `status` = '0' WHERE `parameter`.`id` =99 LIMIT 1 ;

ALTER TABLE `customer` CHANGE `type_connect` `type_connect` INT( 2 ) NOT NULL DEFAULT '2';
ALTER TABLE `customer` DROP INDEX `idx_email` ;

/* 07-08-2012 - Pham Thanh Nam - link */
ALTER TABLE `social_link` ADD `type_show` TINYINT UNSIGNED NOT NULL DEFAULT '0';

INSERT INTO `parameter` (`id`, `name`, `code`, `value`, `always_load`, `status`, `creation_date`, `modification_date`, `id_user_created`, `id_user_modified`, `disabled`, `data_type`, `data`) VALUES
(100, 'Show link is type text', 'TYPE_TEXT', '0', 1, 0, '2012-08-07 14:38:35', NULL, 1, NULL, 0, 1, NULL),
(101, 'Show link is type image', 'TYPE_IMAGE', '1', 1, 0, '2012-08-07 14:39:58', NULL, 1, NULL, 0, 1, NULL);

INSERT INTO `image_size` (`id`, `code`, `name`, `value`) VALUES ('8', 'link', 'Link', '225x50');
UPDATE `image_group` SET `id_image_size` = '7,8' WHERE `image_group`.`id` =4;

INSERT INTO `image` (`id`, `code`, `name`, `description`, `id_image_group`, `file`, `creation_date`, `is_display_front_end`) VALUES (NULL, 'test_social_link', '', 'test_social_link.jpg', '4', 'test_social_link.jpg', CURRENT_TIMESTAMP, '1');

INSERT INTO `social_link` (`id`, `name`, `url`, `id_image`, `is_social`, `type_show`) VALUES
(1, '<en>Google+</en><vi>Google+</vi>', 'http://www.google.com.vn', 196, 1, 0),
(2, '<en>facebook</en><vi>facebook</vi>', 'http://www.facebook.com', 195, 1, 0),
(3, '<en>linkin</en><vi>linkin</vi>', 'http://www.linkin.com', 194, 1, 0),
(5, '<en>twiter</en><vi>twitter</vi>', 'http://www.twitter.com', 193, 1, 0),
(6, '<en>Tuoi Tre News</en><vi>Báo tuổi trẻ</vi>', 'http://www.google.com.vn', NULL, 0, 0),
(7, '<en>Tuoi Tre News</en><vi>Báo tuổi trẻ</vi>', 'http://www.google.com.vn', NULL, 0, 0),
(8, '<en>Tuoi Tre News</en><vi>Báo tuổi trẻ</vi>', 'http://www.google.com.vn', NULL, 0, 0),
(9, '<en>Tuoi Tre News</en><vi>Báo tuổi trẻ</vi>', 'http://www.google.com.vn', NULL, 0, 0);

INSERT INTO `social_link` (`id`, `name`, `url`, `id_image`, `is_social`, `type_show`) VALUES
(10, '<en>test link 1</en><vi>test link 1</vi>', 'http://www.google.com.vn', 197, 0, 1);

INSERT INTO `image` (`id`, `code`, `name`, `description`, `id_image_group`, `file`, `creation_date`, `is_display_front_end`) VALUES
(193, '8A1621DAE39BF1D91D372C77F441E80B8F68B9B6', '', 'twitter', 4, '8A1621DAE39BF1D91D372C77F441E80B8F68B9B6.png', '2012-08-07 11:56:32', 0),
(194, '7728240C80B6BFD450849405E8500D6D207783B6', '', 'linkin', NULL, '7728240C80B6BFD450849405E8500D6D207783B6.png', '2012-08-07 11:58:02', 0),
(195, 'CBE648909034C0624C205FE219D3FBD10052C715', '', 'facebook', NULL, 'CBE648909034C0624C205FE219D3FBD10052C715.png', '2012-08-07 11:58:27', 0),
(196, 'ECAD9E2DE6834A029CBD4B1F9CCC0245BD1473B9', '', 'google+', NULL, 'ECAD9E2DE6834A029CBD4B1F9CCC0245BD1473B9.png', '2012-08-07 12:03:45', 0),
(197, 'test_social_link', '', 'test_social_link.jpg', 4, 'test_social_link.jpg', '2012-08-07 16:12:16', 1);


/* 08/08/2012 - Nguyen Van Cuong - udpate order */
ALTER TABLE `purchase_order` CHANGE `shipping_address` `shipping_address` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;
ALTER TABLE `purchase_order` CHANGE `billing_address` `billing_address` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL ;

ALTER TABLE `customer` CHANGE `type_connect` `type_connect` INT( 2 ) NULL DEFAULT '2';

/*08/08/2012 - Nguyen Van Cuong - delete news_category*/
DELETE FROM `news_category` WHERE `id` IN (1,2);

/* 09/08/2012 - Pham Thanh Nam - fix link linkedin */
UPDATE `social_link` SET `name` = '<en>linkedin</en><vi>linkedin</vi>',
`url` = 'http://www.linkedin.com/' WHERE `social_link`.`id` =3;

UPDATE `image_group` SET `id_image_size` = '1,3,6' WHERE `image_group`.`id` =2;
DELETE FROM `image_group` WHERE `id` = 5;

/* 18/08/2012 - Ly Vinh Truong - Fix upload images path */
DELETE FROM `parameter` WHERE `id` = 18;

```