<?php

if (@$_POST['op'] == 'set')
{
    echo redis_set_Data($_POST['db'],$_POST['key'],$_POST['value']);
}


function redis_set_Data($db,$key,$value)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hset($db,$key,$value);
    return 'ok';
}

function getData($db,$name)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hget($db, $name);
    return explode(",", $data);
}

function redis_get_DataArray($db)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);

    $data = $redis->hgetall($db);
    return $data;
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
