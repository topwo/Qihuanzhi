<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$data = $redis->hmget('data', array(
    'cards.count',
));
echo json_encode($data);
?>
