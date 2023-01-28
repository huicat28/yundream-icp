<?php
namespace app\user\controller;
use think\Db;
use think\facade\Session;
use think\Controller;
class Settings extends Controller
{
    public function index()
    {
        $this->assign("SETTING_SITENAME",Db::table("icp_settings")->where("key_name","site_name")->value("key_value"));
        $this->assign("PAGE_TITLE","个人设置");
        $this->assign("NAVID",3);
        if (!Session::has("login")) {
            header("Location: /user.php/login");
            exit("未登录");
        }
        $this->assign("USER",Db::table("icp_users")->where("id",Session::get("login"))->find());
        return $this->fetch("settings/index");
    }
    public function check(){
        if (!Session::has("login")) {
            return "登录错误";
        }
        $displayname = $_POST["displayname"];
        $description = $_POST["description"];
        $email = $_POST["email"];
        if(mb_strlen($displayname) < 1) return "显示名称至少要1个字";
        if(mb_strlen($displayname) > 12) return "显示名称过长";
        if(mb_strlen($email) < 1) return "邮箱至少要写字";
        if(mb_strlen($email) > 25) return "邮箱过长";
        if(mb_strlen($description) > 150) return "个人描述过长";
        Db::table("icp_users")->where("id",Session::get("login"))->update(["displayname"=>$displayname,"u_description"=>$description,"email"=>$email]);
        return 'ok';
    }
    public function check_u($u){
        if(count(Db::table("icp_users")->where("username",$u)->select()) > 0) return "1";
        else return "0";
    }
    public function update_u($u){
        if(!$this->check_u($u)){
            Db::table("icp_users")->where("id",Session::get("login"))->update(["username"=>$u]);
            return "1";
        }else return "0";
    }
    public function update_p($o,$p){
        if(Db::table("icp_users")->where("id",Session::get("login"))->value("password") == md5($o)){
            Db::table("icp_users")->where("id",Session::get("login"))->update(["password"=>md5($p)]);
            return "1";
        }else return "0";
    }
}
