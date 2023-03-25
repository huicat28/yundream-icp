<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\facade\Session;

class Index extends Controller
{
    public function index()
    {
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        if (!Session::has("login")) {
            header("Location: /user.php/login");
            exit("未登录");
        }
        $user = Db::table("icp_users")->where("id",Session::get("login"))->find();
        $this->assign("USER",$user);
        if($user["u_type"] <= 0){
            header("Location: /user.php");
            exit("无权限");
        }
        $this->assign("NAVID",0);

        $this->assign("PAGE_TITLE","管理首页");

        $this->assign("icp_count",count(Db::table("icp_list")->select()));
        $this->assign("icp_0",count(Db::table("icp_list")->whereIn("is_remove",1)->select()));
        $this->assign("icp_1",count(Db::table("icp_list")->whereIn("is_remove",0)->whereIn("icp_status","正常")->select()));
        $this->assign("icp_2",count(Db::table("icp_list")->whereIn("is_remove",0)->whereIn("icp_status","失效")->select()));
        $this->assign("icp_3",count(Db::table("icp_list")->whereIn("is_remove",0)->whereIn("icp_status","违规")->select()));
        $this->assign("icp_4",count(Db::table("icp_list")->whereIn("is_remove",0)->whereIn("icp_status","待审核")->select()));
        $this->assign("icp_5",count(Db::table("icp_list")->whereIn("is_remove",0)->whereIn("icp_status","审核未通过")->select()));

        return $this->fetch("index/index");
    }
}
