<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

?>

<div id="battle-ready">
    <div class="row">
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
    </div>
    <div class="row">
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
        <img class="row-img" src="../img/ui/battle.ready.border.png" />
    </div>
    <div class="row">
        <img src="../img/ui/button.battle.ready.start.png" />
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
