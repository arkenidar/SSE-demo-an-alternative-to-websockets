<?php

// use with
/// require('db_connect.php');

//open the database
$db = new PDO("mysql:host=localhost;dbname=sse_demo;charset=utf8", 'root', 'root');

//create the database
$db->exec("CREATE TABLE messages (id INTEGER PRIMARY KEY AUTO_INCREMENT, msg TEXT, cid INTEGER)");
?>