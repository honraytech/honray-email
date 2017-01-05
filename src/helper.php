<?php
    
/**
+----------------------------------------------------------
 * 功能：系统邮件发送函数
+----------------------------------------------------------
 * @param string $config        邮箱配置
    //邮箱配置
    'config' => array ( 
        'smtp_host' => 'smtp.exmail.qq.com', SMTP 服务器
        'smtp_port' => '25',                 SMTP服务器的端口号
        'from_email' => 'xxxx@xxx.com',      设置发件人地址   
        'from_name' => 'xxxx',               设置发件人名称    
        'smtp_user' => 'xxx@xxxx.com',       SMTP服务器用户名
        'smtp_pass' => 'xxxx',               SMTP服务器密码
        'reply_email' => '', 
        'reply_name' => '', 
        'test_email' => '', 
    ),
 * @param string $to            接收邮件者邮箱
 * @param string $name          接收邮件者名称
 * @param string $subject       邮件主题
 * @param string $body          邮件内容
 * @param string $attachment 附件列表namespace
+----------------------------------------------------------
 * @return boolean
+----------------------------------------------------------
 */

use think\email\PHPMailer\PHPMailer;

function send_email($config, $to, $name, $subject, $body, $attachment = null)
{
    $mail = new PHPMailer();                                // PHPMailer对象
    $mail->CharSet = 'UTF-8';                               // 设置邮件编码
    $mail->IsSMTP();                                        // 设定使用SMTP服务
    $mail->IsHTML(true);                                    // 可以发送html格式   
    $mail->SMTPDebug = 0;                                   // 关闭SMTP调试功能
    $mail->SMTPAuth = true;                                 // 启用 SMTP 验证功能
    if ($config['smtp_port'] == 465){
        $mail->SMTPSecure = 'ssl';                          // 使用安全协议
    }
    $mail->Host = $config['smtp_host'];                     // SMTP 服务器
    $mail->Port = $config['smtp_port'];                     // SMTP服务器的端口号
    $mail->Username = $config['smtp_user'];                 // SMTP服务器用户名
    $mail->Password = $config['smtp_pass'];                 // SMTP服务器密码
    $mail->SetFrom($config['from_email'], $config['from_name']);
    $replyEmail = $config['reply_email'] ? $config['reply_email'] : $config['reply_email'];
    $replyName = $config['reply_name'] ? $config['reply_name'] : $config['reply_name'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            if (is_array($file)) {
                is_file($file['path']) && $mail->AddAttachment($file['path'], $file['name']);
            } else {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
    } else {
        is_file($attachment) && $mail->AddAttachment($attachment);
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}
?>