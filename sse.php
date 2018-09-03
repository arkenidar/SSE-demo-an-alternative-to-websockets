<?php

function getMessage($cid){
    if (ob_get_level() == 0) ob_start();
    $sleep=false;
    try{
        require_once('db_connect.php');
        $db = db_connect();
        // prepare sql queries
        $stmt_get = $db->prepare('select * from messages where cid=:cid order by id asc limit 1');
        $stmt_get->bindParam(':cid', $cid);
        $stmt_delete = $db->prepare('delete from messages where cid=:cid order by id asc limit 1');
        if($stmt_get->execute()){
            if ($row = $stmt_get->fetch()) {
                // send item
                echo 'id: '.$row['id']."\n";
                echo 'data: M'.$row['msg']."\n\n";
                // flush
                flush();
                ob_flush();
                // delete sent item
                $stmt_delete->bindParam(':cid', $cid);
                $stmt_delete->execute();
            }
        }
    }catch(PDOException $pdo_exception){
        $sleep=true;
        $db=null;
        echo 'data: E';
        db_exception($pdo_exception);
        echo "\n\n";
    }

    ob_end_flush();
    $db = null;
    if($sleep) sleep(1);
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
$cid = (int)@$_GET["cid"];
while(getMessage($cid)){}

?>
