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

// 用户设定
$redis->hmset('user.1', array(
    // 首页卡牌
    'main.cards' => '1,2,1,2,1',
    // 出战卡牌 - 团队1
    'team1.cards' => '1,0,0,0,0,2',
    // 拥有卡牌
    'cards' => '1,2,3',

    'gold' => '139677323',
    'fushi' => '727',
));
// 用户拥有卡牌设定
$redis->hmset('user.1.cards', array(
    // key=卡牌编号，value=卡牌数据
    // [0]等级
    '1' => '60',
    '2' => '30',
    '3' => '10',
));


// 数据设定
$redis->hmset('data', array(
    // 卡牌总数
    'cards.count' => '3',
));

// 卡牌资料设定
$redis->hmset('cards', array(
    // [0]卡牌编号，[1]卡牌星级，[2]1级攻击，[3]1级生命，[4]领导力
    // [5]技能-普通，[6]技能-主动，[7]被动天赋，[8]英雄介绍，[9]卡牌名称
    // [10]职业
    '1' => '1,2,362,2105,8,1,2,1,具有深不可测的能力，四暗影和会长的师父。,哀木涕,战士',
    '2' => '2,2,362,2105,8,1,2,3,具有深不可测的能力，四暗影和会长的师父。,傻馒,萨满',
    '3' => '3,2,362,2105,8,1,2,3,具有深不可测的能力，四暗影和会长的师父。,神棍德,萨满',
));

// 卡牌升级系数设定
$redis->hmset('cards.coefficient', array(
    // key=卡牌编号，value=系数
    // [0]生命，[1]攻击
    '1' => '100,20',
    '2' => '50,100',
    '3' => '75,50',
));

// 卡牌技能设定
// 技能名，技能描述，起始技能，技能轮，
$redis->hmset('cards.skill', array(
    '1' => '重击,对单体使用普通物理攻击。',
    '2' => '剧毒射击,降低敌方前排大量受治疗，持续2回合，不影响持续恢复技能。,1,3',
));

// 卡牌技能设定
$redis->hmset('cards.talent', array(
    '1' => '初级防护天赋,微量+韧性，少量+物抗',
    '2' => '中级防护天赋,少量+韧性，中量+物抗',
    '3' => '高级防护天赋,中量+韧性，大量+物抗',
    '4' => '究级防护天赋,大量+韧性，巨量+物抗',
));

// 稀有程度设定
$redis->hmset('cards.level', array(
    '1' => '10', // 白色
    '2' => '30', // 绿色
    '3' => '60',  // 蓝色
    '4' => '75',  // 紫色
    '5' => '90',  // 橙色
    '6' => '100',  // 红色
));

// 卡牌技能上限等级设定
$redis->hmset('cards.level.skill', array(
    '1' => '3', // 白色
    '2' => '6', // 绿色
    '3' => '6',  // 蓝色
    '4' => '6',  // 紫色
    '5' => '10',  // 橙色
    '6' => '15',  // 红色
));

// 卡牌稀有度设定
$redis->hmset('cards.level.name', array(
    '1' => '朴素', // 白色
    '2' => '普通', // 绿色
    '3' => '珍贵',  // 蓝色
    '4' => '稀有',  // 紫色
    '5' => '史诗',  // 橙色
    '6' => '传说',  // 红色
));

// 卡牌组合设定
// % 防止搜索误会：11 包含 1，%11% 不包含 %1%
$redis->hmset('cards.collect', array(
    '%1%,%2%' => '牛皮的厚度,牛皮的厚度总是不可想象！,【+6% 物抗】 【+4% 韧性】',
    '%1%,%2%,%3%' => '牛皮的厚2度,牛皮的厚度总是不可想象！,【+6% 物抗】 【+4% 韧性】',
    '%2%,%3%' => '牛皮的厚度3,牛皮的厚度总是不可想象！,【+6% 物抗】 【+4% 韧性】',
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
