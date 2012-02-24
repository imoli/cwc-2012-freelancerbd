-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2012 at 06:49 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tech_adda`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`event_id`, `user_id`) VALUES
(1, 4),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `title`) VALUES
(1, 'PHP'),
(2, 'Ruby'),
(3, '.NET');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `talk_id` int(11) DEFAULT '0',
  `event_id` int(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text,
  `rating` tinyint(1) DEFAULT NULL,
  `is_private` tinyint(1) DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `talk_id`, `event_id`, `user_id`, `body`, `rating`, `is_private`, `create_date`) VALUES
(1, 1, 0, 1, 'Excellent session!', NULL, 0, '2012-01-23 05:01:53'),
(2, 1, 0, 1, 'It did really open my eyes; as web developers we very often ignore the actual protocol that we''re sending stuff through. Understanding the underlying mechanics of HTTP is indeed really important and even though I was half asleep the talk did indeed have many valid points and was nicely presented.', NULL, 0, '2012-01-23 05:11:34'),
(4, 1, 0, 1, 'Great talk! It''s very nice to listen the basics explained by a master. Specially some basics I even knew about, thought.', NULL, 0, '2012-01-23 05:36:27'),
(5, 1, 0, 1, 'Although much of the talk was what you can see in Symfony2 caching documentation, but anyway it is a pleasure to hear Fabien live. Big todo to all of us, read the HTTP Specification.', NULL, 0, '2012-01-23 05:39:31'),
(7, 1, 0, 3, 'jhjhjhjk j', NULL, 0, '2012-01-27 00:29:17'),
(15, 0, 1, 3, 'hello', NULL, 0, '2012-01-27 02:35:51'),
(17, 1, 0, 3, '', NULL, 0, '2012-01-27 02:54:45'),
(18, 2, 0, 3, 'teest', NULL, 0, '2012-01-27 03:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `summary` text CHARACTER SET latin1,
  `logo` varchar(200) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `location` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `href` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `total_attending` int(11) DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `title`, `summary`, `logo`, `category_id`, `location`, `href`, `start_date`, `end_date`, `is_active`, `total_attending`, `create_date`) VALUES
(1, 1, 'PHPBenelux Conference 2012', 'The conference and tutorials will take place at the Best Western Hotel Ter Elst in Antwerp (Belgium). Friday morning January 27th we have a set of tutorials. The conference is spread over 2 days: Friday afternoon (after the tutorials) and Saturday. Tutorials as well as the conference itself are spread over several parallel tracks.\n\nOn Friday evening, we''re having the conference social. This will include drinks and bowling as we managed to reserve the entire bowling alley.', 'http://joind.in/inc/img/event_icons/phpbnl2012-small.png', 1, 'Best Western Ter Elst', 'http://conference.phpbenelux.eu/', '2012-01-27', '2012-01-29', 1, 1, '2012-01-19 19:11:12'),
(2, 1, 'ZendCon 2011', 'The 7th Annual Zend PHP Conference (ZendCon) will take place October 17-20, 2011, in Santa Clara, California. ZendCon is the largest gathering of the PHP Community and brings together PHP developers and IT managers from around the world to discuss PHP best practices and explore new technologies.\r\n\r\nAt ZendCon, youâ€™ll learn from a variety of technical sessions and in-depth tutorials. International industry experts, renowned thought-leaders and experienced PHP practitioners, will discuss PHP best practices and explore future technological developments. ZendCon 2011 will focus on ways that PHP fits into major trends in the IT world. The primary conference themes are Cloud Computing, Mobile and User Experience, and Enterprise and Professional PHP.\r\n\r\nAn Exhibit Hall featuring industry leaders offers a space to meet innovative companies and unique networking opportunities are at hand.', NULL, 1, 'Santa Clara Convention Center', 'http://joind.in/inc/img/event_icons/zendcon-icon.gif', '0000-00-00', '0000-00-00', 1, 1, '2012-01-23 19:13:46'),
(3, 1, 'PHPCon Poland 2011', 'The second edition of Polish weekend meeting for PHP programmers and enthusiasts. Attedees spend the time on lectures, workshops, lightning talks and after hours discussions to late night. There will be also a time for a little sightseeing - hotel is located in national park neighborhood.\r\n\r\nThe Official PHPConPL''s webpage has been just started. Talk proposals can be entered directly at phpcon.pl.', 'http://joind.in/inc/img/event_icons/logo-joind-in.png', 1, 'Przedwiosnie Hotel', 'http://www.phpcon.pl/2011/en/', '0000-00-00', '0000-00-00', 1, 1, '2012-01-23 19:18:35'),
(4, 3, 'test event with logo', 'test event with logotest event with logotest event with logotest event with logotest event with logotest event with logo', 'http://localhost/cwc2012/assets/images/', 3, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10', '2012-10-10', 1, 0, '2012-01-27 03:50:00'),
(5, 3, 'test event with logo', 'test event with logotest event with logotest event with logotest event with logotest event with logo', 'http://localhost/cwc2012/assets/images/eventlogo_1327668730.jpg', 2, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10', '2012-10-10', 1, 0, '2012-01-27 03:52:10'),
(6, 3, 'alert(&#39;sohel&#39;)', 'alert(&#39;sohel&#39;)', 'http://localhost/cwc2012/assets/images/eventlogo_1327675976.jpg', 1, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10', '2012-10-10', 1, 0, '2012-01-27 05:52:56'),
(7, 3, 'test event with logo', 'test event with logo', '', 1, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10', '2012-10-10', 1, 0, '2012-01-27 06:11:11'),
(8, 4, 'alert(&#39;ok&#39;);', 'alert(&#39;ok&#39;);', 'http://localhost/cwc2012/assets/images/eventlogo_1327680777.jpg', 1, 'alert(&#39;ok&#39;);', 'www.testing.com', '2012-10-02', '2012-10-03', 1, 0, '2012-01-27 07:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `talk_id` int(10) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`talk_id`, `tag`, `user_id`) VALUES
(1, 'this is  test', 3),
(1, ' test', 3),
(1, 'tag', 3),
(2, 'test', 3);

-- --------------------------------------------------------

--
-- Table structure for table `talks`
--

CREATE TABLE IF NOT EXISTS `talks` (
  `talk_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `summary` text,
  `speaker` varchar(50) NOT NULL DEFAULT '',
  `slide_link` varchar(200) DEFAULT NULL,
  `total_comments` int(11) DEFAULT '0',
  PRIMARY KEY (`talk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`talk_id`, `event_id`, `title`, `summary`, `speaker`, `slide_link`, `total_comments`) VALUES
(1, 2, 'Profiling PHP Applications', 'The web is full of advice focussed on improving performance. Before you can optimise however, you need to find out if your code is actually slow; then you need to understand the code; and then you need to find out what you can optimise.\n\nThis talk introduces various tools and concepts to optimise the optimisation of your PHP applications.', 'Derick Rethans', NULL, 0),
(2, 3, 'test', 'This is test', 'terst', 'hhh', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `create_date`) VALUES
(1, 'phpfour@gmail.com', '', '2012-01-22 16:36:06'),
(2, 'goodboy840@gmail.com', NULL, '2012-01-24 17:53:55'),
(3, 'mdsahedul@gmail.com', 'Sohel', '2012-01-25 07:50:44'),
(4, 'imran3968@gmail.com', 'Imran', '2012-01-27 07:09:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
