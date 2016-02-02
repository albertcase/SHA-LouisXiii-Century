<?php
$appid = 'wx58a67f867fcafc39';
$secret = '4fa9a62da0cc3c2b94053ae76e14f5f7';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$rs = curl_exec($ch);
curl_close($ch);
//$rs = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$secret);
$rs = json_decode($rs,true);
$array= array();
if(isset($rs['access_token'])){	
	$time = time() + $rs['expires_in'];
	$access_token = $rs['access_token'];		
	$fp = fopen("access_token_time.txt", "w");
	fwrite($fp, $time);
	fclose($fp);
	$fp = fopen("access_token.txt", "w");
	fwrite($fp, $access_token);
	fclose($fp);
	$array['expires_in'] = $rs['expires_in'];
	$array['access_token'] = $rs['access_token'];
	echo json_encode($array);		
}else{
	throw new Exception($rs['errcode']);
}

?>