<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

$user = getDataArray('user.1');
?>

<div id="main">
    <img src="../img/ui/main.png" class="row">
    <img src="../img/avater/<?php echo ex($user['main.cards'])[0] ?>.png" class="card" style="left: calc(0% + 10px)" />
    <img src="../img/avater/<?php echo ex($user['main.cards'])[1] ?>.png" class="card" style="left: calc(20% + 8px)" />
    <img src="../img/avater/<?php echo ex($user['main.cards'])[2] ?>.png" class="card" style="left: calc(40% + 6px)" />
    <img src="../img/avater/<?php echo ex($user['main.cards'])[3] ?>.png" class="card" style="left: calc(60% + 5px)" />
    <img src="../img/avater/<?php echo ex($user['main.cards'])[4] ?>.png" class="card" style="left: calc(80% + 2px)" />

    <img id="go_main_hero" src="../img/ui/menu_hero.png" class="card" style="left: calc(0% + 18px);top:160px;" />
    <img src="../img/ui/menu_strengthen.png" class="card" style="left: calc(25% + 8px);top:160px;" />
    <img src="../img/ui/menu_bag.png" class="card" style="left: calc(50% + 8px);top:160px;" />
    <img src="../img/ui/menu_eqiupment.png" class="card" style="left: calc(75% + 8px);top:160px;" />
</div>

<script>
$("#go_main_hero").click(function()
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","../pages/main.hero.php",true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            $('#iframe').html(xmlhttp.responseText);
        }
    }
});
</script>
