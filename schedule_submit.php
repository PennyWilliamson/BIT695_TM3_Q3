<!DOCTYPE html>
<html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Form Submission</title>

<body>
Thank you for submitting an event.
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

$tempdate=$_POST["date"];
$tempboardgame=$_POST["boardgame"];
$tempvenue=$_POST["venue"];
$tempeventType=$_POST["eventType"];


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
	$dateErr="";
	$boardgameErr="";
	$venueErr="";
	$eventTypeErr="";
	$date="";
	$boardgame="";
	$venue="";
	$eventType="";
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($_POST["date"]))
		{
			$dateErr="date is required";
		} 
		else
		{
			$date=test_input($_POST["date"]);
			if(!preg_match("/^[0-9 \/ -]*$/",$date))
			{
				$dateErr="Please use date format";
			}
		}
		if(empty($_POST["boardgame"]))
		{
			$boardgameErr="Boardgame is required";
		} 
		else
		{
			$boardgame=test_input($_POST["boardgame"]);
			if(!preg_match("/^[a-z A-Z 0-9]*$/",$boardgame))
			{
				$boardgameErr="Please use only letters, numbers and spaces";
			}
		}
		if(empty($_POST["venue"]))
		{
			$venueErr="Venue address is required";
			
		} 
		else
		{
			$venue=test_input($_POST["venue"]);
			if(!preg_match("/^[a-z A-Z 0-9 ']*$/",$venue))
			{
				$venueErr="Please use only letters, numbers and spaces";
				
			}
		}
		if(empty($_POST["eventType"]))
		{
			$eventTypeErr="Type of Event is required";
		}
		else
		{
			$eventType=test_input($_POST["eventType"]);
			if(!preg_match("/^[a-z A-Z 0-9]*$/",$eventType))
			{
				$eventTypeErr="Please enter event type";
			}
		}
	}
	
	$valid=false;
	if($dateErr=="" && $boardgameErr=="" && $venueErr==""  && $eventTypeErr=="")
	{
		$valid=true;
	}
	return $valid;
}



function insert_form($conn, $tempdate, $tempboardgame, $tempvenue, $tempeventType){

 $sql ="INSERT INTO `schedule` (`Day`, `Boardgame`, `Venue`, `EventType`)
VALUES ('$tempdate', '$tempboardgame', '$tempvenue', '$tempeventType')";

$result = $conn -> query($sql);
	  
      return $result;
}


$valid=validate_code(); 
//Checks that the form has passed server side validation before inserting the data.
if($valid==true){
$result=insert_form($conn, $tempdate, $tempboardgame, $tempvenue, $tempeventType);
}

	  ?>
	  </body>
	  </html>