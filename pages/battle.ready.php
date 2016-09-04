<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

$user = getDataArray('user.1');
//echo $user['team1.cards'];

?>

<div id="battle-ready">
    <?php
    for ($i=0; $i < 6; $i++)
    {
        if ($i % 3 == 0)
        {
            echo '<div class="row">';
        }

        $t = ex($user['team1.cards'])[$i]!=-1?'<img src="../img/card/'.ex($user['team1.cards'])[$i].'.png" />':'';
        echo '<div class="row-img">',$t,'</div>';

        if ($i % 3 == 2)
        {
            echo '</div>';
        }
    }
    ?>
    <div class="row-teamSkill">
        <img class="row-icon" src="../img/ui/button.battle.ready.teamskill.png" />
        <span class="row-icon-big">队长技能</span><span class="row-icon-small">大量增加全体物理攻击</span><span class="row-icon-big">+2</span>
    </div>
    <div class="row" style="text-align:center;">
        <img class="row-button" src="../img/ui/button.battle.ready.start.png" />
    </div>
</div>

<script>
// 重绘导航
$('#nav-top-div').html(
    '\
    <img style="-webkit-filter:hue-rotate(-30deg);" class="nav-top-button" src="../img/ui/button.battle.ready.team1.png">\
    <img class="nav-top-button" src="../img/ui/button.battle.ready.array.png">\
    '
);
</script>
