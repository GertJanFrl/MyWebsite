-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 16, 2015 at 03:58 PM
-- Server version: 5.6.27
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_bisdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `gl_articles`
--

CREATE TABLE `gl_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `pubdate` varchar(17) NOT NULL,
  `body` text NOT NULL,
  `author` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_menu`
--

CREATE TABLE `gl_menu` (
  `id` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `class` varchar(45) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_pages`
--

CREATE TABLE `gl_pages` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `body_sidebar` text NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `meta_title` tinytext,
  `meta_description` tinytext,
  `slider_id` int(11) DEFAULT NULL,
  `navigation_visible` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_pages_sub`
--

CREATE TABLE `gl_pages_sub` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `body_sidebar` text NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_description` varchar(100) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_portfolio`
--

CREATE TABLE `gl_portfolio` (
  `id` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `meta_title` tinytext,
  `meta_description` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_portfolio_images`
--

CREATE TABLE `gl_portfolio_images` (
  `id` int(11) NOT NULL,
  `id_portfolio` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_slider`
--

CREATE TABLE `gl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_slider_slides`
--

CREATE TABLE `gl_slider_slides` (
  `id` int(11) NOT NULL,
  `id_slider` int(11) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gl_system`
--

CREATE TABLE `gl_system` (
  `key` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gl_system`
--

INSERT INTO `gl_system` (`key`, `value`) VALUES
('web_title', 'Gertlily'),
('smtp_server', 'gl-kanto.nl'),
('smtp_port', '587'),
('smtp_email', 'server@gertlily.frl'),
('smtp_password', '0K3nRCvj'),
('social_facebook', ''),
('social_twitter', ''),
('social_linkedin', ''),
('contact_address', ''),
('contact_postcode', ''),
('contact_phone', ''),
('contact_email', 'info@gl-dev.nl'),
('social_googleplus', ''),
('supportwidget_openingstijden', '09:00 - 18:00'),
('supportwidget_phone', '085 201 77 22'),
('supportwidget_email', 'support@gertlily.frl'),
('supportwidget_website', 'http://gertlily.frl');

-- --------------------------------------------------------

--
-- Table structure for table `gl_system_modules`
--

CREATE TABLE `gl_system_modules` (
  `name` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gl_system_modules`
--

INSERT INTO `gl_system_modules` (`name`, `status`) VALUES
('article', '1'),
('diensten', '0'),
('media', '0'),
('page', '1'),
('portfolio', '1'),
('slideshow', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gl_users`
--

CREATE TABLE `gl_users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rights` enum('1','2','3') NOT NULL DEFAULT '1',
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gl_users`
--

INSERT INTO `gl_users` (`id`, `email`, `tel`, `password`, `name`, `rights`, `lastlogin`, `active`) VALUES
(1, 'gertjan@gertlily.frl', '085 201 77 22', '3bdb319280355811b7fe3c4073f3383034aab7d9d2d4713ea0285a2939a87e3e71a181310ef9d75301a1fa5a42fffead6dc15c32fe4e00447aabe7b0c6761c55', 'Gert-Jan Anema', '3', '0000-00-00 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gl_user_sessions`
--

CREATE TABLE `gl_user_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(10) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gl_articles`
--
ALTER TABLE `gl_articles`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gl_articles` ADD FULLTEXT KEY `fulltext` (`title`,`body`);
ALTER TABLE `gl_articles` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `gl_articles` ADD FULLTEXT KEY `body` (`body`);

--
-- Indexes for table `gl_pages`
--
ALTER TABLE `gl_pages`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gl_pages` ADD FULLTEXT KEY `fulltext` (`title`,`body`,`body_sidebar`);
ALTER TABLE `gl_pages` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `gl_pages` ADD FULLTEXT KEY `body` (`body`);
ALTER TABLE `gl_pages` ADD FULLTEXT KEY `body_sidebar` (`body_sidebar`);

--
-- Indexes for table `gl_pages_sub`
--
ALTER TABLE `gl_pages_sub`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gl_pages_sub` ADD FULLTEXT KEY `fulltext` (`title`,`body`,`body_sidebar`);
ALTER TABLE `gl_pages_sub` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `gl_pages_sub` ADD FULLTEXT KEY `body` (`body`);
ALTER TABLE `gl_pages_sub` ADD FULLTEXT KEY `body_sidebar` (`body_sidebar`);

--
-- Indexes for table `gl_portfolio`
--
ALTER TABLE `gl_portfolio`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gl_portfolio` ADD FULLTEXT KEY `fulltext` (`title`,`body`);
ALTER TABLE `gl_portfolio` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `gl_portfolio` ADD FULLTEXT KEY `body` (`body`);

--
-- Indexes for table `gl_portfolio_images`
--
ALTER TABLE `gl_portfolio_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_slider`
--
ALTER TABLE `gl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_system`
--
ALTER TABLE `gl_system`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `gl_system_modules`
--
ALTER TABLE `gl_system_modules`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `gl_users`
--
ALTER TABLE `gl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_user_sessions`
--
ALTER TABLE `gl_user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gl_articles`
--
ALTER TABLE `gl_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_pages`
--
ALTER TABLE `gl_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_pages_sub`
--
ALTER TABLE `gl_pages_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_portfolio`
--
ALTER TABLE `gl_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_portfolio_images`
--
ALTER TABLE `gl_portfolio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_slider`
--
ALTER TABLE `gl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gl_users`
--
ALTER TABLE `gl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
