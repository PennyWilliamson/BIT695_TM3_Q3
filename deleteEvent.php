<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Delete Event </title>
 
</head>
<body>
Event deleted.
<?php

 $uid="root";

 $pwd="root";

 $database="assignment2";

 $host = 'localhost';

 function connect_db($host, $uid, $pwd, $database) 
 {  	$conn=mysqli_connect($host, $uid, $pwd, $database)

 	or die('connection problem:' . mysqli_connect_error());

 	return $conn;

 }
$conn=connect_db($host, $uid, $pwd, $database);
$tempDay= $_GET["day"]; 
//Temporary varible for holding the value of the parameter.
//Variable needs to be passed in whenever the variable is called.
function deleteEvent($conn, $tempDay) {

$sql = "DELETE FROM `schedule` WHERE `schedule`.`Day`=$tempDay";

      $result = $conn -> query($sql);
	  
      return $result;

 }
  $result = deleteEvent($conn, $tempDay);
  
 ?>
 </body>
 </html>