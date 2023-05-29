

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
	<title>Email Status</title>
</head>
<body>
<div class="center">
<h2>Shot-Happy Teams</h2>
<?php include('navbar.php'); ?>
<h4>Email Status</h4>

<?php
// Add DBConnection Class for Database
require 'DBConnect.php';

// Create an instance of the Database class and use its methods
$db = new DBConnect();
$conn = $db->connect();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

require 'C:\xampp\htdocs\Shot-Happy\PHP Email\PHPMailer-master\PHPMailer-master\src/PHPMailer.php';
require 'C:\xampp\htdocs\Shot-Happy\PHP Email\PHPMailer-master\PHPMailer-master\src/SMTP.php';
require 'C:\xampp\htdocs\Shot-Happy\PHP Email\PHPMailer-master\PHPMailer-master\src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Query the email table for email addresses
$sql = "SELECT email FROM email WHERE email LIKE '%co'";
$result = $conn->query($sql);

// SMTP configuration for Gmail
$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'shothappy12345@gmail.com';
$mail->Password = '';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->setFrom('shothappy12345@gmail.com', 'Shot Happy');

// Loop through each email address and send the email
while($row = $result->fetch_assoc()) {
    $to = $row["email"];
    $mail->addAddress($to);
    $mail->addCC('shothappy12345@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Test email';
    $mail->Body = 'This is a test email from PHP using PHPMailer.';
    try {
        $mail->send();
        echo "Email sent successfully to " . $to . "<br>";
    } catch (Exception $e) {
        echo "Error sending email to " . $to . ": " . $mail->ErrorInfo . "<br>";
    }
    $mail->clearAllRecipients();
}

// Close the database connection
$conn->close();
?>







</div>
</body>
</html>








