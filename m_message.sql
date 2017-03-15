-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 03 月 15 日 09:09
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
-- 表的结构 `m_message`
--

CREATE TABLE IF NOT EXISTS `m_message` (
  `m_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `m_to_user` varchar(20) NOT NULL COMMENT '信息接受者',
  `m_from_user` varchar(20) NOT NULL COMMENT '发信息者',
  `m_content` varchar(500) NOT NULL COMMENT '信息内容',
  `m_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '表示阅读状态',
  `m_date` datetime NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `m_message`
--

INSERT INTO `m_message` (`m_id`, `m_to_user`, `m_from_user`, `m_content`, `m_state`, `m_date`) VALUES
(11, 'weng', '用户4', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:49:47'),
(12, 'weng', '用户5', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:50:18'),
(21, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:33'),
(22, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:40'),
(23, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 1, '2017-03-12 00:54:50'),
(24, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:54:56'),
(25, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:55:02'),
(26, 'weng', 'yonghu1', '生活赋予我们一种巨大的和无限高贵的礼品，这就是青春：充满着力量，充满着期待志愿，充满着求知和斗争的志向，充满着希望信心和青春。', 0, '2017-03-12 00:55:08'),
(30, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 0, '2017-03-15 14:47:37'),
(31, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 0, '2017-03-15 14:47:44'),
(32, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 1, '2017-03-15 14:47:48'),
(33, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 0, '2017-03-15 14:47:52'),
(34, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 1, '2017-03-15 14:47:57'),
(35, 'weng', 'yonghu2', '每个人开始都是一杯浑浊的水，然后会不断有人来帮你澄清。当你变得清澈的时候，别忘了那些喝了泥沙的人。', 1, '2017-03-15 14:48:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
