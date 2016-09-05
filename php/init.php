<?php
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

// 清空数据库
$redis->flushall();

// 可能 废弃数据
$redis->hmset('user_id_1', array(
    'battle.cards' => '1,2,3,4,5,6',
    'cards' => '1,2',
    'gold' => '139677323',
    'fushi' => '727',
));


// 用户拥有卡牌设定



// 副本
$redis->hmset('instance-1.1', array(
    // 卡牌总数
    'cards.count' => '3',
));

// 数据设定
$redis->hmset('data', array(
    // 卡牌总数
    'cards.count' => '3',
));










// 用户设定
$redis->hmset('1.info', array(
    // 首页卡牌
    'main.cards' => '1,2,1,2,1',
    // 出战卡牌 - 团队1
    'team1.cards' => '1,0,0,0,0,2',
    // 拥有卡牌
    'cards' => '1,2,3',

    'gold' => '139677323',
    'fushi' => '727',
));

$redis->hmset('1.cards', array(
    // key=卡牌编号，value=卡牌数据
    // [0]等级
    '1' => '30',
    '2' => '30',
    '3' => '30',
));

echo 'ok';
?>
