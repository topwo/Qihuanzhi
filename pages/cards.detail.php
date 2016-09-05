<?php
require_once '../php/json.php';

require_once '../php/redis.php';

// 卡牌基本数据
$cards = get_data_array_byid('cards','cards', $_GET['value']-1);
$cards_coefficient = get_data_array_byid('cards.param','cards.coefficient', $_GET['value']-1);
$cards_level = get_data_array_byid('cards.param','cards.level', $cards['star']);

// 普通技能
$cards_skillNormal = get_data_array_byid('cards.skill','cards.skill',$cards['skillNormal']-1);
// 主动技能
$cards_skillActive = get_data_array_byid('cards.skill','cards.skill',$cards['skillActive']-1);
// 被动天赋
$cards_talent = get_data_array_byid('cards.param','cards.talent',$cards['talent']-1);
// 组合
$cards_collect = get_dataArray('cards.param','cards.collect');

$u_cards = getDataArray('1.cards');



//$cards_talent = getDataArray('cards.talent');
//$cards_level = getDataArray('cards.level');
//$cards_level_skill = getDataArray('cards.level.skill');
//$cards_level_name = getDataArray('cards.level.name');
//$cards_collect = getDataArray('cards.collect');
//$user_cards = getDataArray('user.1.cards');
//$cards_coefficient = getDataArray('cards.coefficient');
//$cards_skill = getDataArray_Skill('cards.skill');
?>

<div id="card-detail">

    <!-- UI -->
    <div>
        <div class="row-title">
            <div class="row-title-img">
                <div class="row-title-name"><?php echo $cards['name'] ?></div>
            </div>
        </div>
    </div>
    <div>
        <div class="row-pagination">
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div>
        <div class="row-close">
            <img id="hide_this" src="../img/ui/button.close.png" />
        </div>
    </div>

    <!-- 内容展示 -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div id="single" class="swiper-slide">
                <div class="row-info">
                    <div class="row-info-left"><img src="../img/card/<?php echo $cards['id'] ?>.png" /></div>
                    <div class="row-info-right">
                        <span>
                            <div style="float:left;color:#bcff08;"><b><small><?php echo $cards_level['name'] ?>卡牌</small></b></div>
                            <div style="float:right;color:#02f8ff;"><b><small><?php echo $cards['job'] ?></small></b></div>
                        </span>
                        <span style="margin: 25px 0px 7px 0px;">
                            <?php
                            for ($i=1; $i <= $cards['star']; $i++)
                            {
                                echo '<img src="../img/ui/star.png" />';
                            }
                            for ($i=1; $i <= 6-$cards['star']; $i++)
                            {
                                echo '<img src="../img/ui/star2.png" />';
                            }
                            ?>
                        </span>
                        <span>等&emsp;级&nbsp;<b><?php echo $_GET['key']=='my'?$u_cards[$_GET['value']]:'1' ?>/<?php echo $cards_level['maxlv'] ?></b></span>
                        <span>生&emsp;命&nbsp;<b><?php echo $_GET['key']=='my'?$u_cards[$_GET['value']] * $cards_coefficient['hp.coe'] + $cards['firstHP'] : $cards['firstHP'] ?></b></span>
                        <span>攻&emsp;击&nbsp;<b><?php echo $_GET['key']=='my'?$u_cards[$_GET['value']] * $cards_coefficient['att.coe'] + $cards['firstATT'] : $cards['firstATT'] ?></b></span>
                        <span>领导力&nbsp;<b><?php echo @$cards_level['lead'] ?></b></span>
                    </div>
                </div>
                <div class="row-skill">
                    <div class="row-skill-block">
                        <span class="row-skill-block-title"><span>普通技能</span> <b><small><?php echo $cards_skillNormal['name'] ?></small></b></span>
                        <span class="row-skill-block-content"><small><?php echo $cards_skillNormal['desc'] ?></small></span>
                        <span class="row-skill-block-title">
                            <span>主动技能</span> <b><small><?php echo $cards_skillActive['name'] ?></small></b> <b><small>等级1/<?php echo $cards_level['maxSkill'] ?></small></b>
                            <?php
                            for ($i=1; $i <= $cards_skillActive['skill.cycle']; $i++)
                            {
                                echo $i == $cards_skillActive['skill.start'] ? '<img src="../img/ui/cards.info.skill.png" />' : '<img src="../img/ui/cards.info.skill2.png" />' ;
                            }
                            ?>
                        </span>
                        <span class="row-skill-block-content"><small><?php echo $cards_skillActive['desc'] ?></small></span>
                        <span class="row-skill-block-title"><span>被动天赋</span> <b><small><?php echo $cards_talent['name'] ?></small></b></span>
                        <span class="row-skill-block-content"><small><?php echo $cards_talent['desc'] ?></small></span>
                        <span class="row-skill-block-title"><span>队长技能</span></span>
                        <span class="row-skill-block-content">
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <br>
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <small style="color:#ff5e00;">&nbsp;</small>
                        </span>
                        <span class="row-skill-block-title"><span>英雄介绍</span></span>
                        <span class="row-skill-block-content"><small><?php echo $cards['desc'] ?></small></span>
                    </div>
                </div>
            </div>
            <?php
            $tmp = 0;
            foreach ($cards_collect as $key => $value)
            {
                if (strpos($value['relateID'], '%'.$_GET['value'].'%') !== false)
                {
                    echo current($cards_collect) === reset($cards_collect) ? '<div id="multi" class="swiper-slide">' : '';

                    echo '
                    <div class="row-collect">
                        <span class="row-collect-title"><span>',$value['name'],'</span></span>
                        <span class="row-collect-img">
                            <table width="100%">
                                <tr>';
                                for ($i=1; $i <= count(ex($value['relateID'],',','%')); $i++) {
                                    echo '<td width="',100/6,'%"><img src="../img/avater/',$i,'.png" /></td>';
                                }
                                for ($i=1; $i <= 6-count(ex($value['relateID'],',','%')); $i++) {
                                    echo '<td width="',100/6,'%"><img src="../img/avater/1.png" style="display:none;" /></td>';
                                }
                    echo        '</tr>
                            </table>
                        </span>
                        <span class="row-collect-content">
                            <small class="row-collect-content-br">',$value['desc'],'</small>
                            <small style="color:rgb(8,233,9);">',$value['effect'],'</small>
                        </span>
                    </div>
                    ';

                    echo current($cards_collect) === end($cards_collect) ? '</div>' : '';
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
// 横向滑屏事件
var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: false
});

$("#hide_this").click(function()
{
    $("#nav-top-div").css('display','block');
    $('#card-detail').remove();
});
</script>
