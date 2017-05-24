<?php

function getMessage(){
    if(!isset($_REQUEST['cid'])) $cid=1;
    else $cid = (int)$_REQUEST['cid'];

    require('db_connect.php');
    try{
        $result = $db->query("select * from messages where cid={$cid} order by id asc limit 1");
        $got = $result->fetchAll();
        if($got){
            $msg = $got[0]['msg'];
            //echo 'id: '.$got[0]['id'].'\n';
            $text = $msg!==''?$msg.'<br>':'';
            echo "data: ".$text."\n\n";
            $db->query("delete from messages where cid={$cid} order by id asc limit 1");
        }
    }catch(PDOException $e)
    {
        print 'data: Exception : '.$e->getMessage()."\n\n";
    }
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

if (ob_get_level() == 0) ob_start();

for ($i = 0; $i<10; $i++){

    //$time = date('r');
    //$text = "The server time is: {$time}<br>";
    //echo "data: ".$text."\n\n";
    getMessage();

    ob_flush();
    flush();
    //sleep(2);
}

ob_end_flush();
