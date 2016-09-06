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
// 获取玩家卡牌数据
// m1 - m6
$e_current_count = 5;

for ($i=0; $i <= 5; $i++)
{
    if (ex($u_info['team1.cards'])[$i]!=0)
    {
        $current_card_id = ex($u_info['team1.cards'])[$i];
        $cards = get_data_array_byid('cards','cards', $current_card_id-1);
        $cards_coefficient = get_data_array_byid('cards.param','cards.coefficient', $current_card_id-1);
        $cards_skillNormal = get_data_array_byid('cards.skill','cards.skill',$cards['skillNormal']-1);
        $cards_skillActive = get_data_array_byid('cards.skill','cards.skill',$cards['skillActive']-1);

        $m = 'm'.$i;
        $$m = array(
            'id' => $i,
            'hp' => $u_cards[$current_card_id] * $cards_coefficient['hp.coe'] + $cards['firstHP'],
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

// 30回合
for ($t=1; $t <= 7; $t++)
{
    echo 'round '.$t.'<br />';
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

                    if ($t % 3 == 1)
                    {
                        echo 'm'.$$m['id'].'发动技能攻击，造成',round($$m['att'] * $$m['skillActive']['coe.att']),'伤害，';
                        echo 'e'.$$e['id'].'生命',$$e['hp'] = $$e['hp'] - round($$m['att'] * $$m['skillActive']['coe.att']);

                    }
                    else {
                        echo 'm'.$$m['id'].'发动普通攻击，造成',round($$m['att'] * $$m['skillNormal']['coe.att']),'伤害，';
                        echo 'e'.$$e['id'].'生命',$$e['hp'] = $$e['hp'] - round($$m['att'] * $$m['skillNormal']['coe.att']);
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
            echo 'e'.$$e['id'].'发动攻击，造成',round($$e['att'] * $$e['skillNormal']['coe.att']),'伤害，';
            for ($w=0; $w <= 5; $w++)
            {
                $m = 'm'.$w;
                if(isset($$m))
                {
                    echo 'm'.$$m['id'].'生命',$$m['hp'] = $$m['hp'] - round($$e['att'] * $$e['skillNormal']['coe.att']);
                    break;
                }
            }
            echo '<br>';
        }



        /*
        echo 'm1攻击e0，造成',round($m1['att'] * $m1['skillNormal']['coe.att']),'伤害，';
        echo 'e0生命',$e0['hp'] = $e0['hp'] - round($m1['att'] * $m1['skillNormal']['coe.att']);
        echo '<br>';
        echo 'e0攻击m1，造成',round($e0['att'] * $e0['skillNormal']['coe.att']),'伤害，';
        echo 'm1生命',$m1['hp'] = $m1['hp'] - round($e0['att'] * $e0['skillNormal']['coe.att']);
        echo '<br>';
        */
    }

    // 全体阵亡
    if ($e_current_count < 0)
    {
        break;
    }

    echo '<br />';
}
?>
