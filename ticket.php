<?php
$request_url=str_replace("ticket.php","",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
ini_set("display_errors", 1);
echo $access_token_file = file_get_contents($request_url."access_token.php");
$access_token_file = json_decode($access_token_file, true);
$access_token = $access_token_file['access_token'];
echo $access_token;
echo "</br>1</br>";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
curl_setopt($ch, CURLOPT_HEADER, 0);
$ticketfile = curl_exec($ch);
curl_close($ch);
//$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
echo $ticketfile;
echo "</br>2</br>";
$ticketfile = json_decode($ticketfile, true);
$ticket = $ticketfile['ticket'];
$time = time()+ $ticketfile['expires_in'];
echo $time;
echo "</br>3</br>";
echo $ticket;
echo "</br>4</br>";
$fp = fopen("time.txt", "w");
fwrite($fp,$time);
fclose($fp);
$fp = fopen("ticket.txt", "w");
fwrite($fp,$ticket);
fclose($fp);
echo 1;	
?>