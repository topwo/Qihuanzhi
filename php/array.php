<?php

function ex($data,$sign=',',$filter='')
{
    return explode($sign, str_replace($filter,'',$data));
}

?>
