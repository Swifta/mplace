-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2015 at 09:15 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `ads_id` int(5) NOT NULL AUTO_INCREMENT,
  `ads_title` varchar(100) NOT NULL,
  `ads_code` text NOT NULL,
  `ads_position` varchar(10) NOT NULL,
  `page_position` varchar(10) NOT NULL,
  `redirect_url` text NOT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`ads_id`),
  KEY `add_id` (`ads_id`),
  KEY `add_id_2` (`ads_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ads_id`, `ads_title`, `ads_code`, `ads_position`, `page_position`, `redirect_url`, `status`) VALUES
(1, 'Home', '', 'hr', '1', 'https://www.google.co.in/', 1),
(2, 'product', '', 'hr', '3', 'https://www.google.co.in/', 1),
(3, 'deal', '', 'hr', '2', 'https://www.google.co.in/', 1),
(4, 'Auction', '', 'hr', '4', 'https://www.google.co.in/', 1),
(5, 'Home', '', 'ls', '1', 'https://www.google.co.in/', 1),
(6, 'product', '', 'ls', '3', 'https://www.google.co.in/', 1),
(7, 'deal', '', 'ls', '2', 'https://www.google.co.in/', 1),
(8, 'Auction', '', 'ls', '4', 'https://www.google.co.in/', 1),
(9, 'Home', '', 'bf', '1', 'https://www.google.co.in/', 0),
(10, 'Auction', '', 'bf', '4', 'https://www.google.co.in/', 0),
(11, 'product', '', 'bf', '3', 'https://www.google.co.in/', 0),
(12, 'deal', '', 'bf', '2', 'https://www.google.co.in/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `attribute_group` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `name`, `attribute_group`, `sort_order`) VALUES
(11, 'WIDTH OF RING', 14, 1),
(7, 'types', 4, 7),
(8, 'speed', 4, 8),
(10, 'Brand', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_group`
--

CREATE TABLE IF NOT EXISTS `attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sort_order` int(2) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `attribute_group`
--

INSERT INTO `attribute_group` (`attribute_group_id`, `groupname`, `sort_order`) VALUES
(1, 'general', 0),
(13, 'eqweeq', 0),
(4, 'mother board', 6),
(6, 'TV', 1),
(14, 'ring', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `for_store_cred` int(11) NOT NULL COMMENT '1- for store credit, 0-not for store credit',
  `product_value` double NOT NULL,
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `bid_increment` double NOT NULL,
  `bid_count` int(11) NOT NULL,
  `shipping_fee` double NOT NULL,
  `shipping_info` text COLLATE utf8_unicode_ci NOT NULL,
  `startdate` int(10) NOT NULL,
  `enddate` int(10) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `winner` int(11) NOT NULL,
  `auction_status` int(11) NOT NULL,
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `view_count` int(11) NOT NULL,
  `deal_feature` int(1) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `deal_description`, `fineprints`, `highlights`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `for_store_cred`, `product_value`, `deal_value`, `deal_price`, `deal_savings`, `user_limit_quantity`, `bid_increment`, `bid_count`, `shipping_fee`, `shipping_info`, `startdate`, `enddate`, `created_date`, `created_by`, `deal_status`, `winner`, `auction_status`, `commission_status`, `view_count`, `deal_feature`) VALUES
(2, 'Lenovo Essential G500  Laptop -3rd Gen Intel Core i3 3110M- 2GB RAM- 500GB HDD- 15.6 Inches- DOS', 'Lenovo_Essential_G500_Laptop_-3rd_Gen_Intel_Core_i3_3110M-_2GB_RAM-_500GB_HDD-_15.6_Inches-_DOS', '153XhYAU', '<div class="textheadings" name="Technical Specifications" jump-text="Technical Specifications" style="border-bottom-width: 0px !important; border-bottom-style: dotted !important; border-bottom-color: rgb(108, 107, 107) !important; padding: 6px 0px; margin-bottom: -5px; font-family: Tahoma; font-size: medium; background-color: rgb(255, 255, 255); "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Technical Specifications of Lenovo Essential G500 </h2></div><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; background-color: rgb(255, 255, 255); "></p><table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family: Tahoma; font-size: medium; background-color: rgb(255, 255, 255); "><tbody><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">OVERVIEW</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Series</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">G500</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Model Number</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">59-380860</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Utility</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Everyday Use</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Color</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Black</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">PROCESSOR</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Processor Name</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Core i3 (3rd Generation)</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Variant</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">3110M</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Chipset</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Mobile HM76 Express</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Brand</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Intel</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Clock Speed</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">2.4 GHz</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Cache Memory</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">3 MB</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">DISPLAY</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Screen Size</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">15.6 inch</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Resolution</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">1366 x 768 Pixel</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Screen Type</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">LED Display</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">STORAGE</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Hard Disk Capacity</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">500 GB</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">RPM</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">5400</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">SIZE &amp; WEIGHT</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Weight</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">2.5 kg</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Dimension (W*D*H)</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">380 x 260 x 25.8 mm</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">POWER &amp; BATTERY</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Battery Backup</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Upto 3 hours</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">AC Adapter</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">65 W AC Adapter</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Standard Battery</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">6 cell</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">MEMORY</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">RAM</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">2 GB DDR3</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Expandable Memory</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Upto 8 GB</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Memory Slots</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">1 (Unused Slot - 0)</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">PLATFORM</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Architecture</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">64-bit</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Operating System</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">DOS</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">OPTICAL DISK DRIVE</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Optical Drive</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">DVD RW Drive</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">GRAPHICS</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Graphic Processor</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Intel HD Graphics 4000</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">KEYBOARD/INPUT DEVICE</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Integrated Camera</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">0.3 Megapixel 720p HD Webcam</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Pointer Device</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Touchpad</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Keyboard</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">AccuType Keyboard</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">AUDIO</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Speakers</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Sound Effect</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Stereo Speakers with Dolby Advanced Audio</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">COMMUNICATION</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Ethernet</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">10/100 Mbps LAN</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Wireless LAN</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Bluetooth</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr></tbody></table></td></tr><tr><td><table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec" style="border: 1px solid rgb(229, 229, 229); font-family: ''Segoe UI'', Verdana, Arial, Helvetica, sans-serif; font-size: 12px; background-color: rgb(242, 242, 242); margin-top: 15px; background-position: initial initial; background-repeat: initial initial;"><tbody><tr><th colspan="2" style="font-size: 14px; text-transform: uppercase; text-align: left; padding: 5px; color: rgb(56, 56, 56);">PORTS/SLOTS</th></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">USB Port/S</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">1 x USB 2.0, 2 x USB 3.0</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Mic In</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">RJ45 LAN</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">HDMI Port</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">VGA Port</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr><tr><td width="20%" style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Multi Card Slot</td><td style="font-size: 13px; text-align: left; padding: 3px 6px; background-color: rgb(254, 254, 254); color: rgb(97, 97, 97); background-position: initial initial; background-repeat: initial initial;">Yes</td></tr></tbody></table></td></tr></tbody></table>', '', '', '', '', '', 1, 72, 96, 0, 3, 736, 2, 0, 1000, 800, 800, 200, 1, 1, 0, 10, '6 to 8 days ', 1391660820, 2100000000, 1391660368, 14, 1, 0, 0, 1, 1, 1),
(41, 'Just Auction', 'Just-Auction', 'Qt3Wjc7i', 'First auction.<br>', '', '', '', '', '', 1, 70, 88, 0, 3, 157, 1, 1, 100, 89, 89, 11, 0, 2, 0, 10, 'Streets in hills.', 1439868000, 1440959400, 1439877067, 157, 1, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
--

CREATE TABLE IF NOT EXISTS `banner_image` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(256) NOT NULL,
  `redirect_url` text NOT NULL,
  `position` int(3) NOT NULL,
  `product` int(5) NOT NULL,
  `deal` int(5) NOT NULL,
  `auction` int(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Active,0-Deactive',
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`banner_id`, `image_title`, `redirect_url`, `position`, `product`, `deal`, `auction`, `status`) VALUES
(25, 'next Generation Storage', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(26, 'Dress Sale for Men And Women', 'http://demo.uniecommerce.com/', 0, 0, 1, 1, 1),
(4, 'computers', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 0),
(5, 'Dell XPS 12 Ultrabook', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(20, 'Get New Phone With The Best Quality', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(21, 'HP Printer and Scanner ', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(22, 'For Employee Benefits', 'http://demo.uniecommerce.com/', 0, 1, 0, 0, 0),
(23, 'For Job Seekers', 'http://demo.uniecommerce.com/', 0, 1, 0, 0, 0),
(24, 'books', 'http://demo.uniecommerce.com/', 0, 1, 1, 1, 1),
(11, 'Sign up for club membership and enjoy special offers.', '#', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bidding`
--

CREATE TABLE IF NOT EXISTS `bidding` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_id` int(11) NOT NULL,
  `auction_title` varchar(264) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amount` double NOT NULL,
  `shipping_amount` int(11) NOT NULL,
  `bidding_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `winning_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Not win,1-Win,2-Action bought',
  `mail_alert` int(1) NOT NULL COMMENT '1-winng,2-1st-alert,3-2nd-alert',
  PRIMARY KEY (`bid_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `bidding`
--

INSERT INTO `bidding` (`bid_id`, `auction_id`, `auction_title`, `user_id`, `bid_amount`, `shipping_amount`, `bidding_time`, `end_time`, `winning_status`, `mail_alert`) VALUES
(1, 8, 'Teddy Bear Pink with Rani Cap & Heart', 156, 301, 5, 1391682237, 1398315840, 0, 0),
(2, 8, 'Teddy Bear Pink with Rani Cap & Heart', 373, 305, 5, 1391682278, 1398315840, 0, 0),
(3, 8, 'Teddy Bear Pink with Rani Cap & Heart', 257, 304, 5, 1391682375, 1398315840, 0, 0),
(4, 8, 'Teddy Bear Pink with Rani Cap & Heart', 156, 310, 5, 1391682409, 1398315840, 0, 0),
(5, 8, 'Teddy Bear Pink with Rani Cap & Heart', 257, 315, 5, 1391682454, 1398315840, 0, 0),
(6, 8, 'Teddy Bear Pink with Rani Cap & Heart', 156, 325, 5, 1391682472, 1398315840, 1, 1),
(7, 6, 'Light N Living Pretty Round Wall Light', 156, 310, 1, 1391682526, 1396204200, 0, 0),
(8, 7, 'Radio-controlled Helicopter', 257, 115, 10, 1391682570, 1395772200, 0, 0),
(9, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 504, 700, 10, 1393864506, 1396204200, 0, 0),
(10, 8, 'Teddy Bear Pink with Rani Cap & Heart', 599, 306, 5, 1394922603, 1398315840, 0, 0),
(11, 7, 'Radio-controlled Helicopter', 604, 101, 10, 1395091257, 1403721000, 0, 0),
(12, 7, 'Radio-controlled Helicopter', 604, 116, 10, 1395092760, 1403721000, 0, 0),
(13, 7, 'Radio-controlled Helicopter', 607, 108, 10, 1395129510, 1403721000, 0, 0),
(14, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 611, 610, 10, 1395249517, 1403634600, 0, 0),
(15, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 611, 710, 10, 1395249558, 1403634600, 0, 0),
(16, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 611, 610, 10, 1395249601, 1398831780, 0, 0),
(17, 7, 'Radio-controlled Helicopter', 611, 120, 10, 1395249662, 1403721000, 0, 0),
(18, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 615, 650, 10, 1395324589, 1398831780, 0, 0),
(19, 5, 'Amiraj Fruit & Vegetable Juicer', 618, 625, 10, 1395596722, 1401474600, 0, 0),
(20, 5, 'Amiraj Fruit & Vegetable Juicer', 618, 650, 10, 1395596752, 1401474600, 0, 0),
(21, 5, 'Amiraj Fruit & Vegetable Juicer', 618, 670, 10, 1395596819, 1401474600, 1, 1),
(22, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 621, 1000, 10, 1395747716, 1398831780, 0, 0),
(23, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 621, 605, 10, 1395747853, 1398831780, 0, 0),
(24, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 621, 10000, 10, 1395747931, 1398831780, 1, 1),
(25, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 623, 751, 10, 1395837089, 1398831780, 0, 0),
(26, 9, 'Lonsdale Pro Bag Boxing Gloves', 634, 100, 10, 1396602722, 1403807400, 0, 0),
(27, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 639, 607, 10, 1397653350, 1398831780, 0, 0),
(28, 10, 'Stag 6050RA Hanging Bag', 639, 151, 10, 1398162924, 1401474600, 0, 0),
(29, 10, 'Stag 6050RA Hanging Bag', 639, 170, 10, 1398162954, 1401474600, 1, 1),
(30, 1, 'Nikon Coolpix L29 16.1 MP Point & Shoot Digital Camera ', 639, 615, 10, 1398344871, 1398831780, 0, 0),
(31, 6, 'Light N Living Pretty Round Wall Light', 655, 301, 1, 1399025066, 1403807400, 0, 0),
(32, 5, 'Amiraj Fruit & Vegetable Juicer', 655, 607, 10, 1399091119, 1401474600, 0, 0),
(33, 5, 'Amiraj Fruit & Vegetable Juicer', 655, 609, 10, 1399091265, 1401474600, 0, 0),
(34, 6, 'Light N Living Pretty Round Wall Light', 156, 315, 1, 1399109337, 1403807400, 0, 0),
(35, 12, 'Smiledrive Executive with Metal Case Golf Kit', 224, 500, 10, 1400059240, 1403866260, 0, 0),
(36, 12, 'Smiledrive Executive with Metal Case Golf Kit', 224, 505, 10, 1400059297, 1403866260, 0, 0),
(37, 12, 'Smiledrive Executive with Metal Case Golf Kit', 683, 510, 10, 1400106763, 1403866260, 0, 0),
(38, 3, 'Sennheiser HD 598 Headphones', 686, 501, 10, 1400396535, 1402597800, 0, 0),
(39, 3, 'Sennheiser HD 598 Headphones', 686, 502, 10, 1400396721, 1402597800, 0, 0),
(40, 7, 'Radio-controlled Helicopter', 704, 105, 10, 1401369457, 1403721000, 0, 0),
(41, 3, 'Sennheiser HD 598 Headphones', 156, 506, 10, 1401510725, 1402597800, 1, 1),
(42, 9, 'Lonsdale Pro Bag Boxing Gloves', 156, 106, 10, 1401535605, 1403807400, 0, 0),
(43, 9, 'Lonsdale Pro Bag Boxing Gloves', 156, 120, 10, 1401711092, 1403807400, 0, 0),
(44, 6, 'Light N Living Pretty Round Wall Light', 717, 500, 1, 1401996840, 1403807400, 0, 0),
(45, 12, 'Smiledrive Executive with Metal Case Golf Kit', 719, 520, 10, 1402029585, 1403866260, 0, 0),
(46, 6, 'Light N Living Pretty Round Wall Light', 156, 320, 1, 1402481590, 1403807400, 0, 0),
(47, 9, 'Lonsdale Pro Bag Boxing Gloves', 726, 200, 10, 1402486928, 1403807400, 0, 0),
(48, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 731, 630, 10, 1402588644, 1403634600, 0, 0),
(49, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 731, 3820, 10, 1402588701, 1403634600, 0, 0),
(50, 18, 'LG Wonder Door Refrigerator', 738, 5001, 10, 1403013247, 1414607400, 0, 0),
(51, 9, 'Lonsdale Pro Bag Boxing Gloves', 686, 201, 10, 1403849075, 1417199400, 0, 0),
(52, 18, 'LG Wonder Door Refrigerator', 756, 5011, 10, 1403849677, 1414607400, 0, 0),
(53, 16, 'Lenovo Essential G500s Laptop', 756, 8001, 10, 1403849939, 1419359400, 0, 0),
(54, 16, 'Lenovo Essential G500s Laptop', 756, 8002, 10, 1403850122, 1419359400, 0, 0),
(55, 13, 'Philips Food Processor HL1659', 757, 200, 10, 1403851160, 1414693800, 0, 0),
(56, 14, 'Motorola Moto E XT1021', 757, 6000, 10, 1403859775, 1419964200, 0, 0),
(57, 14, 'Motorola Moto E XT1021', 757, 60000, 10, 1403859825, 1419964200, 0, 0),
(58, 14, 'Motorola Moto E XT1021', 757, 50000, 10, 1403864321, 1419964200, 0, 0),
(59, 15, 'Samsung 32 inch EH4003 HD LED TV', 756, 7001, 10, 1403866606, 1417070880, 0, 0),
(60, 17, 'Samsung 212L Refrigerator', 756, 601, 10, 1403866645, 1417026600, 0, 0),
(61, 18, 'LG Wonder Door Refrigerator', 756, 5003, 10, 1403871240, 1414607400, 0, 0),
(62, 19, 'Asmi Diamond Tanmaniya', 760, 6100, 10, 1404293634, 1417113000, 0, 0),
(63, 14, 'Motorola Moto E XT1021', 763, 4589, 10, 1404379586, 1419964200, 0, 0),
(64, 6, 'Light N Living Pretty Round Wall Light', 767, 340, 1, 1404484644, 1414693800, 0, 0),
(65, 6, 'Light N Living Pretty Round Wall Light', 768, 544, 1, 1404687824, 1414693800, 1, 1),
(66, 19, 'Asmi Diamond Tanmaniya', 767, 6110, 10, 1405132141, 1417113000, 0, 0),
(67, 16, 'Lenovo Essential G500s Laptop', 790, 8003, 10, 1405471767, 1419359400, 0, 0),
(68, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 745, 625, 10, 1405738478, 1416940200, 0, 0),
(69, 19, 'Asmi Diamond Tanmaniya', 717, 7000, 10, 1405871726, 1417113000, 0, 0),
(70, 7, 'Radio-controlled Helicopter', 796, 106, 10, 1406093109, 1414607400, 0, 0),
(71, 12, 'Smiledrive Executive with Metal Case Golf Kit', 756, 521, 10, 1406109735, 1417199400, 0, 0),
(72, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 812, 860, 10, 1407265818, 1416940200, 0, 0),
(73, 4, '', 156, 645, 10, 1407389923, 1416940200, 0, 0),
(74, 4, '', 156, 720, 10, 1407406052, 1416940200, 0, 0),
(75, 7, '', 156, 5000, 10, 1407494788, 1414607400, 1, 1),
(76, 7, '', 829, 150, 10, 1407494813, 1414607400, 0, 0),
(77, 4, 'JVC Everio GZ-EX310B 1080p HD Digital Video Camcorder', 156, 646, 10, 1407752492, 1416940200, 0, 0),
(78, 12, 'Smiledrive Executive with Metal Case Golf Kit', 857, 525, 10, 1409606312, 1417199400, 0, 0),
(79, 18, 'LG Wonder Door Refrigerator', 862, 5050, 10, 1409975612, 1414607400, 1, 1),
(80, 14, 'Motorola Moto E XT1021', 156, 4504, 10, 1409998795, 1419964200, 0, 0),
(81, 7, 'Radio-controlled Helicopter', 280, 200, 10, 1410214090, 1414607400, 0, 0),
(82, 14, 'Motorola Moto E XT1021', 328, 4510, 10, 1410533385, 1419964200, 0, 0),
(83, 13, 'Philips Food Processor HL1659', 328, 3000, 10, 1410533422, 1414693800, 1, 1),
(84, 22, 'Sandisk 32GB Micro SD Memory Card', 386, 1020, 0, 1411257301, 1414693800, 0, 0),
(85, 22, 'Sandisk 32GB Micro SD Memory Card', 906, 1030, 0, 1413029556, 1414693800, 1, 1),
(86, 15, 'Samsung 32 inch EH4003 HD LED TV', 918, 7002, 10, 1413547680, 1417070880, 0, 0),
(87, 15, 'Samsung 32 inch EH4003 HD LED TV', 918, 7003, 10, 1413547711, 1417070880, 0, 0),
(88, 15, 'Samsung 32 inch EH4003 HD LED TV', 918, 7005, 10, 1413547737, 1417070880, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(256) NOT NULL,
  `url_title` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blog_description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `meta_keywords` varchar(256) NOT NULL,
  `tags` varchar(256) NOT NULL,
  `allow_comments` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 0=>no',
  `comments_count` int(11) NOT NULL,
  `blog_views` int(11) NOT NULL,
  `blog_date` int(11) NOT NULL,
  `publish_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=> published, 2=>draft',
  `blog_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>deactive',
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `blog_title`, `url_title`, `user_id`, `blog_description`, `category_id`, `meta_title`, `meta_description`, `meta_keywords`, `tags`, `allow_comments`, `comments_count`, `blog_views`, `blog_date`, `publish_status`, `blog_status`) VALUES
(1, 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR_based_Unicommerce_launches_Uniware_a_SAAS_based_order_management_system_for_ecommerce_companies', 0, ' Real-time Management of order fulfillment processes has always been one of the key challenges for etailers in India. Handling procurement, goods receipt, quality assurance, pick and pack, invoicing, shipping, comprehensive return/replacements handling and inventory play critical role in making a successful ecommerce venture.', 1, 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', 'NCR based Unicommerce launches Uniware, a SAAS based order management system for ecommerce companies', '3', 1, 0, 0, 1351515029, 1, 1),
(2, 'Unicommerce services provide to etailers in managing', 'unicommerce-services-provide-to-etailers-in-managing', 0, '    Inventory serialization (Bar-coding) – In Uniware we provide support for assigning unique serial number to every unit even of the same product. This enables us to capture various details like vendor, purchase date, product expiry, sent-to customer and unit specific information like IMEI (mobiles) which we believe is essential to control several common issues like wrong product shipments, ensuring inventory FIFO, pilferage, inventory ageing and timely returns to vendor. This feature has helped us deliver flawless inventory management and eliminate some of the problems completely. We have shipped more than a million shipments across all clients and yet to see our first incorrect shipment.', 18, 'advantages Unicommerce ', 'advantages Unicommercesdfsa', 'advantages Unicommerce ', '6', 1, 5, 0, 1351515133, 1, 1),
(3, 'Should You Show Cart Totals In Checkout?', 'should-you-show-cart-totals-in-checkout', 0, 'I recently listened in on a web clinic from Marketing Experiments titled Optimizing Shopping Carts for the Holidays. One of the case studies presented was particularly intriguing. If you read the title of this post you guessed the subject of the test — showing cart totals in checkout. Cart totals in checkout – best practice? Back in 2007, Elastic Path conducted an audit of the Internet Retailer Top 100 for our Ecommerce Checkout Report. At that time, only 14% of checkouts displayed cart review boxes in checkout. Conversion rates were 60% higher for the sites that didn’t show cart totals.', 77, 'Should You Show ', 'Should You Show ', 'Should You Show ', '3', 1, 2, 0, 1357359276, 1, 1),
(4, 'Email  And Social Habits Of Holiday Shoppers [Research]', 'Email_And_Social_Habits_Of_Holiday_Shoppers_Research', 0, '                &lt;ul&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Email marketing software provider Yesmail Interactive conducted an interesting study, combining dafdsfsdfasdf&lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;a consumer survey on general and holiday shopping habits with analysis of the digital marketing campaigns (email and social) of 20 of &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;the top ecommerce brands in the US. Over 500 consumers were surveyed for Consumer Online Behavior Report: Developing Informed Digital Marketing Strategies for &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Holiday Success about general shopping habits and holiday-specific ones. Ecommerce brands studied include traditional retail like Amazon, Apple, Best Buy, &lt;/span&gt;&lt;/li&gt;&lt;li style=&quot;text-align: justify;&quot;&gt;&lt;span style=&quot;color: rgb(51, 102, 255); font-size: 10pt; &quot;&gt;Crate and Barrel, Dell, JC Penney, Macy’s, Nordstrom, &lt;/span&gt;&lt;/li&gt;&lt;/ul&gt; ', 1, 'advantages Unicommerce ', 'advantages Unicommerce ', 'advantages Unicommerce', '6', 0, 2, 0, 1357359381, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `blogg_id` int(11) NOT NULL,
  `approve_status` int(1) NOT NULL DEFAULT '0' COMMENT '1=>approved,0=>disapproved',
  `comments_date` int(11) NOT NULL,
  `notify_comments` int(1) NOT NULL DEFAULT '0' COMMENT '1=>yes,0=>no',
  `comments_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active,0=>deactive',
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`comments_id`, `name`, `email`, `website`, `comments`, `blogg_id`, `approve_status`, `comments_date`, `notify_comments`, `comments_status`) VALUES
(1, 'Name', 'murugan123@gmail.com', 'http://demo.uniecommerce.com/', 'comments here', 2, 1, 1351836740, 0, 0),
(2, 'Name', 'murugan123@gmail.com', 'http://demo.uniecommerce.com/', 'comments here', 2, 1, 1351836740, 0, 1),
(13, 'tyryy', 'tyryrtyrtyrty@rtrtetre.com', 'Website', 'yrty', 4, 1, 1384421735, 0, 1),
(4, 'vino', 'vinodbabu.k@ndot.in', 'Website', 'nice', 3, 1, 1364308165, 0, 1),
(5, 'muniraj', 'selvam.r@ndot.in', 'http://localhost/UniECommerce-v3/blog/email-and-so', 'hgihgslkghslghgkjhgjhjhg', 4, 0, 1364912597, 0, 1),
(6, 'muni', 'munirajthammapan@gmail.com', 'http://localhost/UniECommerce-v3/blog/should-you-s', 'tatw tttatt attt atat tta ttata tetet eety rryrrru urutre  utu tututu tutu uururu uurur uyryry', 3, 1, 1364963203, 0, 1),
(7, 'sasadsad', 'dsfdsfdf@gmail.com', 'Website', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem It is a long established fact that a reader will be distracted by the readable content of a page whe', 2, 1, 1365001183, 0, 1),
(8, 'asdasvdv', 'asdsadads@gmail.com', 'Website', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem It is a long established fact that a reader will be distracted by the readable content of a page whe', 2, 1, 1365001225, 0, 1),
(9, 'arunkumar', 'arunkumar.m@ndot.in', 'Website', 'hi great..!!!!', 4, 1, 1365231550, 0, 1),
(10, 'udyryyry', 'munirajthammapan@gmail.com', 'http://localhost/UniECommerce-v3/blog/email-and-so', 'hdryrdyydrydrydrydryrdyryydry', 4, 0, 1366003413, 0, 1),
(11, 'mmmmmmm', 'muniraj.t@ndot.in', 'http://192.168.1.153:1011/blog/unicommerce-service', 'http://192.168.1.153:1011/blog/unicommerce-services-provide-to-etailers-in-managing.html', 2, 1, 1366190791, 0, 1),
(12, 'murugan', 'murugan.k@ndot.in', 'Website', 'rewrwrw ewer er w', 4, 0, 1380634705, 0, 1),
(14, 'test for blog', 'rathiskumar.v@ndot.in', 'Website', 'test for blog', 2, 0, 1388992265, 0, 1),
(15, 'test for blog', 'rathiskumar.v@ndot.in', 'Website', 'test for blog comments', 2, 1, 1388992311, 0, 1),
(17, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249761, 0, 1),
(18, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249762, 0, 1),
(19, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249762, 0, 1),
(20, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249763, 0, 1),
(21, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249764, 0, 1),
(22, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249764, 0, 1),
(23, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249765, 0, 1),
(24, 'test', 'test1ndot@gmail.com', 'Website', 'This is test informion ', 3, 0, 1403249766, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_settings`
--

CREATE TABLE IF NOT EXISTS `blog_settings` (
  `blog_settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `allow_comment_posting` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>no',
  `require_adminapproval_comments` int(1) NOT NULL DEFAULT '1' COMMENT '1=>yes, 2=>no',
  `posts_per_page` int(5) NOT NULL DEFAULT '4',
  PRIMARY KEY (`blog_settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `blog_settings`
--

INSERT INTO `blog_settings` (`blog_settings_id`, `allow_comment_posting`, `require_adminapproval_comments`, `posts_per_page`) VALUES
(1, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(3) NOT NULL AUTO_INCREMENT,
  `main_category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `category_mapping` text COLLATE utf8_unicode_ci NOT NULL,
  `category_status` int(1) NOT NULL DEFAULT '1',
  `deal` int(1) NOT NULL,
  `product` int(1) NOT NULL,
  `auction` int(1) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 - main , 2- 2layer , 3 - 3layer , 4 - 4layer',
  PRIMARY KEY (`category_id`),
  FULLTEXT KEY `subtypename` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=195 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `main_category_id`, `sub_category_id`, `category_name`, `category_url`, `category_mapping`, `category_status`, `deal`, `product`, `auction`, `type`) VALUES
(1, 0, 0, 'Electronics', 'Electronics', '', 1, 1, 1, 1, 1),
(2, 0, 0, 'Men', 'Men', '', 1, 1, 1, 1, 1),
(3, 0, 0, 'Women', 'Women', '', 1, 1, 1, 1, 1),
(4, 0, 0, 'Baby & Kids', 'Baby_Kids', '', 1, 1, 1, 1, 1),
(5, 0, 0, 'Books & Media', 'Books_Media', '', 1, 1, 1, 0, 1),
(6, 0, 0, 'Home & Kitchen', 'Home_Kitchen', '', 1, 1, 1, 1, 1),
(7, 0, 0, 'Sports & Fitness', 'Sports_Fitness', '', 1, 1, 1, 1, 1),
(8, 0, 0, 'Personal Care & Health', 'Personal_Care_Health', '', 1, 1, 1, 0, 1),
(9, 0, 0, 'Gifts & Flowers', 'Gifts_Flowers', '', 1, 1, 1, 0, 1),
(10, 4, 4, 'Boys Clothing', 'Boys_Clothing', '', 1, 0, 0, 0, 2),
(11, 4, 4, 'Girls Clothing', 'Girls_Clothing', '', 1, 0, 0, 0, 2),
(12, 4, 4, 'Infants Clothing', 'Infants_Clothing', '', 1, 0, 0, 0, 2),
(13, 4, 4, 'Boys Footwear', 'Boys_Footwear', '', 1, 0, 0, 0, 2),
(14, 4, 4, 'Girls Footwear', 'Girls_Footwear', '', 1, 0, 0, 0, 2),
(15, 4, 4, 'Toys & Games', 'Toys_Games', '', 1, 0, 0, 0, 2),
(16, 4, 10, 'T-Shirts', 'T-Shirts', '', 1, 0, 0, 0, 3),
(17, 4, 10, 'Shirts', 'Shirts', '', 1, 0, 0, 0, 3),
(18, 4, 10, 'Jeans', 'Jeans', '', 1, 0, 0, 0, 3),
(19, 4, 13, 'Flip Flops', 'Flip_Flops', '', 1, 0, 0, 0, 3),
(20, 4, 13, 'Sandals ', 'Sandals', '', 1, 0, 0, 0, 3),
(21, 4, 13, 'Casual Shoes', 'Casual_Shoes', '', 1, 0, 0, 0, 3),
(22, 4, 11, 'Tees & Tops', 'Tees_Tops', '', 1, 0, 0, 0, 3),
(23, 4, 11, 'Dresses & Skirts', 'Dresses_Skirts', '', 1, 0, 0, 0, 3),
(24, 4, 11, 'Shorts & Capries', 'Shorts_Capries', '', 1, 0, 0, 0, 3),
(25, 4, 12, 'Baby Boys Clothing', 'Baby_Boys_Clothing', '', 1, 0, 0, 0, 3),
(26, 4, 12, 'Baby Girls Clothing', 'Baby_Girls_Clothing', '', 1, 0, 0, 0, 3),
(27, 4, 14, 'Girls Sandals', 'Girls_Sandals', '', 1, 0, 0, 0, 3),
(28, 4, 14, 'Girls Casual Shoes', 'Girls_Casual_Shoes', '', 1, 0, 0, 0, 3),
(29, 4, 14, 'Clogs', 'Clogs', '', 1, 0, 0, 0, 3),
(30, 4, 15, 'Baby Toys', 'Baby_Toys', '', 1, 0, 0, 0, 3),
(31, 4, 15, 'Board Games', 'Board_Games', '', 1, 0, 0, 0, 3),
(32, 4, 15, 'Card Games', 'Card_Games', '', 1, 0, 0, 0, 3),
(33, 4, 15, 'Cars Trains & Bikes', 'Cars_Trains_Bikes', '', 1, 0, 0, 0, 3),
(34, 5, 5, 'Books', 'Books', '', 1, 0, 0, 0, 2),
(35, 5, 5, 'eBooks', 'eBooks', '', 1, 0, 0, 0, 2),
(36, 5, 5, 'Music', 'Music', '', 1, 0, 0, 0, 2),
(37, 5, 5, 'Movies & TV Shows', 'Movies_TV_Shows', '', 1, 0, 0, 0, 2),
(38, 5, 37, 'Pre-Orders', 'Pre-Orders', '', 1, 0, 0, 0, 3),
(39, 5, 37, 'New Releases', 'New_Releases', '', 1, 0, 0, 0, 3),
(40, 5, 37, 'Blu-Rays and 3D', 'Blu-Rays_and_3D', '', 1, 0, 0, 0, 3),
(41, 5, 37, 'DVDs', 'DVDs', '', 1, 0, 0, 0, 3),
(42, 5, 37, 'Health & Wellness', 'Health_Wellness', '', 1, 0, 0, 0, 3),
(43, 5, 35, 'Literature & Fiction', 'Literature_Fiction', '', 1, 0, 0, 0, 3),
(44, 5, 35, 'Science & Technology', 'Science_Technology', '', 1, 0, 0, 0, 3),
(45, 5, 35, 'Biographies & Autobiography', 'Biographies_Autobiography', '', 1, 0, 0, 0, 3),
(46, 5, 34, 'Business Investing & Mgmt', 'Business_Investing_Mgmt', '', 1, 0, 0, 0, 3),
(47, 5, 34, 'Academic & Professional', 'Academic_Professional', '', 1, 0, 0, 0, 3),
(48, 5, 34, 'Entrance Exam', 'Entrance_Exam', '', 1, 0, 0, 0, 3),
(49, 5, 34, 'Literature & Books Fiction', 'Literature_Books_Fiction', '', 1, 0, 0, 0, 3),
(50, 5, 34, 'New Releases Books', 'New_Releases_Books', '', 1, 0, 0, 0, 3),
(51, 5, 36, 'Pre-Orders Music', 'Pre-Orders_Music', '', 1, 0, 0, 0, 3),
(52, 5, 36, 'New Releases Music', 'New_Releases_Music', '', 1, 0, 0, 0, 3),
(53, 5, 36, 'Devotional & Spiritual', 'Devotional_Spiritual', '', 1, 0, 0, 0, 3),
(54, 3, 3, 'Clothing', 'Clothing', '', 1, 0, 0, 0, 2),
(55, 3, 3, 'Footwear', 'Footwear', '', 1, 0, 0, 0, 2),
(56, 3, 3, 'Watches', 'Watches', '', 1, 0, 0, 0, 2),
(57, 3, 3, 'Bags  Belts and wallets', 'Bags_Belts_and_wallets', '', 1, 0, 0, 0, 2),
(58, 3, 3, 'Beauty and Wellness', 'Beauty_and_Wellness', '', 1, 0, 0, 0, 2),
(59, 3, 57, 'Handbags', 'Handbags', '', 1, 0, 0, 0, 3),
(60, 3, 57, 'Totes', 'Totes', '', 1, 0, 0, 0, 3),
(61, 3, 57, 'Backpacks', 'Backpacks', '', 1, 0, 0, 0, 3),
(62, 3, 57, 'Sling Bags', 'Sling_Bags', '', 1, 0, 0, 0, 3),
(63, 3, 58, 'Skin Care', 'Skin_Care', '', 1, 0, 0, 0, 3),
(64, 3, 58, 'Make Up', 'Make_Up', '', 1, 0, 0, 0, 3),
(65, 3, 58, 'Hair Care', 'Hair_Care', '', 1, 0, 0, 0, 3),
(66, 3, 58, 'Bath & Spa', 'Bath_Spa', '', 1, 0, 0, 0, 3),
(67, 3, 58, 'Oral Care', 'Oral_Care', '', 1, 0, 0, 0, 3),
(68, 1, 1, 'Mobiles', 'Mobiles', '', 1, 0, 0, 0, 2),
(69, 1, 1, 'Tablets', 'Tablets', '', 1, 0, 0, 0, 2),
(70, 1, 1, 'Computer Accessories', 'Computer_Accessories', '', 1, 0, 0, 0, 2),
(71, 1, 1, 'Mobiles Accessories', 'Mobiles_Accessories', '', 1, 0, 0, 0, 2),
(72, 1, 1, 'Laptops', 'Laptops', '', 1, 0, 0, 0, 2),
(73, 1, 1, 'Cameras', 'Cameras', '', 1, 0, 0, 0, 2),
(74, 1, 73, 'Nikon', 'Nikon', '', 1, 0, 0, 0, 3),
(75, 1, 73, 'Canon', 'Canon', '', 1, 0, 0, 0, 3),
(76, 1, 73, 'Sony', 'Sony', '', 1, 0, 0, 0, 3),
(77, 1, 73, 'Samsung', 'Samsung', '', 1, 0, 0, 0, 3),
(78, 1, 68, 'Samsung Mobiles', 'Samsung_Mobiles', '', 1, 0, 0, 0, 3),
(79, 1, 68, 'Nokia', 'Nokia', '', 1, 0, 0, 0, 3),
(80, 1, 68, 'XOLO', 'XOLO', '', 1, 0, 0, 0, 3),
(81, 1, 68, 'Sony Mobiles', 'Sony_Mobiles', '', 1, 0, 0, 0, 3),
(82, 1, 69, 'iPad', 'iPad', '', 1, 0, 0, 0, 3),
(83, 1, 69, 'Tablets with Call Facility', 'Tablets_with_Call_Facility', '', 1, 0, 0, 0, 3),
(84, 1, 69, 'Tablets without Call Facility', 'Tablets_without_Call_Facility', '', 1, 0, 0, 0, 3),
(85, 1, 71, 'Cases & Covers', 'Cases_Covers', '', 1, 0, 0, 0, 3),
(86, 1, 71, 'Headphones', 'Headphones', '', 1, 0, 0, 0, 3),
(87, 1, 71, 'Bluetooth Headsets', 'Bluetooth_Headsets', '', 1, 0, 0, 0, 3),
(88, 1, 70, 'Laptop Accessories', 'Laptop_Accessories', '', 1, 0, 0, 0, 3),
(89, 1, 70, 'Storage', 'Storage', '', 1, 0, 0, 0, 3),
(90, 1, 70, 'Networking Components', 'Networking_Components', '', 1, 0, 0, 0, 3),
(91, 1, 70, 'Computer Components', 'Computer_Components', '', 1, 0, 0, 0, 3),
(92, 1, 70, 'Computer Peripherals', 'Computer_Peripherals', '', 1, 0, 0, 0, 3),
(93, 1, 72, 'Apple', 'Apple', '', 1, 0, 0, 0, 3),
(94, 1, 72, 'Dell', 'Dell', '', 1, 0, 0, 0, 3),
(95, 1, 72, 'HP', 'HP', '', 1, 0, 0, 0, 3),
(96, 1, 72, 'Lenovo', 'Lenovo', '', 1, 0, 0, 0, 3),
(97, 6, 6, 'Home Furnishing', 'Home_Furnishing', '', 1, 0, 0, 0, 2),
(98, 6, 6, 'Kitchen', 'Kitchen', '', 1, 0, 0, 0, 2),
(99, 6, 6, 'Bath', 'Bath', '', 1, 0, 0, 0, 2),
(101, 6, 6, 'Kitchen Appliances', 'Kitchen_Appliances', '', 1, 0, 0, 0, 2),
(102, 6, 99, 'Bath Towels', 'Bath_Towels', '', 1, 0, 0, 0, 3),
(103, 6, 99, 'Mats', 'Mats', '', 1, 0, 0, 0, 3),
(109, 6, 101, 'Electric Cookers', 'Electric_Cookers', '', 1, 0, 0, 0, 3),
(104, 6, 97, 'Vacuum Cleaners', 'Vacuum_Cleaners', '', 1, 0, 0, 0, 3),
(105, 6, 97, 'Emergency Lights', 'Emergency_Lights', '', 1, 0, 0, 0, 3),
(106, 6, 97, 'Water Purifiers', 'Water_Purifiers', '', 1, 0, 0, 0, 3),
(107, 6, 101, 'Sandwich and Rotimakers', 'Sandwich_and_Rotimakers', '', 1, 0, 0, 0, 3),
(108, 6, 101, 'Mixer Juicer Grinders', 'Mixer_Juicer_Grinders', '', 1, 0, 0, 0, 3),
(110, 6, 98, 'Table Covers', 'Table_Covers', '', 1, 0, 0, 0, 3),
(111, 6, 98, 'Table Placemats', 'Table_Placemats', '', 1, 0, 0, 0, 3),
(112, 2, 2, 'Men Clothing', 'Men_Clothing', '', 1, 0, 0, 0, 2),
(113, 2, 2, 'Men Footwear', 'Men_Footwear', '', 1, 0, 0, 0, 2),
(114, 2, 2, 'Men Watches', 'Men_Watches', '', 1, 0, 0, 0, 2),
(115, 2, 2, 'Mens Accessories', 'Mens_Accessories', '', 1, 0, 0, 0, 2),
(116, 2, 2, 'Men Bags Belts and wallets', 'Men_Bags_Belts_and_wallets', '', 1, 0, 0, 0, 2),
(117, 2, 116, 'Men Backpacks', 'Men_Backpacks', '', 1, 0, 0, 0, 3),
(118, 2, 116, 'Laptop Bags', 'Laptop_Bags', '', 1, 0, 0, 0, 3),
(119, 2, 116, 'Messenger Bags', 'Messenger_Bags', '', 1, 0, 0, 0, 3),
(120, 2, 116, 'Gym Bags', 'Gym_Bags', '', 1, 0, 0, 0, 3),
(121, 2, 112, 'Casual & Party Wear Shirts', 'Casual_Party_Wear_Shirts', '', 1, 0, 0, 0, 3),
(122, 2, 112, 'Men Jeans', 'Men_Jeans', '', 1, 0, 0, 0, 3),
(123, 2, 112, 'Formal Shirts', 'Formal_Shirts', '', 1, 0, 0, 0, 3),
(124, 2, 112, 'Sports & Active Wear', 'Sports_Active_Wear', '', 1, 0, 0, 0, 3),
(125, 2, 112, 'Inner Wear & Sleep Wear', 'Inner_Wear_Sleep_Wear', '', 1, 0, 0, 0, 3),
(126, 2, 113, 'Sports Shoes', 'Sports_Shoes', '', 1, 0, 0, 0, 3),
(127, 2, 113, 'Men Casual Shoes', 'Men_Casual_Shoes', '', 1, 0, 0, 0, 3),
(128, 2, 113, 'Formal Shoes', 'Formal_Shoes', '', 1, 0, 0, 0, 3),
(129, 2, 113, 'Sandals & Floaters', 'Sandals_Floaters', '', 1, 0, 0, 0, 3),
(130, 2, 114, 'Watches Fashion Sale', 'Watches_Fashion_Sale', '', 1, 0, 0, 0, 3),
(131, 2, 114, 'Titan', 'Titan', '', 1, 0, 0, 0, 3),
(132, 2, 114, 'Fastrack', 'Fastrack', '', 1, 0, 0, 0, 3),
(133, 2, 115, 'Chains', 'Chains', '', 1, 0, 0, 0, 3),
(134, 2, 115, 'Bracelets', 'Bracelets', '', 1, 0, 0, 0, 3),
(135, 2, 115, 'Wrist Bands', 'Wrist_Bands', '', 1, 0, 0, 0, 3),
(136, 2, 115, 'Cufflinks', 'Cufflinks', '', 1, 0, 0, 0, 3),
(153, 8, 8, 'Beauty & Personal Care', 'Beauty_Personal_Care', '', 1, 0, 0, 0, 2),
(138, 7, 7, 'Team Sports', 'Team_Sports', '', 1, 0, 0, 0, 2),
(139, 7, 7, 'Outdoor Adventure', 'Outdoor_Adventure', '', 1, 0, 0, 0, 2),
(140, 7, 7, 'Indoor Games', 'Indoor_Games', '', 1, 0, 0, 0, 2),
(141, 7, 7, 'Other Sports', 'Other_Sports', '', 1, 0, 0, 0, 2),
(142, 7, 141, 'Boxing', 'Boxing', '', 1, 0, 0, 0, 3),
(143, 7, 141, 'Golf', 'Golf', '', 1, 0, 0, 0, 3),
(144, 7, 141, 'Swimming', 'Swimming', '', 1, 0, 0, 0, 3),
(145, 7, 140, 'Chess', 'Chess', '', 1, 0, 0, 0, 3),
(146, 7, 140, 'Darts', 'Darts', '', 1, 0, 0, 0, 3),
(147, 7, 139, 'Camping & Hiking', 'Camping_Hiking', '', 1, 0, 0, 0, 3),
(148, 7, 139, 'Cycling', 'Cycling', '', 1, 0, 0, 0, 3),
(149, 7, 139, 'Running', 'Running', '', 1, 0, 0, 0, 3),
(150, 7, 138, 'Basketball', 'Basketball', '', 1, 0, 0, 0, 3),
(151, 7, 138, 'Cricket', 'Cricket', '', 1, 0, 0, 0, 3),
(152, 7, 138, 'Other Ball Sports', 'Other_Ball_Sports', '', 1, 0, 0, 0, 3),
(154, 8, 8, 'Perfume Shop', 'Perfume_Shop', '', 1, 0, 0, 0, 2),
(155, 8, 8, 'Health & Fitness', 'Health_Fitness', '', 1, 0, 0, 0, 2),
(156, 8, 153, 'Mens Grooming', 'Mens_Grooming', '', 1, 0, 0, 0, 3),
(157, 8, 153, 'Make Up & Cosmetics', 'Make_Up_Cosmetics', '', 1, 0, 0, 0, 3),
(158, 8, 153, 'Grooming Accessories', 'Grooming_Accessories', '', 1, 0, 0, 0, 3),
(159, 8, 153, 'Hand and Foot', 'Hand_and_Foot', '', 1, 0, 0, 0, 3),
(160, 8, 155, 'Health Monitors', 'Health_Monitors', '', 1, 0, 0, 0, 3),
(161, 8, 155, 'Medicines & Supplements', 'Medicines_Supplements', '', 1, 0, 0, 0, 3),
(162, 8, 155, 'Homeopathic Treatment', 'Homeopathic_Treatment', '', 1, 0, 0, 0, 3),
(163, 9, 9, 'Gifts', 'Gifts', '', 1, 0, 0, 0, 2),
(164, 9, 9, 'Flowers', 'Flowers', '', 1, 0, 0, 0, 2),
(165, 9, 163, 'Cakes', 'Cakes', '', 1, 0, 0, 0, 3),
(166, 9, 163, 'Gift Hamper', 'Gift_Hamper', '', 1, 0, 0, 0, 3),
(167, 9, 163, 'Assorted Gifts', 'Assorted_Gifts', '', 1, 0, 0, 0, 3),
(168, 9, 163, 'Gifts for Him', 'Gifts_for_Him', '', 1, 0, 0, 0, 3),
(169, 9, 163, 'Gifts for Her', 'Gifts_for_Her', '', 1, 0, 0, 0, 3),
(170, 9, 163, 'Birthday Gifts', 'Birthday_Gifts', '', 1, 0, 0, 0, 3),
(171, 9, 163, 'Anniversary Gifts', 'Anniversary_Gifts', '', 1, 0, 0, 0, 3),
(172, 9, 163, 'Wedding Gifts', 'Wedding_Gifts', '', 1, 0, 0, 0, 3),
(173, 9, 163, 'Valentines day gifts', 'Valentines_day_gifts', '', 1, 0, 0, 0, 3),
(174, 9, 164, 'Occasion', 'Occasion', '', 1, 0, 0, 0, 3),
(175, 9, 164, 'Specials', 'Specials', '', 1, 0, 0, 0, 3),
(176, 9, 164, 'Combos', 'Combos', '', 1, 0, 0, 0, 3),
(177, 9, 164, 'Designer Arrangements', 'Designer_Arrangements', '', 1, 0, 0, 0, 3),
(178, 9, 164, 'Remote Delivery', 'Remote_Delivery', '', 1, 0, 0, 0, 3),
(179, 3, 54, 'Shirts Tops & Tunics', 'Shirts_Tops_Tunics', '', 1, 0, 0, 0, 3),
(180, 3, 54, 'Ethnic Wear', 'Ethnic_Wear', '', 1, 0, 0, 0, 3),
(181, 3, 54, 'Women T-Shirts', 'Women_T-Shirts', '', 1, 0, 0, 0, 3),
(182, 3, 54, 'Jeans & Shorts', 'Jeans_Shorts', '', 1, 0, 0, 0, 3),
(183, 8, 159, 'Japanese Restaurant', 'Japanese_Restaurant', '', 1, 0, 0, 0, 4),
(184, 8, 155, 'Yogo', 'Yogo', '', 1, 0, 0, 0, 3),
(188, 1, 1, 'Watch', 'Watch', '', 1, 0, 0, 0, 2),
(186, 3, 55, 'FlipFlop', 'FlipFlop', '', 1, 0, 0, 0, 3),
(187, 3, 55, 'Heels', 'Heels', '', 1, 0, 0, 0, 3),
(189, 1, 188, 'Smart Watches', 'Smart_Watches', '', 1, 0, 0, 0, 3),
(190, 1, 188, 'Wrist Watch', 'Wrist_Watch', '', 1, 0, 0, 0, 3),
(191, 3, 3, 'Women Jewellery', 'Women_Jewellery', '', 1, 0, 0, 0, 2),
(192, 3, 191, ' Bangles', 'Bangles', '', 1, 0, 0, 0, 3),
(193, 3, 191, 'Rings', 'Rings', '', 1, 0, 0, 0, 3),
(194, 3, 191, 'Earrings', 'Earrings', '', 1, 0, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_id` int(3) NOT NULL,
  `city_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_latitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `city_longitude` varchar(15) CHARACTER SET latin1 NOT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `city_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active, 0-deactive',
  PRIMARY KEY (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `city_name`, `city_url`, `city_latitude`, `city_longitude`, `default`, `city_status`) VALUES
(1, 3, 'califorina', 'califorina', '36.66842', '-120.14648', 0, 1),
(2, 2, 'Melbourne', 'melbourne', '-37.92687', '144.93164', 0, 1),
(3, 3, 'Los Angels', 'los-angels', '34.88593', '-117.59766', 0, 1),
(4, 3, 'Sydney', 'sydney', '-33.97981', '151.17188', 0, 1),
(6, 3, 'Mexico', 'mexico', '24.12670', '-102.83203', 0, 1),
(9, 3, 'Washington', 'washington', '47.26432', '-120.08057', 0, 1),
(10, 22, 'Coimbatore', 'coimbatore', '11.03826', '76.91528', 1, 1),
(12, 24, 'Erode', 'erode', '11.00000', '78.00000', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `cms_url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `cms_desc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  `cms_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active, 0-deactive',
  PRIMARY KEY (`cms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`cms_id`, `cms_title`, `cms_url`, `cms_desc`, `type`, `cms_status`) VALUES
(4, 'Press kit', 'Press_kit', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\n typesetting industry. Lorem Ipsum has been the industry''s standard \ndummy text ever since the 1500s, when an unknown printer took a galley \nof type and scrambled it to make a type specimen book. It has survived \nnot only five centuries, but also the leap into electronic typesetting, \nremaining essentially unchanged. It was popularised in the 1960s with \nthe release of Letraset sheets containing Lorem Ipsum passages, and more\n recently with desktop publishing software like Aldus PageMaker \nincluding versions .</p>\n<p>It is a long established fact that a reader will be distracted by the\n readable content of a page when looking at its layout. The point of \nusing Lorem Ipsum is that it has a more-or-less normal distribution of \nletters, as opposed to using ''Content here, content here'', making it \nlook like readable English. Many desktop publishing packages and web \npage editors now use Lorem Ipsum as their default model text, and a \nsearch for ''lorem ipsum'' will uncover many web sites still in their \ninfancy. Various versions have evolved over the years, sometimes by \naccident, sometimes on purpose (injected humour and the like).</p>', 2, 1),
(2, 'Privacy Policy', 'privacy-policy', '<font face="Arial, Verdana" size="2"><p></p><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p><p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><p></p></font>', 2, 1),
(6, 'About Us', 'about-us', '<h1 class="entry-title"><font color="#ffcc00">6 Tips for Creating an Effective About Page</font></h1><p style="text-align: center;"><img class="aligncenter" src="http://i55.tinypic.com/wbx99t.jpg" alt="wbx99t 6 Tips for Creating an Effective About Page" title="6 Tips for Creating an Effective About Page"></p>\n<p class="MsoNormal">In order to add credibility and personalization to \nan online business, a site should have a comprehensive “About Us” \nsection. The page needs to be clear, informative and easy to find. Don’t\n hide information about your business. Instead, give your visitors a \npage that you would be proud to have read. With a solid backbone behind \nyour online presence, visitors will be more likely to consider your site\n for a purchase.<strong> </strong></p>\n<p class="MsoNormal">Here are six things you should include on your “About Us” page.<strong><br>\n</strong></p>\n<h3><strong><font color="#ffcc00">1. What you do</font></strong></h3>\n<p>Before you begin writing, think about what you look for in a company.\n Provide information that would give customers insight as to why your \ncompany is credible and why they should buy from you. This is a great \nplace to list your Mission Statement. An example of an effective Mission\n Statement comes from Google, “Google’s mission is to organize the \nworld’s information and make it universally accessible and useful”. This\n statement tells you what they do, why they do it and in a way that is \nwritten well and to the point.</p>\n<h3><strong><font color="#ffcc00">2. Your story</font></strong></h3>\n<p>Reflect on the core roots of your business and how it all began. Not \nonly how, but why it began. If you are just starting out, think about \nwhat made you decide to start this particular type of business. This \ninformation can add a personal touch to your site.</p>\n<h3><strong><font color="#ffcc00">3. Why you’re different</font></strong></h3>\n<p>This can either be an extremely easy question to answer, or an \nextremely hard one. Think on this one for awhile. Your answer can range \nfrom offering free shipping on all items, to being a mom-and-pop shop. \nYou can also give some general information here that may boost you above\n the competition, such as listing items that are rare or giving \ncustomers reassuring statements- “If you aren’t satisfied with an item, \nyour money back guaranteed!”</p>\n<h3><strong><font color="#ffcc00">4. How long you’ve been around</font></strong></h3>\n<p>If you have a physical store, include the length of time it’s been \naround. If a customer sees that your brick and mortar store has been \naround for several years- whether your site is a week or a year old may \nmake no difference. Instead, the fact that you’ve been involved in \nselling these particular items for a length of time is substantial \nenough. Also mention how long your company has had its website. If your \nbusiness is a website in its entirety and it’s just starting out, don’t \nbe afraid to mention that. The truth is always the best answer in \ngenerating trust.</p>\n<h3><strong><font color="#ffcc00">5. How to reach you</font></strong></h3>\n<p>If you already have an easily seen “Contact Us” section, good job. \nThe “About Us” section is a great place to reiterate this information. \nIf you have a physical location, list the address here. Having an actual\n address and a phone number on the site is a major plus. In generating \nyour contact information, take it from a customer’s point of view. If a \nnumber and address aren’t listed, what is the reasoning behind such? \nDoes the company not want to be bothered? Are they hiding something? If I\n make a purchase and I’m not satisfied, what could I possibly do? Try to\n write your information in a way to make even the biggest pessimistic \nconsider your company for a purchase.</p>\n<h3><strong><font color="#ffcc00">6. Helpful tips</font></strong></h3>\n<p>Feel free to provide common information in this section as well, such\n as standard shipping and return procedures. The easier you make the \npurchase process, the better!</p>\n<p class="MsoNormal">Overall, the information provided in your “About \nUs” section should answer several questions a new customer may have, but\n most importantly in online selling it should answer the question- Why \nshould I trust purchasing from you? Providing easily accessible company \ninformation will show that you have nothing to hide and instead, you \nwant to educate your potential customers about your business. Providing \ninsight as to who you are and what you do adds a personal, trustworthy \ntouch that may make the difference between a visitor and a customer.</p>', 1, 1),
(8, 'Terms and Conditions', 'terms-and-conditions', '<font face="Arial, Verdana" size="2">Visa, Master and American express Card payments are processed through an online payment gateway system. You need not worry about your card information falling into the wrong hands because your bank will authorize the card transaction directly without any information passing through us. In approximately 25-30 seconds (depending on your internet connection) your bank will issue, using the online payment gateway, an authorization code and confirmation of completion of transaction.<br>CartDeals, as a Verisign Certified Site, uses the latest 128 bit encryption technology and other sophisticated methods to protect your credit card information. You can book your product using SSL encryption (the internet standard for secure transactions). In fact, transacting online with a credit card at the Website is even safer than using a credit card at a restaurant because we do not retain your credit card information. You can be assured that CartDeals offers you the highest standards of security currently available on the internet so as to ensure that your shopping experience is private, safe and secure.<br>If the payment on the credit card is declined for some reason, alternate payment instructions must be received by CartDeals 72 hours prior to the time of departure; else, the order is liable to be cancelled.<br>CartDeals charges a service fee on all domestic airline bookings. In case of cancellation of booking, this fee is non-refundable.<br><br>Internet Banking<br><br>If you have an account with any of the below mentioned banks, then you can pay for your order through respective bank''s net banking options and the amount will be automatically debited from your account. "www.CartDealseals.com" processes the payments through an online gateway system which enables safe and secure transaction. Bank is not responsible for any inconvenience caused or non receipt of the tickets or passengers not allowed on the basis of E-tickets.<br>- Bank Of India<br>- CitiBank<br>- HDFC Bank<br>- IDBI Bank<br>- Indusind Bank<br>- Kotak Bank<br>- Punjab National Bank<br>- AXIS Bank<br>- Bank of Baroda - Retail NetBanking<br>- Bank of Baroda - Corporate NetBanking<br><br></font>', 2, 0),
(28, 'Help', 'Help', '<h3 id="faq_1" rel="howOrder" class="h3_invert" style="outline: none; margin: 0px; padding: 0px 0px 0px 20px; background-image: url(http://shopping.indiatimes.com/images/shopping_help/arrow.png); background-attachment: scroll; background-color: rgb(255, 255, 255); color: rgb(0, 84, 166); cursor: pointer; font-size: 14px; font-weight: normal; line-height: 30px; clear: both; font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-position: 0% 50%; background-repeat: no-repeat no-repeat;">How do I check the current status of my order?</h3><div id="faq_4_ans" style="outline: none; margin: 0px 0px 0px 20px; padding: 0px; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(209, 209, 209); color: rgb(70, 70, 70); font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-color: rgb(255, 255, 255);"><p style="outline: none; margin: 10px 0px; padding: 0px;">You can check the status of your order by visiting the "My Account" link. Please follow the steps mentioned as under:</p><p style="outline: none; margin: 10px 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">Step 1:</strong> Click on <a href="http://shopping.indiatimes.com/control/orderhistory?SHOW_OLD=true" target="_blank" style="outline: none; margin: 0px; padding: 0px; text-decoration: none; color: rgb(0, 84, 166);">Track order</a> Link in the My Account section. It shall display the orders you have placed on our shopping channel with current status.</p><p style="outline: none; margin: 10px 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">Step 2:</strong> Click on the Order number to know the details of the order. This displays the order page with the order number and sub order numbers with respective details.</p></div><h3 id="faq_5" class="h3_invert" style="outline: none; margin: 0px; padding: 0px 0px 0px 20px; background-image: url(http://shopping.indiatimes.com/images/shopping_help/arrow.png); background-attachment: scroll; background-color: rgb(255, 255, 255); color: rgb(0, 84, 166); cursor: pointer; font-size: 14px; font-weight: normal; line-height: 30px; clear: both; font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-position: 0% 50%; background-repeat: no-repeat no-repeat;">Are there any hidden costs on purchase?</h3><div id="faq_5_ans" style="outline: none; margin: 0px 0px 0px 20px; padding: 0px; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(209, 209, 209); color: rgb(70, 70, 70); font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-color: rgb(255, 255, 255);"><p style="outline: none; margin: 10px 0px; padding: 0px;">There are absolutely no hidden charges. You pay only the amount that you see in your order summary page. In some cases, if the courier delivery person asks for any extra charges then kindly <a href="http://shopping.indiatimes.com/contactUs" style="outline: none; margin: 0px; padding: 0px; text-decoration: none; color: rgb(0, 84, 166);">Contact Us</a>.</p></div><h3 id="faq_6" rel="IndianorImported" class="h3_invert" style="outline: none; margin: 0px; padding: 0px 0px 0px 20px; background-image: url(http://shopping.indiatimes.com/images/shopping_help/arrow.png); background-attachment: scroll; background-color: rgb(255, 255, 255); color: rgb(0, 84, 166); cursor: pointer; font-size: 14px; font-weight: normal; line-height: 30px; clear: both; font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-position: 0% 50%; background-repeat: no-repeat no-repeat;">Do you have warranty on your products?</h3><div id="faq_6_ans" style="outline: none; margin: 0px 0px 0px 20px; padding: 0px; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(209, 209, 209); color: rgb(70, 70, 70); font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-color: rgb(255, 255, 255);"><p style="outline: none; margin: 10px 0px; padding: 0px;">Yes, we do have warranty on most of our products. These are of two types:</p><p style="outline: none; margin: 10px 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">Seller Warranty:</strong> Our sellers offer warranty on most of their products against possible defects in materials and workmanship. Whenever defects occur within the warranty period, our seller will repair or replace the item in question. The warranty is not available on certain products, such as flowers, books, music, movies, magazine, health products, perfumes etc. The warranty terms is either mentioned with product and is also sent across with the products serviced. The warranty is limited and is only valid when the product is used for the purpose it was intended under normal conditions. The warranty does not cover any damage caused by normal wear &amp; tear, neglect, misuse, abrasion, exposure to extreme temperatures, acids or solvents; nor does it cover damage caused by third parties during transportation. All returns are subject to inspection and approval by the seller before any repair or replacement is authorised.</p><p style="outline: none; margin: 10px 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">Manufacturer warranty:</strong> For products which are offered on manufacturer warranty, please contact the nearest service center of the manufacturer. Our customer care would be able to assist you with the service center contact numbers only or you can visit the respective manufacturers website to obtain the nearest service centre details, any request for replacement or repair of the products shall not be entertained. Such services are offered directly by the Manufacturer of those products.</p><p style="outline: none; margin: 10px 0px; padding: 0px;">For more details please refer our <a href="http://shopping.indiatimes.com/returnPolicy" target="_blank" style="outline: none; margin: 0px; padding: 0px; text-decoration: none; color: rgb(0, 84, 166);">Return Policy</a>.</p></div><h3 id="faq_7" class="h3_invert" style="outline: none; margin: 0px; padding: 0px 0px 0px 20px; background-image: url(http://shopping.indiatimes.com/images/shopping_help/arrow.png); background-attachment: scroll; background-color: rgb(255, 255, 255); color: rgb(0, 84, 166); cursor: pointer; font-size: 14px; font-weight: normal; line-height: 30px; clear: both; font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-position: 0% 50%; background-repeat: no-repeat no-repeat;">What if I find my package opened or tampered upon delivery?</h3><div id="faq_7_ans" style="outline: none; margin: 0px 0px 0px 20px; padding: 0px; border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(209, 209, 209); color: rgb(70, 70, 70); font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-color: rgb(255, 255, 255);"><p style="outline: none; margin: 10px 0px; padding: 0px;">Please don''t accept an open or tampered package. Notify us of the same just after receiving the package since our courier partner doesn''t provide open delivery option.</p></div><h3 id="faq_8" class="h3_invert" style="outline: none; margin: 0px; padding: 0px 0px 0px 20px; background-image: url(http://shopping.indiatimes.com/images/shopping_help/arrow.png); background-attachment: scroll; background-color: rgb(255, 255, 255); color: rgb(0, 84, 166); cursor: pointer; font-size: 14px; font-weight: normal; line-height: 30px; clear: both; font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-position: 0% 50%; background-repeat: no-repeat no-repeat;">What does the various product availability options mean?</h3><div id="faq_8_ans" style="outline: none; margin: 0px 0px 0px 20px; padding: 0px; border-bottom-style: none; color: rgb(70, 70, 70); font-family: ''Trebuchet MS'', Helvetica, Arial, Verdana, sans-serif; background-color: rgb(255, 255, 255);"><p style="outline: none; margin: 10px 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">In Stock:</strong> The item is available; we expect to deliver it in the mentioned timelines.<br style="outline: none; margin: 0px; padding: 0px;"><strong style="outline: none; margin: 0px; padding: 0px;">Out of Stock:</strong> This item is sold out and is currently not in stock. In such cases please enter your e-mail id to get notified when the product is back in stock.</p></div>', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `color_name` varchar(128) NOT NULL,
  `color_code_name` varchar(64) NOT NULL,
  `color_code_id` int(11) NOT NULL,
  `color_status` int(1) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `deal_id`, `color_name`, `color_code_name`, `color_code_id`, `color_status`) VALUES
(40, 2, 'FFFF00', 'Yellow', 3, 0),
(39, 2, '6195ED', 'Cornflower Blue', 1, 0),
(38, 2, '0000FF', 'Blue', 4, 0),
(51, 3, '1B1404', 'Acadia', 33, 0),
(50, 3, 'FFFF00', 'Yellow', 3, 0),
(49, 3, 'F07C60', 'Burnt Sienna', 18, 0),
(59, 4, '90B6F9', 'Malibu', 5, 0),
(58, 4, '1B1404', 'Acadia', 33, 0),
(76, 6, '7CB0A1', 'Acapulco', 29, 0),
(75, 6, '10264C', 'Blue Zodiac', 15, 0),
(74, 6, '0000FF', 'Blue', 4, 0),
(67, 9, 'ED61D5', 'Lavender Magenta', 19, 0),
(66, 9, 'F07C60', 'Burnt Sienna', 18, 0),
(65, 9, '0000FF', 'Blue', 4, 0),
(62, 10, '0000FF', 'Blue', 4, 0),
(61, 10, 'FFFF00', 'Yellow', 3, 0),
(60, 10, '6195ED', 'Cornflower Blue', 1, 0),
(73, 11, 'F07C60', 'Burnt Sienna', 18, 0),
(72, 11, '1B1404', 'Acadia', 33, 0),
(71, 11, '10264C', 'Blue Zodiac', 15, 0),
(70, 11, '044022', 'Zuccini', 7, 0),
(69, 11, '0000FF', 'Blue', 4, 0),
(30, 12, 'ED61D5', 'Lavender Magenta', 19, 0),
(31, 12, 'F07C60', 'Burnt Sienna', 18, 0),
(32, 12, '0000FF', 'Blue', 4, 0),
(33, 14, '6195ED', 'Cornflower Blue', 1, 0),
(34, 14, '00FF00', 'Green', 2, 0),
(35, 14, 'FFFF00', 'Yellow', 3, 0),
(36, 14, '0000FF', 'Blue', 4, 0),
(37, 14, '044022', 'Zuccini', 7, 0),
(41, 2, '1B1404', 'Acadia', 33, 0),
(48, 3, '00FF00', 'Green', 2, 0),
(47, 3, '0000FF', 'Blue', 4, 0),
(63, 10, 'F07C60', 'Burnt Sienna', 18, 0),
(64, 10, '1B1404', 'Acadia', 33, 0),
(68, 9, '0076A3', 'Allports', 35, 0),
(77, 6, '0076A3', 'Allports', 35, 0),
(78, 22, '0000FF', 'Blue', 4, 0),
(79, 22, '10264C', 'Blue Zodiac', 15, 0),
(80, 22, '1B1404', 'Acadia', 33, 0),
(81, 22, '0076A3', 'Allports', 35, 0),
(82, 23, '326749', 'Killarney', 52, 0),
(83, 23, '333333', 'Mine Shaft', 51, 0),
(84, 23, '0076A3', 'Allports', 35, 0),
(85, 23, '1B1404', 'Acadia', 33, 0),
(86, 23, '3B7A57', 'Amazon', 32, 0),
(87, 23, '7CB0A1', 'Acapulco', 29, 0),
(88, 23, 'ED61D5', 'Lavender Magenta', 19, 0),
(89, 24, '10264C', 'Blue Zodiac', 15, 0),
(90, 24, '7DA1DE', 'Chetwode Blue', 17, 0),
(91, 24, 'ED61D5', 'Lavender Magenta', 19, 0),
(92, 24, '7CB0A1', 'Acapulco', 29, 0),
(93, 24, '1B1404', 'Acadia', 33, 0),
(94, 25, '0000FF', 'Blue', 4, 0),
(95, 25, '1B1404', 'Acadia', 33, 0),
(96, 25, '333333', 'Mine Shaft', 51, 0),
(97, 25, 'AF8F2C', 'Alpine', 31, 0),
(98, 27, '6195ED', 'Cornflower Blue', 1, 0),
(99, 27, '0000FF', 'Blue', 4, 0),
(100, 27, '10264C', 'Blue Zodiac', 15, 0),
(101, 27, 'F07C60', 'Burnt Sienna', 18, 0),
(102, 27, 'ED61D5', 'Lavender Magenta', 19, 0),
(103, 27, '4C4F56', 'Abbey', 22, 0),
(104, 29, '326749', 'Killarney', 52, 0),
(105, 29, '0076A3', 'Allports', 35, 0),
(106, 29, 'AF8F2C', 'Alpine', 31, 0),
(107, 29, 'ED61D5', 'Lavender Magenta', 19, 0),
(108, 29, '044022', 'Zuccini', 7, 0),
(109, 43, 'ED61D5', 'Lavender Magenta', 19, 0),
(110, 43, '00FF00', 'Green', 2, 0),
(111, 43, '1B1404', 'Acadia', 33, 0),
(112, 43, 'FFFF00', 'Yellow', 3, 0),
(113, 43, 'F07C60', 'Burnt Sienna', 18, 0),
(114, 43, '0000FF', 'Blue', 4, 0),
(115, 49, '333333', 'Mine Shaft', 51, 0),
(116, 49, '1B1404', 'Acadia', 33, 0),
(117, 85, '00FF00', 'Green', 2, 0),
(118, 85, 'FFFF00', 'Yellow', 3, 0),
(119, 85, '0000FF', 'Blue', 4, 0),
(120, 85, 'ED61D5', 'Lavender Magenta', 19, 0),
(121, 85, '1B1404', 'Acadia', 33, 0),
(129, 87, '044022', 'Zuccini', 7, 0),
(128, 87, '7CB0A1', 'Acapulco', 29, 0),
(130, 90, '326749', 'Killarney', 52, 0),
(131, 97, 'FFFF00', 'Yellow', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `color_code`
--

CREATE TABLE IF NOT EXISTS `color_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_code` varchar(64) NOT NULL,
  `color_name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `color_code`
--

INSERT INTO `color_code` (`id`, `color_code`, `color_name`) VALUES
(1, '6195ED', 'Cornflower Blue'),
(2, '00FF00', 'Green'),
(3, 'FFFF00', 'Yellow'),
(4, '0000FF', 'Blue'),
(5, '90B6F9', 'Malibu'),
(7, '044022', 'Zuccini'),
(15, '10264C', 'Blue Zodiac'),
(17, '7DA1DE', 'Chetwode Blue'),
(18, 'F07C60', 'Burnt Sienna'),
(19, 'ED61D5', 'Lavender Magenta'),
(22, '4C4F56', 'Abbey'),
(29, '7CB0A1', 'Acapulco'),
(31, 'AF8F2C', 'Alpine'),
(32, '3B7A57', 'Amazon'),
(33, '1B1404', 'Acadia'),
(35, '0076A3', 'Allports'),
(51, '333333', 'Mine Shaft'),
(52, '326749', 'Killarney');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `message` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Active , 0- InActive',
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `phone_number`, `message`, `status`) VALUES
(1, 'test', 'test21689@gmail.com', '', 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', 1),
(2, 'test', 'hariprasath.rr@gmail.com', '', 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', 1),
(3, 'test 1', 'hariprasath.rr@gmail.com', '', 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', 1),
(4, 'mail testing', 'hariprasath.rr@gmail.com', '', 'sgd sgd hfhn fdhnfhfg jfgh jfgh jmghkhj khjkm, h,khj hjm kgjmjkgh jgfmkj fgjkmfgkg kjg ', 1),
(5, 'Hariprasath.R', 'hariprasath.r@ndot.in', '919787272400', 'this for test', 1),
(6, 'Hariprasath.R', 'hariprasath.r@ndot.in', '919787272400', 'this is for test', 1),
(7, 'Noah', 'greenwood@webtown.com', '30418213753', 'Have you got a telephone directory? <a href=" http://www.annebowen.com/about.php ">scabies stromectol</a>  Providers must select one of the alternate access methods. If they choose not to use a\n <a href=" http://usersolutions.com/privacy-policy/ ">lasix for</a>  COB Segment: Amount reported on your claim, it will\n <a href=" http://www.rjackbalthazar.com/about-us.html ">betnovate cream online</a>  formal presentation using appropriate audiovisual media support and handouts. Through seminar,\n <a href=" http://www.abetterworkplace.com/presentations/ ">voltaren retard 75</a>  Read The ASHP Discussion Guide for Compounding Sterile Preparations\n ', 1),
(8, 'Owen', 'flyman@gmail.com', '47859949653', 'Could you ask him to call me? <a href=" http://www.painttheparks.com/quest/ ">proscar time results</a>  Compounding Topical Syringes :\n <a href=" http://www.abetterworkplace.com/presentations/ ">voltaren 75 sr</a>  315 Recipient Not Medicare, Services Not Reimbursable\n <a href=" http://www.myglobalbordeaux.com/tag/bordeaux/ ">premarin tablets</a>  by the medical education coordinator. The other is used mainly by Chero Woodin, but can be\n ', 1),
(9, 'Chloe', 'lifestile@msn.com', '23368680398', 'I quite like cooking <a href=" http://wehwlaw.com/estate-planning ">buy robaxin online</a>  there is anything you would like to take back to the States, make a request. Her bargaining skills are better than a\n <a href=" http://www.abetterworkplace.com/presentations/ ">voltaren gel canada</a>  and contraindications to non-pharmacological and pharmacological therapy.\n <a href=" http://www.myglobalbordeaux.com/tag/bordeaux/ ">premarin tablets</a>  5. Members have the right to receive pharmaceutical care without regard to race, color,\n ', 1),
(10, 'Alexis', 'kidrock@msn.com', '54687108674', 'On another call <a href=" http://www.basncr.org/exhibits/ ">atenolol 50 mg tablet</a>  medication history write-ups, patient education sheets, newsletter articles, drug use\n <a href=" http://www.annebowen.com/about.php ">order stromectol online</a>  directly with the hands. Clean-up of spills ± Spills may occur when containers of blood or other potentially infectious\n <a href=" http://www.rjackbalthazar.com/about-us.html ">betnovate cream for acne</a>  ZoomingElectromotive (with double speed function)3\n <a href=" http://canadastop20.com/index.php/featured/ ">buy cheap synthroid</a>  electronic batch. If a non-capture transaction (NO CLAIM TO FA) is being reversed, the\n ', 1),
(11, 'Maria', 'unlove@gmail.com', '26041528301', 'The line''s engaged <a href=" http://www.annebowen.com/about.php ">purchase ivermectin</a>  Number of Refills The Number of Refills Authorized is entered in this field. New\n <a href=" http://usersolutions.com/privacy-policy/ ">order furosemide</a>  interactions, efficacy, lab values, to, laboratory studies, serum\n <a href=" http://www.rjackbalthazar.com/about-us.html ">betnovate ointment 0.1</a>  integrity. The system also strives to uphold the accused studen ts right to due process.\n <a href=" http://www.abetterworkplace.com/presentations/ ">voltaren ec tablets 50mg</a>  equilateral triangle, is intendedThis equipment has been tested\n ', 1),
(12, 'Lucas', 'crazyfrog@hotmail.com', '98591965971', 'What''s the last date I can post this to  to arrive in time for Christmas? <a href=" http://www.utecreekcattlecompany.com/bout ">avapro mg</a>  They will be rejected if the conditions for these reason codes exist.\n <a href=" http://www.thepennyloafers.com/portfolio/amanda-triglia/ ">ranbaxy eriacta</a>  received from a recipient?s other third party insurance\n <a href=" http://fuckedup.cc/category/writing/ ">topamax 25 mg for weight loss</a>  attesting to the statement. If you have been issued a 4 digit ETIN, you may leave off\n <a href=" http://www.chdesignsinc.com/?page_id=194 ">cheap acyclovir online no prescription</a>  #1 satisfactorily and directed questioning to prompting to completes most\n ', 1),
(13, 'Eric', 'greenwood@webtown.com', '59426356951', 'We''ve got a joint account <a href=" http://tecnecollective.com/about ">cefixime tablets</a>  original dispensing, reimbursement can be claimed. The signed prescription must be\n <a href=" http://www.moorelegal.net/austin-law-office.html ">is there a generic nexium</a>  prescriptions to treat vitamin deficiencies (e.g. resulting from anemia, diabetes), prescriptions to\n <a href=" http://www.utecreekcattlecompany.com/bout ">avapro online</a>  system for each transaction.\n <a href=" http://lbhoffmangroup.com/index.php/testimonials ">endep tablets</a>  prescription drugs the recipient has taken over the past 90 days and alert the pharmacists\n ', 1),
(14, 'getjoy', 'nogood87@yahoo.com', '77007199222', 'I never went to university <a href=" http://tecnecollective.com/about ">cefixime dose</a>  FS FB 3 variable O x''1C'' FB\n <a href=" http://www.moorelegal.net/austin-law-office.html ">nexium in mexico</a>  education of the students at the College of Pharmacy, however, participation in\n <a href=" http://lbhoffmangroup.com/index.php/testimonials ">amitriptyline online</a>  For writing, it is best to use a felt tip pen with a fine point. Avoid ballpoint pens that skip; do not use pencils,\n ', 1),
(15, 'Claire', 'unlove@gmail.com', '28108986474', 'An estate agents <a href=" http://tecnecollective.com/about ">cheap suprax</a>  available experiential opportunities. All selections will be made through a lottery system\n <a href=" http://www.moorelegal.net/austin-law-office.html ">nexium dosage 80 mg</a>  North Carolina at Chapel Hill UNC Eshelman School of Pharmacy, and that I am not guaranteed a site in the\n <a href=" http://www.thepennyloafers.com/portfolio/amanda-triglia/ ">buy eriacta</a>  037 Outpatient Coverage without Long Term Care\n ', 1),
(16, 'Wyatt', 'goodsam@gmail.com', '76005739587', 'I didn''t go to university <a href=" http://tecnecollective.com/about ">suprax antibiotics</a>  Foreign Asset Control (OFAC), List of Specially Designated Nationals (SDN), U.S.\n <a href=" http://www.utecreekcattlecompany.com/bout ">generic for avapro</a>  2.6 Identify, evaluate, trend and describe or recommend corrective action(s) in medication\n <a href=" http://www.moorelegal.net/austin-law-office.html ">nexium alternatives</a>  the claim directly to the eMedNY contractor via paper. The claim will pay upon the local\n <a href=" http://lbhoffmangroup.com/index.php/testimonials ">purchase endep online</a>  or increased cost to the DHB:\n ', 1),
(17, 'Ykojvdgq', 'rlcgckug@ziqnnmba.com', '30918381771', '5 GW end of this metalloid. In the Western concessions., <a href="http://spelautomaterpanatetsverige.com/">online casino</a>, [url="http://spelautomaterpanatetsverige.com/"]online casino[/url],  619020, <a href="http://sverigetopp5.com/">casino online sverige</a>, [url="http://sverigetopp5.com/"]casino online sverige[/url],  hiwt, ', 1),
(18, 'Bhtcjwzj', 'zdclxrid@uchbehnb.com', 'TpdprRfLYaF', 'The concern has to be Thursday, said Fumihiko Imamura, a year of 1945 saw the japanese app, despite the macro mode.In this paper, instant noodles, vegetables and fish per day, you''re the type of Dongguan is an industry that serves a civilian purpose only., <a href="http://spelautomaterpanatetsverige.com/">internet casino</a>, [url="http://spelautomaterpanatetsverige.com/"]internet casino[/url],  91625, <a href="http://sverigeonlinecasinoratings.com/">casino bonus</a>, [url="http://sverigeonlinecasinoratings.com/"]casino bonus[/url],  6136, ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(3) NOT NULL AUTO_INCREMENT,
  `country_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `country_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `currency_symbol` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_url`, `country_name`, `country_code`, `country_status`, `currency_symbol`, `currency_code`) VALUES
(22, 'canadian', 'Canadian', 'CA', 1, 'C$', 'CAD'),
(3, 'us', 'US', 'US', 1, '$', 'USD'),
(21, 'singapore', 'Singapore', 'SG', 1, 's$', 'SGD'),
(24, 'india', 'India', 'IND', 1, '₹', 'INR'),
(23, 'New_zealand', 'New zealand', 'NZ', 1, '$', 'NZD');

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `for_store_cred` int(11) NOT NULL COMMENT '1-for store credit, 0-not for store credit',
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `deal_percentage` float NOT NULL,
  `purchase_count` int(11) NOT NULL,
  `minimum_deals_limit` int(11) NOT NULL,
  `maximum_deals_limit` int(11) NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `bid_increment` double NOT NULL,
  `startdate` int(10) NOT NULL,
  `enddate` int(10) NOT NULL,
  `expirydate` int(10) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `view_count` int(11) NOT NULL,
  `deal_feature` int(1) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `deal_description`, `fineprints`, `highlights`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `for_store_cred`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `purchase_count`, `minimum_deals_limit`, `maximum_deals_limit`, `user_limit_quantity`, `bid_increment`, `startdate`, `enddate`, `expirydate`, `created_date`, `created_by`, `deal_status`, `commission_status`, `view_count`, `deal_feature`) VALUES
(1, 'Hair House Saloon', 'Hair_House_Saloon', 'NK8q7eWJ', '<p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); ">If most of your gifts seem to consist of mostly hair care products then its high time you get yourself a hair makeover! Start taking the hint that your hair is need of care and pay a visit to <strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Hair House Saloon</strong>! With a chemical treatment to give you a whole<em style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">sassy</em> new look and add that with hair treatment, cut, wash and blow to give you that sleek and silky mane. Emerge with an improvement to your crowning glory only at Hair House Saloon!</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Benefits: </strong><br>- Glossy and silky hair <br>- Improves hair condition<br>- Tame and more manageable hair</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Highlights: </strong><br>- Valid for all hair length <br>- Using Alfaparf Milano Product from Italia <br>- Convenient location with ample parking space <br>- Strategically located at Pusat Perdangagan Tuanku Haminah (Taman Rakyat) <br>- Comfortable &amp; professional environment, superior facilities &amp; friendly services at affordable rate <br>- Provides professional hair services such as style-cuts, hairstyling, colouring, perming, straightening &amp; hair treatments</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">What You Get:</strong><br>1) Hair Colouring / Highlights<br>2) Hair Treatment<br>3) Cut<br>4) Wash<br>5) Blow</p>', '', '', '', '', '', 3, 58, 65, 0, 1, 736, 1, 1, 70, 145, 75, 51.7241, 0, 15, 200, 20, 0, 1391597580, 2100000000, 2100000000, 1391768543, 14, 1, 1, 131, 0),
(2, '[Instant Redemption] Mushroom Soup', 'Instant_Redemption_Mushroom_Soup', 'F1lbHote', '<p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); ">There are times when you''d like to save and also have a meal that can satisfy your hunger. Feed your tummy with some yummylicious delights at <strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Cha is Tea</strong>. Indulge in mouthwatering servings in your 3-Course Meal which you will not regret. There''s only one thing that''s left to be said; Bon appétit!</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Highlights:</strong> <br>- New opened cafe beside Old Town, Jalan Perak<br>- Cozy and relaxing environment with nice ambience <br>- Comfortable, air conditioned dining area to enjoy your meal <br>- Outdoor seating available <br>- Friendly and cordial services</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">What You Get:</strong><br><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Offer 1:</strong> 2Pax (RM14) - only RM7 per person<br><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">Offer 2:</strong> 4Pax (RM24) - only RM6 per person</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); "><strong style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-variant: inherit; vertical-align: baseline; line-height: 1; ">3-Course Meal Includes:</strong><br>a) Mushroom Soup</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); ">b) Main Course (choose one):<br>- Carbonara Spaghetti <br>- Bolognese Chicken Spaghetti</p><p style="margin: 10px 0px 0px; padding: 0px; border: 0px; font-family: ''Helvetica Neue'', Arial, Helvetica, sans-serif; font-size: 14px; vertical-align: baseline; line-height: 18px; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); ">c) Dessert <br>- Pudding</p>', '', '', '', '', '', 8, 153, 159, 183, 1, 157, 2, 0, 100, 145, 45, 31.0345, 0, 15, 200, 100, 0, 1391598000, 2100000000, 2100000000, 1394195214, 14, 1, 1, 145, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE IF NOT EXISTS `discussion` (
  `discussion_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` int(10) NOT NULL,
  `discussion_status` int(1) NOT NULL DEFAULT '1',
  `delete_status` int(2) NOT NULL DEFAULT '1' COMMENT '1-Active,0-Inactive',
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`discussion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_likes`
--

CREATE TABLE IF NOT EXISTS `discussion_likes` (
  `likes_id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`likes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `discussion_unlike`
--

CREATE TABLE IF NOT EXISTS `discussion_unlike` (
  `unlike_id` int(11) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  PRIMARY KEY (`unlike_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `sendgrid_host` varchar(150) NOT NULL,
  `sendgrid_port` int(10) NOT NULL,
  `sendgrid_username` varchar(256) NOT NULL,
  `sendgrid_password` varchar(50) NOT NULL,
  `smtp_host` varchar(150) NOT NULL,
  `smtp_port` int(10) NOT NULL,
  `smtp_username` varchar(256) NOT NULL,
  `smtp_password` varchar(50) NOT NULL,
  `api_key` varchar(256) NOT NULL,
  `list_id` varchar(256) NOT NULL,
  `replay_to_mail` varchar(150) NOT NULL,
  `from_name` varchar(250) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`settings_id`, `sendgrid_host`, `sendgrid_port`, `sendgrid_username`, `sendgrid_password`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `api_key`, `list_id`, `replay_to_mail`, `from_name`, `status`) VALUES
(1, 'smtp.sendgrid.net', 587, 'requin', 'S123123278755r', 'smtp.gmail.com', 465, 'livetest172@gmail.com', 'pwndz172', 'd3b197b0bcbafbf04f9d4710a885a4af-us6', 'd6e121b6da', 'livetest172@gmail.com', 'E-Marketplace', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_subscribe`
--

CREATE TABLE IF NOT EXISTS `email_subscribe` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `suscribe_city_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-Subscribe,0-Unsbscribe',
  `suscribe_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-subscribe,0-unsubscribe',
  `is_deleted` int(1) NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_subscribe`
--

INSERT INTO `email_subscribe` (`subscribe_id`, `user_id`, `email_id`, `country_id`, `city_id`, `category_id`, `suscribe_city_status`, `suscribe_status`, `is_deleted`) VALUES
(1, 933, 'shallbe@swifta.com', '3', '1', '8', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` int(2) NOT NULL AUTO_INCREMENT,
  `question` varchar(164) NOT NULL,
  `answer` text NOT NULL,
  `faq_status` int(11) NOT NULL DEFAULT '1' COMMENT '1-active,0-inactive',
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `question`, `answer`, `faq_status`) VALUES
(5, 'How much does it cost to create check-in deals?', 'Check-in Deals are currently free to create. In the future, the product, product availability, and pricing are all subject to change.', 1),
(6, 'I found a deal I like - how do I buy it?', 'It''s simple. Just click the green "Get It" button for the deal you wish to purchase. You’ll then be directed to a third-party site to complete your purchase.', 1),
(7, 'Wait, why did I leave Metromix when I clicked “Get It”?', 'We aggregate deals from across the web to help you find the best and most exciting offers. When you click the “Get It” button from a deal that originated somewhere other than Metromix, you’ll be taken to that provider’s website to complete your purchase.', 1),
(8, 'What if I have an issue with the deal I purchased?', 'Any purchases you choose to make are from the deal sites themselves. If you have a question or concern, each site has a customer service phone number or email address so you can quickly address any issues. Please be sure to read and follow the terms and conditions of each site and offer.', 1),
(9, 'What is the new Deals section on Metromix?', 'Not only is Metromix your trusted resource for places to go and things to do, now, with Metromix Deals, you can also find extraordinary deals and specials available in your city.', 1),
(10, 'How can I feature my business on Metromix Deals?', 'To be considered for a listing on Metromix Deals, please complete our Deal Inquiry Form.', 1),
(11, 'How long does my Deal last?', 'Your Deal will remain available for consumers to purchase indefinitely unless you indicate a maximum number available or remove your Deal via biz.yelp.com.', 1),
(12, 'How are refunds handled?', 'If Yelp issues a refund to a customer, you owe Yelp your 70% share of the customer''s payment. Yelp will deduct this amount from future payments owed to you. In general, we believe that Yelp Deals should always be a great experience for the customer. So when a customer is unhappy or believes that a Deal was difficult to redeem at your business, we will refund their payment right away.', 1),
(13, 'I created my Deal, now what?', 'Watch this video to learn more about how your deal will appear on the Yelp web site and in mobile apps. Also learn how to redeem customer deals, and how to get paid.', 1),
(14, 'How do I track who purchased my Deal?', 'Once your Deal is created there will be a dedicated area within the "Yelp Deals" section where you will find a list of purchasers, as well as their unique redemption codes. When someone redeems their Deal you can electronically check them off by hitting "redeem" next to their name.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image_resize`
--

CREATE TABLE IF NOT EXISTS `image_resize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `list_width` int(5) NOT NULL,
  `list_height` int(5) NOT NULL,
  `detail_width` int(5) NOT NULL,
  `detail_height` int(5) NOT NULL,
  `thumb_width` int(5) NOT NULL,
  `thumb_height` int(5) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `image_resize`
--

INSERT INTO `image_resize` (`id`, `list_width`, `list_height`, `detail_width`, `detail_height`, `thumb_width`, `thumb_height`, `type`) VALUES
(1, 159, 41, 15, 15, 23, 24, 1),
(2, 174, 253, 393, 400, 82, 61, 2),
(3, 171, 132, 393, 400, 82, 61, 3),
(4, 158, 108, 393, 400, 82, 61, 4),
(5, 228, 152, 455, 378, 100, 100, 5),
(6, 50, 50, 170, 165, 486, 248, 6),
(7, 100, 128, 0, 0, 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `module_settings`
--

CREATE TABLE IF NOT EXISTS `module_settings` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_deal` int(1) NOT NULL,
  `is_product` int(1) NOT NULL,
  `is_auction` int(1) NOT NULL,
  `is_blog` int(1) NOT NULL,
  `is_paypal` int(1) NOT NULL DEFAULT '1',
  `is_credit_card` int(1) NOT NULL DEFAULT '1',
  `is_authorize` int(1) NOT NULL DEFAULT '1',
  `is_cash_on_delivery` int(1) NOT NULL,
  `is_shipping` int(1) NOT NULL COMMENT '1- Free Shipping ,  2- Flat Shipping, 3- Per Product Shipping , 4- Per Item Shipping',
  `is_map` int(1) NOT NULL,
  `is_store_list` int(1) NOT NULL,
  `is_past_deal` int(1) NOT NULL,
  `is_faq` int(1) NOT NULL,
  `is_city` int(1) NOT NULL,
  `is_cms` int(1) NOT NULL COMMENT '1-header position,0-footer position',
  `is_newsletter` int(1) NOT NULL,
  `free_shipping` int(1) NOT NULL,
  `flat_shipping` int(1) NOT NULL,
  `per_product` int(1) NOT NULL,
  `per_quantity` int(1) NOT NULL,
  `aramex` int(1) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `module_settings`
--

INSERT INTO `module_settings` (`module_id`, `is_deal`, `is_product`, `is_auction`, `is_blog`, `is_paypal`, `is_credit_card`, `is_authorize`, `is_cash_on_delivery`, `is_shipping`, `is_map`, `is_store_list`, `is_past_deal`, `is_faq`, `is_city`, `is_cms`, `is_newsletter`, `free_shipping`, `flat_shipping`, `per_product`, `per_quantity`, `aramex`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, 0, 0, 4, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `deal_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deal_description` text COLLATE utf8_unicode_ci NOT NULL,
  `fineprints` text COLLATE utf8_unicode_ci NOT NULL,
  `highlights` text COLLATE utf8_unicode_ci NOT NULL,
  `color` int(1) NOT NULL DEFAULT '0' COMMENT '0 - No , 1 - Yes',
  `size` int(1) NOT NULL,
  `shipping_amount` double NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `sec_category_id` int(11) NOT NULL,
  `third_category_id` int(11) NOT NULL,
  `deal_type` int(1) NOT NULL COMMENT '1-deals, 2-products, 3 - Auction',
  `merchant_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deal_value` double NOT NULL,
  `deal_price` double NOT NULL,
  `deal_savings` double NOT NULL,
  `deal_percentage` float NOT NULL,
  `for_store_cred` int(1) NOT NULL COMMENT '1- for store credit, 0-not for store credit',
  `weight` double NOT NULL,
  `height` double NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `purchase_count` int(11) NOT NULL,
  `user_limit_quantity` int(5) NOT NULL,
  `created_date` int(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deal_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `commission_status` int(1) NOT NULL DEFAULT '1',
  `delivery_period` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `view_count` int(11) NOT NULL,
  `attribute` int(1) NOT NULL COMMENT '1-Yes,0-No',
  `deal_feature` int(1) NOT NULL,
  `Including_tax` int(1) NOT NULL,
  `shipping` int(1) NOT NULL,
  PRIMARY KEY (`deal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=102 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`deal_id`, `deal_title`, `url_title`, `deal_key`, `deal_description`, `fineprints`, `highlights`, `color`, `size`, `shipping_amount`, `terms_conditions`, `meta_description`, `meta_keywords`, `category_id`, `sub_category_id`, `sec_category_id`, `third_category_id`, `deal_type`, `merchant_id`, `shop_id`, `deal_value`, `deal_price`, `deal_savings`, `deal_percentage`, `for_store_cred`, `weight`, `height`, `length`, `width`, `purchase_count`, `user_limit_quantity`, `created_date`, `created_by`, `deal_status`, `commission_status`, `delivery_period`, `view_count`, `attribute`, `deal_feature`, `Including_tax`, `shipping`) VALUES
(1, 'Sony CyberShot W810 20.1MP Point & Shoot Digital Camera ', 'Sony_CyberShot_W810_20.1MP_Point_Shoot_Digital_Camera', 'yky4G6po', '<h3 style="margin: 0px; padding: 0px; border: 0px; font-family: arial, tahoma, verdana, sans-serif; font-size: 13px; line-height: 18px; vertical-align: baseline; color: rgb(102, 102, 102); text-align: left; word-spacing: 2px; background-color: rgb(255, 255, 255); "><div class="textheadings" style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(202, 202, 202); padding: 6px 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: Tahoma; font-size: medium; font-weight: normal; line-height: normal; text-align: start; word-spacing: 0px; "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Product Summary of Sony CyberShot W810 20.1MP Point &amp; Shoot Digital Camera (Silver)</h2></div><ul class="key-features" style="list-style: none; padding: 0px; margin: 8px 8px 12px; color: rgb(55, 55, 55); font-size: 12px !important; overflow: hidden; font-family: Tahoma; font-weight: normal; line-height: normal; text-align: start; word-spacing: 0px; "><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">6X optical zoom</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">20.1 effective mega pixels</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">HD movie (720p)</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">2.7</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">intelligent auto</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">party mode</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">picture effect</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">beauti effect</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">sweep panorama</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">SUPC: <span id="hightLightSupc">SDL879998630</span></li></ul></h3>', '', '', 0, 1, 10, '', '', '', 1, 73, 76, 0, 2, 157, 1, 1800, 2000, 200, 10, 0, 0, 0, 0, 0, 9, 1000, 1391594067, 14, 1, 1, '3 - 5', 421, 0, 0, 1, 1),
(2, 'Amkette Ergo Wireless Mouse', 'Amkette_Ergo_Wireless_Mouse', 'MFP6waOB', '<div id="specifications" class="item_left_column" ><h2 > Amkette Ergo Wireless Mouse (Red)<label class="lang prod-desc-lang" style="cursor: inherit !important;"></label></a></h2></div><div class="details-content" style="font-size: 13px !important; color: rgb(0, 0, 0); font-family: Tahoma; font-weight: normal; line-height: normal; text-align: start; text-transform: none; "><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "></p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; ">Amkette'' Ergo Wireless Mouse gives you amazing wireless freedom. With an innovative design offering a super comfortable grip, it boasts of smart power saving technology. The high-precision sensors assure smooth and accurate movement and the 2.4 GHz advanced RF technology promises high performance every time. The wireless mouse has a high resolution of 1000 dpi and has multiple-surface tracking ability.</p><p style="padding: 0px 8px; line-height: 20px !important; color: rgb(46, 46, 46) !important; font-family: tahoma !important; "><div class="textheadings" style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(202, 202, 202); padding: 6px 0px; margin-bottom: 10px; color: rgb(0, 0, 0); font-family: Tahoma; font-size: medium; line-height: normal; "><h2 style="font-size: 15px !important; color: rgb(21, 21, 21); padding: 6px 0px !important; line-height: 20px !important; margin: 0px; word-wrap: break-word; ">Product Summary of Amkette Ergo Wireless Mouse (Red)</h2></div><ul class="key-features" style="list-style: none; padding: 0px; margin: 8px 8px 12px; color: rgb(55, 55, 55); font-size: 12px !important; overflow: hidden; font-family: Tahoma; line-height: normal; "><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Plug-n-forget Nano receiver</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">High 1000 dpi resolution</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Ergonomic Design</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Superior Grip</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Multiple Surface Tracking</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">2.4 GHz Advanced Wireless</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">Smart Power Saving</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">10 meters of wireless freedom</li><li style="background-image: url(http://i3.sdlcdn.com/img/snapdeal/pdp/productList_small.gif); padding: 0px 15px 0px 9px; float: left; width: 340px; margin: 2px 0px; line-height: 11pt; color: rgb(93, 93, 93); background-position: 0% 8px; background-repeat: no-repeat no-repeat; ">SUPC: <span id="hightLightSupc">SDL291139028</span></li></ul></p></div><table cellspacing="0" class="fk-specs-type2" style="color: rgb(132, 132, 132); font-family: inherit; line-height: inherit; font-size: 10pt; font-style: inherit; font-variant: inherit; font-weight: normal; margin: 0px 0px 30px; padding: 0px; border: 0px; vertical-align: baseline; border-collapse: collapse; border-spacing: 0px; width: 729px; "><tbody style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><tr style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><th class="group-head" colspan="2" style="margin: 0px; padding: 5px; border: 1px solid rgb(249, 249, 249); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; background-color: rgb(249, 249, 249); "><br></th></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr><tr class="" style="margin: 0px; padding: 0px; border: 0px; font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: baseline; "><td class="specs-key" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-style: dotted solid dotted none; border-top-color: rgb(201, 201, 201); border-right-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; width: 172px; "><br></td><td class="specs-value fk-data" style="margin: 0px; padding: 5px; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-top-style: dotted; border-bottom-style: dotted; border-left-style: none; border-top-color: rgb(201, 201, 201); border-bottom-color: rgb(201, 201, 201); font-family: inherit; font-size: inherit; font-style: inherit; font-variant: inherit; line-height: inherit; vertical-align: top; "><br></td></tr></tbody></table></h3></div>', '', '', 1, 1, 20, '', '', '', 1, 70, 91, 0, 2, 736, 2, 160, 200, 40, 20, 0, 0, 0, 0, 0, 59, 1000, 1391594338, 14, 1, 1, '3 - 5', 281, 0, 0, 1, 1),
(91, 'USB Dongle', 'USB-Dongle', 'xj5nNure', 'This Modem is really fast. Up to 42mps, the world''s fastest so far.<br>', '', '', 0, 1, 0, '', '', '', 1, 70, 90, 0, 2, 157, 1, 60, 60, 0, 0, 1, 0, 0, 0, 0, 0, 1, 1439801289, 157, 0, 1, '1-2', 0, 0, 0, 1, 1),
(92, 'Beats Studio Headphones', 'Beats-Studio-Headphones', 'rckzDAw5', 'Listen to music as the artist and producer intended to.<br>', '', '', 0, 1, 0, '', '', 'Headphones, Audio, Music, Artist', 1, 71, 86, 0, 2, 157, 1, 100, 100, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1439801721, 157, 1, 1, '1-2', 1, 0, 0, 1, 1),
(93, 'Laptop Bag', 'Laptop-Bag', 'kMiX2CqH', 'This laptop bag is water proof, well cushioned, has a strong material.<br>', '', '', 0, 1, 0, '', '', 'Laptop bag', 1, 70, 88, 0, 2, 157, 1, 75, 80, 5, 6.25, 0, 0, 0, 0, 0, 0, 1, 1439803083, 157, 1, 1, '1-2', 0, 0, 0, 1, 1),
(94, 'Polo Lauren', 'Polo-Lauren', 'CdOCNet7', 'jkfjkfkj', '', '', 0, 1, 0, '', '', '', 2, 112, 121, 0, 2, 157, 1, 13, 15, 2, 13.3333, 1, 0, 0, 0, 0, 1, 1, 1439819663, 157, 1, 1, '1-2', 1, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_policy`
--

CREATE TABLE IF NOT EXISTS `product_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=300 ;

--
-- Dumping data for table `product_policy`
--

INSERT INTO `product_policy` (`id`, `product_id`, `text`) VALUES
(77, 1, 'Occasion : newlaunches'),
(76, 1, 'Battery : Alkaline'),
(75, 1, 'Megapixel : 18.1 MP & Above'),
(74, 1, 'Type : Point & Shoot'),
(73, 1, 'Brand : Sony'),
(82, 2, 'Occasion : Ergonomic'),
(81, 2, 'Connectivity : Wireless'),
(80, 2, 'Brand : Amkette'),
(79, 2, 'Cash on Delivery'),
(95, 3, '1 year manufacturer warranty'),
(94, 3, 'Operating System: Windows 8'),
(117, 4, 'Quad Core Processor'),
(114, 4, '8 MP Primary Camera'),
(115, 4, 'Cash on Delivery'),
(144, 5, 'Occasion - Casual'),
(143, 5, 'Round Neck'),
(142, 5, 'Cash on Delivery'),
(140, 6, 'Full sleeves of this shirt'),
(139, 6, 'Call 1800 208 9898 (toll free) for assistance from our product expert.'),
(138, 6, 'Cash on Delivery'),
(133, 7, 'Pattern - Striped'),
(132, 7, 'Call 1800 208 9898 (toll free) for assistance from our product expert.'),
(131, 7, 'Cash on Delivery'),
(137, 8, 'Occasion - Casual'),
(136, 8, 'Pattern - Checkered'),
(135, 8, 'Cash on Delivery'),
(123, 9, 'Cash on Delivery'),
(122, 9, 'Call 1800 208 9898 (toll free) for assistance from our product expert.'),
(120, 10, 'Pattern - Solid'),
(119, 10, 'Call 1800 208 9898 (toll free) for assistance from our product expert.'),
(118, 10, 'Cash on Delivery'),
(128, 11, 'Occasion - Casual'),
(127, 11, 'Call 1800 208 9898 (toll free) for assistance from our product expert.'),
(126, 11, 'Cash on Delivery'),
(50, 12, 'Cash on Delivery'),
(51, 12, 'Brand : Nature Plush'),
(52, 12, 'Age : 0 to 2 Years,2 Years to 4 Years'),
(53, 12, 'Ideal for : Boys,Girls'),
(54, 12, 'Occasion : Valentine Offers'),
(55, 13, 'Cash on Delivery'),
(56, 13, 'Brand : Fisher-Price'),
(57, 13, 'Ideal for : Boys,Girls'),
(58, 13, 'Age : 0 to 2 Years,2 Years to 4 Years,5 Years to 7 Years'),
(59, 13, 'Type : Musical Toys'),
(60, 13, 'Occasion : Offer'),
(61, 14, 'Brand : Goodway'),
(62, 14, 'Age : Y (2-4)'),
(63, 14, 'Type : T Shirts'),
(64, 14, 'Color : Multi'),
(65, 14, 'Sleeves : Half'),
(67, 15, 'Cash on Delivery'),
(68, 15, 'Brand : Fisher-Price'),
(69, 15, 'Age : 0 to 2 Years,2 Years to 4 Years'),
(70, 15, 'Type : Bouncers'),
(71, 15, 'Ideal For : Boys,Girls'),
(72, 15, 'Occasion : Offer'),
(78, 1, 'Cash on Delivery'),
(83, 2, '1 year manufacturer warranty'),
(93, 3, 'Colour: Glossy Imprint Black Licorice Colour'),
(92, 3, 'Hard Disk Capacity: 500GB'),
(91, 3, 'Screen Size: 14.0-inch'),
(96, 3, 'Weight: 2.2 kg'),
(97, 3, 'RAM: 2GB'),
(116, 4, 'Android Jelly Bean OS'),
(113, 4, '4.5-inch qHD Display'),
(121, 10, 'Occasion - Casual'),
(124, 9, 'Pattern - Solid'),
(125, 9, 'Occasion - Casual'),
(129, 11, 'Pattern  - Solid'),
(130, 11, 'Neck - Fashion Neck'),
(134, 7, 'Occasion - Casual'),
(141, 6, 'Occasion - Formal'),
(145, 5, 'Pattern - Printed'),
(146, 16, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(147, 16, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time'),
(148, 17, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(149, 17, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time. '),
(150, 18, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(151, 18, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time. '),
(152, 19, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(153, 19, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time. '),
(154, 20, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(155, 20, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time. '),
(156, 21, 'For Express Delivery products we are unable to commit a specific time of delivery due to seasonal rush. Please read our Disclaimer section for more details. Choose Midnight & Fixed Time delivery options to ensure time specific delivery'),
(157, 21, 'Since we deliver only Freshly baked cakes, they can be delivered only after noon time.'),
(158, 22, 'Spray Feature'),
(159, 22, 'Teflon Coated Soleplate'),
(160, 22, 'Steam Burst Feature'),
(161, 22, '1200 W Power Consumption'),
(162, 22, '360° Rotation of Base'),
(163, 23, '1000 W Motor Power'),
(164, 23, 'Dust Bag Full Indicator'),
(165, 23, '1 L Dust Capacity'),
(166, 23, '1 Year Eureka Forbes India Warranty '),
(167, 23, 'Cash on Delivery'),
(168, 24, 'Cash on Delivery'),
(169, 24, '5 m Hose Length'),
(170, 24, 'Flow Rate 350 L/hr'),
(171, 24, 'Max Pressure 120 Bar'),
(172, 24, '1500 W Motor Power'),
(173, 25, 'Cash on Delivery'),
(174, 25, '1 Year Prestige India Warranty'),
(175, 25, 'Power Consumption - 2900 W'),
(176, 25, 'Brand - Prestige'),
(177, 26, 'Cash on Delivery'),
(178, 26, 'Ideal For - Junior, Senior'),
(179, 26, 'Depth	0.5 inch'),
(180, 26, 'Other Dimensions	15 inch Diameter'),
(181, 26, 'Material	Top Qaulity Coiled Paper Dart Board'),
(182, 27, 'Cash on Delivery'),
(183, 27, 'Type	Soft Tip'),
(184, 27, 'Ideal For	Unisex'),
(185, 27, 'WARRANTY - 2 Years'),
(186, 28, 'Cash on Delivery'),
(187, 28, 'Sport Type	Cricket'),
(188, 28, 'Ideal For	Men, Women'),
(189, 28, 'Ventilation Type	Channel Ventilation'),
(190, 28, 'Other Helmet Features	Heat Distribution'),
(191, 29, 'Designed for	Intermediate'),
(192, 29, 'Suitable Ground	Hard'),
(193, 29, 'Outer Material	Rubber'),
(194, 29, 'Ideal for	Senior'),
(195, 30, 'Cash on Delivery'),
(196, 30, 'Ideal For	Women''s'),
(197, 30, 'Occasion	Casual'),
(198, 30, 'Pattern	Printed'),
(199, 31, 'Cash on Delivery'),
(200, 31, 'Wash Care : Wash dark colors separately.'),
(201, 31, 'Disclaimer : Product color may slightly vary due to photographic lighting sources or your monitor settings.'),
(202, 32, 'Cash on Delivery'),
(203, 32, 'Sold By YORK EXPORTS LTD'),
(204, 32, 'Brand : Club York '),
(205, 32, 'Color : Pink '),
(206, 33, 'Cash on Delivery'),
(207, 33, 'Brand : Fashionista '),
(208, 33, 'Collars & Neck : Round Neck '),
(209, 34, 'Cash on Delivery'),
(210, 34, 'Brand : SPECIES '),
(211, 34, 'Collars & Neck : Round Neck '),
(212, 35, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(213, 36, 'Available in all  sizes'),
(214, 37, 'Packaging & Delivery  Packaging Detail:	Fedex Pack Delivery Detail:	6-8 Days'),
(215, 38, 'Shipping Cost in India : FREE '),
(216, 38, 'Shipping Cost Outside of India (Rs. ): 50.00 '),
(217, 39, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(218, 40, ''),
(219, 41, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(220, 42, ''),
(221, 43, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(223, 44, ''),
(224, 45, ''),
(225, 46, ''),
(231, 47, ''),
(232, 48, ''),
(233, 49, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(234, 50, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(235, 51, ''),
(236, 52, ''),
(237, 53, ''),
(238, 54, ''),
(239, 55, ''),
(241, 56, ''),
(243, 57, ''),
(244, 58, ''),
(245, 59, ''),
(246, 60, ''),
(247, 61, ''),
(248, 62, ''),
(249, 63, ''),
(251, 64, ''),
(252, 65, ''),
(253, 66, ''),
(254, 67, ''),
(256, 68, ''),
(258, 69, ''),
(259, 70, ''),
(260, 71, ''),
(261, 72, ''),
(262, 73, ''),
(263, 74, ''),
(264, 75, ''),
(265, 76, ''),
(266, 77, ''),
(267, 78, ''),
(268, 79, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(269, 80, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(270, 81, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(271, 82, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(272, 83, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(273, 84, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(274, 85, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(275, 86, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(284, 87, 'cgfghgf'),
(283, 87, 'FREE SHIPPING ON ALL ORDERS OVER RM 50 GUARANTEED WARRANTY'),
(288, 88, 'None'),
(286, 89, ''),
(289, 90, 'None'),
(290, 91, 'None'),
(291, 92, 'None'),
(292, 93, ''),
(293, 94, ''),
(294, 96, ''),
(295, 97, ''),
(296, 98, ''),
(297, 99, ''),
(298, 100, ''),
(299, 101, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE IF NOT EXISTS `product_size` (
  `product_size_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `size_name` varchar(64) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  PRIMARY KEY (`product_size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `deal_id`, `size_name`, `quantity`, `size_id`) VALUES
(35, 1, 'None', 1000, 1),
(36, 2, 'None', 1000, 1),
(201, 101, 'm', 1, 20),
(200, 100, 'm', 1, 20),
(199, 99, 'm', 1, 20),
(198, 98, 'm', 1, 20),
(197, 97, 'None', 1, 1),
(196, 96, 's', 1, 19),
(195, 94, 'm', 0, 20),
(194, 93, 'None', 1, 1),
(193, 92, 'None', 1, 1),
(192, 91, 'None', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` double NOT NULL,
  `type_id` int(11) NOT NULL,
  `module_id` int(1) NOT NULL COMMENT '1-deal,2-product,3-auction',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`rate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `rating`, `type_id`, `module_id`, `user_id`) VALUES
(1, 4, 11, 2, 156),
(2, 3, 5, 2, 156),
(3, 3, 9, 2, 653),
(4, 3, 16, 1, 667),
(5, 5, 1, 1, 717),
(6, 4, 2, 2, 738),
(7, 2, 2, 2, 813),
(8, 3, 7, 2, 812),
(9, 4, 13, 2, 859),
(10, 5, 10, 2, 156),
(11, 4, 8, 2, 890),
(12, 5, 61, 2, 890),
(13, 5, 52, 2, 890),
(14, 5, 67, 2, 156),
(15, 5, 8, 2, 915);

-- --------------------------------------------------------

--
-- Table structure for table `request_fund`
--

CREATE TABLE IF NOT EXISTS `request_fund` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL COMMENT '1-merchant request, 2-affiliate amount request',
  `user_id` int(11) NOT NULL,
  `payment_comments` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date_time` int(10) NOT NULL,
  `request_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-pending, 2-approved, 3-Rejected',
  `payment_status` int(1) NOT NULL DEFAULT '0' COMMENT '1-success, 2-Failure',
  `transaction_date` int(10) NOT NULL,
  `transaction_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `error_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `error_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `error_message` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `default_language` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `contact_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `webmaster_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `noreply_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_page` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `android_page` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `iphone_page` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_fanpage` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `youtube_url` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `analytics_code` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook_app_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_secret_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_api_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_secret_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gmap_api_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_payment_mode` int(1) NOT NULL COMMENT ' 0 - test account 1 - live account',
  `paypal_account_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_api_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_api_signature` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `authorizenet_transaction_key` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `authorizenet_api_id` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `min_fund_request` double NOT NULL,
  `max_fund_request` double NOT NULL,
  `deal_commission` int(2) NOT NULL,
  `currency_symbol` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `referral_amount` float NOT NULL,
  `site_mode` int(1) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1',
  `latitude` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `email_type` int(1) NOT NULL DEFAULT '1' COMMENT '1-Sendgrid,2-Smtp,3-Mailchimp',
  `flat_shipping` int(5) NOT NULL,
  `tax_percentage` int(3) NOT NULL,
  `auction_extend_day` int(3) NOT NULL,
  `auction_alert_day` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `meta_keywords`, `meta_description`, `title`, `theme`, `default_language`, `contact_name`, `contact_email`, `webmaster_email`, `noreply_email`, `phone1`, `phone2`, `facebook_page`, `twitter_page`, `linkedin_page`, `android_page`, `iphone_page`, `facebook_fanpage`, `youtube_url`, `analytics_code`, `facebook_app_id`, `facebook_secret_key`, `twitter_api_key`, `twitter_secret_key`, `gmap_api_key`, `paypal_payment_mode`, `paypal_account_id`, `paypal_api_password`, `paypal_api_signature`, `authorizenet_transaction_key`, `authorizenet_api_id`, `min_fund_request`, `max_fund_request`, `deal_commission`, `currency_symbol`, `currency_code`, `country_code`, `referral_amount`, `site_mode`, `status`, `latitude`, `longitude`, `email_type`, `flat_shipping`, `tax_percentage`, `auction_extend_day`, `auction_alert_day`) VALUES
(1, 'E-Marketplace', 'deals, daily deals, group deals,', 'sell services using multiple ways like group deals, coupons, and social media.', 'E-Marketplace Best deals and Products ', 'default', 'english', 'Nandha', 'contact-sales@ndot.in', 'admin@ndot.com', 'noreply@uniecommerce.com', '+91 960-098-8668', ' +91- 9595959595', 'https://www.facebook.com/UniEcommerce', 'http://twitter.com/UniEcommerce', 'http://www.linkedin.com/company/269461', 'https://play.google.com/store/apps/details?id=com.uniecommerce.uninew.ecommerce', 'https://itunes.apple.com/us/app/uniecommercenew/id592052500?ls=1&mt=8', 'https://www.facebook.com/UniEcommerce', 'http://www.youtube.com/watch?v=QhzrdsS5J9w', '<script type="text/javascript">\n  var _gaq = _gaq || [];\n  _gaq.push([''_setAccount'', ''UA-20025738-1'']);\n  _gaq.push([''_trackPageview'']);\n  (function() {\n    var ga = document.createElement(''script''); ga.type = ''text/javascript''; ga.async = true;\n    ga.src = (''https:'' == document.location.protocol ? ''https://ssl'' : ''http://www'') + ''.google-analytics.com/ga.js'';\n    var s = document.getElementsByTagName(''script'')[0]; s.parentNode.insertBefore(ga, s);\n  })();\n</script>     ', '338122283006323', 'bbf3e41aa6824c590b130c56fbc1c0fb', '291719054236926', 'b24927947a1adc1cff504bd4cbb16968', 'b24927947a1adc1cff504bd4cbb16968', 0, 'haripr_1357394973_biz_api1.gmail.com', '1357395004', 'AVn.D2cvC.MsQAvZRc6lx0CJVtKGAIuUArsExV4UM81uJVNdHaQrEddJ', '3F8R4gtLfrf7763q', '5rBy75ZQDAk9', 12, 150, 0, '$', 'USD', 'US', 20, 1, 1, '11.0168445', '76.955832099', 2, 5, 0, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_info`
--

CREATE TABLE IF NOT EXISTS `shipping_info` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_type` int(1) NOT NULL DEFAULT '1' COMMENT '1- product , 2 auction',
  `transaction_id` int(11) NOT NULL,
  `tracking` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adderss1` varchar(256) NOT NULL,
  `address2` varchar(256) NOT NULL,
  `city` int(11) NOT NULL,
  `state` varchar(256) NOT NULL,
  `country` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `postal_code` int(10) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `shipping_date` varchar(15) NOT NULL,
  `delivery_status` int(1) NOT NULL DEFAULT '0' COMMENT '0-Pending,1-order packed,2-Shipped to center,3-Out of delivery,4-Delivered,5-Failed',
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `shipping_info`
--

INSERT INTO `shipping_info` (`shipping_id`, `shipping_type`, `transaction_id`, `tracking`, `user_id`, `adderss1`, `address2`, `city`, `state`, `country`, `name`, `postal_code`, `phone`, `shipping_date`, `delivery_status`) VALUES
(1, 1, 1, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438697519', 0),
(2, 1, 2, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438783164', 0),
(3, 1, 3, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438783167', 0),
(4, 1, 4, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', ' Live', 899898, '9787272400', '1438788668', 0),
(5, 1, 5, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', ' Live', 899898, '9787272400', '1438789058', 0),
(6, 1, 6, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438926025', 0),
(7, 1, 7, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438926230', 0),
(8, 1, 8, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438926840', 0),
(9, 1, 9, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438926975', 0),
(10, 1, 10, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438927109', 0),
(11, 1, 11, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438927216', 0),
(12, 1, 12, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438927730', 0),
(13, 1, 13, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438927877', 0),
(14, 1, 14, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438928003', 0),
(15, 1, 15, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438928677', 0),
(16, 1, 16, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438932138', 0),
(17, 1, 17, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933324', 0),
(18, 1, 18, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933508', 0),
(19, 1, 19, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933553', 0),
(20, 1, 20, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933590', 0),
(21, 1, 21, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933809', 0),
(22, 1, 22, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438933827', 0),
(23, 1, 23, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438934359', 0),
(24, 1, 24, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438934473', 0),
(25, 1, 25, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438934728', 0),
(26, 1, 26, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438935335', 0),
(27, 1, 27, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438935596', 0),
(28, 1, 28, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438935698', 0),
(29, 1, 29, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438935884', 0),
(30, 1, 30, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438936042', 0),
(31, 1, 31, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438936458', 0),
(32, 1, 32, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438938193', 0),
(33, 1, 33, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1438938678', 0),
(34, 1, 34, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439207279', 0),
(35, 1, 35, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439207289', 0),
(36, 1, 36, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439207704', 0),
(37, 1, 37, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439207714', 0),
(38, 1, 38, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439208020', 0),
(39, 1, 39, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439208031', 0),
(40, 1, 40, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439534423', 0),
(41, 1, 41, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439534431', 0),
(42, 1, 42, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439545990', 0),
(43, 1, 43, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439546623', 0),
(44, 1, 44, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439546629', 0),
(45, 1, 45, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439556085', 0),
(46, 1, 46, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439557745', 2),
(47, 1, 47, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1439557957', 0),
(48, 1, 48, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440317182', 0),
(49, 1, 49, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440322636', 0),
(50, 1, 50, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440322636', 0),
(51, 1, 51, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440323312', 0),
(52, 1, 52, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440323312', 0),
(53, 1, 53, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440396353', 0),
(54, 1, 54, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440396492', 0),
(55, 1, 55, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397029', 0),
(56, 1, 56, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397072', 0),
(57, 1, 57, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397103', 0),
(58, 1, 58, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397161', 0),
(59, 1, 59, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397202', 0),
(60, 1, 60, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397384', 0),
(61, 1, 61, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397422', 0),
(62, 1, 62, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397425', 0),
(63, 1, 63, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397461', 0),
(64, 1, 64, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397553', 0),
(65, 1, 65, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397613', 0),
(66, 1, 66, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397812', 0),
(67, 1, 67, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397823', 0),
(68, 1, 68, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440397882', 0),
(69, 1, 69, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398144', 0),
(70, 1, 70, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398263', 0),
(71, 1, 71, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398387', 0),
(72, 1, 72, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398542', 0),
(73, 1, 73, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398619', 0),
(74, 1, 74, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440398900', 0),
(75, 1, 75, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399166', 0),
(76, 1, 76, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399220', 0),
(77, 1, 77, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399444', 0),
(78, 1, 78, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399637', 0),
(79, 1, 79, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399806', 0),
(80, 1, 80, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440399962', 0),
(81, 1, 81, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440400230', 0),
(82, 1, 82, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440400297', 0),
(83, 1, 83, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440400566', 0),
(84, 1, 84, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440400915', 0),
(85, 1, 85, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401096', 0),
(86, 1, 86, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401165', 0),
(87, 1, 87, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401328', 0),
(88, 1, 88, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401610', 0),
(89, 1, 89, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401662', 0),
(90, 1, 90, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440401860', 0),
(91, 1, 91, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440402077', 0),
(92, 1, 92, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440402362', 0),
(93, 1, 93, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440402514', 0),
(94, 1, 94, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440402590', 0),
(95, 1, 95, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440402789', 0),
(96, 1, 96, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440403109', 0),
(97, 1, 97, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440403472', 0),
(98, 1, 98, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440403568', 0),
(99, 1, 99, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440403846', 0),
(100, 1, 100, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440403961', 0),
(101, 1, 101, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440404287', 0),
(102, 1, 102, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440423011', 0),
(103, 1, 103, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440423021', 0),
(104, 1, 104, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440424347', 0),
(105, 1, 105, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440424904', 0),
(106, 1, 106, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440424913', 0),
(107, 1, 107, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440425079', 0),
(108, 1, 108, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440425087', 0),
(109, 1, 109, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440425652', 0),
(110, 1, 110, '', 933, 'New Orleans', 'Kamper', 1, 'Juicy', 'US', 'Live', 899898, '9787272400', '1440425662', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_module_settings`
--

CREATE TABLE IF NOT EXISTS `shipping_module_settings` (
  `ship_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_user_id` int(11) NOT NULL,
  `free` int(1) NOT NULL DEFAULT '1',
  `flat` int(1) NOT NULL DEFAULT '1',
  `per_product` int(1) NOT NULL DEFAULT '1',
  `per_quantity` int(1) NOT NULL DEFAULT '1',
  `aramex` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ship_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `shipping_module_settings`
--

INSERT INTO `shipping_module_settings` (`ship_module_id`, `ship_user_id`, `free`, `flat`, `per_product`, `per_quantity`, `aramex`) VALUES
(1, 157, 1, 1, 1, 1, 1),
(2, 159, 1, 1, 1, 1, 1),
(3, 737, 1, 1, 1, 1, 1),
(4, 921, 1, 1, 0, 1, 0),
(5, 922, 1, 1, 0, 1, 0),
(6, 923, 1, 1, 1, 1, 0),
(7, 932, 1, 1, 1, 1, 0),
(8, 934, 1, 1, 1, 1, 0),
(9, 935, 1, 1, 1, 1, 0),
(10, 936, 1, 1, 1, 1, 0),
(11, 937, 1, 1, 1, 1, 0),
(12, 938, 1, 1, 1, 1, 0),
(13, 939, 1, 1, 1, 1, 0),
(14, 940, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(256) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`) VALUES
(10, '7'),
(2, '8'),
(3, '9'),
(4, '10'),
(5, '11'),
(6, '32'),
(8, '46'),
(9, '36'),
(1, 'None'),
(20, 'm'),
(19, 's'),
(17, '50'),
(21, 'l');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `store_url_title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `store_key` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(5) NOT NULL,
  `country_id` int(5) NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `store_type` int(1) NOT NULL COMMENT '1-Main, 2 - Branch',
  `merchant_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` int(10) NOT NULL,
  `store_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`store_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_name`, `store_url_title`, `store_key`, `address1`, `address2`, `city_id`, `country_id`, `phone_number`, `zipcode`, `website`, `meta_keywords`, `meta_description`, `latitude`, `longitude`, `store_type`, `merchant_id`, `created_by`, `created_date`, `store_status`) VALUES
(1, 'Crabtree & Evelyn', 'Crabtree_Evelyn', 'b2uN0m3s', '1656 Union Street, Eureka.', '111 Grand Avenue, Oakland.', 1, 3, '9787272400', '3700', 'http://demo.uniecommerce.com/', 'Good Store', 'Good Store', '37.80978', '-122.28882', 1, 157, 14, 1351514002, 1),
(2, 'American Apparel', 'American_Apparel', 'wKGY76ba', '8605 Santa Monica Blvd, Los Angeles.', '805 Santa Monica, Los Angeles.', 3, 3, '7845232663', '515381', 'http://www.cityshop.com', 'store,deal', '', '34.02535', '-118.48480', 1, 736, 14, 1351578526, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(300) NOT NULL,
  `module_type` int(11) NOT NULL,
  `tags_count` varchar(300) NOT NULL DEFAULT '0',
  `tags_status` int(1) NOT NULL DEFAULT '1' COMMENT '1=>active, 0=>deactive',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `payer_id` varchar(25) NOT NULL,
  `payer_status` varchar(25) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `correlation_id` varchar(50) NOT NULL,
  `acknowledgement` varchar(25) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `recipt_id` varchar(50) NOT NULL,
  `transaction_type` varchar(25) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `order_date` int(10) NOT NULL,
  `amount` double NOT NULL,
  `referral_amount` double NOT NULL,
  `bid_amount` double NOT NULL,
  `shipping_amount` double NOT NULL,
  `shipping_methods` int(1) NOT NULL,
  `tax_amount` float NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `pending_reason` varchar(100) NOT NULL,
  `reason_code` varchar(50) NOT NULL,
  `paypal_email` varchar(256) NOT NULL,
  `quantity` int(5) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1-CREDITCARD,2-PAYPAL, 3- REFER PAY, 4 - AUTHORIZE.NET',
  `captured` int(1) NOT NULL COMMENT '0-NO,1-YES',
  `captured_transaction_id` varchar(50) NOT NULL,
  `captured_date` int(10) NOT NULL,
  `captured_correlation_id` varchar(50) NOT NULL,
  `captured_ack` varchar(50) NOT NULL,
  `captured_payment_type` varchar(100) NOT NULL,
  `captured_payment_status` varchar(100) NOT NULL,
  `captured_pending_reason` text NOT NULL,
  `friend_gift_status` int(1) NOT NULL DEFAULT '0',
  `deal_merchant_commission` int(11) NOT NULL,
  `coupon_mail_sent` int(1) NOT NULL DEFAULT '0',
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  `aramex_currencycode` varchar(3) NOT NULL,
  `aramex_value` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `deal_id`, `product_id`, `auction_id`, `payer_id`, `payer_status`, `country_code`, `currency_code`, `transaction_date`, `correlation_id`, `acknowledgement`, `firstname`, `lastname`, `transaction_id`, `recipt_id`, `transaction_type`, `payment_type`, `order_date`, `amount`, `referral_amount`, `bid_amount`, `shipping_amount`, `shipping_methods`, `tax_amount`, `payment_status`, `pending_reason`, `reason_code`, `paypal_email`, `quantity`, `type`, `captured`, `captured_transaction_id`, `captured_date`, `captured_correlation_id`, `captured_ack`, `captured_payment_type`, `captured_payment_status`, `captured_pending_reason`, `friend_gift_status`, `deal_merchant_commission`, `coupon_mail_sent`, `product_size`, `product_color`, `aramex_currencycode`, `aramex_value`) VALUES
(110, 933, 0, 1, 0, '', '', 'US', 'USD', 1440425662, '', '', 'Live Shallbe', 'Live Shallbe', 'mTpjs7gtIcqrBAMe', '', 'COD', '', 1440425662, 1800, 0, 0, 0, 1, 0, 'Pending', 'Cash on delivery', '', '', 1, 5, 0, '', 0, '', '', '', '', '', 0, 0, 0, 0, 0, '0', 0),
(109, 933, 0, 2, 0, '', '', 'US', 'USD', 1440425652, '', '', 'Live Shallbe', 'Live Shallbe', 'Is4risOT5I4E1Z5g', '', 'COD', '', 1440425652, 160, 0, 0, 0, 1, 0, 'Pending', 'Cash on delivery', '', '', 1, 5, 0, '', 0, '', '', '', '', '', 0, 0, 0, 0, 0, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mapping`
--

CREATE TABLE IF NOT EXISTS `transaction_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `coupon_code` varchar(11) NOT NULL,
  `transaction_date` int(10) NOT NULL,
  `coupon_code_status` int(1) NOT NULL DEFAULT '1',
  `friend_name` varchar(64) NOT NULL,
  `friend_email` varchar(64) NOT NULL,
  `product_size` int(11) NOT NULL,
  `product_color` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `transaction_mapping`
--

INSERT INTO `transaction_mapping` (`id`, `deal_id`, `product_id`, `auction_id`, `user_id`, `transaction_id`, `coupon_code`, `transaction_date`, `coupon_code_status`, `friend_name`, `friend_email`, `product_size`, `product_color`) VALUES
(110, 0, 1, 0, 933, '110', 'Qe4ya1fI', 1440425662, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0),
(109, 0, 2, 0, 933, '109', '589UyKFd', 1440425652, 1, 'xxxyyy', 'xxxyyy@zzz.com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fb_user_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `fb_session_key` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_access_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_secret_token` int(100) NOT NULL,
  `address1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(5) NOT NULL DEFAULT '0',
  `country_id` int(5) NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `my_favouites` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `payment_account_id` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `user_referral_balance` double NOT NULL,
  `merchant_account_balance` double NOT NULL,
  `merchant_commission` double NOT NULL COMMENT 'merchant commission',
  `referral_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `referred_user_id` int(11) NOT NULL,
  `deal_bought_count` int(5) NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT '4' COMMENT '1-Website-Admin, 2-CityAdmin, 3-Merchant, 4-users',
  `user_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-active,0-deactive',
  `login_type` int(1) NOT NULL DEFAULT '1' COMMENT '1-direct, 2-admin, 3-facebook, 4-twitter',
  `joined_date` int(10) NOT NULL,
  `last_login` int(10) NOT NULL,
  `facebook_update` int(1) NOT NULL DEFAULT '0' COMMENT '1-active 0-Dactive',
  `approve_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-approve,0-disapprove',
  `wishlist` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ship_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_address1` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_address2` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_state` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ship_country` int(11) NOT NULL,
  `ship_city` int(11) NOT NULL,
  `ship_mobileno` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `ship_zipcode` bigint(11) NOT NULL,
  `AccountCountryCode` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `AccountEntity` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `AccountNumber` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `AccountPin` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `UserName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ShippingPassword` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `flat_amount` double NOT NULL,
  `club_member` int(11) NOT NULL,
  `nuban` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=942 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `fb_user_id`, `fb_session_key`, `twitter_id`, `twitter_access_token`, `twitter_secret_token`, `address1`, `address2`, `city_id`, `country_id`, `phone_number`, `my_favouites`, `payment_account_id`, `user_referral_balance`, `merchant_account_balance`, `merchant_commission`, `referral_id`, `referred_user_id`, `deal_bought_count`, `created_by`, `user_type`, `user_status`, `login_type`, `joined_date`, `last_login`, `facebook_update`, `approve_status`, `wishlist`, `ship_name`, `ship_address1`, `ship_address2`, `ship_state`, `ship_country`, `ship_city`, `ship_mobileno`, `ship_zipcode`, `AccountCountryCode`, `AccountEntity`, `AccountNumber`, `AccountPin`, `UserName`, `ShippingPassword`, `flat_amount`, `club_member`, `nuban`) VALUES
(14, 'Adminn', '', 'admin@ndot.in', '21232f297a57a5a743894a0e4a801fc3', '0', '0', '', '', 0, 'Wajeda house, Gr. Floor', 'Gulmohar Cross Rd. No. 7', 3, 3, '+1 (323) 982-894', '', 'admin@ndot.in', 0, 24527, 0, '', 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, '', 0, 'SA', 'JED', '6004985', '553654', 'eng_ibrahim@hk301.com', 'amih2363439', 0, 0, ''),
(933, 'Live Shallbe', '', 'shallbe@swifta.com', 'eb42ed1f6fffddee080144a9fe281425', '', '', '', '', 0, '', '', 1, 3, '', '', '', 0, 0, 0, 'yFP4bd8B', 0, 0, 0, 4, 1, 1, 1438595536, 1438595536, 0, 1, '', 'Live', 'New Orleans', 'Kamper', 'Juicy', 3, 1, '9787272400', 899898, '', '', '', '', '', '', 1, 1, '8787878787'),
(736, 'Just me', 'Live', 'pksks@gmail.com', 'eb42ed1f6fffddee080144a9fe281425', '', '', '', '', 0, 'K/A', 'N/A', 1, 3, '9787272400', '', 'ppounds1@gmail.com', 0, 0, 0, '', 0, 0, 0, 3, 1, 2, 1438699314, 0, 0, 0, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, 0, ''),
(157, 'Just', 'Lucy', 'ppounds1@gmail.com', 'eb42ed1f6fffddee080144a9fe281425', '', '', '', '', 0, 'N/A', 'N/A', 1, 3, '9787272400', '', 'ppounds1@gmail.com', 0, 0, 0, '', 0, 0, 0, 3, 1, 2, 1439201095, 0, 0, 0, '', '', '', '', '', 0, 0, '', 0, '', '', '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `view_count_location`
--

CREATE TABLE IF NOT EXISTS `view_count_location` (
  `view_id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_key` varchar(32) NOT NULL,
  `product_key` varchar(32) NOT NULL,
  `auction_key` varchar(35) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `city` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `date` int(20) NOT NULL,
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `view_count_location`
--

INSERT INTO `view_count_location` (`view_id`, `deal_key`, `product_key`, `auction_key`, `ip`, `city`, `country`, `date`) VALUES
(1, '', '0NLKFwnw', '', '::1', '', '', 1438595291),
(2, '', '0xzLtwic', '', '::1', '', '', 1438595300),
(3, '', 'UoRMm6hX', '', '::1', '', '', 1438602965),
(4, '', 'mEwY0GLd', '', '::1', '', '', 1438615985),
(5, '', 'FssxcN6e', '', '::1', '', '', 1438616017),
(6, '', 'ib6ut8M1', '', '::1', '', '', 1438616064),
(7, '', '28v3nWdx', '', '::1', '', '', 1438661550),
(8, '', 'DWXi0ETc', '', '::1', '', '', 1438661554),
(9, '', 'n0cDRn8K', '', '::1', '', '', 1438674933),
(10, '', 'es2nqUG3', '', '::1', '', '', 1438674966),
(11, '', 'bH3y63PE', '', '::1', '', '', 1438675081),
(12, '', 'Jm5xUQrV', '', '::1', '', '', 1438675086),
(13, '', 'R4ufBmyV', '', '::1', '', '', 1438675090),
(14, '', 'qbh6MGtq', '', '::1', '', '', 1438675638),
(15, '', '7PK6QacI', '', '::1', '', '', 1438680377),
(16, '', 'Pyw1tguj', '', '::1', '', '', 1438680999),
(17, '', 'e1AanVzK', '', '::1', '', '', 1438699392),
(18, '', 'SY1sbIxy', '', '::1', '', '', 1438699407),
(19, '', 'gYASP6XN', '', '::1', '', '', 1438788893),
(20, '', 'K0DK23A0', '', '::1', '', '', 1438931986),
(21, '', 'D9rZgFBf', '', '::1', '', '', 1438931995),
(22, '', 'uigwol2k', '', '::1', '', '', 1438934286),
(23, '', 'yky4G6po', '', '::1', '', '', 1438938144),
(24, '', 'wSyux9fG', '', '::1', '', '', 1439206502),
(25, '', 'b7V9mTjO', '', '::1', '', '', 1439206566),
(26, '', 'YGrBT9oC', '', '::1', '', '', 1439206660),
(27, '', 'G7EepdpF', '', '::1', '', '', 1439475258),
(28, '', 'wSyux9fG', '', '127.0.0.1', '', '', 1439534303),
(29, '', 'yky4G6po', '', '127.0.0.1', '', '', 1439534327),
(30, 'F1lbHote', '', '', '127.0.0.1', '', '', 1439545796),
(31, '', 'MFP6waOB', '', '127.0.0.1', '', '', 1439545865),
(32, '153XhYAU', '', '', '127.0.0.1', '', '', 1439546945),
(33, '', 'mZLzKPH4', '', '::1', '', '', 1440045075),
(34, '', 'MFP6waOB', '', '::1', '', '', 1440064922),
(35, 'F1lbHote', '', '', '::1', '', '', 1440320627),
(36, '', 'CdOCNet7', '', '::1', '', '', 1440322270),
(37, '', 'rckzDAw5', '', '::1', '', '', 1440422957);

-- --------------------------------------------------------

--
-- Table structure for table `x`
--

CREATE TABLE IF NOT EXISTS `x` (
  `x` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`x`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zenith_opened_account`
--

CREATE TABLE IF NOT EXISTS `zenith_opened_account` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_number` int(10) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_class` int(11) NOT NULL,
  `dating` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=990 ;

--
-- Dumping data for table `zenith_opened_account`
--

INSERT INTO `zenith_opened_account` (`user_id`, `account_number`, `account_name`, `account_class`, `dating`) VALUES
(933, 2147483647, 'DUMMY NAME', 57, '2015-08-25 07:05:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
