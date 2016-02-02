<?php
echo $request_url=str_replace("test.php","",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);die;

?>