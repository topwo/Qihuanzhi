<?php
function num2str($num,$mode=true)
{
    $char = array("零","一","二","三","四","五","六","七","八","九");
    $dw = array("","十","百","千","","万","亿","兆");
    $dec = "点";
    $retval = "";

    if($mode)
    preg_match_all("/^0*(\d*)\.?(\d*)/",$num, $ar);
    else
    preg_match_all("/(\d*)\.?(\d*)/",$num, $ar);

    if($ar[2][0] != "")
    $retval = $dec . ch_num($ar[2][0],false); //如果有小数，先递归处理小数
    if($ar[1][0] != "") {
    $str = strrev($ar[1][0]);
    for($i=0;$i<strlen($str);$i++) {
    $out[$i] = $char[$str[$i]];
    if($mode) {
    $out[$i] .= $str[$i] != "0"? $dw[$i%4] : "";
    if($str[$i]+@$str[$i-1] == 0)
    $out[$i] = "";
    if($i%4 == 0)
    $out[$i] .= $dw[4+floor($i/4)];
    }
    }
    $retval = join("",array_reverse($out)) . $retval;
    }
    return $retval;
}
?>
