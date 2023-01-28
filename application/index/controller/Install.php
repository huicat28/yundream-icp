<?php
namespace app\index\controller;
use think\Db;
use think\Controller;

class Install extends Controller
{
    public function index()
    {
        if (file_exists("../install")) {
            header("Location: /");
            exit("已经安装");
        }
        return $this->fetch("public@install/index");
    }
    public function next()
    {
        if (file_exists("../install")) {
            header("Location: /");
            exit("已经安装");
        }
        try {
            $_sql = file_get_contents("../database.sql");
            $_arr = explode(';',$_sql);
            foreach ($_arr as $_value){
                if($_value == "") continue;
                Db::query($_value.';');
            }
        }catch (\Exception $e){
            $this->assign("error",$e);
            return $this->fetch("public@install/index2");
        }
        return $this->fetch("public@install/next");
    }
    public function next2()
    {
        if (file_exists("../install")) {
            header("Location: /");
            exit("已经安装");
        }
        return $this->fetch("public@install/next2");
    }
    public function next2b()
    {
        if (file_exists("../install")) {
            header("Location: /");
            exit("已经安装");
        }
        try {
            Db::table("icp_settings")->where("key_name","site_name")->update(["key_value"=>$_GET["site_name"]]);
            Db::table("icp_settings")->where("key_name","search_placeholder")->update(["key_value"=>$_GET["search_placeholder"]]);
            Db::table("icp_settings")->where("key_name","bg_url")->update(["key_value"=>$_GET["bg_url"]]);
            Db::table("icp_settings")->where("key_name","default_icp_status")->update(["key_value"=>$_GET["default_icp_status"]]);
            Db::table("icp_users")->insert(["username"=>"admin","displayname"=>"管理员","u_description"=>"","password"=>md5("123456"),"join_time"=>0,"u_type"=>2,"email"=>"","qq"=>"","u_number"=>"0"]);
            file_put_contents("../install","come的喂，ABC！".SYS_VERSION);
        }catch (\Exception $e){
            $this->assign("error",$e);
            return $this->fetch("public@install/next2a");
        }
        return $this->fetch("public@install/next2b");
    }
}
