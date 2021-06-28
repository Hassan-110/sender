<?php
$start_time = microtime(true) ;


<html>
  <body>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Email: <input name="email" type="text" placeholder="Email" /><br /><br />
        Subject: <input name="subject" type="text" placeholder="Subject" /><br /><br />
        Message:<br />
        <textarea rows="15" cols="40"; name="message" id="message"></textarea><br /><br />
        <input type="submit" name="submit" value="Send An Email" class="btn btn-primary">
    </form>
   
  </body>
</html>

<?php
#use PHPMailer\PHPMailer;
require "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";






  if(isset($_POST['submit'])){

$to      = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$from = "s201743930@kfupm.edu.sa";
$headers = "From: s201743930@kfupm.edu.sa "."\r\n";


// read from database
$dsn = 'mysql:dbname=sender;host=127.0.0.1';
$user = 'root';
$password = '';

$dbh = new PDO($dsn, $user, $password);

$sql = "select * from emails";

foreach( $dbh->query($sql) as $row){

  $to = $row["To"];
  $mail_result = mail($to, $subject, $message,$headers);
}







if($mail_result){
    echo "sent";
}else{
    echo "failed";
}

}

$finish_time = microtime(true);

$exec_time = ($finish_time - $start_time);
echo "<p>";
echo $exec_time;
echo "</p>";
?>