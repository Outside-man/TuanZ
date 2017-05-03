<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/19
 * Time: 12:12
 */

class indexController extends \core\lib\BaseController {
    public function index(){
        if(isset($_SESSION['is_login'])&&$_SESSION['is_login']==0){
            Header("Location: /index/login");
            return ;
        }
        $this->display('index/index.html');
    }
    public function login(){
        if(!isset($_SESSION['is_login'])||$_SESSION['is_login']!=0) {
            $userService = new \app\php\service\UserService();
            $user = $userService->loginCheck($_POST['username'], $_POST['password']);
            if ($user != null) {
                $_SESSION['is_login'] = 0;
                $_SESSION['SESSION_CURRENT_USER'] = $user;
                $this->ajaxReturn($user, '登陆成功', 0);
                return;
            } else {
                Header("Location: /index/index");
                return;
            }
        }
        out($_SESSION);
        $this->assign('user', $this->getCurrentUser());
        $this->display('index/user.html');
        return ;

    }
    public function logout(){
        $this->clearCurrentUser();
        Header("Location: /index/index");
    }
    public function mail(){
        $mail = new \core\lib\mail();
        $mail = $mail->setMail($_POST['tomail'], $_POST['title'],$_POST['content'],null);
        if($mail->send()){
            $this->ajaxReturn('success', '发送成功', 0);
            return ;
        }
    }
}