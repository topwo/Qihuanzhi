<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

?>

<div id="instance-easy" class="instance" style="display:block;">
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第十一章 祭坛</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第十章 遗迹</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第九章 埋骨圣地</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第八章 巨魔家园</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第七章 废墟</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第六章 高原</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第五章 教堂</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第四章 荒泽</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第三章 银堡</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第二章 废矿</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div id="instance-easy-1-go" class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第一章 溶洞</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
</div>

<div id="instance-hard" class="instance">
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第三章 银堡</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第二章 废矿</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第一章 溶洞</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
</div>

<div id="instance-ulimate" class="instance">
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">第一章 溶洞</span>
        <span class="instance-list-star">★ 0/15</span>
    </div>
</div>

<div id="instance-activity" class="instance">
    <div class="instance-list">
        <span class="instance-list-status">开启中</span>
        <span class="instance-list-title">天空之役</span>
        <span class="instance-list-star">挑战</span>
    </div>
</div>

<!-- 副本细节 -->
<div id="instance-easy-1" class="instance">
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">1-5 鱼人萨满</span>
        <span class="instance-list-power">体力：6</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">1-4 永生者</span>
        <span class="instance-list-power">体力：6</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">1-3 烤肉莱恩</span>
        <span class="instance-list-power">体力：6</span>
    </div>
    <div class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-title">1-2 瑟迪粉丝</span>
        <span class="instance-list-power">体力：6</span>
    </div>
    <div id="instance-easy-1-ready" class="instance-list">
        <span class="instance-list-status">已通关</span>
        <span class="instance-list-clear">★☆☆</span>
        <span class="instance-list-title">1-1 大囧龟</span>
        <span class="instance-list-power">体力：6</span>
    </div>
    <div class="instance-listInfo">
        溶洞
        <span class="instance-list-description">
            &emsp;&emsp;迷失在冬雪梦境中的小软们每天最喜欢的活动就是内裤大赛，
            每当有漂亮内裤展示时，它们就纷纷模拟人声大喊：“好！”。由于
            发声器官比较独特的缘故，听起来却像是哀嚎一般！
        </span>
    </div>
</div>

<script>
// 重绘导航
$('#nav-top-div').html(
    '\
    <img id="instance-div-easy" style="-webkit-filter:hue-rotate(-30deg);" class="nav-top-button" src="../img/ui/button.instance.easy.png">\
    <img id="instance-div-hard" class="nav-top-button" src="../img/ui/button.instance.hard.png">\
    <img id="instance-div-ulimate" class="nav-top-button" src="../img/ui/button.instance.ulimate.png">\
    <img id="instance-div-activity" class="nav-top-button" src="../img/ui/button.instance.activity.png">\
    '
);

function display_block(key)
{
    $("#instance-easy").css('display','none');
        $("#instance-easy-1").css('display','none');

    $("#instance-hard").css('display','none');
    $("#instance-ulimate").css('display','none');
    $("#instance-activity").css('display','none');

    $("#"+key).css('display','block');
}
function filter_block(key)
{
    $("#instance-div-easy").css('-webkit-filter','hue-rotate(0deg)');
    $("#instance-div-hard").css('-webkit-filter','hue-rotate(0deg)');
    $("#instance-div-ulimate").css('-webkit-filter','hue-rotate(0deg)');
    $("#instance-div-activity").css('-webkit-filter','hue-rotate(0deg)');

    $("#"+key).css('-webkit-filter','hue-rotate(-30deg)');
}

// 从副本跳转到战斗准备页面
$("#instance-easy-1-ready").click(function()
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","../pages/battle.ready.php",true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            $('#iframe').html(xmlhttp.responseText);
        }
    }
});

$("#instance-easy-1-go").click(function()
{
    display_block('instance-easy-1');
});

$("#instance-div-easy").click(function()
{
    display_block('instance-easy');
    filter_block('instance-div-easy');
});
$("#instance-div-hard").click(function()
{
    display_block('instance-hard');
    filter_block('instance-div-hard');
});
$("#instance-div-ulimate").click(function()
{
    display_block('instance-ulimate');
    filter_block('instance-div-ulimate');
});
$("#instance-div-activity").click(function()
{
    display_block('instance-activity');
    filter_block('instance-div-activity');
});
</script>
