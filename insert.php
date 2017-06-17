<?php

try{
    require_once('db_connect.php');
    $db = db_connect();
} catch(PDOException $pdo_exception){
    $db = null;
    db_exception($pdo_exception);
}

$msg = @$_REQUEST['msg'];
if($msg=='') $msg='...';

$cid_sequence=[0,1];
$stmt = $db->prepare('INSERT INTO messages (msg,cid) VALUES (:msg,:cid)');
foreach($cid_sequence as $cid){
    try{
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':cid', $cid);

        $stmt->execute();

    } catch(PDOException $pdo_exception){
        $db = null;
        db_exception($pdo_exception);
    }
}

$db = null;
?>