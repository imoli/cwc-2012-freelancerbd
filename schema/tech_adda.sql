-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2012 at 07:17 AM
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
(1, 5),
(2, 3),
(2, 5),
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
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `total_attending` int(11) DEFAULT '0',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `user_id`, `title`, `summary`, `logo`, `category_id`, `location`, `href`, `start_date`, `end_date`, `is_active`, `total_attending`, `create_date`) VALUES
(1, 1, 'PHPBenelux Conference 2012', 'The conference and tutorials will take place at the Best Western Hotel Ter Elst in Antwerp (Belgium). Friday morning January 27th we have a set of tutorials. The conference is spread over 2 days: Friday afternoon (after the tutorials) and Saturday. Tutorials as well as the conference itself are spread over several parallel tracks.\n\nOn Friday evening, we''re having the conference social. This will include drinks and bowling as we managed to reserve the entire bowling alley.', 'http://joind.in/inc/img/event_icons/phpbnl2012-small.png', 1, 'Best Western Ter Elst', 'http://conference.phpbenelux.eu/', '2012-01-27 00:00:00', '2012-01-29 00:00:00', 1, 2, '2012-01-19 19:11:12'),
(2, 1, 'ZendCon 2011', 'The 7th Annual Zend PHP Conference (ZendCon) will take place October 17-20, 2011, in Santa Clara, California. ZendCon is the largest gathering of the PHP Community and brings together PHP developers and IT managers from around the world to discuss PHP best practices and explore new technologies.\r\n\r\nAt ZendCon, youâ€™ll learn from a variety of technical sessions and in-depth tutorials. International industry experts, renowned thought-leaders and experienced PHP practitioners, will discuss PHP best practices and explore future technological developments. ZendCon 2011 will focus on ways that PHP fits into major trends in the IT world. The primary conference themes are Cloud Computing, Mobile and User Experience, and Enterprise and Professional PHP.\r\n\r\nAn Exhibit Hall featuring industry leaders offers a space to meet innovative companies and unique networking opportunities are at hand.', NULL, 1, 'Santa Clara Convention Center', 'http://joind.in/inc/img/event_icons/zendcon-icon.gif', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 2, '2012-01-23 19:13:46'),
(3, 1, 'PHPCon Poland 2011', 'The second edition of Polish weekend meeting for PHP programmers and enthusiasts. Attedees spend the time on lectures, workshops, lightning talks and after hours discussions to late night. There will be also a time for a little sightseeing - hotel is located in national park neighborhood.\r\n\r\nThe Official PHPConPL''s webpage has been just started. Talk proposals can be entered directly at phpcon.pl.', 'http://joind.in/inc/img/event_icons/logo-joind-in.png', 1, 'Przedwiosnie Hotel', 'http://www.phpcon.pl/2011/en/', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, '2012-01-23 19:18:35'),
(4, 3, 'test event with logo', 'test event with logotest event with logotest event with logotest event with logotest event with logotest event with logo', 'http://localhost/cwc2012/assets/images/', 3, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10 00:00:00', '2012-10-10 00:00:00', 1, 0, '2012-01-27 03:50:00'),
(5, 3, 'test event with logo', 'test event with logotest event with logotest event with logotest event with logotest event with logo', 'http://localhost/cwc2012/assets/images/eventlogo_1327668730.jpg', 2, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10 00:00:00', '2012-10-10 00:00:00', 1, 0, '2012-01-27 03:52:10'),
(6, 3, 'alert(&#39;sohel&#39;)', 'alert(&#39;sohel&#39;)', 'http://localhost/cwc2012/assets/images/eventlogo_1327675976.jpg', 1, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10 00:00:00', '2012-10-10 00:00:00', 1, 0, '2012-01-27 05:52:56'),
(7, 3, 'test event with logo', 'test event with logo', '', 1, 'Dhaka, mirpur, 1216,  Bangladesh', 'http://example.com', '2010-10-10 00:00:00', '2012-10-10 00:00:00', 1, 0, '2012-01-27 06:11:11'),
(8, 4, 'alert(&#39;ok&#39;);', 'alert(&#39;ok&#39;);', 'http://localhost/cwc2012/assets/images/eventlogo_1327680777.jpg', 1, 'alert(&#39;ok&#39;);', 'www.testing.com', '2012-10-02 00:00:00', '2012-10-03 00:00:00', 1, 0, '2012-01-27 07:12:57'),
(9, 5, 'Five common PHP design patterns', 'Five common PHP design patterns', 'http://placehold.it/90x90', 1, 'Dhaka', '', '2012-04-11 00:00:00', '2012-10-11 00:00:00', 1, 0, '2012-02-24 12:44:56'),
(72, 5, 'Dutch PHP Conference 2012', 'Ibuildings is proud to organise the sixth Dutch PHP Conference on June 8 and 9, plus a pre-conference tutorial day on June 7. Both programs will be completely in English so the only Dutch thing about it is the location. Keywords for these days: Know-how, Technology, Best Practices, Networking, Tips & Tricks.', NULL, NULL, NULL, 'http://www.phpconference.nl/', '2012-06-07 00:00:00', '2012-06-09 23:59:59', 1, 0, '2012-02-25 05:48:52'),
(73, 5, 'Dutch Mobile Conference 2012', 'Ibuildings is proud to organise the first Dutch Mobile Conference on June 8 and 9, plus a pre-conference tutorial day on June 7. Both programs will be completely in English so the only Dutch thing about it is the location. Keywords for these days: Know-how, Technology, Best Practices, Networking, Tips & Tricks.', NULL, NULL, NULL, 'http://www.mobileconference.nl/', '2012-06-07 00:00:00', '2012-06-09 23:59:59', 1, 0, '2012-02-25 05:48:52'),
(74, 5, 'WebClusters 2012', 'Serwisy internetowe juÅ¼ dawno temu przestaÅ‚y byÄ‡ katalogiem peÅ‚nym plikÃ³w HTML, czasem tylko doprawionym kilkoma skryptami CGI. Dzisiaj najwiÄ™ksze portale to setki specjalistÃ³w od uÅ¼ytecznoÅ›ci aplikacji, grafikÃ³w, redaktorÃ³w treÅ›ci, a takÅ¼e armia inÅ¼ynierÃ³w dbajÄ…cych o kod ÅºrÃ³dÅ‚owy, serwery, infrastrukturÄ™.\n\nKonferencja WebClusters jako pierwsza w Polsce podejmuje temat rozwiÄ…zaÅ„ programistycznych i architekturalnych dla duÅ¼ych serwisÃ³w internetowych. Jak napisaÄ‡ aplikacjÄ™, Å¼eby dobrze dziaÅ‚aÅ‚a pod duÅ¼ym obciÄ…Å¼eniem? Jak rozplanowaÄ‡ architekturÄ™ serwisu, Å¼eby moÅ¼na byÅ‚o Å‚atwo rozÅ‚oÅ¼yÄ‡ ruch na wiele serwerÃ³w? Z jakich rozwiÄ…zaÅ„ korzystaÄ‡, a jakich unikaÄ‡? Na te pytania odpowiedzÄ… nasi prelegenci â€“ ludzie z duÅ¼ym doÅ›wiadczeniem w tej tematyce, pracujÄ…cych przy najwiÄ™kszych polskich serwisach internetowych.\n', NULL, NULL, NULL, '', '2012-05-24 00:00:00', '2012-05-25 23:59:59', 1, 0, '2012-02-25 05:48:52'),
(75, 5, 'phpDay 2012', 'The GrUSP, the italian php user group, organize the 8th phpDay (http://www.phpday.it) a conference dedicated to the php for the enterprise.\n', NULL, NULL, NULL, 'http://www.phpday.it', '2012-05-18 00:00:00', '2012-05-19 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(76, 5, 'JsDay 2012', 'jsDay will be all about Javascript and web development. We''ll show new development traits, best-pratices and success cases related to the Javascript language. There are also talks about no-sql, html5 and various js-related technologies.', NULL, NULL, NULL, 'http://www.jsday.it/2012/', '2012-05-16 00:00:00', '2012-05-17 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(77, 5, 'How to deal in REST in practice', 'You''ve read the dissertation by Roy Fielding. You''ve seen the slides on slideshare. You know everything that you need to know about HATEOAS. So now it''s time to deploy REST into your new API and turns out: it''s not as easy as it looks. How do we let someone login? How do we search through collections? And how do we do asynchronous operations? How do we send emails from your API? It''s very tempting to fall back to what you know and sooner than later your RESTful design is transformed back into a XML-RPC interface. This presentation is not about what REST is, but I will show you how to put REST concepts into practice, how to deal with certain situations and how to avoid the common RESTful pitfalls.\n\nBio:\nJoshua Thijssen is a freelance consultant, developer and trainer. His passion lies in designing and working with complex projects, working on high scalability and availability projects and helping other to achieve higher standards in both coding and thinking. His programming skills include (but is not limited) to C, PHP, Python, Java and perl. He is a speaker on both national and international conferences, article publisher and maintains his personal blog at:\nwww.adayinthelifeof.nl\n\nProgram:\n18.00h Doors open, Food & Drinks\n19.00h Start presentation\n\nPlease let us know if you want join us:\nhttp://www.competa.com/community/events.php/23\n\nNOTE:\nThis event will (also) be webcasted on competa.tv but is best experienced live at the Competa Conference Center.', NULL, NULL, NULL, 'http://www.competa.com/community/events.php/23', '2012-05-03 00:00:00', '2012-05-03 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(78, 5, 'IT Automation 2012', 'The focus during this event is on IT job scheduling, batch systems, Distributed Resource management systems and end-to-end business process automation.   \nAnd this on all different kinds of platforms and ERP systems.', NULL, NULL, NULL, '', '2012-04-26 01:00:00', '2012-04-27 00:59:59', 1, 0, '2012-02-25 05:48:53'),
(79, 5, 'Whisky Web Conference', 'THE WEB CONFERENCE IN SCOTLAND\n\nThe inaugural Whisky Web conference kicks off in Edinburgh on the 13th and 14th of April 2012. A web conference created for the web community, by the web community; Whisky Web will have something to offer everyone who works with the web, be they a designer, a developer or something in between. This is an amazing opportunity to get your geek on in Scotland''s inspiring capital.\n\nMore at http://whiskyweb.co.uk/', NULL, NULL, NULL, '', '2012-04-13 00:00:00', '2012-04-14 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(80, 5, 'Techademy Trainingsdag Maart 2012', 'The monthly Techademy training day, this month features "Scrum" and "Documentation"', NULL, NULL, NULL, 'http://techademy.nl/maart-2012-scrum-documentatie/', '2012-03-16 00:00:00', '2012-03-16 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(81, 5, 'JavaScript Days', 'Die Entwickler Akademie prÃ¤sentiert Ihnen zusammen mit dem Entwickler Magazin die ersten JavaScript Days! Das groÃŸe Trainingsevent vermittelt Ihnen in drei Tagen die wichtigsten JavaScript-Themen in kompakter und intensiver Form. Dabei kÃ¶nnen Sie Ihre individuellen Themenschwerpunkte aus insgesamt 18 halbtÃ¤gigen Power Workshops und einer spannenden Keynote mit David Crockford auswÃ¤hlen. Erleben Sie auch das Speaker Panel am zweiten Abend, das Ihnen zusÃ¤tzlich wertvolle Informationen bietet.\n\nDas umfangreiche Programm ist in vier Tracks aufgeteilt: JavaScript Technologies, Best Practices, JavaScript Kickstart und JavaScript Testing. Hier lernen Sie tiefgehend wie Sie JavaScript-basierte Anwendungen optimal planen, realisieren und zu einem erfolgreichen Abschluss bringen, welche StÃ¤rken und SchwÃ¤chen die verschiedenen Technologien haben oder wie Sie bei der Wahl einer geeigneten Architektur vorgehen sollten.\n\nBei all dem profitieren Sie vom geballten Wissen und der Praxiserfahrung von sechs der international bedeutendsten JavaScript-Experten. Nutzen Sie auch die einmalige Chance, Ihre individuellen Fragen und Herausforderungen mit den hochkarÃ¤tigen Experten vor Ort intensiv zu diskutieren. Dieses einzigartige JavaScript-Event sollten Sie auf keinen Fall verpassen!', NULL, NULL, NULL, 'http://javascript-days.de', '2012-03-12 00:00:00', '2012-03-14 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(82, 5, 'Mdevcon', 'Developers working with mobile technology. There will be talks targeted at a specific platform and talks of a more platform independent nature. We welcome independent developers, freelancers and developers working for a company â€“ It doesnâ€™t matter who you are or where you work, if you work with mobile technology youâ€™ll enjoy this conference.', NULL, NULL, NULL, 'http://mdevcon.com', '2012-03-10 00:00:00', '2012-03-10 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(83, 5, '10th World Food Technology and Innovation Forum 2012', 'The 10th Annual World Food Technology and Innovation Forum gathers the world leaders in research and development, innovation and NPD to debate, and shape the future of the food industry \n\nThe current economic climate has affected all industries including food and beverage companies and they must continue to innovate in order to survive and thrive in the short, medium and long term. This programme highlights the most effective strategies, tools and techniques to maximise innovation, competitiveness and profitibilty in new market conditions. \n\n Successfully communicating with evolving ethical consumer mindsets \n Taking long term vs short term approaches to sustainability  \n Harnessing the power of social media to create new consumer interaction and innovation strategies \n Preparing the innovation pipeline for 3 possible future economic scenarios \n Strengthening the brand against private label competition \n Capitalising on the growth in premium and luxury food sales  \n Incorporating new disruptive technologies into the innovation strategy \n\nBook now to secure your place at 10th World Food Technology and Innovation Forum 2012\n\n', NULL, NULL, NULL, '', '2012-02-29 00:00:00', '2012-03-01 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(84, 5, 'PHPBenelux February 2012 meeting @ WEBclusive', 'Shortly after our conference we have been contacted by our friends at WEBclusive to organize a meeting for February.\n\nWe are still determining the program, and we will update this post accordingly as soon as we have the speakers confirmed. Keep the spot reserved in your agenda''s, this evening will be a big blast!\n\nTuesday February 28th everybody is invited to visit WEBclusive office at the Rozengracht 133 in Amsterdam! They are sponsoring the venue, drinks and a speaker this evening. This promises to be a great PHP evening once again!', NULL, NULL, NULL, '', '2012-02-28 00:00:00', '2012-02-28 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(85, 5, 'ConFoo 2012', 'PHP QuÃ©bec, MontrÃ©al-Python, Montreal.rb, Montreal Jug, W3Qc, OWASP MontrÃ©al, Android Montreal, are proud to announce the third edition of the ConFoo Conference. From February 29th to March 2nd, 2012, international experts in Java, .Net, PHP, Python and Ruby will present solutions for developers and project managers the prestigious Hilton Bonaventure Hotel, located downtown MontrÃ©al.\n', NULL, NULL, NULL, 'http://confoo.ca/', '2012-02-27 00:00:00', '2012-03-02 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(86, 5, 'PHP UK Conference 2012', 'PHP London are pleased to announce their 7th annual UK PHP conference, building on the success of previous events by expanding to a double-day event, to accommodate the continual growth of the PHP community and PHP development industry.\n\n It takes place at the modern Business Design Centre in London''s bustling Islington area, close to Kings Cross and Euston and just two minutes walk from Angel underground station. There are 16 one hour sessions that comprise the 3 track schedule for the day. As usual we''ve arranged social events for both the evening before and straight after each day of the event - the former being free to anyone to come along. The registration price also includes a buffet lunch and dessert, refreshments throughout each day, cloakroom facilities, wifi, countless networking opportunities, and a raffle.', NULL, NULL, NULL, 'http://www.phpconference.co.uk/', '2012-02-24 00:00:00', '2012-02-25 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(87, 5, 'Dallas PHP User Group Meeting - February 2012', 'This month we''re going to have a special guest coming in from out of town - Paul Jones will be presenting his talk "Solving the N+1 Problem; or, A Stitch In Time Saves Nine". Here''s the summary:\n\n-----------\n\nWhen dealing with databases, developers frequently run into the N+1 problem, in which they populate domain objects via queries in loops. This causes terrible performance drags. There is a solution in plain PHP that makes the number of queries constant to increase performance overall. The talk shows typical PHP code involving the N+1 problem, then shows how to solve the problem in plain PHP (that is, without a framework or ORM), and includes editorializing about the origins of the N+1 problem in the developer mindset.', NULL, NULL, NULL, '', '2012-02-21 00:00:00', '2012-02-21 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(88, 5, 'Techademy Trainingsdag Februari 2012', 'The monthly Techademy training day, this month features "Composer" and "Puppet"', NULL, NULL, NULL, '', '2012-02-17 00:00:00', '2012-02-17 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(89, 5, 'Drupal User Group meeting - CultuurNet Vlaanderen: spreading central data across multiple websites with Drupal', 'Kristof Coomans (technical lead - Statik), Sven Houtmeyers (developer - CultuurNet Vlaanderen) and Davy Van Den Bremt (Drupal developer at Krimson, give an extensive case presentation about CultuurNet Vlaanderen (UiTdatabank, UiTinVlaanderen): project setup, best practices, technical challenges and solutions, ... ', NULL, NULL, NULL, '', '2012-02-16 00:00:00', '2012-02-16 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(90, 5, 'MKEPUG - February 2012 Meeting', 'Monthly meeting featuring Beth Tucker Longs'' Continuous Integration: In Real Life presentation.', NULL, NULL, NULL, '', '2012-02-14 00:00:00', '2012-02-14 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(91, 5, 'Free Continuing Legal Education on Patent Illustrations', 'Topics will cover how IP professionals can help your vendor complete the drawings in one draft instead of three and proven techniques to reduce confusion and improve figure clarity. Expect insightful information from our professionals holding more than 10 years of experience working with top IP and AmLaw firms and individual inventors.\n\nTopics Covered      \nÂ· Techniques that reduce examiner confusion and improve figure clarity\nÂ· Best practices for working with inventors and vendors\nÂ· Quality control - what details are examiners looking for in your illustrations\nÂ· How can you help your vendor complete the drawings in one draft instead of three?\nÂ· Lines, shading, text and fills for Utility and Design patents\nÂ· Samples and examples throughout the webinar ', NULL, NULL, NULL, '', '2012-02-14 00:00:00', '2012-02-14 23:59:59', 1, 0, '2012-02-25 05:48:53'),
(92, 5, 'this is test talk from api', 'this is test talk from api', NULL, 1, 'Dhaka', 'http://dhaka.net', '2012-02-25 00:00:00', '2012-02-26 00:00:00', 1, 0, '2012-02-25 07:14:16'),
(93, 5, 'this is test talk from api', 'this is test talk from api', NULL, 1, 'Dhaka', 'http://dhaka.net', '2012-02-25 00:00:00', '2012-02-26 00:00:00', 1, 0, '2012-02-25 07:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `talk_id` int(10) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  UNIQUE KEY `talk_id` (`talk_id`,`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`talk_id`, `tag`, `user_id`) VALUES
(1, '  vis ', 5),
(1, 'php', 5),
(1, 'tag', 3),
(1, 'test', 3),
(1, 'this is  test', 3),
(2, 'test', 3),
(3, 'php', 5),
(3, 'svn', 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`talk_id`, `event_id`, `title`, `summary`, `speaker`, `slide_link`, `total_comments`) VALUES
(1, 2, 'Profiling PHP Applications', 'The web is full of advice focussed on improving performance. Before you can optimise however, you need to find out if your code is actually slow; then you need to understand the code; and then you need to find out what you can optimise.\n\nThis talk introduces various tools and concepts to optimise the optimisation of your PHP applications.', 'Derick Rethans', NULL, 0),
(2, 3, 'test', 'This is test', 'terst', 'hhh', 0),
(3, 9, 'TortoiseSVN', 'how to install and use SVN on windows', 'Oli', '', 0),
(4, 2, 'this is test talk from api', 'this is test talk from api', 'test speaker', 'example.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `name`, `create_date`, `token`) VALUES
(1, 'phpfour@gmail.com', '', '2012-01-22 16:36:06', ''),
(2, 'goodboy840@gmail.com', NULL, '2012-01-24 17:53:55', ''),
(3, 'mdsahedul@gmail.com', 'Sohel', '2012-01-25 07:50:44', ''),
(4, 'imran3968@gmail.com', 'Imran', '2012-01-27 07:09:38', ''),
(5, 'imtiazmasrur@gmail.com', 'Oli', '2012-02-24 12:36:38', 'xyz45gggEEERTDSGDG987CSVrepolRES124dddjdfjTFl');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
