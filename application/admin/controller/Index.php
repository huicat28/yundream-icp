<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\facade\Session;

class Index extends Controller
{
    public function index()
    {
        if(isset($_GET["r"]) && !empty($_GET)){
            Session::delete("admin");
        }else{
            if (!Session::has("login")) {
                header("Location: /user.php/login");
                exit("未登录");
            }
            if (Db::table("icp_users")->where("id",Session::get("login"))->value("u_type") < 1) {
                $this->error("用户权限不足","/user.php");
            }
            Session::set("admin",1);
        }
        return redirect("/user.php");
    }
}
