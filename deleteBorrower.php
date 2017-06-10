<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Delete Borrower </title>
 
</head>
<body>
Borrower record deleted.
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
$tempMemberID= $_GET["memberID"]; 
//Temporary varible for holding the value of the parameter.
//Variable needs to be passed in whenever the variable is called.
function deleteBorrower($conn, $tempMemberID) {

$sql = "DELETE FROM `library_borrowers` WHERE `library_borrowers`.`MemberID`=$tempMemberID";

      $result = $conn -> query($sql);
	  
      return $result;

 }
  $result = deleteBorrower($conn, $tempMemberID);
  
 ?>
 </body>
 </html>