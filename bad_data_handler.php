<?php include ("lib/function_library.php"); 

if($_REQUEST['lat'] != "") {

	$to = "solarp@umn.edu";
	$to_name = "Bad Data Czar";
	$subject = "Bad Data Notification";
	$body = "<br>This location needs to be reprocessed: <a href='http://solar.maps.umn.edu/app/index.html?lat=" . $_REQUEST['lat'] . "&long=" . htmlentities($_REQUEST['long']) ."'>" . $_REQUEST['lat'] . ", " . $_REQUEST['long'] . "</a><br><br>" . $_REQUEST['notes']. "<br>";
	$replytoaddress = $_REQUEST['email'];
	$fromname = $_REQUEST['name'];

	$result = send_email($to, $to_name, $body, $subject, $fromaddress="mnsolarsuitability@gmail.com", $fromname, $replytoaddress);	
	
	if($result) {
	//echo "Email Sent Successfully.";
		//header( "Location: /app" );
		$msg = "Your report was sent successfully. We'll do our best to fix the data asap.";
	} else {
		$msg = "There was an error sending your report. Please try again.";
	}
}

$x = htmlentities($_REQUEST['x']);
$y = htmlentities($_REQUEST['y']);

?>


<!DOCTYPE html>
<html>
<head>
  <!-- University of Minnesota Web template:  v5.101021 -->
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta content="Chris Martin" name="author">
  <meta content="Solar Suitability Analysis - UMN" name="description">
  <meta content="solar, Minnesota, University of Minnesota, UMN" name="keywords">
  <meta content="09/16/2014" name="date">

  <title>Minnesota Solar Suitability Analysis</title>
  
<?php include_once("assets/nav/header.php"); ?>

</head>

<body>

<!-- Top Nav -->
<?php include_once ("assets/nav/top_nav.php");?>
  
<!-- START OUR CONTENT -->
<h3>You have indicated that there is a problem with the following location:<br>
<a href="/app/index.html?lat=<?php echo $y; ?>&long=<?php echo $x; ?>"><?php echo $y .", ". $x; ?></a></h3>
<p>&nbsp;</p>
<?php if($msg != ""){ 

			echo "<h5>".$msg."</h5><a href='javascript:window.close()'>X Close this window and return to the app</a>";

		} else {
?>

    <form action="" method="post">
    <p>Please tell us who you are: </p>
    <p><label for="name">Name:</label>
      <input type="name" name="name" id="name">
    </p>
    <p>
      <label for="email">Email:</label>
      <input name="email" type="email" required="required" id="email">
    </p>
    <p>
      <label for="notes">Notes:</label>
      <textarea name="notes" id="notes"></textarea>
    </p>
    <p>
    <input type="hidden" name="lat" id="lat" value="<?php echo $y; ?>">
    <input type="hidden" name="long" id="long" value="<?php echo $x; ?>">
      <input type="submit" name="submit" id="submit" value="Submit" onClick="javascript:document.getElementById('submit').value = '******* Sending now. Thank You! *******';">
    </p>
    </form>

<?php } ?>
<p>&nbsp;</p>
  <!-- BEGIN UofM FOOTER -->
<?php include_once ("assets/nav/footer.php");?>
</body>
</html>