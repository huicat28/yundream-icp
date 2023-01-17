<?php
namespace app\user\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class Login extends Controller
{
    public function index()
    {
        $this->assign("SETTING_BGURL",Db::table("icp_settings")->where("key_name","bg_url")->value("key_value"));
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","登录");
        return $this->fetch("public@user/login");
    }
    public function check(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(mb_strlen($username) < 4) return "用户名至少要4个字";
        if(mb_strlen($username) > 12) return "用户名过长";
        if(mb_strlen($password) < 6) return "密码至少要6个字";
        if(mb_strlen($password) > 18) return "密码过长";
        if(count(Db::table("icp_users")->where("username",$username)->select()) < 0) return "用户名或密码错误不存在";
        if(Db::table("icp_users")->where("username",$username)->value("password") == md5($password)) {
            Session::set("login",Db::table("icp_users")->where("username",$username)->value("id"));
            return "ok";
        }
        else return "用户名或密码错误不存在";
    }
    public function loginout(){
        if(Session::has("login")) Session::delete("login");
        header("Location: /");
        exit();
    }
}
