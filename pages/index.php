<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/array.php';

$user = getDataArray('user.1');
?>

<!DOCTYPE>
<html>
<head>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="0">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../css/global.css" rel="stylesheet">
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/swiper.css" rel="stylesheet">
    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="../js/swiper.min.js"></script>
    <script src="../framework/tran/work.js"></script>
    <script src="../framework/security/cookie.js"></script>
</head>
<body>
<div id="index">

<!--
<div id="div_announcement">
    <div id="div_announcement_alpha"></div>
    <iframe id='iframe_announcement' src="../pages/announcement.html"></iframe>
</div>
-->

<script>
//$("#div_announcement").css('display', 'block')
getCookie('announcement_onoff') == null ? console.log('a') : console.log('b');

// 隐藏公告
$("#div_announcement_alpha").click(function(){
    $('#div_announcement').hide();
});
</script>

<div class="nav-top">
    <img id='nav-top-img' src="../img/ui/top.png" style="width:100%;">
    <div id='nav-top-gold'><?php echo $user['gold'] ?></div>
    <div id='nav-top-fushi'><?php echo $user['fushi'] ?></div>
    <div id='nav-top-div'>
        <img id="nav-top-button" src="../img/ui/button_hero.png">
    </div>
</div>

<div id='iframe-liubai'></div>
<div id='iframe'></div>

<div class="nav-bottom">
    <img id="go_index" src="../img/ui/home.jpg" class="nav-img">
    <img id="go_instance" src="../img/ui/instance.jpg" class="nav-img">
    <img id="go_battle" src="../img/ui/battle.jpg" class="nav-img">
    <img src="../img/ui/shop.jpg" class="nav-img">
    <img src="../img/ui/friend.jpg" class="nav-img">
    <img id="go_help" src="../img/ui/help.jpg" class="nav-img">
</div>

<script>
    $("#go_battle").click(function()
    {
        location.href = '../pages/battle.html';
    });

    $("#go_help").click(function()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","../pages/help.cards.php",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                $('#iframe').html(xmlhttp.responseText);
            }
        }
    });

    $("#go_instance").click(function()
    {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","../pages/instance.php",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                $('#iframe').html(xmlhttp.responseText);
            }
        }
    });

    $("#go_index").click(function(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.open("GET","../pages/main.php",true);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                $('#iframe').html(xmlhttp.responseText);
                $('#nav-top-div').html(
                    '<img id="nav-top-button" src="../img/ui/button_hero.png">'
                );
            }
        }
    });

    // 已经看过公告
    setCookie('announcement_onoff','1');

    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET","../pages/main.php",true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            $('#iframe').html(xmlhttp.responseText);
            $('#nav-top-div').html(
                '<img id="nav-top-button" src="../img/ui/button_hero.png">'
            );
        }
    }
</script>

</div>
</body>
</html>
