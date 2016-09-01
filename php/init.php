<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

// 用户设定
$redis->hmset('user_id_1', array(
    // 出战卡牌
    'battle.cards' => '1,2,3,4,5,6',

    // 拥有卡牌
    'cards' => '1,2',

    'gold' => '139677323',
    'fushi' => '727',
));

// 数据设定
$redis->hmset('data', array(
    // 卡牌总数
    'cards.count' => '2',
));

// 系统设定
$redis->hmset('system', array(
    'announcement' => '
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    ',
));

echo 'ok';
?>
