<!DOCTYPE html>
 <html lang=en-GB>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="StyleSheet" href="styles.css" type="text/css" media="screen" />
 <title>Edit Game </title>
 
</head>
<body>
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
 $tempMemberID= $_GET["memberID"];
 //variable declaration to get form data from the database.
 $formMemberID=$_POST["frmID"];
 $formFname=$_POST["frmFname"];
 $formBGame=$_POST["frmBGame"];
 $formAvailable=$_POST["frmAvailable"];
 $formNotes=$_POST["frmNotes"];
 if($formMemberID != '')
 { 
$tempMemberID=$formMemberID;
}
 //function to get the data from the database to display on the form.
 function get_data($conn, $tempMemberID){
	 $sql="SELECT * FROM `library` WHERE `library`.`MemberID`=$tempMemberID";
	 $result= $conn -> query($sql);
	 return $result;
 }
 
 function updateGame($conn, $tempMemberID, $formFname, $formBGame, $formAvailable, $formNotes) 
 {

$sql = "UPDATE `library`  SET `FirstName`='$formFname',
`Boardgame`='$formBGame', `Available`='$formAvailable', 
`Notes`='$formNotes' WHERE `library`.`MemberID`=$tempMemberID" ;

      $result = $conn -> query($sql);

      return $result;

 }
 //The if statement to update the database. Checks if the Member ID field still
 //holds the member ID, which is the primary key, first.
 if($formMemberID != ''){
 $result=updateGame($conn, $formMemberID, $formFname, $formBGame, $formAvailable, $formNotes);
 }
 $result=get_data($conn, $tempMemberID);
 ?>
 <form id="EditGame" 
	method="post" 
	enctype="application/x-www-form-urlencoded"
	action="editGame.php">
 
 <fieldset>
	<legend> Edit Game</legend>
	<ul>
	<?php $row = $result->fetch_assoc() ?> <!--fetchs the data for the form-->
<li>
<label>Membership ID</label>
<input type="int" tabindex="1" name="frmID" value="<?php echo $row["MemberID"];?>">
</li>
<li>
<label>First name:<br> </label>
<input type="text" tabindex="2" name="frmFname" value="<?php echo $row["FirstName"]; ?>">
</li>
<li>
<label>Boardgame:<br> </label>
<input type="text" tabindex="3" name="frmBGame" value="<?php echo $row["Boardgame"];?>">
</li>
<li>
<label>Available:<br> </label>
<input type="text" tabindex="4" name="frmAvailable" value="<?php echo $row["Available"];?>">
</li>
<li>
<label>Notes:<br> </label>
<input type="tel" tabindex="5" name="frmNotes" value="<?php echo $row["Notes"];?>"> 
</li>
</ul>
<input type="submit" value="Update">
</fieldset>
</form>
 </body>
 </html>