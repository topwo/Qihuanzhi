<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$data = $redis->hmget('system', array(
    'announcement',
));
echo json_encode($data);
?>
