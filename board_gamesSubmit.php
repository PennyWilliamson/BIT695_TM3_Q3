<!DOCTYPE html>
<html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Form Submission</title>

<body>
Thank you for submitting a position.
<?php

 $uid="root";

 $pwd="root";

 $database="assignment2";

 $host = 'localhost';

 function connect_db($host, $uid, $pwd, $database) {  	$conn=mysqli_connect($host, $uid, $pwd, $database)

 	or die('connection problem:' . mysqli_connect_error());

 	return $conn;
	

 } /*Modified from code supplied
in BIT695 notes, The Open Polytechnic Companion Guide,
Block 2, Part 5:The server side(2), section 5 Querying a database.
Retrieved 10 April 2017.
Also used in BIT695_TM2_3431274 Question 1.
*/

 $conn=connect_db($host, $uid, $pwd, $database);

$tempMemberID=$_POST["memberID"];
$tempBoardgame=$_POST["boardgame"];
$tempPosition=$_POST["position"];
$tempNotes=$_POST["notes"];
$tempDate=$_POST["date"];
$tempEvent=$_POST["event"];

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
	$boardgameErr="";
	$positionErr="";
	$notesErr="";
	$dateErr="";
	$eventErr="";
	$memberID="";
	$boardgame="";
	$position="";
	$notes="";
	$date="";
	$event="";
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(empty($_POST["memberID"]))
		{
			$memberIDErr="member ID is required";
		} 
		else
		{
			$memberID=test_input($_POST["memberID"]);
			if(!preg_match("/^[0-9]*$/",$memberID))
			{
				$memberIDErr="Please use only numbers";
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
				$boardgameErr="Please use only letters and numbers";
			}
		}
		if(empty($_POST["position"]))
		{
			$positionErr="Position is required";
			
		} 
		else
		{
			$position=test_input($_POST["position"]);
			if(!preg_match("/^[0-9]*$/",$position))
			{
				$positionErr="Please use numbers and equals sign";
				
			}
		}
		if(empty($_POST["notes"]))
		{
			$notesErr="Notes is required";
		}
		else
		{
			$notes=test_input($_POST["notes"]);
			if(!preg_match("/^[a-z A-Z 0-9]*$/",$notes))
			{
				$notesErr="Please enter notes";
			}
		}
		if(empty($_POST["date"]))
		{
			$dateErr="date is required";
		}
		else
		{
			$date=test_input($_POST["date"]);
			if(!preg_match("/^[0-9 - \/]*$/",$date))
			{
				$dateErr="Please enter date";
			}
		}
		if(empty($_POST["event"]))
		{
			$eventErr="Event is required";
		}
		else
		{
			$event=test_input($_POST["event"]);
			if(!preg_match("/^[a-z A-Z 0-9]*$/",$event))
			{
				$eventErr="Please enter event";
			}
		}
	}
	$valid=false;
	if($memberIDErr=="" && $boardgameErr=="" && $positionErr=="" && $notesErr=="" && $dateErr=="" && $eventErr=="")
	{
		$valid=true;
	}
	return $valid;
}


 
function insert_form($conn, $tempMemberID, $tempBoardgame, $tempPosition, $tempNotes, $tempDate, $tempEvent){

 $sql ="INSERT INTO `board_games` (`MemberID`, `Boardgame`, `Position`, `Notes`, `Date`, `Event`)
VALUES ('$tempMemberID', '$tempBoardgame', '$tempPosition', '$tempNotes', '$tempDate', '$tempEvent')";

$result = $conn -> query($sql);
	  
      return $result;
}


$valid=validate_code();
//Checks that the form has passed server side validation before inserting the data.
if($valid==true){
$result=insert_form($conn, $tempMemberID, $tempBoardgame, $tempPosition, $tempNotes, $tempDate, $tempEvent);
}

	  ?>
	  </body>
	  </html>