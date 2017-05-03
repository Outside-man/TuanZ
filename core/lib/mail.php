<?php

/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/25
 * Time: 20:24
 */
namespace core\lib;
use core\tuanz;

require_once 'PHPMailer/PHPMailerAutoload.php';
//ubuntu 系统下使用
//require_once 'PHPMailer\PHPMailerAutoload.php';
class mail{
    public $mail = null;
    function __construct(){
        $config = tuanz::getConfig('MailConfig.xml');
        $mail = new \PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet = $config['CharSet']; //设置邮件的字符编码
        $mail->SMTPAuth = true;//开启认证
        $mail->Port = $config['Port'];
        $mail->Host = $config['Host'];
        $mail->Username = $config['Username'];
        $mail->Password = $config['Password'];
        $mail->AddReplyTo($config['AddReplyToMail'],$config['AddReplyToName']);//回复地址
        $mail->From = $config['From'];//发件人
        $mail->FromName = $config['FromName'];//发件人
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        //当邮件不支持html时备用显示，可以省略
        $mail->WordWrap = $config['WordWrap']; // 设置每行字符串的长度
        $mail->IsHTML(true);
        $this->mail = $mail;
    }
    public function setMail($tomail, $title, $content, $file){
        try {
            $this->mail->addAddress($tomail);//收件人
            $this->mail->Subject = $title;
            $this->mail->Body = $content;
            if($file!=null)
                $this->mail->AddAttachment($file); //添加附件
            return $this->mail;
        }catch (\Exception $e){
//            echo "邮件设置失败：".$e->errorMessage();
            return false;
        }

    }
    public function sendMail(){
        try{
            $this->mail->Send();
            return true;
        }catch (\Exception $e){
//            echo "邮件发送失败：".$e->errorMessage();
            return false;
        }
    }
}