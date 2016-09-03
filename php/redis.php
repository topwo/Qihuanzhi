<?php

function getData($db,$name)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hget($db, $name);
    return explode(",", $data);
}

function getDataArray($db)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hgetall($db);
    return $data;
}

function getDataArray_Skill($db)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hmget($db, array(
        '1',
        '2',
    ));
    return $data;
}

?>
