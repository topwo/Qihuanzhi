<?php


/*
function get_data_array($file,$db,$index)
{
    $json = file_get_contents("../data/".$file.".json","r");
    $str = json_decode( $json, true );
    return $str[$db][$index];
}

*/


function ex($data,$op=null,$param=null)
{
    // str分割成array
    $array = explode(',', $data);
    if($op == 're')
    {
        // 去除掉指定值
        foreach ($array as $key => $value)
        {
            if( $value == $param ) unset( $array[$key] );
        }
        // 重排数据
        return $array;
    }
    return $array;
}

// 根据键值 重排
function reKey($array,$except)
{
    foreach ($array as $key => $value)
    {
        if( $value == $except ) unset( $array[$key] );
    }
    return array_keys($array);
}

function get_dataArray($file,$db)
{
    $json = file_get_contents("../data/".$file.".json","r");
    $str = json_decode( $json, true );
    return $str[$db];
}

function get_dataArray_count($file,$db)
{
    $json = file_get_contents("../data/".$file.".json","r");
    $str = json_decode( $json, true );
    return count($str[$db]);
}

function get_data_array_byid($file,$db,$id)
{
    $json = file_get_contents("../data/".$file.".json","r");
    $str = json_decode( $json, true );
    foreach ($str[$db] as $key => $value)
    {
        if ( $key == $id)
        {
            return $value;
        }
    }
}

?>
