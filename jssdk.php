<?php
$url = isset($_GET['url']) ? $_GET['url'] : "";
$appid = "wx58a67f867fcafc39";
$time=file_get_contents("upload/time.txt");
$ticket=file_get_contents("upload/ticket.txt");
if (time()>=$time) {
	$access_token = file_get_contents("http://wx.bysoftchina.com.cn/wx-token/token.php");
	$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
	$ticketfile = json_decode($ticketfile, true);
	$ticket = $ticketfile['ticket'];
	$time = time()+ $ticketfile['expires_in'];
	$fp = fopen("upload/time.txt", "w");
	fwrite($fp,$time);
	fclose($fp);
	$fp = fopen("upload/ticket.txt", "w");
	fwrite($fp,$ticket);
	fclose($fp);
}
$str = '1234567890abcdefghijklmnopqrstuvwxyz';
$noncestr = '';
for($i=0;$i<8;$i++){
$randval = mt_rand(0,35);
$noncestr .= $str[$randval];
}
$ticketstr="jsapi_ticket=". $ticket ."&noncestr=". $noncestr ."&timestamp=". $time ."&url=". $url;
$sign = sha1($ticketstr);
return json_encode(array("appid" => $appid, "timestamp" => $time, "noncestr" => $noncestr, "sign" => $sign, "url" => $url));	
?>