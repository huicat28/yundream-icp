<?php
namespace app\admin\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class Icp extends Controller
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
        $this->assign("PAGE_TITLE","备案列表");
        $this->assign("NAVID",1);

        if (isset($_GET["search"])) $this->assign("icp_list",Db::table("icp_list")->where("icp_number",$_GET["search"])->whereOr("site_name","LIKE","%".$_GET["search"]."%")->paginate(10));
        else $this->assign("icp_list",Db::table("icp_list")->paginate(10));
        return $this->fetch("icp/index");
    }
    public function add(){
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
        $this->assign("PAGE_TITLE","添加备案");
        $this->assign("NAVID",2);
        return $this->fetch("icp/add");
    }
    public function add_check(){
        $icp_user = $_POST["user"];
        $sitename = $_POST["sitename"];
        $sitedesc = $_POST["sitedesc"];
        $icpowner = $_POST["icpowner"];
        $icpurl = $_POST["icpurl"];
        $mainurl = $_POST["mainurl"];
        $number = $_POST["number"];
        if (!Session::has("login")) {
            return '登录错误';
        }
        $user = Db::table("icp_users")->where("id",Session::get("login"))->find();
        if($user["u_type"] <= 0){
            header("Location: /user.php");
            exit("无权限");
        }
        if(mb_strlen($sitename) > 12) return "站点名称过长";
        if(mb_strlen($sitedesc) > 20) return "站点描述过长";
        if(mb_strlen($mainurl) > 30) return "首页链接过长";
        if(mb_strlen($icpurl) > 30) return "备案链接过长";
        if(mb_strlen($icpowner) > 18) return "所有人过长";
        if($this->add_user_check($icp_user) == "0") return "用户不存在";
        if(count(Db::table("icp_list")->where("icp_number",$number)->select()) > 0) return "备案号已存在";

        Db::table("icp_list")->insert(["site_name"=>$sitename,"site_description"=>$sitedesc,"site_main_url"=>$mainurl,"site_icp_url"=>$icpurl,"site_owner"=>$icpowner,"icp_time"=>time(),"icp_status"=>Db::table("icp_settings")->where("key_name","default_icp_status")->value("key_value"),"icp_number"=>$number,"by_user"=>Session::get("login")]);
        return "ok";
    }
    public function add_user_check($id){
        if (count(Db::table("icp_users")->where("id",$id)->select()) > 0) return "1";
        else return "0";
    }
    public function del($id){
        if (Session::has("login")) {
            $user = Db::table("icp_users")->where("id",Session::get("login"))->find();
            if($user["u_type"] > 0) Db::table("icp_list")->where("icp_number",$id)->update(["is_remove"=>1]);
            else return "no permissions";
        }else return "login error";
    }
    public function del_sure($id){
        if (Session::has("login")) {
            $user = Db::table("icp_users")->where("id",Session::get("login"))->find();
            if($user["u_type"] > 0) Db::table("icp_list")->where("icp_number",$id)->delete();
            else return "no permissions";
        }else return "login error";
    }
}
