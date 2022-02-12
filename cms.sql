-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 02:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(3, 'PHP'),
(4, 'Java'),
(5, 'Ionic');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_post_id` int(5) NOT NULL,
  `comment_author` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `comment_email` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `comment_content` text COLLATE utf8_vietnamese_ci NOT NULL,
  `comment_status` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'unapproved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(7, 6, 'edder', 'edder@mail.io', 'This is a nice course! Hehe', 'approved', '2021-05-14'),
(9, 6, 'edwin', 'edwindiaz@coder.io', 'You right!', 'approved', '2021-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(5) NOT NULL,
  `like_user_id` int(5) NOT NULL,
  `like_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(5) NOT NULL,
  `post_category_id` int(5) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `post_author` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `post_status` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'draft',
  `post_tags` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `post_image` text COLLATE utf8_vietnamese_ci NOT NULL,
  `post_content` longtext COLLATE utf8_vietnamese_ci NOT NULL,
  `post_user` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `post_user_id` int(5) NOT NULL,
  `post_comments_count` int(9) NOT NULL DEFAULT 0,
  `post_views_count` int(9) NOT NULL DEFAULT 0,
  `post_likes_count` int(5) NOT NULL DEFAULT 0,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_status`, `post_tags`, `post_image`, `post_content`, `post_user`, `post_user_id`, `post_comments_count`, `post_views_count`, `post_likes_count`, `post_date`) VALUES
(6, 4, 'Masterclass Java Course', 'Javaman', 'published', 'javaman, java, masterclass', 'image_5.jpg', 'This is a nice course', 'hello', 7, 1, 53, 0, '2021-05-23'),
(7, 4, 'Masterclass Java Course', 'Javaman', 'published', 'javaman, java, masterclass', 'image_5.jpg', '<p>Not a lie. This is really helpful for anyone who wants to get java oca</p>', '', 0, 0, 36, 0, '2021-05-13'),
(8, 4, 'Cyber Security Course', 'Zaid Lambo', 'published', 'zaid, cyber, lambo', 'image_1.jpg', '<p>Hey Welcome. I make this course 1 week</p>', '', 0, 0, 7, 0, '2021-05-13'),
(9, 2, 'Javascript Master Course', 'Jonas Schedtmann', 'published', 'javascript, jonas, master', 'image_5.jpg', '<p>This is a nice little trick. Oops! I cannot reveal to you.</p>', 'vincenzo', 1, 0, 21, 0, '2021-05-16'),
(10, 3, 'Edwin PHP Master Course', 'Edwin Diaz', 'published', 'edwin, php, master', 'image_2.jpg', 'Wooooo. This is a really cool stuff.Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'vincenzo', 1, 0, 14, 0, '2021-05-23'),
(13, 1, 'Bootstrap Master Course', 'Edwin Diaz', 'published', 'bootstrap, master, edwin', 'image_3.jpg', 'Wooooo. This is a really cool stuff. The new Bootstrap\'s course', 'mukyang', 4, 0, 4, 0, '2021-05-17'),
(14, 2, 'Ionic Framework Course', 'Somebody', 'published', 'ionic, framework', 'image_1.jpg', 'Wooooo. The first step to your dream', 'donkeyking', 5, 0, 2, 0, '2021-05-17'),
(15, 3, 'Edwin PHP Master Course', 'Edwin Diaz', 'draft', '', 'image_2.jpg', 'Wooooo. This is a really cool stuff.', 'mukyang', 4, 0, 4, 0, '2021-05-17'),
(17, 3, 'Edwin\'s PHP Master Course', 'Edwin Diaz', 'published', 'edwin', 'image_2.jpg', 'Wooooo. This is a really cool stuff.', 'vincenzo', 1, 0, 4, 0, '2021-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_firstname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_lastname` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `user_image` text COLLATE utf8_vietnamese_ci NOT NULL,
  `user_role` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `randSalt` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`) VALUES
(1, 'vincenzo', '$2y$12$wUydKEqrZ8LPBlI.WCmdGuqcGMvBuJ26rHGNhNcxPvSmC0HHh84Yi', 'vincenzo', 'cassano', 'cassano@mafia.italia', '', 'admin', '', ''),
(3, 'paolo', '$2y$12$.TQGcIEngc/lQ19SKP94qejG8q7xvki8JCPIABc0xJ.wcrlrarJSO', 'paolo', 'luciano', 'luciano@mafia.italy', '', 'subscriber', '', ''),
(4, 'mukyang', '$2y$12$2/Z7PFjrKDiX5s5svXlvQ.fXZO6T5dGLG6XaXIs9ZaPGrTEFOppOa', 'mukyang', '2043', 'mukyang2044@assassin.mana', '', 'admin', '', ''),
(5, 'donkeyking', 'iamking', 'king', 'donkey', 'donkeyking@mail.io', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(6, 'tinikun', '$2y$10$iusesomecrazystrings2uz/HkvnvHFd41nowL3oLCmiMEM4CLQyW', '', '', 'tinikun@lol.vn', '', 'subscriber', '$2y$10$iusesomecrazystrings22', 'f7b555758f5cd18fee3cca55c966b9aa9f6b922a5425675465335f02c4456a2757509a8690e0a69688cfed21620a5f098cbd'),
(7, 'hello', '$2y$12$yFHYKct.3suWIFgR.njZkulKOHmIZq5JXWT28kkbh6gPAKV0TRoY.', 'hello', 'bonjour', 'hello@hi.io', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(9, 'james', '$2y$10$rKHPQCjFPZ0PrptnkyvasuyCWCncF.LoNDwdIUwJvq8bCwQNTErNa', 'james', 'bond', 'james@home.io', '', 'subscriber', '$2y$10$iusesomecrazystrings22', ''),
(15, 'edwin', '$2y$10$5YB9IjAz8eong/QghkQgp.a/yFWvRmTB2HSNFPaXQZFgqY8H5yFTW', '', '', 'edwindiaz@super.coder', '', 'subscriber', '$2y$10$iusesomecrazystrings22', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(5) NOT NULL,
  `session` varchar(100) COLLATE utf8_vietnamese_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(13, 'p8stbvau2jh5f7klevodi6dv09', 1621608682),
(14, 'nsoddcq5ctecmj5vqn197ittp8', 1621761122),
(15, 'lck5f0b709vr5l0ic9b66j0nui', 1621780482);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
