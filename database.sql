-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-01-14 12:51:52
-- 服务器版本： 5.7.28
-- PHP 版本： 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `icp`
--

-- --------------------------------------------------------

--
-- 表的结构 `icp_list`
--

CREATE TABLE `icp_list` (
  `id` int(11) NOT NULL COMMENT '站点ID',
  `site_name` text NOT NULL COMMENT '站点名称',
  `site_description` text NOT NULL COMMENT '站点描述',
  `site_main_url` text NOT NULL COMMENT '站点主页网址',
  `site_icp_url` text NOT NULL COMMENT '站点网址',
  `site_owner` text NOT NULL COMMENT '站点所有人',
  `icp_time` bigint(20) NOT NULL COMMENT '更新时间',
  `icp_status` text NOT NULL COMMENT '备案状态',
  `icp_number` text NOT NULL COMMENT '备案号',
  `by_user` int(11) NOT NULL COMMENT '绑定用户ID',
  `is_remove` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点表';

-- --------------------------------------------------------

--
-- 表的结构 `icp_settings`
--

CREATE TABLE `icp_settings` (
  `id` int(11) NOT NULL COMMENT '设置索引',
  `key_name` text NOT NULL COMMENT '设置键名',
  `key_value` text NOT NULL COMMENT '设置键值',
  `update_time` bigint(20) NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置表';

--
-- 转存表中的数据 `icp_settings`
--

INSERT INTO `icp_settings` (`id`, `key_name`, `key_value`, `update_time`) VALUES
(1, 'site_name', '云梦次元ICP备案系统', 0),
(2, 'search_placeholder', '输入备案号、网站名称或网址来查询备案', 0),
(3, 'bg_url', '/static/bg.jpg', 0),
(4, 'default_icp_status', '正常', 0);

-- --------------------------------------------------------

--
-- 表的结构 `icp_users`
--

CREATE TABLE `icp_users` (
  `id` int(11) NOT NULL COMMENT '用户索引',
  `username` text NOT NULL COMMENT '用户名',
  `displayname` text NOT NULL COMMENT '显示名称',
  `u_description` text NOT NULL COMMENT '用户描述',
  `password` text NOT NULL,
  `join_time` text NOT NULL COMMENT '加入时间',
  `u_type` int(11) NOT NULL COMMENT '用户权限',
  `email` text NOT NULL COMMENT '邮箱',
  `qq` text NOT NULL COMMENT 'QQ',
  `u_number` text NOT NULL COMMENT '用户号（类似萌号）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转储表的索引
--

--
-- 表的索引 `icp_list`
--
ALTER TABLE `icp_list`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `icp_settings`
--
ALTER TABLE `icp_settings`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `icp_users`
--
ALTER TABLE `icp_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `icp_list`
--
ALTER TABLE `icp_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '站点ID', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `icp_settings`
--
ALTER TABLE `icp_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设置索引', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `icp_users`
--
ALTER TABLE `icp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户索引', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
