<?php
namespace app\admin\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class User extends Controller
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
        $this->assign("PAGE_TITLE","用户列表");
        $this->assign("NAVID",1);

        if (isset($_GET["search"])) $this->assign("user_list",Db::table("icp_users")->where("id",$_GET["search"])->whereOr("username","LIKE","%".$_GET["search"]."%")->whereOr("displayname","LIKE","%".$_GET["search"]."%")->paginate(10));
        else $this->assign("user_list",Db::table("icp_users")->paginate(10));
        return $this->fetch("user/index");
    }
    public function username_check($name){
        if (count(Db::table("icp_users")->where("username",$name)->select()) > 0) return "1";
        else return "0";
    }
    public function del($id){
        if (Session::has("login")) {
            $user = Db::table("icp_users")->where("id",Session::get("login"))->find();
            if($user["u_type"] > 0) Db::table("icp_users")->where("id",$id)->delete();
            else return "no permissions";
        }else return "login error";
    }
}
