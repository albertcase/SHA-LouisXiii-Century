<?php
$url = isset($_GET['url']) ? $_GET['url'] : "";
$appid = "wx58a67f867fcafc39";
$time=file_get_contents("time.txt");
$ticket=file_get_contents("ticket.txt");
if (time()>=$time) {
	$request_url=str_replace("jssdk.php","",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
	$access_token_file = file_get_contents($request_url."access_token.php");
	$access_token_file = json_decode($access_token_file, true);
	$access_token = $access_token_file['access_token'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$ticketfile = curl_exec($ch);
	curl_close($ch);
	//$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
	$ticketfile = json_decode($ticketfile, true);
	$ticket = $ticketfile['ticket'];
	$time = time()+ $ticketfile['expires_in'];
	$fp = fopen("time.txt", "w");
	fwrite($fp,$time);
	fclose($fp);
	$fp = fopen("ticket.txt", "w");
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
echo json_encode(array("appid" => $appid, "timestamp" => $time, "noncestr" => $noncestr, "sign" => $sign, "url" => $url));	
?>