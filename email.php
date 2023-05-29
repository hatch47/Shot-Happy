<!-- email is still a work in progress, will only work locally -->
<!-- // my email set up for this is shothappy12345@gamil.com -->

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
	<title>Email</title>
</head>
<body>
<div class="center">
<h2>Shot-Happy Teams</h2>
<h4>Email</h4>
<?php require 'navbar.php'?>
<br><br>
<form method="post">
    <input type="submit" name="email" value="Send Email">
</form>
<?php

if(isset($_POST['email'])) {
    //
    // *** To Email ***
    $to = 'shothappy12345@gmail.com';
    //
    // *** Subject Email ***
    $subject = 'Test';
    //
    // *** Content Email ***
    $content = 'This is a test';
    //
    //*** Head Email ***
    $headers = "From: shothappy12345@gmail.com\r\n";
    //
    //*** Show the result... ***
    if (mail($to, $subject, $content, $headers))
    {
        echo "<br><br>Email Sent";
    } 
    else 
    {
        echo "<br><br>Error sending email";
    }
}

?>
</div>
</body>
</html> 




