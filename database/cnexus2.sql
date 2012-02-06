-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2012 at 03:28 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cnexus2`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(87, NULL, NULL, NULL, 'controllers', 1, 168),
(88, 87, NULL, NULL, 'Categories', 2, 15),
(89, 88, NULL, NULL, 'admin_index', 3, 4),
(90, 88, NULL, NULL, 'admin_add', 5, 6),
(91, 88, NULL, NULL, 'admin_edit', 7, 8),
(92, 88, NULL, NULL, 'admin_delete', 9, 10),
(93, 88, NULL, NULL, 'admin_movedown', 11, 12),
(94, 88, NULL, NULL, 'admin_moveup', 13, 14),
(95, 87, NULL, NULL, 'Contents', 16, 31),
(96, 95, NULL, NULL, 'index', 17, 18),
(97, 95, NULL, NULL, 'admin_index', 19, 20),
(98, 95, NULL, NULL, 'admin_add', 21, 22),
(99, 95, NULL, NULL, 'admin_edit', 23, 24),
(100, 95, NULL, NULL, 'admin_delete', 25, 26),
(101, 95, NULL, NULL, 'admin_movedown', 27, 28),
(102, 95, NULL, NULL, 'admin_moveup', 29, 30),
(103, 87, NULL, NULL, 'Dashboard', 32, 37),
(104, 103, NULL, NULL, 'index', 33, 34),
(105, 103, NULL, NULL, 'admin_index', 35, 36),
(106, 87, NULL, NULL, 'Engadgets', 38, 47),
(107, 106, NULL, NULL, 'admin_index', 39, 40),
(108, 106, NULL, NULL, 'admin_manager', 41, 42),
(109, 106, NULL, NULL, 'admin_install', 43, 44),
(110, 106, NULL, NULL, 'admin_uninstall', 45, 46),
(111, 87, NULL, NULL, 'Menus', 48, 63),
(112, 111, NULL, NULL, 'admin_index', 49, 50),
(113, 111, NULL, NULL, 'admin_liststype', 51, 52),
(114, 111, NULL, NULL, 'admin_add', 53, 54),
(115, 111, NULL, NULL, 'admin_edit', 55, 56),
(116, 111, NULL, NULL, 'admin_delete', 57, 58),
(117, 111, NULL, NULL, 'admin_movedown', 59, 60),
(118, 111, NULL, NULL, 'admin_moveup', 61, 62),
(119, 87, NULL, NULL, 'Menutypes', 64, 73),
(120, 119, NULL, NULL, 'admin_index', 65, 66),
(121, 119, NULL, NULL, 'admin_add', 67, 68),
(122, 119, NULL, NULL, 'admin_edit', 69, 70),
(123, 119, NULL, NULL, 'admin_delete', 71, 72),
(124, 87, NULL, NULL, 'Pages', 74, 77),
(125, 124, NULL, NULL, 'display', 75, 76),
(126, 87, NULL, NULL, 'Roles', 78, 89),
(127, 126, NULL, NULL, 'admin_index', 79, 80),
(128, 126, NULL, NULL, 'admin_view', 81, 82),
(129, 126, NULL, NULL, 'admin_add', 83, 84),
(130, 126, NULL, NULL, 'admin_edit', 85, 86),
(131, 126, NULL, NULL, 'admin_delete', 87, 88),
(132, 87, NULL, NULL, 'Users', 90, 105),
(133, 132, NULL, NULL, 'admin_index', 91, 92),
(134, 132, NULL, NULL, 'admin_view', 93, 94),
(135, 132, NULL, NULL, 'admin_add', 95, 96),
(136, 132, NULL, NULL, 'admin_edit', 97, 98),
(137, 132, NULL, NULL, 'admin_delete', 99, 100),
(138, 132, NULL, NULL, 'login', 101, 102),
(139, 132, NULL, NULL, 'logout', 103, 104),
(140, 87, NULL, NULL, 'Widgets', 106, 121),
(141, 140, NULL, NULL, 'admin_index', 107, 108),
(142, 140, NULL, NULL, 'admin_type', 109, 110),
(143, 140, NULL, NULL, 'admin_add', 111, 112),
(144, 140, NULL, NULL, 'admin_edit', 113, 114),
(145, 140, NULL, NULL, 'admin_delete', 115, 116),
(146, 140, NULL, NULL, 'admin_movedown', 117, 118),
(147, 140, NULL, NULL, 'admin_moveup', 119, 120),
(148, 87, NULL, NULL, 'Acl', 122, 167),
(149, 148, NULL, NULL, 'Acos', 123, 130),
(150, 149, NULL, NULL, 'admin_index', 124, 125),
(151, 149, NULL, NULL, 'admin_empty_acos', 126, 127),
(152, 149, NULL, NULL, 'admin_build_acl', 128, 129),
(153, 148, NULL, NULL, 'Aros', 131, 166),
(154, 153, NULL, NULL, 'admin_index', 132, 133),
(155, 153, NULL, NULL, 'admin_check', 134, 135),
(156, 153, NULL, NULL, 'admin_users', 136, 137),
(157, 153, NULL, NULL, 'admin_update_user_role', 138, 139),
(158, 153, NULL, NULL, 'admin_ajax_role_permissions', 140, 141),
(159, 153, NULL, NULL, 'admin_role_permissions', 142, 143),
(160, 153, NULL, NULL, 'admin_user_permissions', 144, 145),
(161, 153, NULL, NULL, 'admin_empty_permissions', 146, 147),
(162, 153, NULL, NULL, 'admin_clear_user_specific_permissions', 148, 149),
(163, 153, NULL, NULL, 'admin_grant_all_controllers', 150, 151),
(164, 153, NULL, NULL, 'admin_deny_all_controllers', 152, 153),
(165, 153, NULL, NULL, 'admin_get_role_controller_permission', 154, 155),
(166, 153, NULL, NULL, 'admin_grant_role_permission', 156, 157),
(167, 153, NULL, NULL, 'admin_deny_role_permission', 158, 159),
(168, 153, NULL, NULL, 'admin_get_user_controller_permission', 160, 161),
(169, 153, NULL, NULL, 'admin_grant_user_permission', 162, 163),
(170, 153, NULL, NULL, 'admin_deny_user_permission', 164, 165);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 6, NULL, 1, 4),
(2, NULL, 'Role', 7, NULL, 5, 8),
(3, NULL, 'Role', 8, NULL, 9, 12),
(4, 1, 'User', 3, NULL, 2, 3),
(5, 2, 'User', 4, NULL, 6, 7),
(6, 8, 'User', 5, NULL, 14, 15),
(7, 3, 'User', 6, NULL, 10, 11),
(8, NULL, 'Role', 9, NULL, 13, 16);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(2, 1, 87, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` mediumtext,
  `note` text,
  `status` int(3) NOT NULL DEFAULT '0',
  `access` int(10) DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `languague` varchar(20) DEFAULT NULL,
  `ordering` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `alias`, `description`, `note`, `status`, `access`, `role_id`, `user_id`, `created`, `modified`, `languague`, `ordering`, `lft`, `rght`) VALUES
(2, NULL, 'My Categories', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 1, 2),
(3, NULL, 'Fun', 'fun', '', '', 1, NULL, 6, NULL, '2031-01-01 00:00:00', '2031-01-01 00:00:00', '', NULL, 3, 22),
(4, 3, 'Sport', 'sport', '', '', 0, NULL, 6, NULL, '2031-01-01 00:00:00', '2031-01-01 00:00:00', '', NULL, 4, 9),
(5, 3, 'Surfing', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 5, 6),
(6, 3, 'Friends', '', '', '', 1, NULL, 4, NULL, '2031-01-01 00:00:00', '2031-01-01 00:00:00', '', NULL, 10, 21),
(7, 6, 'Gerald', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 11, 12),
(8, 6, 'Gwendolyn', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 13, 20),
(9, NULL, 'Work', 'work', '', '', 1, NULL, 6, NULL, '2031-01-01 00:00:00', '2031-01-01 00:00:00', '', NULL, 23, 30),
(10, 9, 'Reports', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 24, 29),
(11, 10, 'Annual', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 25, 26),
(12, 10, 'Status', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 27, 28),
(13, 8, 'Trips', 'trips', '', '', 0, NULL, 2, NULL, '2032-01-01 00:00:00', '2032-01-01 00:00:00', '', NULL, 14, 19),
(14, 13, 'National', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 17, 18),
(15, 13, 'International', '', NULL, NULL, 0, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '2',
  `category_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) unsigned DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned DEFAULT NULL,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `body` mediumtext NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `access` varchar(255) DEFAULT NULL,
  `featured` tinyint(3) NOT NULL DEFAULT '0',
  `language_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT '0',
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `alias`, `status`, `category_id`, `created`, `user_id`, `created_by`, `modified`, `modified_by`, `publish_up`, `publish_down`, `body`, `ordering`, `metakey`, `metadesc`, `metadata`, `access`, `featured`, `language_id`, `role_id`, `lft`, `rght`, `parent_id`) VALUES
(10, 'sample article 1', 'sample_article_1', 2, 4, '0000-00-00 00:00:00', 1, '', '2011-10-22 21:19:57', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim ultrices cursus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed lacinia orci sed magna luctus euismod. Fusce suscipit metus non velit interdum laoreet rhoncus felis molestie. Mauris consequat, ligula in ultrices vulputate, dolor leo tempor mauris, sed mattis quam purus in nisi. Curabitur at lorem eget magna viverra lobortis at non neque. Nullam ultricies eleifend diam, id porttitor leo pharetra ut. Maecenas nec arcu non purus dignissim fermentum. Etiam sit amet tellus nec orci eleifend bibendum eget id nisi.</p>\r\n<p>\r\n	Morbi placerat dolor lorem, sit amet posuere tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac arcu ut nisl auctor sodales in sed tellus. Quisque a urna sed eros commodo mollis non ullamcorper nunc. Proin augue est, viverra sit amet semper at, commodo id enim. Nullam porta velit quis justo porttitor nec lobortis mi viverra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse iaculis hendrerit justo, vitae auctor mauris tempus eu. Duis quis velit lectus, vitae accumsan urna. Donec felis sem, egestas et scelerisque vel, iaculis et odio. Donec aliquam tincidunt nisl, sed hendrerit erat fermentum vel. Quisque vitae odio nec nunc consequat feugiat aliquet ut nulla. Suspendisse eget felis felis. Pellentesque consequat libero a mi cursus at gravida neque tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse elit urna, cursus a vulputate sed, lacinia nec justo. Vestibulum malesuada magna eu ligula consequat condimentum. Donec nunc odio, consequat sit amet interdum et, consectetur nec sem.</p>\r\n<p>\r\n	Morbi in vehicula dolor. Nam eros erat, eleifend in molestie ut, faucibus ut dui. Sed rutrum, dolor tincidunt congue vestibulum, turpis nibh condimentum justo, quis pulvinar velit ante nec mauris. Quisque risus mauris, mattis at facilisis nec, feugiat sed nisl. Sed ac felis eu neque euismod placerat eu condimentum augue. Cras sit amet libero augue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum accumsan, tellus in posuere varius, orci felis accumsan sapien, sed venenatis dui enim nec lacus. Sed cursus egestas malesuada.</p>\r\n<p>\r\n	Sed a lacinia diam. Praesent quam nulla, vehicula quis viverra quis, elementum ac justo. Phasellus auctor interdum eros, a auctor neque commodo ac. Sed facilisis, velit quis mattis faucibus, turpis massa volutpat mi, non mattis metus erat id libero. Morbi elementum vulputate augue, id euismod dui faucibus et. Nullam at interdum nisi. Phasellus faucibus, mauris at pharetra condimentum, leo dolor posuere nulla, eget porta urna est vel lectus. Maecenas tortor libero, tempor vitae adipiscing faucibus, fermentum tempor libero. Pellentesque vulputate metus eget velit commodo quis semper augue molestie. Proin ultrices porta tellus, at tincidunt leo facilisis a. Integer facilisis, velit a placerat pulvinar, magna ligula lobortis urna, eget facilisis augue dui quis nibh. Sed at orci at mi cursus suscipit. Sed vitae risus non justo volutpat rutrum. Nulla non tincidunt arcu. Aliquam congue sem eu diam fermentum ultricies. Ut nec elementum magna. Proin et velit a nisi auctor pretium. Duis id nisl tortor, eget viverra lectus. Aliquam libero justo, ultricies fringilla auctor et, rutrum a nisi. Mauris eu nisl eros, sed elementum purus. Maecenas consequat, libero vitae ornare mollis, neque ligula consectetur turpis, eget mollis justo erat vel risus.</p>\r\n', NULL, '', '', '', 'Administrador ', 0, NULL, 3, 5, 6, NULL),
(11, 'sample article 2', 'sample_article_2', 2, 4, '0000-00-00 00:00:00', 1, '', '2011-10-22 21:49:43', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '<p>\r\n	<strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. Mauris dignissim ultrices cursus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed lacinia orci sed magna luctus euismod. Fusce suscipit metus non velit interdum laoreet rhoncus felis molestie. Mauris consequat, ligula in ultrices vulputate, dolor leo tempor mauris, sed mattis quam purus in nisi. Curabitur at lorem eget magna viverra lobortis at non neque. Nullam ultricies eleifend diam, id porttitor leo pharetra ut. Maecenas nec arcu non purus dignissim fermentum. Etiam sit amet tellus nec orci eleifend bibendum eget id nisi. Morbi placerat dolor lorem, sit amet posuere tellus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac arcu ut nisl auctor sodales in sed tellus. Quisque a urna sed eros commodo mollis non ullamcorper nunc. Proin augue est, viverra sit amet semper at, commodo id enim.</p>\r\n<p>\r\n	Nullam porta velit quis justo porttitor nec lobortis mi viverra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse iaculis hendrerit justo, vitae auctor mauris tempus eu. Duis quis velit lectus, vitae accumsan urna. Donec felis sem, egestas et scelerisque vel, iaculis et odio. Donec aliquam tincidunt nisl, sed hendrerit erat fermentum vel. Quisque vitae odio nec nunc consequat feugiat aliquet ut nulla. Suspendisse eget felis felis. Pellentesque consequat libero a mi cursus at gravida neque tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse elit urna, cursus a vulputate sed, lacinia nec justo. Vestibulum malesuada magna eu ligula consequat condimentum. Donec nunc odio, consequat sit amet interdum et, consectetur nec sem. Morbi in vehicula dolor. Nam eros erat, eleifend in molestie ut, faucibus ut dui.</p>\r\n<p>\r\n	Sed rutrum, dolor tincidunt congue vestibulum, turpis nibh condimentum justo, quis pulvinar velit ante nec mauris. Quisque risus mauris, mattis at facilisis nec, feugiat sed nisl. Sed ac felis eu neque euismod placerat eu condimentum augue. Cras sit amet libero augue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum accumsan, tellus in posuere varius, orci felis accumsan sapien, sed venenatis dui enim nec lacus. Sed cursus egestas malesuada. Sed a lacinia diam. Praesent quam nulla, vehicula quis viverra quis, elementum ac justo. Phasellus auctor interdum eros, a auctor neque commodo ac. Sed facilisis, velit quis mattis faucibus, turpis massa volutpat mi, non mattis metus erat id libero. Morbi elementum vulputate augue, id euismod dui faucibus et. Nullam at interdum nisi. Phasellus faucibus, mauris at pharetra condimentum, leo dolor posuere nulla, eget porta urna est vel lectus. Maecenas tortor libero, tempor vitae adipiscing faucibus, fermentum tempor libero. Pellentesque vulputate metus eget velit commodo quis semper augue molestie. Proin ultrices porta tellus, at tincidunt leo facilisis a. Integer facilisis, velit a placerat pulvinar, magna ligula lobortis urna, eget facilisis augue dui quis nibh. Sed at orci at mi cursus suscipit. Sed vitae risus non justo volutpat rutrum. Nulla non tincidunt arcu. Aliquam congue sem eu diam fermentum ultricies. Ut nec elementum magna. Proin et velit a nisi auctor pretium.</p>\r\n<p>\r\n	Duis id nisl tortor, eget viverra lectus. Aliquam libero justo, ultricies fringilla auctor et, rutrum a nisi. Mauris eu nisl eros, sed elementum purus. Maecenas consequat, libero vitae ornare mollis, neque ligula consectetur turpis, eget mollis justo erat vel risus.</p>\r\n', NULL, '', '', '', 'Editores ', 0, NULL, 4, 3, 4, NULL),
(12, 'sample 2 slug', 'sample_2_slug', 1, 4, '0000-00-00 00:00:00', 1, '', '2011-10-22 22:47:57', 1, NULL, NULL, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim ultrices cursus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed lacinia orci sed magna luctus euismod. Fusce suscipit metus non velit interdum laoreet rhoncus felis molestie. Mauris consequat, ligula in ultrices vulputate, dolor leo tempor mauris, sed mattis quam purus in nisi. Curabitur at lorem eget magna viverra lobortis at non neque. Nullam ultricies eleifend diam, id porttitor leo pharetra ut. Maecenas nec arcu non purus dignissim fermentum. Etiam sit amet tellus nec orci eleifend bibendum eget id nisi. Morbi placerat dolor lorem, sit amet posuere tellus.</p>\r\n<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac arcu ut nisl auctor sodales in sed tellus. Quisque a urna sed eros commodo mollis non ullamcorper nunc. Proin augue est, viverra sit amet semper at, commodo id enim. Nullam porta velit quis justo porttitor nec lobortis mi viverra. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse iaculis hendrerit justo, vitae auctor mauris tempus eu. Duis quis velit lectus, vitae accumsan urna. Donec felis sem, egestas et scelerisque vel, iaculis et odio. Donec aliquam tincidunt nisl, sed hendrerit erat fermentum vel. Quisque vitae odio nec nunc consequat feugiat aliquet ut nulla. Suspendisse eget felis felis. Pellentesque consequat libero a mi cursus at gravida neque tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse elit urna, cursus a vulputate sed, lacinia nec justo. Vestibulum malesuada magna eu ligula consequat condimentum. Donec nunc odio, consequat sit amet interdum et, consectetur nec sem. Morbi in vehicula dolor. Nam eros erat, eleifend in molestie ut, faucibus ut dui. Sed rutrum, dolor tincidunt congue vestibulum, turpis nibh condimentum justo, quis pulvinar velit ante nec mauris. Quisque risus mauris, mattis at facilisis nec, feugiat sed nisl. Sed ac felis eu neque euismod placerat eu condimentum augue. Cras sit amet libero augue. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum accumsan, tellus in posuere varius, orci felis accumsan sapien, sed venenatis dui enim nec lacus. Sed cursus egestas malesuada. Sed a lacinia diam. Praesent quam nulla, vehicula quis viverra quis, elementum ac justo. Phasellus auctor interdum eros, a auctor neque commodo ac. Sed facilisis, velit quis mattis faucibus, turpis massa volutpat mi, non mattis metus erat id libero. Morbi elementum vulputate augue, id euismod dui faucibus et.</p>\r\n<p>\r\n	Nullam at interdum nisi. Phasellus faucibus, mauris at pharetra condimentum, leo dolor posuere nulla, eget porta urna est vel lectus. Maecenas tortor libero, tempor vitae adipiscing faucibus, fermentum tempor libero. Pellentesque vulputate metus eget velit commodo quis semper augue molestie. Proin ultrices porta tellus, at tincidunt leo facilisis a. Integer facilisis, velit a placerat pulvinar, magna ligula lobortis urna, eget facilisis augue dui quis nibh. Sed at orci at mi cursus suscipit. Sed vitae risus non justo volutpat rutrum. Nulla non tincidunt arcu. Aliquam congue sem eu diam fermentum ultricies. Ut nec elementum magna. Proin et velit a nisi auctor pretium. Duis id nisl tortor, eget viverra lectus. Aliquam libero justo, ultricies fringilla auctor et, rutrum a nisi. Mauris eu nisl eros, sed elementum purus. Maecenas consequat, libero vitae ornare mollis, neque ligula consectetur turpis, eget mollis justo erat vel risus.</p>\r\n', NULL, '', '', '', 'Editores ', 1, NULL, 4, 1, 2, NULL),
(13, 'sample article 5', 'sample_article_5', 1, 11, '2011-09-29 15:23:42', NULL, '', '2011-10-23 03:57:28', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', NULL, '', '', '', 'For all users ', 0, NULL, 5, 7, 8, NULL),
(17, 'sample article 2', 'sample_article_2', 2, 0, '2011-10-06 03:18:07', NULL, '', '2011-10-19 03:01:21', NULL, NULL, NULL, '', NULL, '', '', '', 'For all users ', 0, NULL, 0, 9, 10, NULL),
(18, 'La Victoria', 'La_Victoria', 2, 4, '2011-10-15 22:35:13', 1, '', '2011-10-19 15:00:41', NULL, NULL, NULL, '<p>\r\n	sample text</p>\r\n', NULL, '', '', '', 'For all users ', 0, NULL, 0, 11, 12, NULL),
(19, 'La victoria 2', 'La_victoria_2', 0, 11, '2011-10-15 22:51:36', 1, '', '2011-10-15 22:51:36', NULL, NULL, NULL, '<p>\r\n	sdsdsd</p>\r\n', NULL, '', '', '', 'For all users ', 0, NULL, 0, 19, 20, NULL),
(20, 'La victoria 2', 'La_victoria_2', 0, 11, '2011-10-15 22:51:37', 1, '', '2011-10-15 22:51:37', NULL, NULL, NULL, '<p>\r\n	sdsdsd</p>\r\n', NULL, '', '', '', 'For all users ', 0, NULL, 0, 13, 14, NULL),
(21, 'la vic3', 'la_vic3', 0, 9, '2011-10-15 22:54:45', 1, '', '2011-10-15 22:54:45', NULL, NULL, NULL, '', NULL, '', '', '', 'For all users ', 0, NULL, 0, 15, 16, NULL),
(22, 'la vi4', 'la_vi4', 0, 0, '2011-10-15 22:59:21', 1, 'Super User ', '2011-10-23 02:05:16', 1, '2011-10-22 00:00:00', '2011-10-31 00:00:00', '', NULL, '', '', '', 'For all users ', 0, NULL, 5, 17, 18, NULL),
(23, 'vitoria 4', 'vitoria_4', 0, 0, '2011-10-15 23:38:12', 2, 'admin ', '2011-10-15 23:38:12', NULL, NULL, NULL, '', NULL, '', '', '', 'For all users ', 0, NULL, 0, 21, 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engadgets`
--

CREATE TABLE IF NOT EXISTS `engadgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `version` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `engadgets`
--

INSERT INTO `engadgets` (`id`, `name`, `title`, `location`, `status`, `type`, `version`, `date`, `author`, `folder`, `description`) VALUES
(2, 'sample', 'Sample Widget', NULL, 0, 'widget', NULL, NULL, NULL, NULL, NULL),
(3, 'sample2', 'Sample 2 Sample', NULL, 0, 'widget', NULL, NULL, NULL, NULL, NULL),
(8, 'widget_menu', 'Widget Menu', 'site', 1, 'widget', '0.1', '2020-01-11', 'Luis Master', '', 'This module displays a menu on the frontend.');

-- --------------------------------------------------------

--
-- Table structure for table `i18n`
--

CREATE TABLE IF NOT EXISTS `i18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` mediumtext,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `i18n`
--

INSERT INTO `i18n` (`id`, `locale`, `model`, `foreign_key`, `field`, `content`) VALUES
(7, 'es_es', 'User', 9, 'name', 'Super User'),
(10, 'es_es', 'User', 1, 'name', 'Super User'),
(11, 'es_es', 'User', 2, 'name', 'admin'),
(12, 'en_us', 'User', 3, 'name', 'Luis Manuel Espinosa'),
(13, 'en_us', 'User', 4, 'name', 'Administrator'),
(14, 'en_us', 'User', 5, 'name', 'demo'),
(15, 'en_us', 'User', 6, 'name', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `menutype_id` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_type_id` int(11) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '_parent',
  `rel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '2',
  `link_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role_id` int(11) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `access` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `menutype_id`, `title`, `link_type`, `link_type_id`, `alias`, `link_image`, `language`, `note`, `link`, `target`, `rel`, `status`, `link_class`, `page_class`, `lft`, `rght`, `params`, `modified`, `modified_by`, `created`, `role_id`, `user_id`, `access`) VALUES
(25, NULL, 7, 'Quienes Somos?', 'Single_Article', 0, 'quienes_somos?', '', '', NULL, 'localhost:90/cnexus/admin/menus/add/7', '_parent', '', 1, '', '', 5, 6, '{"param1":"parametro 1 y que","param2":"parametro dos u que fue"}', '2012-02-05 23:13:44', NULL, '2011-11-08 21:56:25', 0, NULL, 'For all users '),
(26, NULL, 7, 'About Us', 'Single_Article', 13, 'about_us', '', '', NULL, '/noodleapps/contents/view', '_parent', '', 1, '', '', 1, 2, '{"title":"luis","ape":"espinosa"}', '2011-11-22 20:40:47', NULL, '2011-11-08 21:58:58', 2, NULL, 'Super Users '),
(27, NULL, 8, 'Mi perfil', NULL, NULL, 'mi_perfil', '', '', NULL, '#', '_parent', '', 1, '', '', 3, 4, '{"param1":"","param2":""}', '2011-12-08 02:22:08', NULL, '2011-11-09 15:29:46', 2, NULL, 'Super Users ');

-- --------------------------------------------------------

--
-- Table structure for table `menutypes`
--

CREATE TABLE IF NOT EXISTS `menutypes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` int(1) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `link_count` int(11) NOT NULL,
  `params` text COLLATE utf8_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `menutypes`
--

INSERT INTO `menutypes` (`id`, `title`, `alias`, `description`, `status`, `weight`, `link_count`, `params`, `updated`, `created`) VALUES
(7, 'Menu principal', 'mainmenu', 'Menu de la pagina principal', 1, NULL, 0, NULL, '2011-12-08 22:41:48', '2011-08-30 01:59:51'),
(8, 'Menu Usuario', 'usermenu', 'Menu de los Usuario', 1, NULL, 0, NULL, '2012-02-05 23:13:25', '2011-08-30 02:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `modified`) VALUES
(6, 'Super Users', '2012-02-04 03:06:40', '2012-02-05 17:27:18'),
(7, 'Administrator', '2012-02-04 03:06:56', '2012-02-04 03:06:56'),
(8, 'Managers', '2012-02-04 03:07:05', '2012-02-04 03:07:05'),
(9, 'Registered', '2012-02-05 20:23:08', '2012-02-05 20:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(40) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`, `created`, `modified`, `name`, `email`, `status`) VALUES
(3, 'luismaster', '2e74c99c776c8f5640b2c50f2d7d1ac14e823831', 6, '2012-02-04 03:07:36', '2012-02-04 03:07:36', 'Luis Manuel Espinosa', 'luismaster809@hotmail.com', 1),
(4, 'admin', '304a778d3dfe6e3810d16788ed48d91528c535d8', 7, '2012-02-04 16:54:26', '2012-02-04 17:55:28', 'Administrator', 'admin@adi.com', 0),
(5, 'demo', '8f29a31b85c95e9496995be0b74bbdc5e4623bcb', 9, '2012-02-04 18:02:21', '2012-02-06 01:36:43', 'demo', 'demo', 1),
(6, 'managers', '2e74c99c776c8f5640b2c50f2d7d1ac14e823831', 8, '2012-02-04 18:34:43', '2012-02-04 18:58:20', 'manager', 'admin@adi.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `content` text,
  `ordering` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `publish_up` datetime DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '2',
  `widget` varchar(255) DEFAULT NULL,
  `access` varchar(255) DEFAULT NULL,
  `showtitle` int(1) NOT NULL DEFAULT '1',
  `params` text,
  `language` char(7) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `engadget_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `title`, `note`, `content`, `ordering`, `position`, `publish_up`, `publish_down`, `status`, `widget`, `access`, `showtitle`, `params`, `language`, `lft`, `rght`, `parent_id`, `engadget_id`, `role_id`, `user_id`) VALUES
(1, 'Main Menu', '', NULL, NULL, 'position-1', '2011-11-30 00:00:00', '2011-11-30 00:00:00', 1, 'widget_menu', NULL, 0, '{"menutype_id":"7","startlevel":"0","endlevel":"0","show_submenu_items":"0"}', NULL, 1, 2, NULL, 8, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
