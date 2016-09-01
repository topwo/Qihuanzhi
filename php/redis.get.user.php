<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$data = $redis->hmget('user_id_1', array(
    'battle.cards',

    'cards',

    'gold',
    'fushi',
));
echo json_encode($data);
?>
