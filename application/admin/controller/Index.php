<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\facade\Session;

class Index extends Controller
{
    public function index()
    {
        return redirect("/user.php");
    }
}
