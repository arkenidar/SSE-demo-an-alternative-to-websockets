<?php

function getMessage(){

    $sleep=false;

    if(!isset($_REQUEST['cid'])) $cid=1;
    else $cid = (int)$_REQUEST['cid'];

    try{
        require('db_connect.php');

        $stmt_get = $db->prepare('select * from messages where cid=:cid order by id asc limit 1');
        $stmt_delete = $db->prepare('delete from messages where cid=:cid order by id asc limit 1');
        $stmt_get->bindParam(':cid', $cid);

        if($stmt_get->execute()){
            if ($row = $stmt_get->fetch()) {
                echo 'id: '.$row['id']."\n";
                echo 'data: M'.$row['msg']."\n\n";

                $stmt_delete->bindParam(':cid', $cid);
                $stmt_delete->execute();
            }
        }
    }catch(PDOException $e){ echo 'data: EPDOException: '.$e->getMessage()."\n\n"; $sleep=true;}

    return $sleep;
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

if (ob_get_level() == 0) ob_start();

while(true){

    $sleep=getMessage();

    flush();
    ob_flush();

    if($sleep) sleep(1);
}

ob_end_flush();

$db = null;
?>