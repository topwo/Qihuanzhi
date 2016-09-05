<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/json.php';

$u_info = redis_get_DataArray('1.info');

?>

<script>
var tmp1 = 0;
var tmp2 = 0;

function chang_position_start(id)
{
    tmp1 = $("#img"+id).attr('id').substring(3,4); // 顺序
    tmp2 = $("#img"+id+" img").attr('src').substring(12,13); // 图片
    if (tmp2 != 0)
    { $("#div_change_position").css('display','block'); }
}

function chang_position_end(id)
{
    var tmp3 = $("#img"+id+" img").attr('src').substring(12,13); // 图片
    $("#div_change_position").css('display','none');
    $("#img"+id).html('<img src="../img/card/'+tmp2+'.png" />');
    $("#img"+tmp1).html('<img src="../img/card/'+tmp3+'.png" />');
    tmp1 = 0;
    tmp2 = 0;
    tmp3 = 0;

    var tmp4 = '';
    for (var i = 0; i < 6; i++) {
        tmp4 = tmp4 + $("#img"+i+" img").attr('src').substring(12,13) + ',';
    }
    tmp4 = tmp4.substring(0,tmp4.length-1);

    // 传输数据给服务器
    $.ajax({
        type: "POST",
        url: "../php/redis.php",
        data: 'op=set&db=1.info&key=team1.cards&value='+tmp4,
        contentType: "application/x-www-form-urlencoded"
    });
}
</script>

<div id="battle-ready">
    <?php
    for ($i=0; $i < 6; $i++)
    {
        if ($i % 3 == 0)
        {
            echo '<div class="row">';
        }

        $t = ex($u_info['team1.cards'])[$i]!=0?'<img src="../img/card/'.ex($u_info['team1.cards'])[$i].'.png" />':'<img src="../img/card/0.png" />';
        echo '<div class="row-img" id="img',$i,'" onclick="chang_position_start(',$i,')">',$t,'</div>';

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
    <div id="go_battle" class="row" style="text-align:center;">
        <img class="row-button" src="../img/ui/button.battle.ready.start.png" />
    </div>
    <div id="div_change_position">
        <div onclick="chang_position_end(0)" class='div_num_position'>0</div>
        <div onclick="chang_position_end(1)" class='div_num_position'>1</div>
        <div onclick="chang_position_end(2)" class='div_num_position'>2</div>
        <div onclick="chang_position_end(3)" class='div_num_position'>3</div>
        <div onclick="chang_position_end(4)" class='div_num_position'>4</div>
        <div onclick="chang_position_end(5)" class='div_num_position'>5</div>
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

$("#go_battle").click(function()
{
    location.href = '../pages/battle.php';
});
</script>
