<?php

// use with
/// require_once('db_connect.php');

function db_connect(){
    //open the database
    require('db_config.php');
    $db_host = $db_config['host'];
    $db_name = $db_config['dbname'];
    $db_username = $db_config['user'];
    $db_password = $db_config['password'];
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
    assert($db!=null);
    return $db;
}

function db_exception($pdo_exception){
    http_response_code(500);
    echo 'PDOException: '.$pdo_exception->getMessage();
}

function db_init(){
    $db = db_connect();
    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY AUTO_INCREMENT, msg TEXT, cid INTEGER)");
    $db = null;
}

db_init();

?>
