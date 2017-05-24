<?php
try
{
//open the database
require('db_connect.php');

/*
//insert some data...
$db->exec("INSERT INTO messages (msg) VALUES ('msg1');" .
           "INSERT INTO messages (msg) VALUES ('msg2'); " .
           "INSERT INTO messages (msg) VALUES ('msg3');" );
*/


$result = $db->query('select * from messages order by id asc limit 1;');
$db->query('delete from messages order by id asc limit 1;');

$got = $result->fetchAll();
if($got) print $got[0]['msg'].'<br>';
else print 'no result<br>';

//now output the data to a simple html table...
print "<table border=1>";
print "<tr><td>id</td><td>msg</td></tr>";
$result = $db->query('SELECT * FROM messages');
foreach($result as $row)
{
  print "<tr>";
  print "<td>".$row['id']."</td>";
  print "<td>".$row['msg']."</td>";
  print "</tr>";
}
print "</table>";

// close the database connection
$db = NULL;
}
catch(PDOException $e)
{
print 'Exception : '.$e->getMessage();
}
