<?php
namespace app\user\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class Register extends Controller
{
    public function index()
    {
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","注册");
        return $this->fetch("public@user/register_0");
    }
    public function number()
    {
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","选号");
        return $this->fetch("public@user/register_1");
    }
    public function number_can($number)
    {
        $db = Db::table("icp_list")->where("icp_number",$number)->select();
        if(count($db) > 0) return "1";
        else return "0";
    }
    public function info($n){
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","填写基本信息");
        $this->assign("number",$n);
        return $this->fetch("public@user/register_2");
    }
    public function info_check(){
        $username = $_POST["username"];
        $displayname = $_POST["displayname"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $number = $_POST["number"];
        if(mb_strlen($username) < 4) return "用户名至少要4个字";
        if(mb_strlen($username) > 12) return "用户名过长";
        if(mb_strlen($displayname) < 1) return "显示名称至少要1个字";
        if(mb_strlen($displayname) > 12) return "显示名称过长";
        if(mb_strlen($password) < 6) return "密码至少要6个字";
        if(mb_strlen($password) > 18) return "密码过长";
        if(mb_strlen($email) < 1) return "邮箱至少要写字";
        if(mb_strlen($email) > 25) return "邮箱过长";
        if($this->number_can($number) == "1") return "备案号已存在";
        if(count(Db::table("icp_users")->where("username",$username)->select()) > 0) return "用户名已存在";
        if(count(Db::table("icp_users")->where("email",$email)->select()) > 0) return "邮箱已存在";

        $newi = Db::table("icp_users")->insertGetId(["username"=>$username,"displayname"=>$displayname,"u_description"=>"","password"=>md5($password),"email"=>$email,"qq"=>"","u_type"=>0,"join_time"=>time(),"u_number"=>""]);
        Session::set("login",$newi);
        return "ok;".$newi;
    }
    public function end($n,$i){
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","填写备案信息");
        $this->assign("number",$n);
        $this->assign("userid",mb_substr($i,3,mb_strlen($i)));
        return $this->fetch("public@user/register_3");
    }
    public function end_check(){
        $sitename = $_POST["sitename"];
        $sitedesc = $_POST["sitedesc"];
        $icpowner = $_POST["icpowner"];
        $icpurl = $_POST["icpurl"];
        $mainurl = $_POST["mainurl"];
        $number = $_POST["number"];
        $userid = $_POST["userid"];
        if(mb_strlen($sitename) > 12) return "站点名称过长";
        if(mb_strlen($sitedesc) > 20) return "站点描述过长";
        if(mb_strlen($mainurl) > 30) return "首页链接过长";
        if(mb_strlen($icpurl) > 30) return "备案链接过长";
        if(mb_strlen($icpowner) > 18) return "所有人过长";
        if($this->number_can($number) == "1") return "备案号已存在";
        if(count(Db::table("icp_users")->where("id",$userid)->select()) < 0) return "用户ID不存在";

        Db::table("icp_list")->insert(["site_name"=>$sitename,"site_description"=>$sitedesc,"site_main_url"=>$mainurl,"site_icp_url"=>$icpurl,"site_owner"=>$icpowner,"icp_time"=>time(),"icp_status"=>Db::table("icp_settings")->where("key_name","default_icp_status")->value("key_value"),"icp_number"=>$number,"by_user"=>$userid]);
        return "ok";
    }
}
