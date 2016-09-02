<?php
//echo $_GET['key'];
//echo $_GET['value'];
?>

<div id="cards-detail">
    <div id="div_alpha"></div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="row">
                    <div class="img" style="top:4%;"><img src="../img/ui/cards.info.name.png" /></div>
                    <div class="name">闭月</div>
                </div>
                <div class="row">
                    <div class="left" style="top:8%;"><img src="../img/card/1.png" /></div>
                    <div class="right" style="top:13%;">
                        <span>
                            <div style="float:left;color:#bcff08;"><b><small>稀有卡牌</small></b></div>
                            <div style="float:right;color:#02f8ff;"><b><small>牧师</small></b></div>
                        </span>
                        <span style="margin: 25px 0px 7px 0px;">
                            <img src="../img/ui/star.png" />
                            <img src="../img/ui/star.png" />
                            <img src="../img/ui/star2.png" />
                            <img src="../img/ui/star2.png" />
                            <img src="../img/ui/star2.png" />
                        </span>
                        <span>等&emsp;级&nbsp;<b>91/92</b></span>
                        <span>攻&emsp;击&nbsp;<b>16263+1786</b></span>
                        <span>生&emsp;命&nbsp;<b>61145+6606</b></span>
                        <span>领导力&nbsp;<b>40+5</b></span>
                    </div>
                </div>
                <div class="row">
                    <div class="detail"><img src="../img/ui/cards.info.detail.png" /></div>
                    <div class="row-child">
                        <span class="title"><big>普通技能</big> <b><small>射击</small></b></span>
                        <span class="content"><small>对单体使用普通物理攻击</small></span>
                        <span class="title"><big>主动技能</big> <b><small>剧毒射击</small></b> <b><small>等级10/10</small></b> <img src="../img/ui/cards.info.skill.png" /><img src="../img/ui/cards.info.skill2.png" /><img src="../img/ui/cards.info.skill2.png" /> </span>
                        <span class="content"><small>降低敌方前排大量受治疗，持续2回合，不影响持续恢复技能。</small></span>
                        <span class="title"><big>被动天赋</big> <b><small>中级防护天赋</small></b></span>
                        <span class="content"><small>微量+韧性，大量+物抗</small></span>
                        <span class="title"><big>队长技能</big></span>
                        <span class="content">
                            <small style="color:#ff5e00;">① 宗师法力庇护</small>
                            <small style="color:#ff5e00;">① 宗师法力庇护</small>
                            <br>
                            <small style="color:#ff5e00;">① 宗师法力庇护</small>
                            <small style="color:#ff5e00;">① 宗师法力庇护</small>
                        </span>
                        <span class="title"><big>英雄介绍</big></span>
                        <span class="content"><small>具有深不可测的能力，四暗影和会长的师父。</small></span>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">Slide 2</div>
            <div class="swiper-slide">Slide 3</div>
        </div>
    </div>
    <div class="row">
        <div class="div_tab">
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="row">
        <div class="div_close">
            <img src="../img/ui/button.close.png" />
        </div>
    </div>
</div>

<script>
// 横向滑屏事件
var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: false
});

$(".div_close img").click(function()
{
    $('#cards-detail').remove();
});
</script>
