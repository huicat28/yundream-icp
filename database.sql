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
CREATE TABLE `icp_settings` (
  `id` int(11) NOT NULL COMMENT '设置索引',
  `key_name` text NOT NULL COMMENT '设置键名',
  `key_value` text NOT NULL COMMENT '设置键值',
  `update_time` bigint(20) NOT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='设置表';
INSERT INTO `icp_settings` (`id`, `key_name`, `key_value`, `update_time`) VALUES
(1, 'site_name', '云梦次元ICP备案系统', 0),
(2, 'search_placeholder', '输入备案号、网站名称或网址来查询备案', 0),
(3, 'bg_url', '/static/bg.jpg', 0),
(4, 'default_icp_status', '正常', 0);
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
ALTER TABLE `icp_list`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `icp_settings`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `icp_users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `icp_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '站点ID', AUTO_INCREMENT=4;
ALTER TABLE `icp_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '设置索引', AUTO_INCREMENT=5;
ALTER TABLE `icp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户索引', AUTO_INCREMENT=6;