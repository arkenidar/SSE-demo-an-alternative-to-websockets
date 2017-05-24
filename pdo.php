<?php
try
{
//open the database
require('db_connect.php');

//insert some data...
$db->exec(
"INSERT INTO messages (msg,cid) VALUES ('msg1', 1);" .
"INSERT INTO messages (msg,cid) VALUES ('msg1', 2);" .

"INSERT INTO messages (msg,cid) VALUES ('msg2', 1); " .
"INSERT INTO messages (msg,cid) VALUES ('msg2', 2); " .

"INSERT INTO messages (msg,cid) VALUES ('msg3', 1);" .
"INSERT INTO messages (msg,cid) VALUES ('msg3', 2);"
);

//now output the data to a simple html table...
print "<table border=1>";
print "<tr><td>id</td><td>msg</td><td>cid</td></tr>";
$result = $db->query('SELECT * FROM messages order by id asc');
foreach($result as $row)
{
  print "<tr>";
  print "<td>".$row['id']."</td>";
  print "<td>".$row['msg']."</td>";
  print "<td>".$row['cid']."</td>";
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
