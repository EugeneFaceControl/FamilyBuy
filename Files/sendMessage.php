<?php
$myVk = "eugenegrabs-556f48ce2@vkmessenger.com";
$myMail = "zhenya113@mail.ru";
$message = $_POST["message"];
echo $message;
$sent = mail($myMail, "Message", $message);
echo $sent;
?>