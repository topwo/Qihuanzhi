<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$data = $redis->hmget('user_id_1', array(
    'card1',
    'card2',
    'card3',
    'card4',
    'card5',
    'card6',

    'gold',
));
echo json_encode($data);

/*
$redis->hmset('user_id_1', array(
    'card1' => '1',
    'card2' => '2',
    'card3' => '3',
    'card4' => '4',
    'card5' => '5',
    'card6' => '6',
));
*/
//echo 'ok';
?>