<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 基础控制器，负责验证用户有没有登录
 */
class BaseController extends Controller {

    public function __construct()
    {
        if(!session(['id'])){
            redirect("Admin/Login/login");
            // $this->error('请先登录',U('Login/login'));
        }
        parent::__construct();
    }




}










