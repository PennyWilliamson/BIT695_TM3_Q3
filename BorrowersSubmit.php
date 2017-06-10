<!DOCTYPE html>
<html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Borrowers Form Submission</title>

<body>
Enjoy your borrowed game.
<?php

 $uid="root";

 $pwd="root";

 $database="assignment2";

 $host = 'localhost';

 function connect_db($host, $uid, $pwd, $database) {  	$conn=mysqli_connect($host, $uid, $pwd, $database)

 	or die('connection problem:' . mysqli_connect_error());

 	return $conn;
	

 } 
 /*Modified from code supplied
in BIT695 notes, The Open Polytechnic Companion Guide,
Block 2, Part 5:The server side(2), section 5 Querying a database.
Retrieved 10 April 2017.
Also used in BIT695_TM2_3431274 Question 1.
*/

 $conn=connect_db($host, $uid, $pwd, $database);

$tempMemberID=$_POST["memberID"];
$tempFirstName=$_POST["firstName"];
$tempBorrowed=$_POST["borrowed"];


function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}

/*Define the variables, and set to empty values 
before starting validation.
Code patterns from W3Schools; 
PHP form Validation,
https://www.w3schools.com/php/php_form_validation.asp
PHP form URL/Email, 
https://www.w3schools.com/php/php_form_url_email.asp
and PHP form Required, 
https://www.w3schools.com/php/php_form_required.asp
retreived: April 17 2017  */
$conn=connect_db($host, $uid, $pwd, $database);

function validate_code()
{
	$memberIDErr="";
	$firstNameErr="";
	$borrowedErr="";
	$memberID="";
	$firstName="";
	$borrowed="";
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($_POST["memberID"]))
		{
			$memberIDErr="Member ID is required";
		} 
		else
		{
			$memberID=test_input($_POST["memberID"]);
			if(!preg_match("/^[0-9]*$/",$memberID))
			{
				$memberIDErr="Please use only numbers";
			}
		}
		if(empty($_POST["firstName"]))
		{
			$memberIDErr="First name is required";
		} 
		else
		{
			$firstName=test_input($_POST["firstName"]);
			if(!preg_match("/^[a-z A-Z]*$/",$firstName))
			{
				$firstNameErr="Please use only letters";
			}
		}
		if(empty($_POST["borrowed"]))
		{
			$borrowedErr="Boardgame borrowed is required";
		} 
		else
		{
			$borrowed=test_input($_POST["borrowed"]);
			if(!preg_match("/^[a-z A-Z 0-9]*$/",$boardgame))
			{
				$boardgameErr="Please use only letters, numbers and spaces";
			}
		}
		
	}
	
	$valid=false;
	if($memberIDErr=="" && $firstNameErr=="" && $borrowedErr=="")
	{
		$valid=true;
	}
	return $valid;
}



function insert_form($conn, $tempMemberID, $tempFirstName, $tempBorrowed){

$sql ="INSERT INTO `library_borrowers` (`MemberID`, `FirstName`, `Borrowed`)
VALUES ('$tempMemberID', '$tempFirstName', '$tempBorrowed')";

$result = $conn -> query($sql);
	  
      return $result;
}


$valid=validate_code(); 
//Checks that the form has passed server side validation before inserting the data.
if($valid==true){
$result=insert_form($conn, $tempMemberID, $tempFirstName, $tempBorrowed);
}

	  ?>
	  </body>
	  </html>