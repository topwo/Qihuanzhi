<?php
// echo $_GET['key']; 请求操作，all
require_once '../php/redis.php';
require_once '../php/json.php';

$u_info = redis_get_DataArray('1.info');
$u_tmp_enemy_cards = redis_get_DataArray('1.tmp');
?>

<!DOCTYPE>
<html>
<head>
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="0">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="../css/normalize.css" rel="stylesheet">
    <link href="../css/global.css" rel="stylesheet">
    <script src="../js/jquery-3.1.0.min.js"></script>
    <script src="../js/velocity.min.js"></script>
    <script src="../js/audio.js"></script>
    <script src="../js/check.js"></script>
</head>
<body>



<div id="battle">

<img id="skill" class="skill">

<div id="skill_num" class="skill_num">
    3244
</div>

<center>

<div class="top">
    <div style="margin-top: 16px;">
        <img onclick="action_queue()" class="card" id="e4" src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[3] ?>.png">
        <img class="card" id='e5' src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[4] ?>.png">
        <img class="card" id='e6' src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[5] ?>.png">
    </div>
      <div style="margin-top: 3px;">
          <div class="div_progress" id="progress_e4" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[3]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 10%;"></div>
          </div>
          <div class="div_progress" id="progress_e5" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[4]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 90%;"></div>
          </div>
          <div class="div_progress" id="progress_e6" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[5]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 50%;"></div>
          </div>
      </div>
      <div style="margin-top: 12px;">
          <img class="card" id='e1' src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[0] ?>.png">
          <img class="card" id='e2' src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[1] ?>.png">
          <img class="card" id='e3' src="../img/card/<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[2] ?>.png">
      </div>
      <div style="margin-top: 3px;">
          <div class="div_progress" id="progress_e1" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[0]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 10%;"></div>
          </div>
          <div class="div_progress" id="progress_e2" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[1]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 90%;"></div>
          </div>
          <div class="div_progress" id="progress_e3" style="<?php echo ex($u_tmp_enemy_cards['enemy.cards'])[2]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 50%;"></div>
          </div>
      </div>
</div>

<div class="bottom">
      <div style="margin-bottom: 3px;">
          <img class="card" id="m1" src="../img/card/<?php echo ex($u_info['team1.cards'])[0] ?>.png">
          <img class="card" id="m2" src="../img/card/<?php echo ex($u_info['team1.cards'])[1] ?>.png">
          <img class="card" id="m3" src="../img/card/<?php echo ex($u_info['team1.cards'])[2] ?>.png">
      </div>
      <div style="margin-bottom: 12px;">
          <div class="div_progress" id="progress_m1" style="<?php echo ex($u_info['team1.cards'])[0]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 10%;"></div>
          </div>
          <div class="div_progress" id="progress_m2" style="<?php echo ex($u_info['team1.cards'])[1]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 90%;"></div>
          </div>
          <div class="div_progress" id="progress_m3" style="<?php echo ex($u_info['team1.cards'])[2]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 50%;"></div>
          </div>
      </div>
      <div style="margin-bottom: 3px;">
          <img class="card" id="m4" src="../img/card/<?php echo ex($u_info['team1.cards'])[3] ?>.png">
          <img class="card" id="m5" src="../img/card/<?php echo ex($u_info['team1.cards'])[4] ?>.png">
          <img class="card" id="m6" src="../img/card/<?php echo ex($u_info['team1.cards'])[5] ?>.png">
      </div>
      <div style="margin-bottom: 16px;">
          <div class="div_progress" id="progress_m4" style="<?php echo ex($u_info['team1.cards'])[3]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 10%;"></div>
          </div>
          <div class="div_progress" id="progress_m5" style="<?php echo ex($u_info['team1.cards'])[4]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 90%;"></div>
          </div>
          <div class="div_progress" id="progress_m6" style="<?php echo ex($u_info['team1.cards'])[5]==0?'visibility:hidden;':'' ?>">
              <div class="progress" style="width: 50%;"></div>
          </div>
      </div>
</div>

</center>

<script>
// 检测性能插件
var stats = new Stats();
stats.showPanel( 0 ); // 0: fps, 1: ms, 2: mb, 3+: custom
document.body.appendChild( stats.dom );
function animate()
{
    stats.begin();
    stats.end();
    requestAnimationFrame( animate );
}
requestAnimationFrame( animate );

// 兼容性修正
window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
</script>

<script>
// 组件库
function playAudio(filename,format,delay)
{
    setTimeout(function(){
        var audio5js = new Audio5js
        ({
            ready: function ()
            {
                this.load('../mp3/' + filename + '.' + format);
                this.play();
                // Audio 播放状态监控
                // this.on('play', function () { console.log('play'); }, this);
                // this.on('pause', function () { console.log('pause'); }, this);
                this.on('ended', function () { this.destroy(); }, this);
            }
        });
    }, delay)
}

function anim_num(eId,time,duringTime)
{
    var x = document.getElementById(eId).getBoundingClientRect().left;
    var y = document.getElementById(eId).getBoundingClientRect().top;

    $("#skill_num").css('left', x);
    $("#skill_num").css('top', y);
    $("#skill_num").css('z-index', 2);

    $("#skill_num")
        .velocity("fadeIn", { duration: time })
        .velocity({
            translateZ: 0,
        }, { duration: duringTime })
        .velocity("fadeOut", { duration: time })
    ;
}

function anim_long_attack(mId,eId,time,img)
{
    var m_x = document.getElementById(mId).getBoundingClientRect().left;
    var m_y = document.getElementById(mId).getBoundingClientRect().top;
    var x = document.getElementById(eId).getBoundingClientRect().left - document.getElementById(mId).getBoundingClientRect().left;
    var y = document.getElementById(eId).getBoundingClientRect().top - document.getElementById(mId).getBoundingClientRect().top;

    $("#skill").css('left', m_x);
    $("#skill").css('top', m_y);
    $("#skill").css('z-index', 2);
    $("#skill").attr('src', '../img/skill/'+img+'.png');

    $("#skill")
        .velocity("fadeIn", { duration: time/2 })
        .velocity({
            translateZ: 0,
            translateX: x,
            translateY: y,
        }, {
            duration: time,
            complete: function(){
                playAudio('attack','mp3',0);
                anim_num(eId,200,200);

                // 被攻击动画
                $('#'+eId)
                    .velocity({
                        translateZ: 0,
                        scaleX: 0.9,
                        scaleY: 0.9,
                    })
                    .velocity("reverse");

                $(this).velocity("fadeOut", { duration: time/2 })
                       .velocity({translateX: 0,translateY: 0}, 1);  // 重置动画初始位置
            }
        })
    ;
}

function anim_close_attack(mId,eId,time,img)
{
    var x = document.getElementById(eId).getBoundingClientRect().left;
    var y = document.getElementById(eId).getBoundingClientRect().top;

    $("#skill").css('left', x);
    $("#skill").css('top', y);
    $("#skill").css('z-index', 2);
    $("#skill").attr('src', '../img/skill/'+img+'.png');

    $("#skill")
        .velocity("fadeIn", {
            duration: time,
            begin: function(){
                playAudio('attack','mp3',0);

                // 被攻击动画
                $('#'+eId)
                    .velocity({
                        translateZ: 0,
                        scaleX: 0.9,
                        scaleY: 0.9,
                    })
                    .velocity("reverse");
            },
        })

        .velocity({
            translateZ: 0,
        }, {
            duration: time/4,
            complete: function(){
                anim_num(eId,200,400);
            },
        })

        .velocity("fadeOut", {
            duration: time,
            complete: function(){

            },
        });
}
</script>

<script>
function action_queue()
{
    setTimeout("event_long_attack('m2','e3','fire')", 0);
    setTimeout("event_close_attack('m4','e2','attack')", 2000);
    setTimeout("history.back(-1)", 5000);
}

function event_long_attack(mId,eId,img)
{
    $('#'+mId)
        .velocity({
            translateZ: 0,
            translateY: -10,
        },{
            duration: 200,
            begin: function(){
                $('#'+"progress_"+mId).css("visibility","hidden");
            },
            complete: function(){
                anim_long_attack(mId,eId,400,img);
            }
        })
        .velocity("reverse",{
            complete: function(){
                $('#'+"progress_"+mId).css("visibility","visible");
            }
        })
    ;
}

function event_close_attack(mId,eId,img)
{
    var x = document.getElementById(eId).getBoundingClientRect().left - document.getElementById(mId).getBoundingClientRect().left;
    var y = document.getElementById(eId).getBoundingClientRect().top - document.getElementById(mId).getBoundingClientRect().top;

    $('#'+mId)
        .velocity({
            translateZ: 0,
            translateX: x,
            translateY: y + 80,
        },{
            duration: 500,
            begin: function(){
                $('#'+"progress_"+mId).css("visibility","hidden");
            }
        })

        .velocity({
            translateZ: 0,
            rotateZ: "6deg",
        },{
            duration: 300,
            complete: function(){
                anim_close_attack(mId,eId,400,img);
                $('#'+"progress_"+eId+" div").css("width","80%");
            },
        })

        .velocity({
            translateZ: 0,
            rotateZ: "-12deg",
        },{
            complete: function(){

            }
        })

        .velocity({
            translateZ: 0,
            translateX: 0,
            translateY: 0,
            rotateZ: "0deg",
        },{
            duration: 500,
            complete: function(){
                $('#'+"progress_"+mId).css("visibility","visible");
            }
        })
    ;
}
</script>

</div>
</body>
</html>
