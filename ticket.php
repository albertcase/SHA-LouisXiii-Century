<?php
$access_token = file_get_contents("http://wx.bysoftchina.com.cn/wx-token/token.php");
$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
$ticketfile = json_decode($ticketfile, true);
$ticket = $ticketfile['ticket'];
$time = time()+ $ticketfile['expires_in'];
$fp = fopen("time.txt", "w");
fwrite($fp,$time);
fclose($fp);
$fp = fopen("ticket.txt", "w");
fwrite($fp,$ticket);
fclose($fp);
echo $ticket;	
?>