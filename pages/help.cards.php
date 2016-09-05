<?php
require_once '../php/json.php';

$count = get_dataArray_count('cards','cards');
?>

<div id="help-cards">
    <?php
    for ($i=1; $i <= $count; $i++)
    {
        echo '<img onclick="card(\'','all\',',$i,')" src="../img/avater/',$i,'.png" class="card" />';
    }
    ?>
</div>

<script>
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
