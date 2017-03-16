-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 03 月 16 日 14:14
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `message`
--

-- --------------------------------------------------------

--
-- 表的结构 `m_friend`
--

CREATE TABLE IF NOT EXISTS `m_friend` (
  `m_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_added_user` varchar(20) NOT NULL COMMENT '被添加好友者',
  `m_request_user` varchar(20) NOT NULL COMMENT '发出添加请求者',
  `m_content` varchar(40) NOT NULL COMMENT '验证内容',
  `m_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '好友状态',
  `m_date` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `m_friend`
--

INSERT INTO `m_friend` (`m_id`, `m_added_user`, `m_request_user`, `m_content`, `m_state`, `m_date`) VALUES
(1, 'admin4', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:11:39'),
(2, 'admin3', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:23:08'),
(3, 'admin2', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:24:13'),
(4, 'admin1', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:24:42'),
(5, 'yonghu5', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:43:38'),
(6, 'yonghu6', 'weng', '你好，我是weng,想和你交个朋友...', 0, '2017-03-15 20:43:44'),
(9, 'weng', '用户1', '你好，我是用户1,想和你交个朋友...', 0, '2017-03-15 20:46:29'),
(10, 'weng', '用户2', '你好，我是用户2,想和你交个朋友...', 1, '2017-03-15 20:46:57'),
(11, 'weng', '用户3', '你好，我是用户3,想和你交个朋友...', 0, '2017-03-15 22:06:41'),
(12, 'weng', '用户4', '你好，我是用户4,想和你交个朋友...', 0, '2017-03-15 22:07:16'),
(13, 'weng', 'yonghu1', '你好，我是yonghu1,想和你交个朋友...', 0, '2017-03-15 22:07:55');

-- --------------------------------------------------------

--
-- 表的结构 `m_message`
--

CREATE TABLE IF NOT EXISTS `m_message` (
  `m_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_to_user` varchar(20) NOT NULL COMMENT '信息接受者',
  `m_from_user` varchar(20) NOT NULL COMMENT '发信息者',
  `m_content` varchar(500) NOT NULL COMMENT '信息内容',
  `m_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '阅读状态,0表示未读，1表示已读',
  `m_date` datetime NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `m_message`
--

INSERT INTO `m_message` (`m_id`, `m_to_user`, `m_from_user`, `m_content`, `m_state`, `m_date`) VALUES
(11, 'weng', '用户4', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:49:47'),
(12, 'weng', '用户5', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:50:18'),
(21, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:33'),
(22, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:40'),
(23, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:50'),
(24, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:56'),
(25, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:55:02'),
(26, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:55:08'),
(27, 'weng', 'yonghu2', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 05:11:47'),
(28, 'weng', 'yonghu2', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 05:11:52'),
(29, 'weng', 'yonghu2', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 1, '2017-03-12 05:11:58'),
(30, 'admin4', 'weng', 'hello,admin4', 0, '2017-03-15 20:38:15');

-- --------------------------------------------------------

--
-- 表的结构 `m_user`
--

CREATE TABLE IF NOT EXISTS `m_user` (
  `m_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户自动编号',
  `m_uniqid` char(40) NOT NULL COMMENT '注册唯一标识符',
  `m_active` char(40) NOT NULL COMMENT '登录唯一标识符',
  `m_username` varchar(20) NOT NULL COMMENT '用户名',
  `m_password` char(40) NOT NULL COMMENT '密码',
  `m_question` varchar(30) NOT NULL COMMENT '提问',
  `m_answer` char(40) NOT NULL COMMENT '提问回答',
  `m_sex` char(3) NOT NULL COMMENT '性别',
  `m_face` varchar(20) NOT NULL COMMENT '头像',
  `m_email` varchar(30) DEFAULT NULL COMMENT 'email',
  `m_qq` varchar(10) DEFAULT NULL COMMENT 'qq',
  `m_url` varchar(40) DEFAULT NULL COMMENT '个人网址',
  `m_level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '权限，1表示管理员，0表示普通会员',
  `m_regtime` datetime NOT NULL COMMENT '注册时间',
  `m_last_logtime` datetime NOT NULL COMMENT '最后登录时间',
  `m_lastip` varchar(20) NOT NULL COMMENT '最后登录IP',
  `m_logtimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '记录登录次数',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `m_user`
--

INSERT INTO `m_user` (`m_id`, `m_uniqid`, `m_active`, `m_username`, `m_password`, `m_question`, `m_answer`, `m_sex`, `m_face`, `m_email`, `m_qq`, `m_url`, `m_level`, `m_regtime`, `m_last_logtime`, `m_lastip`, `m_logtimes`) VALUES
(5, 'b96eca8a9f0b065675505e4c29b0695ff9b53003', '', '用户1', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/30.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 14:53:48', '2017-03-15 20:46:19', '::1', 2),
(6, '259459c7a774321471051625c0199d9e283d9c3f', '', '用户2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/15.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 14:54:34', '2017-03-15 20:46:48', '::1', 2),
(7, '47b77c6ea624a9a02df6ee7ef7e456bdec7177d1', '', '用户3', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/11.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 14:55:08', '2017-03-15 22:06:13', '::1', 2),
(8, '178db9d95d1a96733fa0bdafe6a6cc33fdb2105a', '', '用户4', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/3.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 14:55:46', '2017-03-15 22:07:07', '::1', 2),
(9, '07f2d6b71b9d78c591d36cd233cef754493bd004', '', '用户5', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/12.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:05:38', '2017-03-12 00:50:06', '::1', 1),
(10, '1c98293d14627a0ba872fc314ccd9c08f5335914', '', '用户6', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/5.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:06:10', '2017-03-12 00:50:34', '::1', 1),
(11, 'b71ce6123846ef170dbf2000b5ce017ec6d44acc', '', '用户7', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/26.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:06:42', '2017-03-12 00:51:02', '::1', 1),
(12, '6f56d763fb55143bf1c14ac18f9a7ab6b77f704a', '', '用户8', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/11.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:07:27', '2017-03-12 00:51:27', '::1', 1),
(13, '23fbd49478130dcfff2f93ee5a23c851a5584fa2', '', '用户9', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/32.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:07:56', '2017-03-12 00:51:56', '::1', 1),
(14, 'e7ce03feedec7c86599983913802e3dbcfad355e', '', '用户10', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/41.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:08:50', '2017-03-12 00:52:21', '::1', 1),
(15, 'c434b9d1881beaf9dc6816ab97bc2d7cf687f58e', '', '用户11', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/28.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:09:12', '2017-03-12 00:52:48', '::1', 1),
(16, 'b0f274a1f203c5f3db2ae098aea44f029144dd1b', '', '用户12', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/48.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:09:41', '2017-03-12 00:53:26', '::1', 1),
(17, '402e3519b87f8853c42ac6ecb19155cfa0407bbd', '', '用户13', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/51.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:10:07', '2017-03-12 00:53:54', '::1', 1),
(18, 'b335a1d255f40ea57816ea52418b799f1f25b3e3', '', '用户14', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/49.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:10:52', '2017-03-07 15:10:52', '::1', 0),
(19, '6835943a6aedcc25cea53c788de981e316764311', '', '用户15', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/33.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:11:26', '2017-03-07 15:11:26', '::1', 0),
(20, 'ebfbc3ec6fb9e9bc96f1daa947b5c937f7556d3f', '', '用户16', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/43.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:11:55', '2017-03-07 15:11:55', '::1', 0),
(21, 'af9b61165db40d522752194e03c1c1aee38746ce', '', 'yonghu1', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/10.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:12:52', '2017-03-16 21:12:53', '::1', 5),
(22, '7f6194e655547ef3b580fc7f7d8afe1bd0bb719b', '', 'yonghu2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/37.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:13:24', '2017-03-12 05:11:37', '::1', 1),
(23, '36e5fba05aee8de38a5d16551417e8bd1001484a', '', 'yonghu3', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/40.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:13:49', '2017-03-15 20:45:18', '::1', 2),
(24, '0beffef92298015ba3c638a0b6594765cba7e9ad', '', 'yonghu4', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/38.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:14:16', '2017-03-07 15:14:16', '::1', 0),
(25, '99470965e5f6759c2668c8972e0963cd528b9681', '', 'yonghu5', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/47.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:14:41', '2017-03-15 20:45:50', '::1', 1),
(26, 'a21931c1118f50132d4730622220c6de9591b45b', '', 'yonghu6', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/41.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:15:09', '2017-03-07 15:15:09', '::1', 0),
(27, '704972e45499dfd5061e617b5918bc2964b242b6', '', 'admin1', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/50.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:15:35', '2017-03-07 15:15:35', '::1', 0),
(28, 'd7deab1c831b79ab74f9d2c270799902e5a4fe10', '', 'admin2', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/29.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:16:05', '2017-03-07 15:16:05', '::1', 0),
(29, '6fae8cb54777870f6c36b8a0513ee2cbf9467a8b', '', 'admin3', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '男', 'images/face/25.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:16:34', '2017-03-07 15:16:34', '::1', 0),
(30, '7111252da64712fc298db4af68542b51ef0f2d8d', '', 'admin4', '7c4a8d09ca3762af61e59520943dc26494f8941b', '11111', '1111', '女', 'images/face/30.jpg', 'yqwq@136.com', '46541213', 'http://www.vv.com', 0, '2017-03-07 15:16:58', '2017-03-07 15:16:58', '::1', 0),
(31, '', '', 'user1', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(32, '', '', 'user2', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(33, '', '', 'user3', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(34, '', '', 'user4', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(35, '', '', 'user5', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(36, '', '', 'user6', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(37, '', '', 'user7', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(38, '', '', 'user8', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(39, '', '', 'user9', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(40, '', '', 'user10', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(41, '', '', 'user11', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(42, '', '', 'user12', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(43, '', '', 'user13', '123456', '1111', '1111', '男', 'images/face/30.jpg', 'weng@163.com', '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', 0),
(44, 'b7bff6b20d4c4abcd803c87ffdf9f9a4d090b40b', '', 'weng', '7c4a8d09ca3762af61e59520943dc26494f8941b', '我的家在哪里', '巫山', '男', 'images/face/32.jpg', 'weng@163.com', '12345667', 'http://weng.com.cn', 1, '2017-03-09 21:54:36', '2017-03-16 21:15:52', '::1', 12);

-- --------------------------------------------------------

--
-- 表的结构 `m_zan`
--

CREATE TABLE IF NOT EXISTS `m_zan` (
  `m_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_to_user` varchar(20) NOT NULL COMMENT '鲜花接收者',
  `m_from_user` varchar(20) NOT NULL COMMENT '送花者',
  `m_zan_num` mediumint(8) unsigned NOT NULL COMMENT '赞',
  `m_date` datetime NOT NULL COMMENT '送花时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `m_zan`
--

INSERT INTO `m_zan` (`m_id`, `m_to_user`, `m_from_user`, `m_zan_num`, `m_date`) VALUES
(1, 'admin2', 'weng', 1, '2017-03-16 21:08:09'),
(2, 'weng', 'yonghu1', 1, '2017-03-16 21:13:01'),
(3, 'weng', 'yonghu3', 1, '2017-03-16 21:15:15'),
(4, 'weng', 'yonghu4', 1, '2017-03-16 21:15:21'),
(6, 'weng', '用户1', 1, '2017-03-16 21:15:35'),
(7, 'weng', '用户2', 1, '2017-03-16 21:15:39'),
(8, 'weng', '用户3', 1, '2017-03-16 21:20:14'),
(9, 'weng', '用户4', 1, '2017-03-16 21:20:18'),
(10, 'weng', '用户5', 1, '2017-03-16 21:20:23'),
(11, 'weng', '用户6', 1, '2017-03-16 21:20:27'),
(12, 'weng', '用户7', 1, '2017-03-16 21:20:32'),
(13, 'weng', '用户8', 1, '2017-03-16 21:20:45'),
(15, 'weng', '用户10', 1, '2017-03-16 21:20:55'),
(17, '用户9', 'weng', 1, '2017-03-16 21:55:23'),
(18, '用户8', 'weng', 1, '2017-03-16 21:55:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
