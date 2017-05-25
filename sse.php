<?php

function getMessage(){
    if(!isset($_REQUEST['cid'])) $cid=1;
    else $cid = (int)$_REQUEST['cid'];

    try{
        require('db_connect.php');

        $stmt = $db->prepare('select * from messages where cid=:cid order by id asc limit 1');
        $stmt->bindParam(':cid', $cid);

        if($stmt->execute()){
            if ($row = $stmt->fetch()) {
                echo 'id: '.$row['id']."\n";
                echo 'data: '.$row['msg']."\n\n";

                $stmt = $db->prepare('delete from messages where cid=:cid order by id asc limit 1');
                $stmt->bindParam(':cid', $cid);
                $stmt->execute();
            }
        }
    }catch(PDOException $e){ echo 'data: PDOException: '.$e->getMessage()."\n\n"; }
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

if (ob_get_level() == 0) ob_start();

while(true){

    getMessage();

    flush();
    ob_flush();
}

ob_end_flush();
