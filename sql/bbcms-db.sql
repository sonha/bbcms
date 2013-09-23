-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: Sep 23, 2013 at 08:57 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbcms`
--
CREATE DATABASE IF NOT EXISTS `bbcms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bbcms`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `showon_menu` tinyint(3) NOT NULL,
  `showon_homepage` int(11) NOT NULL,
  `list_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_layout` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `showon_menu`, `showon_homepage`, `list_layout`, `item_layout`, `status`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'BB CMS', 'bb-cms', 1, 1, NULL, NULL, 'on', 1, '2013-09-20 07:59:49', '2013-09-23 02:43:09', NULL),
(2, 0, 'Blog', 'blog', 1, 1, NULL, NULL, 'on', 1, '2013-09-20 07:59:57', '2013-09-20 10:29:02', NULL),
(3, 1, 'version 1.0', 'version-10', 1, 1, NULL, NULL, 'on', 1, '2013-09-20 13:56:48', '2013-09-20 13:56:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE `category_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_con_unique` (`category_id`,`post_id`),
  KEY `category_content_content_id_foreign` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `category_id`, `post_id`, `created_at`, `updated_at`) VALUES
(22, 1, 1, '2013-09-23 12:40:25', '2013-09-23 12:40:25'),
(21, 3, 3, '2013-09-23 10:18:09', '2013-09-23 10:18:09'),
(20, 1, 3, '2013-09-23 10:18:09', '2013-09-23 10:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `post_id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 'Đ&acirc;y l&agrave; b&igrave;nh luận đầu ti&ecirc;n.', 'on', '2013-09-20 11:53:01', '2013-09-20 11:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '{"users":1,"news.create":1,"admin":1,"user.create":1,"user.edit":1,"user.detele":1,"group.create":1,"group.edit":1,"group.detele":1,"news.edit":1,"news.editpublish":1,"news.editowner":1,"news.delete":1,"news.publish":1,"news.editcategory":1,"news.deletecategory":1,"news.editcomment":1,"pages.create":1,"pages.edit":1,"pages.delete":1,"news.deletecomment":1,"medias.upload":1,"medias.edit":1,"medias.delete":1,"news.createcategory":1,"news.createtag":1,"news.edittag":1,"news.deletetag":1}', '2013-09-12 03:36:59', '2013-09-23 09:22:00'),
(2, 'Biên tập viên', '{"news.create":1}', '2013-09-12 03:41:04', '2013-09-20 12:36:03'),
(3, 'Phóng viên', '{"admin":1,"news.edit":1,"news.editcomment":1,"news.deletecomment":1}', '2013-09-20 12:36:18', '2013-09-21 01:41:35'),
(4, 'Thành viên', '', '2013-09-20 12:36:52', '2013-09-20 12:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mpath` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `title`, `mpath`, `mname`, `user_id`, `created_at`, `updated_at`) VALUES
(10, '', 'uploads/medias/2013/09/23', '23.09.2013_bb_1379950344.jpg', 1, '2013-09-23 08:32:24', '2013-09-23 08:32:24'),
(9, '', 'uploads/medias/2013/09/23', '23.09.2013_bb_1379950326.jpg', 1, '2013-09-23 08:32:07', '2013-09-23 08:32:07'),
(3, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379712966.png', 1, '2013-09-20 14:36:07', '2013-09-20 14:36:07'),
(4, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379712998.png', 1, '2013-09-20 14:36:39', '2013-09-20 14:36:39'),
(5, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379713015.png', 1, '2013-09-20 14:36:55', '2013-09-20 14:36:55'),
(6, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379713028.png', 1, '2013-09-20 14:37:09', '2013-09-20 14:37:09'),
(7, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379713037.png', 1, '2013-09-20 14:37:17', '2013-09-20 14:37:17'),
(8, '', 'uploads/medias/2013/09/20', '20.09.2013_bb_1379713051.png', 1, '2013-09-20 14:37:32', '2013-09-20 14:37:32'),
(11, '', 'uploads/medias/2013/09/23', '23.09.2013_bb_1379950459.jpg', 1, '2013-09-23 08:34:20', '2013-09-23 08:34:20'),
(12, '', 'uploads/medias/2013/09/23', '23.09.2013_bb_1379951318.jpg', 1, '2013-09-23 08:48:39', '2013-09-23 08:48:39'),
(13, '', 'uploads/medias/2013/09/23', '23.09.2013_bb_1379951796.jpg', 1, '2013-09-23 08:56:37', '2013-09-23 08:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 1),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 1),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 1),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 1),
('2013_01_19_011903_create_posts_table', 2),
('2013_01_19_044505_create_comments_table', 2),
('2013_03_23_193214_update_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8_unicode_ci NOT NULL,
  `media_id` int(11) NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_popular` tinyint(1) NOT NULL DEFAULT '0',
  `showon_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'post',
  `publish_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `content`, `excerpt`, `media_id`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `allow_comments`, `is_featured`, `is_popular`, `showon_homepage`, `comment_count`, `post_type`, `publish_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'BBCMS phi&ecirc;n bản 1.0', 'bbcms-phien-ban-10', '<p><span style="line-height: 1.6em;">L&agrave; ứng dụng ph&aacute;t triển dựa tr&ecirc;n framework m&atilde; nguồn mở </span><a href="http://laravel.com/" style="line-height: 1.6em;">Laravel 4</a><span style="line-height: 1.6em;">.</span></p>\r\n\r\n<h2>Chức năng</h2>\r\n\r\n<ul>\r\n	<li>Twitter Bootstrap 3</li>\r\n	<li>jQuery 1.10.2</li>\r\n	<li>T&ugrave;y biến&nbsp;Error Pages:\r\n	<ul>\r\n		<li>403</li>\r\n		<li>404</li>\r\n		<li>500</li>\r\n		<li>503</li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>Editor</strong>\r\n	<ul>\r\n		<li>Quản l&yacute; người d&ugrave;ng v&agrave; nh&oacute;m người d&ugrave;ng\r\n		<ul>\r\n			<li>Th&ecirc;m sửa x&oacute;a người d&ugrave;ng</li>\r\n			<li>Ph&acirc;n quyền người d&ugrave;ng cụ thể</li>\r\n			<li>Th&ecirc;m sửa x&oacute;a nh&oacute;m người d&ugrave;ng</li>\r\n			<li>Ph&acirc;n quyền nh&oacute;m người d&ugrave;ng</li>\r\n		</ul>\r\n		</li>\r\n		<li>Quản l&yacute; tin\r\n		<ul>\r\n			<li>Đăng tin, x&eacute;t duyệt tin, xuất bản tin (theo ph&acirc;n quyền)</li>\r\n		</ul>\r\n		</li>\r\n		<li>Quản l&yacute; chuy&ecirc;n mục (đa cấp)</li>\r\n		<li>Quản l&yacute; b&igrave;nh luận</li>\r\n		<li>Quản l&yacute; thư viện\r\n		<ul>\r\n			<li>Tải ảnh, đặt đại diện</li>\r\n			<li>Thư viện theo người d&ugrave;ng</li>\r\n		</ul>\r\n		</li>\r\n		<li>Quản l&yacute; trang</li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>Hệ thống đăng nhập</strong>\r\n	<ul>\r\n		<li>Đăng nhập</li>\r\n		<li>Đăng k&yacute;</li>\r\n		<li>Lấy lại mật khẩu</li>\r\n		<li>K&iacute;ch hoạt người d&ugrave;ng</li>\r\n	</ul>\r\n	</li>\r\n	<li><strong>T&agrave;i khoản người d&ugrave;ng</strong></li>\r\n	<li><strong>Trang li&ecirc;n hệ</strong></li>\r\n	<li><strong><a href="https://github.com/cartalyst/sentry">Cartalyst Sentry 2</a></strong></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Y&ecirc;u cầu hệ thống​</h2>\r\n\r\n<ul>\r\n	<li>PHP 5.3.7 or later</li>\r\n	<li>MCrypt PHP Extension</li>\r\n</ul>\r\n\r\n<h2><br />\r\nC&agrave;i đặt</h2>\r\n\r\n<p><em>đang cập nhật...</em><br />\r\n&nbsp;</p>\r\n\r\n<h2>Một số h&igrave;nh ảnh về BBCMS</h2>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379712876.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379712966.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379712998.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center">&nbsp;</p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379713015.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379713028.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379713037.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p align="center"><img src="/uploads/medias/2013/09/20/520x500/20.09.2013_bb_1379713051.png" style="padding: 10px 0; width: 500px; text-align: center" /></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Chỉ bao gồm các thành phần cơ bản nhất của 1 editor. Bước đầu giúp các lập trình viên xây dựng các ứng dụng web về trang thông tin tổng hợp, tòa soạn điện tử mini, các trang thông tin doanh nghiệp...', 8, '', '', '', 'published', 1, 1, 1, 1, 0, 'post', '2013-09-21 14:40:17', '2013-09-20 10:29:31', '2013-09-23 12:40:25', NULL),
(2, 1, 0, 'Giới thiệu', 'gioi-thieu', '<p>Giới thiệu</p>\r\n', 'Giới thiệu', 0, NULL, NULL, NULL, 'hidden', 1, 0, 0, 0, 0, 'page', '2013-09-23 09:39:05', '2013-09-23 02:26:17', '2013-09-23 02:39:05', NULL),
(3, 1, 0, 'Hướng dẫn c&agrave;i đặt', 'huong-dan-cai-dat', '<p>Hướng dẫn c&agrave;i đặt</p>\r\n', 'Hướng dẫn cài đặt', 0, '', '', '', 'published', 0, 0, 0, 0, 0, 'post', '2013-09-22 17:00:00', '2013-09-23 07:41:07', '2013-09-23 10:18:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'tag',
  `status` varchar(5) NOT NULL DEFAULT 'on',
  `news_count` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `status`, `news_count`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Chống tham nhũng', 'chong-tham-nhung', 'topic', 'on', 0, 1, '2013-09-23 16:26:53', '2013-09-23 09:26:53'),
(2, 'thời gian c&ocirc;ng sở m&ugrave;a đ&ocirc;ng', 'thoi-gian-cong-so-mua-dong', 'topic', 'on', 0, 1, '2013-09-23 11:52:56', '2013-09-23 11:52:56'),
(3, 'Sao lộ h&agrave;ng', 'sao-lo-hang', 'topic', 'on', 0, 1, '2013-09-23 11:53:56', '2013-09-23 11:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `tag_post`
--

CREATE TABLE `tag_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tag_post`
--

INSERT INTO `tag_post` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(2, 3, 1, '2013-09-23 11:38:25', '2013-09-23 11:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 1, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(2, 3, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `deleted_at`, `website`, `country`, `gravatar`) VALUES
(1, 'binhbeer@taymay.vn', '', '$2y$10$Ybkr8jdakkvUd4EXBPP4aeaLA/iiD5kMGONiNC0o8ym3h.9ejLAY.', '{"admin":1,"user":1}', 1, NULL, NULL, '2013-09-20 23:35:22', '$2y$10$tiJOSVBOZI.48Fce2AWX8eIEHJIU04gL3HdToDimS9ZkZm.9gW7uq', NULL, 'Binh', 'BEER', '2013-09-12 03:37:00', '2013-09-20 23:35:22', NULL, 'http://taymay.vn', 'Viet Nam', ''),
(2, 'blacksheep@example.com', '', '$2y$10$3oMfmNfE9eYo496zd/Z71.jPbsbYNNRs9or6lwgEFdD7qlnxnMede', '{"superuser":-1}', 1, NULL, NULL, NULL, NULL, NULL, 'Black', 'Sheep', '2013-09-12 03:37:00', '2013-09-19 21:16:36', NULL, NULL, NULL, NULL),
(3, 'member@test.com', '', '$2y$10$JbIWOUdbUBr/RRp4ccyuluaLhs4yoJg8ig29IDseMRmtC4ViejUGC', '', 1, 'P0qZAEAfpfiLQvHVPGAeALt1fD3DHj5oiQZ4Rmx5Tz', NULL, '2013-09-20 12:38:01', '$2y$10$VW2ts2PsJaNGsBASjEMOcu/BrK0RWyX3qJHXXJu6hlD9mmR7STCXe', NULL, 'member', 'test', '2013-09-20 12:13:47', '2013-09-23 08:20:47', '2013-09-23 08:20:47', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
