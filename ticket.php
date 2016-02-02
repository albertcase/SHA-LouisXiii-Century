<?php
ini_set("display_errors", 1);
$access_token_file = file_get_contents("access_token.php");
$access_token_file = json_decode($access_token_file, true);
$access_token = $access_token_file['access_token'];
echo $access_token;
echo "</br>1</br>";
$ticketfile = file_get_contents("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi");
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