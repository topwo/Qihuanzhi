<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

$user_cards = getDataArray('user.1.cards');
$cards = getDataArray('cards');
$cards_coefficient = getDataArray('cards.coefficient');
?>

<div id="main-hero">
    <?php
    for ($i=1; $i <= count($user_cards); $i++)
    {
        echo '<div class="main-hero-list" onclick="card(\'my\',\'',$i,'\')"><img class="main-hero-list-img" src="../img/avater/',$i,'.png" />';
        echo '<span class="main-hero-list-lv">等级 <b>',$user_cards[$i],'</b></span>';
        echo '<span class="main-hero-list-title">',ex($cards[$i])[9],'</span>';
        echo '<span class="main-hero-list-content">',$user_cards[$i] * ex($cards_coefficient[$i])[0] + ex($cards[$i])[3],'</span>';
        echo '<span class="main-hero-list-content2">',$user_cards[$i] * ex($cards_coefficient[$i])[1] + ex($cards[$i])[2],'</span>';
        echo '</div>';
    }
    ?>
</div>

<script>
// 导航
$('#nav-top-div').html(
    '<img id="nav-top-button" src="../img/ui/button_hero.png">'
);

function card(key,value)
{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","../pages/cards.detail.php?key="+key+"&value="+value,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            $('body').append(xmlhttp.responseText);
            $("#nav-top-div").css('display','none');
        }
    }
}
</script>
