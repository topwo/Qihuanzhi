<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/json.php';

$u_info = redis_get_DataArray('1.info');
$u_cards = redis_get_DataArray('1.cards');
$u_tmp_enemy_cards = redis_get_DataArray('1.tmp');



$cards_coefficient = getDataArray('cards.coefficient');

?>

<?php
// 获取剩余存在的卡牌数
$e_current_count = 5;
$m_current_count = 5;

for ($i=0; $i <= 5; $i++)
{
    if (ex($u_info['team1.cards'])[$i]!=0)
    {
        $m_current_count -= 1;
        $current_card_id = ex($u_info['team1.cards'])[$i];
        $cards = get_data_array_byid('cards','cards', $current_card_id-1);
        $cards_coefficient = get_data_array_byid('cards.param','cards.coefficient', $current_card_id-1);
        $cards_skillNormal = get_data_array_byid('cards.skill','cards.skill',$cards['skillNormal']-1);
        $cards_skillActive = get_data_array_byid('cards.skill','cards.skill',$cards['skillActive']-1);

        $m = 'm'.$i;
        $$m = array(
            'id' => $i,
            'hp' => $u_cards[$current_card_id] * $cards_coefficient['hp.coe'] + $cards['firstHP'],
            'maxHp' => $u_cards[$current_card_id] * $cards_coefficient['hp.coe'] + $cards['firstHP'],
            'att' => $u_cards[$current_card_id] * $cards_coefficient['att.coe'] + $cards['firstATT'],
            'skillNormal' => $cards_skillNormal,
            'skillActive' => $cards_skillActive
        );
    }
}

// 获取敌人卡牌数据
// e1 - e6
for ($i=0; $i <= 5; $i++)
{
    if (ex($u_tmp_enemy_cards['enemy.cards'])[$i]!=0)
    {
        $e_current_count -= 1;
        $current_card_id = ex($u_tmp_enemy_cards['enemy.cards'])[$i];
        $cards = get_data_array_byid('cards','cards', $current_card_id-1);
        $cards_skillNormal = get_data_array_byid('cards.skill','cards.skill',$cards['skillNormal']-1);
        $cards_skillActive = get_data_array_byid('cards.skill','cards.skill',$cards['skillActive']-1);

        $e = 'e'.$i;
        $$e = array(
            'id' => $i,
            'hp' => $cards['firstHP'],
            'att' => $cards['firstATT'],
            'skillNormal' => $cards_skillNormal,
            'skillActive' => $cards_skillActive
        );
    }
}

// 得到 [存在] 且 [当前生命比例最低] 且 [存活] 的 [一个] [敌人]
$tmp = function() use (&$m0,&$m1,&$m2,&$m3,&$m4,&$m5)
{
    $tmp2 = array();
    for ($g=0; $g <=5 ; $g++)
    {
        $t = 'm'.$g;
        if (isset($$t) && $$t['hp'] > 0)
        {
            $tmp2[$g] = (float)($$t['hp'] / $$t['maxHp']);
        }
    }
    //print_r($tmp2);
    return min(array_keys($tmp2));
};

// 得到 [存在] 且 [随机] 且 [存活] 的 [3个] [敌人]
$exist_random_alive_many_3 = function() use (&$e0,&$e1,&$e2,&$e3,&$e4,&$e5)
{
    $tmp = array();

    $tmp2 = array();

    for ($i=0; $i <= 5; $i++) {
    $t =  'e'.$i;
    if (isset($$t))
    {
    array_push($tmp2, $i);
    }
    }

    $tmp3 = array_rand($tmp2,3);

    foreach ($tmp3 as $key => $value)
    {
        $t = 'e'.$value;
        // 得到存在的卡牌对象，且存活
        if (isset($$t) && $$t['hp'] > 0)
        {
            $tmp[$key] = $$t['id'];
        }
    }
    //print_r($tmp);
    return $tmp;
};

/*
$battle_result = function() use (&$e_current_count,&$m_current_count,&$game_status)
{
    if ($e_current_count < 0)
    {
        $game_status = '<br>胜利';
    }
    if ($m_current_count < 0)
    {
        $game_status = '<br>失败';
    }
};
*/

// 游戏状态
$game_status = '<br>平局';

// 30回合
for ($k=1; $k <= 30; $k++)
{
    echo 'round '.$k.'<br />';
    for ($i=0; $i <= 5; $i++)
    {
        $m = 'm'.$i;
        if(isset($$m))
        {
            for ($w=0; $w <= 5; $w++)
            {

                $e = 'e'.$w;
                if(isset($$e))
                {
                    // 技能轮
                    if ($k % 3 == 1)
                    {
                        switch ($$m['skillActive']['type'])
                        {
                            case '1':
                                if ( $$m['skillActive']['coe.count'] > 1 )
                                {
                                    $count = $$m['skillActive']['coe.count'];
                                    echo 'm'.$$m['id'].'发动',$$m['skillActive']['name'],'，对',$count,'个敌人造成',round($$m['att'] * $$m['skillActive']['coe.att']),'伤害，';

                                    // 随机攻击多个敌人
                                    for ($k1=0; $k1 < $count; $k1++)
                                    {
                                        if(!isset($exist_random_alive_many_3()[$k1]))
                                        {
                                            echo '';
                                        }
                                        else
                                        {
                                            $k2 = $exist_random_alive_many_3()[$k1];
                                            $k3 = 'e'.$k2;
                                            echo 'e'.$$k3['id'].'生命',$$k3['hp'] = $$k3['hp'] - round($$m['att'] * $$m['skillActive']['coe.att']),'，';
                                        }
                                    }
                                }
                                else
                                {
                                    echo 'm'.$$m['id'].'发动',$$m['skillActive']['name'],'，造成',round($$m['att'] * $$m['skillActive']['coe.att']),'伤害，';
                                    echo 'e'.$$e['id'].'生命',$$e['hp'] = $$e['hp'] - round($$m['att'] * $$m['skillActive']['coe.att']);
                                }
                                break;
                        }
                    }
                    // 普通攻击轮
                    else
                    {

                        switch ($$m['skillNormal']['type'])
                        {
                            case '1':
                                echo 'm'.$$m['id'].'发动',$$m['skillNormal']['name'],'，造成',round($$m['att'] * $$m['skillNormal']['coe.att']),'伤害，';
                                echo 'e'.$$e['id'].'生命',$$e['hp'] = $$e['hp'] - round($$m['att'] * $$m['skillNormal']['coe.att']);
                                break;
                            case '2':
                                $t = 'm'.$tmp();
                                echo 'm'.$$m['id'].'发动',$$m['skillNormal']['name'],'，恢复m',$tmp(),' ',round($$m['att'] * $$m['skillNormal']['coe.cure']),'生命，';
                                echo 'm'.$tmp().'生命',$$t['hp'] = $$t['hp'] + round($$m['att'] * $$m['skillNormal']['coe.cure']);
                                break;
                        }
                    }

                    if ($$e['hp'] <= 0)
                    {
                        echo '<br>e'.$$e['id'].'死了'.'';
                        unset($$e);
                        $e_current_count -= 1;
                    }
                    break;
                }
            }
            echo '<br>';
        }

        $e = 'e'.$i;
        if(isset($$e))
        {
            echo 'e'.$$e['id'].'发动',$$e['skillNormal']['name'],'，造成',round($$e['att'] * $$e['skillNormal']['coe.att']),'伤害，';
            for ($w=0; $w <= 5; $w++)
            {
                $m = 'm'.$w;
                if(isset($$m))
                {
                    echo 'm'.$$m['id'].'生命',$$m['hp'] = $$m['hp'] - round($$e['att'] * $$e['skillNormal']['coe.att']);

                    if ($$m['hp'] <= 0)
                    {
                        echo '<br>m'.$$m['id'].'死了'.'';
                        unset($$m);
                        $m_current_count -= 1;

                        // 游戏状态
                        //echo $battle_result();
                        if ($e_current_count < 0)
                        {
                            $game_status = '<br>胜利';
                            break 3;
                        }
                        elseif ($m_current_count < 0)
                        {
                            $game_status = '<br>失败';
                            break 3;
                        }
                        elseif ($k == 30)
                        {
                            $game_status = '<br>平局';
                            break 3;
                        }
                    }
                    break;
                }
            }
            echo '<br>';
        }
    }
}

echo $game_status;

?>
