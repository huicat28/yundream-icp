<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        $this->assign("SETTING_SITENAME", Db::table("icp_settings")->where("key_name", "site_name")->value("key_value"));
        $this->assign("PAGE_TITLE", "管理员主页");
        exit("未来开发");
    }
}
