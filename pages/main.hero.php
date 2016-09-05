<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/json.php';

$u_info = redis_get_DataArray('1.info');
$u_cards = redis_get_DataArray('1.cards');


$cards_coefficient = getDataArray('cards.coefficient');
?>

<div id="main-hero">
    <?php
    for ($i=1; $i <= count(ex($u_info['cards'])); $i++)
    {
        $current_card_id = ex( $u_info['cards'] ) [$i-1];
        $cards = get_data_array_byid('cards','cards', $current_card_id-1);
        $cards_coefficient = get_data_array_byid('cards.param','cards.coefficient', $current_card_id-1);

        echo '<div class="main-hero-list" onclick="card(\'my\',\'',$i,'\')"><img class="main-hero-list-img" src="../img/avater/',$i,'.png" />';
        echo '<span class="main-hero-list-lv">等级 <b>',$u_cards[$current_card_id],'</b></span>';
        echo '<span class="main-hero-list-title">',$cards['name'],'</span>';
        echo '<span class="main-hero-list-content">',$u_cards[$current_card_id] * $cards_coefficient['hp.coe'] + $cards['firstHP'],'</span>';
        echo '<span class="main-hero-list-content2">',$u_cards[$current_card_id] * $cards_coefficient['att.coe'] + $cards['firstATT'],'</span>';
        echo '</div>';
    }
    ?>
</div>

<script>
// 导航
$('#nav-top-div').html(
    '<img class="nav-top-button" src="../img/ui/button_hero.png">'
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
