<?php



function get_data_array($file,$db,$index)
{
    $json = file_get_contents("../data/".$file.".json","r");
    $str = json_decode( $json, true );
    return $str[$db][$index];
}




function ex($data,$sign=',',$filter='')
{
    return explode($sign, str_replace($filter,'',$data));
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
