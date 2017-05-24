<?php

require('db_connect.php');

$msg = @$_REQUEST['msg'];
if($msg=='') $msg='default_message!!';
$msg = $db->quote($msg);

$cid_sequence = explode(',',@$_REQUEST['cids']);
$cid_sequence=[1,2];

foreach($cid_sequence as $cid){
    //$cid = ctype_digit($cid);
    $sql = "INSERT INTO messages (msg,cid) VALUES ({$msg},{$cid});\n";
    //echo $sql;
    try{
        $db->exec($sql);
    }catch(PDOException $e)
    {
    print 'Exception : '.$e->getMessage();
    }
}
