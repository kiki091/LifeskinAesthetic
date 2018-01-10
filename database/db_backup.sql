CREATE DATABASE  IF NOT EXISTS `beautyhouse` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `beautyhouse`;
-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: beautyhouse
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_one_title` varchar(100) DEFAULT NULL,
  `section_one_description` text,
  `section_one_images` varchar(255) DEFAULT NULL,
  `section_two_title` varchar(100) DEFAULT NULL,
  `section_two_introduction` varchar(255) DEFAULT NULL,
  `section_two_images` varchar(255) DEFAULT NULL,
  `section_two_choose_one_title` varchar(100) DEFAULT NULL,
  `section_two_choose_one_introduction` varchar(255) DEFAULT NULL,
  `section_two_choose_two_title` varchar(100) DEFAULT NULL,
  `section_two_choose_two_introduction` varchar(255) DEFAULT NULL,
  `section_two_choose_three_title` varchar(100) DEFAULT NULL,
  `section_two_choose_three_introduction` varchar(255) DEFAULT NULL,
  `section_three_title` varchar(100) DEFAULT NULL,
  `section_three_introduction` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
INSERT INTO `about` VALUES (1,'About Our Lifeskin Aesthetic','<p class=\"text-1\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet dolor libero, eget loved venenatis mauris finibus dictum. Vestibulum quis elit eget neque porttitor  no amet dolor. Proin pretium purus a lorem ornare</p><p class=\"text-2\">sed lobortis pulvinar. Integer laoreet mi id eros porta euismod. Suspendisse potenti. Nulla eros mauris, convallis et sem tempus, viverra hendrerit sapien  Lorem  amet, consectetur adipiscing elit. Donec aliquet dolor libero, </p>','about-1.jpg','WHY CHOOSE US?','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>','choose.png','BEAUTIFUL & SEXY LIFE','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis . </p>','NATURAL ATMOSPHERE','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis . </p>','XOSS ENVIRONMENT','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis . </p>','OUR LOVELY TEAM','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>',NULL,NULL);
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_1_idx` (`member_id`),
  CONSTRAINT `fk_cart_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,1,'0',NULL,NULL),(2,1,'0',NULL,NULL);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_detail`
--

DROP TABLE IF EXISTS `cart_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL DEFAULT '0',
  `book_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_detail_1_idx` (`package_id`),
  CONSTRAINT `fk_cart_detail_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_detail`
--

LOCK TABLES `cart_detail` WRITE;
/*!40000 ALTER TABLE `cart_detail` DISABLE KEYS */;
INSERT INTO `cart_detail` VALUES (1,2,450000,0,'2018-01-11',NULL,NULL),(2,2,450000,0,'2018-01-12',NULL,NULL);
/*!40000 ALTER TABLE `cart_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Face treatment','face-treatment',NULL,NULL),(2,'Nail treatment','nail-treatment',NULL,NULL),(3,'Hair treatment','hair-treatment',NULL,NULL),(4,'Body treatment','body-treatment',NULL,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `messages` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `category_id` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gallery_1_idx` (`category_id`),
  KEY `index3` (`title`),
  CONSTRAINT `fk_gallery_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,'Gallery Images','1.jpg','1.jpg',1,NULL,NULL),(2,'Gallery Images','2.jpg','2.jpg',2,NULL,NULL),(3,'Gallery Images','3.jpg','3.jpg',1,NULL,NULL),(4,'Gallery Images','4.jpg','4.jpg',2,NULL,NULL),(5,'Gallery Images','5.jpg','5.jpg',2,NULL,NULL);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general`
--

DROP TABLE IF EXISTS `general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `web_title` varchar(45) DEFAULT NULL,
  `favicon` varchar(150) DEFAULT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `og_title` varchar(150) DEFAULT NULL,
  `og_description` text,
  `og_images` varchar(150) DEFAULT NULL,
  `latitude` decimal(10,5) DEFAULT NULL,
  `longitude` decimal(10,5) DEFAULT NULL,
  `address` text,
  `address_introduction` varchar(250) DEFAULT NULL,
  `contact_title` varchar(50) DEFAULT NULL,
  `contact_introduction` text,
  `contact_images` varchar(150) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `open_hours` text,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general`
--

LOCK TABLES `general` WRITE;
/*!40000 ALTER TABLE `general` DISABLE KEYS */;
INSERT INTO `general` VALUES (1,'Lifskyn Aesthetic','apple-touch-icon.png','logo.png','Lifskyn Aesthetic','Lifskyn Aesthetic','images.jpg',24.00000,90.00000,'<p>House No 08, Road No 08,<br>Din Bari, Dhaka, Bangladesh</p>','<p>Lorem ipsum dolor sit amet, consectetueiusmodm dost  adipisicing elit, sed do eiusmod is tempincididuntm ut \nlorem ipsome do or sit amt  labore et dolor </p>','GET IN TOUCH','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.','contact.jpg','info@example.com','012345678102','<ul>\n                            <li>Monday - Friday <span>8.00-5.00</span></li>\n                            <li>Saturday <span>12.00-5.00</span></li>\n                            <li>Sunday <span class=\"close\">close</span></li>\n                        </ul>','https://facebook.com/beautyhouse','https://twitter.com/beautyhouse','https://instagram.com/beautyhouse',NULL,NULL);
/*!40000 ALTER TABLE `general` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(100) DEFAULT NULL,
  `gallery_introduction` text,
  `offers_title` varchar(100) DEFAULT NULL,
  `offers_introduction` text,
  `feature_title` varchar(100) DEFAULT NULL,
  `feature_introduction` text,
  `pricing_plant_title` varchar(100) DEFAULT NULL,
  `pricing_plant_introduction` text,
  `blog_title` varchar(100) DEFAULT NULL,
  `blog_introduction` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,'OUR LATEST GALLERY','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>','YOU GET OUR SPECIAL OFFER','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>','OUR FEATURES','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>','OUR PRICING PLAN','<p>  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>','OUR BLOG','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim nostrud exercitation ullamco laboris nisi.</p>',NULL,NULL);
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_banner`
--

DROP TABLE IF EXISTS `main_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `main_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `introduction` varchar(250) NOT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_banner`
--

LOCK TABLES `main_banner` WRITE;
/*!40000 ALTER TABLE `main_banner` DISABLE KEYS */;
INSERT INTO `main_banner` VALUES (1,'welcome our Lifskyn Aesthetic','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel volutpat felis, eu condimentum<br> massa.lorem ipsum dolor sit amet,consectetur adipicing elit.</p>','banner_1.jpg',NULL,NULL),(2,'welcome our Lifskyn Aesthetic','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel volutpat felis, eu condimentum<br> massa.lorem ipsum dolor sit amet,consectetur adipicing elit.</p>','banner_2.jpg',NULL,NULL),(3,'welcome our Lifskyn Aesthetic','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel volutpat felis, eu condimentum<br> massa.lorem ipsum dolor sit amet,consectetur adipicing elit.</p>','banner_3.jpg',NULL,NULL);
/*!40000 ALTER TABLE `main_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_number_UNIQUE` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Kiki','Kurniawan','sheqbo@gmail.com','081287679290','$2y$10$Llk9CHGZDvw0op1iTu6CaOWG3AREJmJBGBgY2z.ticrfwu1TaTi0C',1,NULL,NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `introduction` text,
  `description` text NOT NULL,
  `quotes` text,
  `views` int(10) NOT NULL DEFAULT '0',
  `like` int(10) NOT NULL DEFAULT '0',
  `share` int(10) NOT NULL DEFAULT '0',
  `video_url` varchar(255) DEFAULT NULL,
  `sub_category_id` int(5) NOT NULL DEFAULT '0',
  `meta_title` varchar(60) DEFAULT NULL,
  `meta_keyword` varchar(150) DEFAULT NULL,
  `meta_description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `title` (`title`),
  KEY `fk_news_1_idx` (`sub_category_id`),
  CONSTRAINT `fk_news_1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Lorem Ipsum is simply dummy','slug','thumbnail-1.jpg','filename-1.jpg','<p class=\"text-1\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut rutrum nunc. Donec rhoncus lacus sed mauris feugiat ultrices. Mauris ish veles  ish sapien sem. lovess uisque nec lectus sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut fermentum est, it’ss laoreet is congue nulla. Mauris bibendumess pellentesque facilisis. Maecenas tw ante odio, rutrum nec viverra.justo ma tristique mi, lorem ipsum dolor sit amet. rutrum nec viverra.justo magna tristique mi, aenean nis massa,scelerisque impertied feubiat.</p>','<p class=\"text-2\">Aenean nisl massa, scelerisque imperdiet feugiat et, rutrum ut nibh. Integer elit sem, rutrum vestibulum nunc nec, imperdiet tincidunt es odio. Aenean ant aliquet, ante non pellentesque laoreet, lorem leo egestas metus, eget pellentesque nisi sem non ex. Nulla sollicitudin lorem felis, sit </p><p class=\"text-3\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut rutrum nunc. Donec rhoncus lacus sed mauris feugiat ultrices. Mauri ish veles dost Osapien sem. doiil Quisque nec love lectus sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut fermentum , congu ulla. Mauris bibendum twss lorem ses pellentesque facilisis twss Maecenas ante odio,  </p>','<p><i class=\"fa fa-quote-left\" aria-hidden=\"true\"></i>Aenean nisl massa, scelerisque imperdiet feugiat et, rutrum ut nibh. Integer elit sem, Aenean nish dostlo massa, scelerisque imperdiet feugiat et, rutrum ut nibh.<i class=\"fa fa-quote-right\" aria-hidden=\"true\"></i></p>',0,0,0,NULL,1,'Lorem Ipsum is simply dummy','Lorem Ipsum is simply dummy','Lorem Ipsum is simply dummy','2018-01-04 12:11:46','2018-01-04 12:11:46'),(2,'Lorem Ipsum is simply dummy','slug-2','thumbnail-2.jpg','filename-1.jpg','<p class=\"text-1\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut rutrum nunc. Donec rhoncus lacus sed mauris feugiat ultrices. Mauris ish veles  ish sapien sem. lovess uisque nec lectus sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut fermentum est, it’ss laoreet is congue nulla. Mauris bibendumess pellentesque facilisis. Maecenas tw ante odio, rutrum nec viverra.justo ma tristique mi, lorem ipsum dolor sit amet. rutrum nec viverra.justo magna tristique mi, aenean nis massa,scelerisque impertied feubiat.</p>','<p class=\"text-2\">Aenean nisl massa, scelerisque imperdiet feugiat et, rutrum ut nibh. Integer elit sem, rutrum vestibulum nunc nec, imperdiet tincidunt es odio. Aenean ant aliquet, ante non pellentesque laoreet, lorem leo egestas metus, eget pellentesque nisi sem non ex. Nulla sollicitudin lorem felis, sit </p><p class=\"text-3\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ut rutrum nunc. Donec rhoncus lacus sed mauris feugiat ultrices. Mauri ish veles dost Osapien sem. doiil Quisque nec love lectus sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ut fermentum , congu ulla. Mauris bibendum twss lorem ses pellentesque facilisis twss Maecenas ante odio,  </p>','<p><i class=\"fa fa-quote-left\" aria-hidden=\"true\"></i>Aenean nisl massa, scelerisque imperdiet feugiat et, rutrum ut nibh. Integer elit sem, Aenean nish dostlo massa, scelerisque imperdiet feugiat et, rutrum ut nibh.<i class=\"fa fa-quote-right\" aria-hidden=\"true\"></i></p>',0,0,0,NULL,2,'Lorem Ipsum is simply dummy','Lorem Ipsum is simply dummy','Lorem Ipsum is simply dummy','2018-01-06 12:11:46','2018-01-06 12:11:46');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `description` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `index2` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (1,'Silver Pack','silver-pack','250000','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor indunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>','silver-pack.jpg',NULL,NULL),(2,'Gold Pack','gold-pack','450000','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor indunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>','silver-pack.jpg',NULL,NULL);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package_product`
--

DROP TABLE IF EXISTS `package_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL DEFAULT '0',
  `package_id` int(10) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_package_product_1_idx` (`product_id`),
  KEY `fk_package_product_2_idx` (`package_id`),
  CONSTRAINT `fk_package_product_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_package_product_2` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package_product`
--

LOCK TABLES `package_product` WRITE;
/*!40000 ALTER TABLE `package_product` DISABLE KEYS */;
INSERT INTO `package_product` VALUES (7,3,1,NULL,NULL),(8,4,1,NULL,NULL),(9,5,1,NULL,NULL),(10,5,2,NULL,NULL),(11,3,2,NULL,NULL);
/*!40000 ALTER TABLE `package_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `filename` varchar(250) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `availability` varchar(25) DEFAULT NULL,
  `introduction` text,
  `like` int(10) NOT NULL DEFAULT '0',
  `sub_category_id` int(5) NOT NULL DEFAULT '0',
  `meta_title` varchar(60) DEFAULT NULL,
  `meta_keyword` varchar(150) DEFAULT NULL,
  `meta_description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `title` (`title`),
  KEY `fk_product_1_idx` (`sub_category_id`),
  CONSTRAINT `fk_product_1` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (3,'Face Treatment','face-treatment','face-treatment.jpg','face-treatment-ori.jpg',100000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,1,'Face Treatment','Face Treatment, Face, Treatment','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL),(4,'Body Message','body-message','body-message.jpg','body-message-ori.jpg',300000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,7,'Body Message','Body Message','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL),(5,'Nail Treatment','nail-tratment','nail-tratment.jpg','nail-tratment-ori.jpg',200000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,3,'Nail Treatment','Nail Treatment','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL),(6,'Face Treatment','face-treatment-2','face-treatment.jpg','face-treatment-ori.jpg',100000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,1,'Face Treatment','Face Treatment, Face, Treatment','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL),(7,'Body Message','body-message-2','body-message.jpg','body-message-ori.jpg',300000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,7,'Body Message','Body Message','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL),(8,'Nail Treatment','nail-tratment-2','nail-tratment.jpg','nail-tratment-ori.jpg',200000,'AVAILABILITY','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla.</p><p>Pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.</p>',0,3,'Nail Treatment','Nail Treatment','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ',NULL,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `related_product`
--

DROP TABLE IF EXISTS `related_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `related_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL DEFAULT '0',
  `related_product_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `related_product`
--

LOCK TABLES `related_product` WRITE;
/*!40000 ALTER TABLE `related_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `related_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_key` varchar(30) NOT NULL,
  `meta_title` varchar(150) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seo_key_UNIQUE` (`seo_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
INSERT INTO `seo` VALUES (1,'home::pages','Beautyhouse','LUNCH, SKIN CARE, HAIR CUT, NAIL CARE, BEAUTY SPA','Beautyhouse',NULL,NULL);
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `category_id` int(5) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `fk_sub_category_1_idx` (`category_id`),
  CONSTRAINT `fk_sub_category_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_category`
--

LOCK TABLES `sub_category` WRITE;
/*!40000 ALTER TABLE `sub_category` DISABLE KEYS */;
INSERT INTO `sub_category` VALUES (1,'Face wash','face-wash',1,NULL,NULL),(2,'Cream','cream',1,NULL,NULL),(3,'Nail tratment 1','nail-tratment-1',2,NULL,NULL),(4,'Nail tratment 2','nail-tratment-2',2,NULL,NULL),(5,'Hair cut','hair-cut',3,NULL,NULL),(6,'Hair shampo','hair-shampo',3,NULL,NULL),(7,'Oil message','oil-message',4,NULL,NULL),(8,'Stone message','stone-message',4,NULL,NULL);
/*!40000 ALTER TABLE `sub_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribe`
--

DROP TABLE IF EXISTS `subscribe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(65) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribe`
--

LOCK TABLES `subscribe` WRITE;
/*!40000 ALTER TABLE `subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_news`
--

DROP TABLE IF EXISTS `tag_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(5) NOT NULL DEFAULT '0',
  `news_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tag_news_1_idx` (`tag_id`),
  KEY `fk_tag_news_2_idx` (`news_id`),
  CONSTRAINT `fk_tag_news_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tag_news_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_news`
--

LOCK TABLES `tag_news` WRITE;
/*!40000 ALTER TABLE `tag_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag_product`
--

DROP TABLE IF EXISTS `tag_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(5) NOT NULL DEFAULT '0',
  `product_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_tag_product_1_idx` (`tag_id`),
  KEY `fk_tag_product_2_idx` (`product_id`),
  CONSTRAINT `fk_tag_product_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tag_product_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_product`
--

LOCK TABLES `tag_product` WRITE;
/*!40000 ALTER TABLE `tag_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `member_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_testimonial_1_idx` (`member_id`),
  CONSTRAINT `fk_testimonial_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial`
--

LOCK TABLES `testimonial` WRITE;
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-10 17:48:45
