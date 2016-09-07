<?php
class M
{
    function __construct($id)
    {
        // 获得卡牌基本数据
        $card = get_data_array_byid('cards','cards', $id-1);
        // 获取用户卡牌数据
        $m_cards = redis_get_DataArray('1.cards');

        // 普通技能
        $card_skillNormal = get_data_array_byid('cards.skill', 'cards.skill', $card['skillNormal']-1);
        // 主动技能
        $card_skillActive = get_data_array_byid('cards.skill', 'cards.skill', $card['skillActive']-1);

        $this->id = $id;
        $this->hp = $card['firstHP'] + $card['coe.hp'] * $m_cards[1];
        $this->maxHp = $this->hp;
        $this->att = $card['firstATT'] + $card['coe.att'] * $m_cards[1];
        $this->skillNormal = $card_skillNormal;
        $this->skillActive = $card_skillActive;
    }
}

class E
{
    function __construct($id)
    {
        // 获得卡牌基本数据
        $card = get_data_array_byid('cards','cards', $id-1);
        // 获取用户卡牌数据
        $m_cards = redis_get_DataArray('1.cards');

        $this->id = $id;
        $this->hp = $card['firstHP'];
        $this->maxHp = $this->hp;
        $this->att = $card['firstATT'];
        $this->skillNormal = $card['skillNormal'];
        $this->skillActive = $card['skillActive'];
    }
}

require_once '../php/redis.php';
require_once '../php/json.php';

// 我队卡牌
$m_cards_all = ex(redis_get_DataArray('1.info') ['team1.cards']);
// [key]卡牌站位，[value]图鉴ID
$m_cards_ex = ex(redis_get_DataArray('1.info') ['team1.cards'], 're', 0);

// 敌队卡牌
$e_cards_all = ex(redis_get_DataArray('1.tmp') ['enemy.cards']);
$e_cards_ex = ex(redis_get_DataArray('1.tmp') ['enemy.cards'], 're', 0);

// 给 用户卡牌 循环赋值
foreach ($m_cards_ex as $key => $value)
{
    $m = 'm'.$key;
    $$m = new M($value);
}

// 给 敌队卡牌 循环赋值
foreach ($e_cards_ex as $key => $value)
{
    $e = 'e'.$key;
    $$e = new E($value);
}

// 获取 [存在] 且 [存活] 的 [敌方] [第一个] 卡牌
$get_exist_alive_e_first = function($e0,$e1,$e2,$e3,$e4,$e5) use($e_cards_ex)
{
    $tmp = array();
    foreach ($e_cards_ex as $key => $value)
    {
        $e = 'e'.$key;
        // 获取 存在 对象
        if ( isset($$e) && $$e->hp > 0)
        {
            $tmp[] = $key;
        }
    }
    return $tmp[0];
};

// 获取 [存在] 且 [不存活] 的 [我方] 卡牌
$get_exist_die_m = function($m0,$m1,$m2,$m3,$m4,$m5) use($m_cards_ex)
{
    $tmp = array();
    foreach ($m_cards_ex as $key => $value)
    {
        $m = 'm'.$key;
        // 获取 存在 对象
        if (! isset($$m) )
        {
            $tmp[] = $key;
        }
    }
    return $tmp;
};

// 主循环
for ($c=1; $c <= 15; $c++)
{
    echo '回合',$c,'<br>';

// 死亡
if($c == 3)
{
    unset($m1);
    unset($m3);
    unset($e0);
}
// 复活
if($c == 7)
{
    $m1 = new M($m_cards_ex[1]);
    $m3 = new M($m_cards_ex[3]);
}

    // 顺序出手
    for ($c_b=0; $c_b <= 5; $c_b++)
    {
        // 我方出手
        $m = 'm'.$c_b;
        if( isset($$m) )
        {
            if($c % $$m->skillActive['skill.cycle'] == $$m->skillActive['skill.start'])
            {
                switch ($$m->skillActive['type']) {
                    case 1:
                        $target = $get_exist_alive_e_first(@$e0,@$e1,@$e2,@$e3,@$e4,@$e5);
                        $e = 'e'.$target;
                        echo 'm'.$c_b.'使用'.$$m->skillActive['name'].'，对e'.$target.'，造成'.round($$m->att * $$m->skillActive['coe.att']).'伤害<br>';
                        echo 'e'.$target.'剩余生命'.$$e->hp = $$e->hp - round($$m->att * $$m->skillActive['coe.att']).'<br>';
                        break;
                    case 2:
                        echo 'm'.$c_b.'释放主动技能-治疗<br>';
                        break;
                    case 3:
                        echo 'm'.$c_b.'释放主动技能-复活<br>';
                        // 检测死亡名单
                        //$get_exist_die_m(@$m0,@$m1,@$m2,@$m3,@$m4,@$m5);
                        break;
                }
            }
            else
            {
                switch ($$m->skillNormal['type']) {
                    case 1:
                        $target = $get_exist_alive_e_first(@$e0,@$e1,@$e2,@$e3,@$e4,@$e5);
                        $e = 'e'.$target;
                        echo 'm'.$c_b.'普通攻击e'.$target.'，造成'.round($$m->att * $$m->skillNormal['coe.att']).'伤害<br>';
                        echo 'e'.$target.'剩余生命'.$$e->hp = $$e->hp - round($$m->att * $$m->skillNormal['coe.att']).'<br>';
                        break;
                    case 2:
                        echo 'm'.$c_b.'普通治疗<br>';
                        break;
                }
            }
            echo 'm'.$c_b.'生命：'.$$m->hp.'<br>';
        }

        // 敌方出手
        $e = 'e'.$c_b;
        if( isset($$e) )
        {
            echo 'e'.$c_b.'生命：'.$$e->hp.'<br>';
        }
    }
    echo '<br><br>';
}

?>
