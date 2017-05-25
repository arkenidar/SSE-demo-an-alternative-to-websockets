<?php
try{
    require('db_connect.php');
} catch(PDOException $e){ die('PDOException: '.$e->getMessage()); }

$msg = @$_REQUEST['msg'];
if($msg=='') $msg='...';

$cid_sequence=[1,2];

foreach($cid_sequence as $cid){
    try{
        $stmt = $db->prepare('INSERT INTO messages (msg,cid) VALUES (:msg,:cid)');
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':cid', $cid);

        $stmt->execute();

    } catch(PDOException $e){ print 'PDOException: '.$e->getMessage(); }
}
