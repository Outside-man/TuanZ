<?php

/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/25
 * Time: 13:26
 */
class userController extends \core\lib\BaseController {
    public function register(){
        $userService = new \app\php\service\UserService();
        $user = $userService->register($_POST['username'], $_POST['password']);
        if ($user) {
            $this->ajaxReturn($user, '注册成功', 0);
            return;
        } else {
            $this->ajaxReturn($user, '已存在用户名', 1);
            return;
        }
    }
}