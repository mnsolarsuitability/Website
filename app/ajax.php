<?php

/* create a file in this directory called config.php that contains:
$host = "xx.xx.xx.xx";
$user = "postgres"; 
$pass = "password";
$dbname = "mydb";
$schema = "public";
*/

include 'config.php';

// Connect and select database
$dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$pass")
    or die('Could not connect: ' . pg_last_error());

// Build and perform SQL Query
$query = "SELECT lidar_collect FROM county WHERE countyname = '" . $_REQUEST['c'] . "'";
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
$l = pg_fetch_row($result);

// Return result as JSON - NOTE: JSON Encoder not supported in PHP 5.1 so must build manually
header('Content-Type: application/json');
echo '{"collect":"'.$l[0].'"}';

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

?>