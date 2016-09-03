<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

$cards = getData('cards', $_GET['value']);
$cards_talent = getDataArray('cards.talent');
$cards_level = getDataArray('cards.level');
$cards_level_skill = getDataArray('cards.level.skill');
$cards_level_name = getDataArray('cards.level.name');
$cards_collect = getDataArray('cards.collect');

$cards_skill = getDataArray_Skill('cards.skill');
?>

<div id="card-detail">

    <!-- UI -->
    <div>
        <div class="row-title">
            <div class="row-title-img">
                <div class="row-title-name"><?php echo $cards[9]; ?></div>
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
                    <div class="row-info-left"><img src="../img/card/<?php echo $cards[0]; ?>.png" /></div>
                    <div class="row-info-right">
                        <span>
                            <div style="float:left;color:#bcff08;"><b><small><?php echo $cards_level_name[$cards[1]]; ?>卡牌</small></b></div>
                            <div style="float:right;color:#02f8ff;"><b><small><?php echo $cards[10]; ?></small></b></div>
                        </span>
                        <span style="margin: 25px 0px 7px 0px;">
                            <?php
                            for ($i=1; $i <= $cards[1]; $i++)
                            {
                                echo '<img src="../img/ui/star.png" />';
                            }
                            for ($i=1; $i <= 6-$cards[1]; $i++)
                            {
                                echo '<img src="../img/ui/star2.png" />';
                            }
                            ?>
                        </span>
                        <span>等&emsp;级&nbsp;<b>1/<?php echo $cards_level[$cards[1]] ?></b></span>
                        <span>攻&emsp;击&nbsp;<b><?php echo $cards[2] ?></b></span>
                        <span>生&emsp;命&nbsp;<b><?php echo $cards[3] ?></b></span>
                        <span>领导力&nbsp;<b><?php echo $cards[4] ?></b></span>
                    </div>
                </div>
                <div class="row-skill">
                    <div class="row-skill-block">
                        <span class="row-skill-block-title"><span>普通技能</span> <b><small><?php echo ex($cards_skill[$cards[5]])[0]; ?></small></b></span>
                        <span class="row-skill-block-content"><small><?php echo ex($cards_skill[$cards[5]])[1]; ?></small></span>
                        <span class="row-skill-block-title">
                            <span>主动技能</span> <b><small><?php echo ex($cards_skill[$cards[6]])[0]; ?></small></b> <b><small>等级1/<?php echo $cards_level_skill[$cards[1]] ?></small></b>
                            <?php
                            for ($i=1; $i <= ex($cards_skill[$cards[6]])[3]; $i++)
                            {
                                echo $i==ex($cards_skill[$cards[6]])[2]?'<img src="../img/ui/cards.info.skill.png" />':'<img src="../img/ui/cards.info.skill2.png" />';
                            }
                            ?>
                        </span>
                        <span class="row-skill-block-content"><small><?php echo ex($cards_skill[$cards[6]])[1]; ?></small></span>
                        <span class="row-skill-block-title"><span>被动天赋</span> <b><small><?php echo ex($cards_talent[$cards[7]])[0] ?></small></b></span>
                        <span class="row-skill-block-content"><small><?php echo ex($cards_talent[$cards[7]])[1] ?></small></span>
                        <span class="row-skill-block-title"><span>队长技能</span></span>
                        <span class="row-skill-block-content">
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <br>
                            <small style="color:#ff5e00;">&nbsp;</small>
                            <small style="color:#ff5e00;">&nbsp;</small>
                        </span>
                        <span class="row-skill-block-title"><span>英雄介绍</span></span>
                        <span class="row-skill-block-content"><small><?php echo $cards[8] ?></small></span>
                    </div>
                </div>
            </div>
            <!-- 分页 -->
            <div id="multi" class="swiper-slide">
                <?php
                foreach ($cards_collect as $key => $value)
                {
                    if (strpos($key, '%'.$_GET['value'].'%') !== false)
                    {
                        echo '
                        <div class="row-collect">
                            <span class="row-collect-title"><span>',ex($value)[0],'</span></span>
                            <span class="row-collect-img">
                                <table width="100%">
                                    <tr>';
                                    for ($i=1; $i <= count(ex($key,',','%')); $i++) {
                                        echo '<td width="',100/6,'%"><img src="../img/avater/',$i,'.png" /></td>';
                                    }
                                    for ($i=1; $i <= 6-count(ex($key,',','%')); $i++) {
                                        echo '<td width="',100/6,'%"><img src="../img/avater/1.png" style="display:none;" /></td>';
                                    }
                        echo        '</tr>
                                </table>
                            </span>
                            <span class="row-collect-content">
                                <small class="row-collect-content-br">',ex($value)[1],'</small>
                                <small style="color:rgb(8,233,9);">',ex($value)[2],'</small>
                            </span>
                        </div>
                        ';
                    }
                }
                ?>
            </div>
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
    $('#card-detail').remove();
});
</script>
