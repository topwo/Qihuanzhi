<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

$redis->hmset('user_id_1', array(
    'card1' => '3',
    'card2' => '3',
    'card3' => '2',
    'card4' => '4',
    'card5' => '3',
    'card6' => '6',

    'gold' => '139677323',
));

echo 'ok';
?>
