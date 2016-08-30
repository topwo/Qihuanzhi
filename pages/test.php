<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis->set('test','hello redis');
echo $redis->get('test');
?>
