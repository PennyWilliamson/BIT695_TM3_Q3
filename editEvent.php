<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Edit Event </title>
 
</head>
<body>
Update event using this form.
</body>
</html>
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
 
 $conn=connect_db($host,$uid,$pwd,$database);
 $tempDay= $_GET["day"];
//variable declaration to get form data from the database.
 $formDay=$_POST["day"];
 $formBoardgame=$_POST["boardgame"];
 $formVenue=$_POST["venue"];
 $formEventType=$_POST["eventType"];
 
 if($formDay!= '')
 { 
$tempDay=$formDay;
}
//function to get the data from the database to display on the form.
 function get_data($conn, $tempDay){
	 $sql="SELECT * FROM `schedule` WHERE `schedule`.`Day`='$tempDay'";
	 $result= $conn -> query($sql);
	 return $result;
 }
 
 function updateEvent($conn, $tempDay, $formBoardgame, $formVenue, $formEventType) {

$sql = "UPDATE `schedule` SET `Boardgame`='$formBoardgame',
`Venue`='$formVenue', `EventType`='$formEventType' WHERE `schedule`.`Day`='$tempDay'";

      $result = $conn -> query($sql);

      return $result;

 }
 //The if statement to update the database. Checks if the Day field still
 //holds the date, which is the primary key, first.
 if($formDay != ''){
 $result=updateEvent($conn, $formDay, $formBoardgame, $formVenue, $formEventType);
 }
 $result=get_data($conn, $tempDay); 
 ?>
 <form id="Schedule" 
	method="post" 
	enctype="application/x-www-form-urlencoded"
	action="editEvent.php">
 
 <fieldset>
	<legend> Edit Event </legend>
	<ul>
	<?php $row = $result->fetch_assoc() ?> <!--fetchs the data for the form-->
<li>
<label>Date:</label>
<input type="date" tabindex="1" name="day" value="<?php echo $row["Day"];?>">
</li>
<li>
<label>Boardgame:<br> </label>
<input type="text" tabindex="2" name="boardgame" value="<?php echo $row["Boardgame"];?>">
</li>
<li>
<label>Venue:<br> </label>
<input type="text" tabindex="3" name="venue" value="<?php echo $row["Venue"];?>">
</li>
<li>
<label>Event Type:<br> </label>
<input type="text" tabindex="4" name="eventType" value="<?php echo $row["EventType"];?>">
</li>

</ul>
<input type="submit" value="Update">
</fieldset>
</form>
 </body>
 </html>