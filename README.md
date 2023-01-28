云梦次元ICP备案系统
===============

[![Stars](https://badgen.net/github/stars/huicat28/yundream-icp?style=flat-square)](https://github.com/huicat28/yundream-icp)
[![Latest Stable Version](https://badgen.net/github/release/huicat28/yundream-icp?style=flat-square)](https://github.com/huicat28/yundream-icp/releases)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D5.6-8892BF.svg?style=flat-square)](http://www.php.net/)

### 提示：本系统仅能用于娱乐性质！！！！！

## 源码介绍

![介绍图](https://github.com/huicat28/yundream-icp/blob/master/README.png?raw=true)

本源码为模仿萌国ICP备案系统，目的是让各位可以自己搭建一个自己的“ICP备案”。

本源码完全开源免费，如果您是付费获得的此源码，您就是被骗了。

## 安装教程

~~1.将根目录下的`database.sql`导入到数据库中~~

~~2.修改`config\database.php`文件，填写自己的数据库信息~~

~~3.修改站点配置，将运行目录设置为`/public`文件夹~~

~~4.修改伪静态设置，选择`Thinkphp`伪静态配置文件~~

访问`你的网站域名/install.php`并按照提示进行安装

## QA

### 从老版本升级过来要重新安装怎么办

#### 解决方法
在网站根目录创建一个名叫`install`的文件，不要写扩展名。在里面写上`come的喂，ABC！v1.1.2`。

## 定制教程

### 目录结构

`application\public\view\user`文件夹中存放前端和用户登录以及注册有关的前端文件

`application\public\view\index`文件夹中存放前端和首页、关于以及查询结果有关的前端文件

`application\public\view\install`文件夹中存放安装程序的前端文件

`application\public\view\inc`文件夹中存放前端的各种js以及css引用

`application\user\view\icp`文件夹中存放后台管理的和ICP备案管理有关的页面文件

`application\user\view\index`文件夹中存放后台管理主页的页面文件

`application\user\view\public`文件夹中存放后台管理的导航以及各种js和css引用的页面文件

`public\favicon.ico`为网站缩略图

`public\static\bg.jpg`为默认的前台背景图

`public\static\yshst.ttf`为默认的前台字体

`public\static\hmsans.ttf`为默认的后台管理字体

`public\static\style.css`为默认的样式

### 数据库结构

#### icp_users表

`icp_users`表存储用户信息

#### icp_settings表

`icp_settings`表存储网站设置

##### 结构

`id`→数据库索引

`key_name`→设置的键值名称

`key_value`→设置的键值

`update_time`→设置的更新时间

##### 数据

| key_name           | 该项目的作用                        |
| ------------------ | ----------------------------------- |
| site_name          | 网站的名称（显示在主页以及标题栏）  |
| search_placeholder | 主页搜索查询空置时的占位符          |
| bg_url             | 前端背景图的网址                    |
| default_icp_status | 后台管理申请ICP备案后默认的备案状态 |

#### icp_list表

`icp_settings`表存储备案数据

#### 其他

每个表的结构都写了备注，具体作用请看备注。

## 版权信息

云梦次元ICP备案系统遵循Apache2开源协议发布，并提供免费使用。

版权所有Copyright © 2023 by 云梦次元（http://www.whitedream.cn）

---

本项目包含的第三方源码：

Thinkphp5.1



第三方源码版权信息：

默认背景图片来源于`萌国ICP备案`

版权所有Copyright © 2006-2018 by ThinkPHP (http://thinkphp.cn)

ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

