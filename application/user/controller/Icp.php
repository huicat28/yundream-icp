<?php
namespace app\user\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class Icp extends Controller
{
    public function index()
    {
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","所有备案");
        $this->assign("NAVID",1);
        if (!Session::has("login")) {
            return '登录错误';
        }
        $this->assign("USER",Db::table("icp_users")->where("id",Session::get("login"))->find());
        if(Session::has("admin"))
            $this->assign("icp_list",Db::table("icp_list")->select());
        else
            $this->assign("icp_list",Db::table("icp_list")->where("by_user",Session::get("login"))->select());
        return $this->fetch("icp/index");
    }
    public function add(){
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","新增备案");
        $this->assign("NAVID",2);
        if (!Session::has("login")) {
            return '登录错误';
        }
        $this->assign("USER",Db::table("icp_users")->where("id",Session::get("login"))->find());
        return $this->fetch("icp/add");
    }
    public function add_check(){
        $sitename = $_POST["sitename"];
        $sitedesc = $_POST["sitedesc"];
        $icpowner = $_POST["icpowner"];
        $icpurl = $_POST["icpurl"];
        $mainurl = $_POST["mainurl"];
        $number = $_POST["number"];
        if (!Session::has("login")) {
            return '登录错误';
        }
        if(mb_strlen($sitename) > 12) return "站点名称过长";
        if(mb_strlen($sitedesc) > 20) return "站点描述过长";
        if(mb_strlen($mainurl) > 30) return "首页链接过长";
        if(mb_strlen($icpurl) > 30) return "备案链接过长";
        if(mb_strlen($icpowner) > 18) return "所有人过长";
        if(count(Db::table("icp_list")->where("icp_number",$number)->select()) > 0) return "备案号已存在";

        Db::table("icp_list")->insert(["site_name"=>$sitename,"site_description"=>$sitedesc,"site_main_url"=>$mainurl,"site_icp_url"=>$icpurl,"site_owner"=>$icpowner,"icp_time"=>time(),"icp_status"=>Db::table("icp_settings")->where("key_name","default_icp_status")->value("key_value"),"icp_number"=>$number,"by_user"=>Session::get("login")]);
        return "ok";
    }
    public function del($id){
        if (Session::has("login")) {
            if(Session::has("admin")) Db::table("icp_list")->where("icp_number",$id)->update(["is_remove"=>1]);
            else{
                if(Db::table("icp_list")->where("icp_number",$id)->value("by_user") == Session::get("login")) Db::table("icp_list")->where("icp_number",$id)->update(["is_remove"=>1]);
                else return "no permissions";
            }
        }else return "login error";
    }
    public function re($id){
        if (Session::has("login")) {
            if(Session::has("admin")) Db::table("icp_list")->where("icp_number",$id )->update(["is_remove"=>0]);
            else return "no permissions";
        }else return "login error";
        return $this->redirect("/user.php/icp");
    }
}
