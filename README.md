# honray-email
thinkphp5 系统邮件发送函数

## 安装


> composer require honray/tp5-email


##使用



#####执行方法send_email($config, $to, $name, $subject, $body, $attachment = null)


 * 功能：系统邮件发送函数
 * @param string $config       
 *   邮箱配置
 *   'config' => array ( 
 *       'smtp_host' => 'smtp.exmail.qq.com', SMTP 服务器
 *       'smtp_port' => '25',                 SMTP服务器的端口号
 *       'from_email' => 'xxxx@xxx.com',      设置发件人地址   
 *       'from_name' => 'xxxx',               设置发件人名称    
 *       'smtp_user' => 'xxx@xxxx.com',       SMTP服务器用户名
 *       'smtp_pass' => 'xxxx',               SMTP服务器密码
 *       'reply_email' => '', 
 *       'reply_name' => '', 
 *       'test_email' => '', 
 *   ),
 * @param string $to            接收邮件者邮箱
 * @param string $name          接收邮件者名称
 * @param string $subject       邮件主题
 * @param string $body          邮件内容
 * @param string $attachment 附件列表namespace