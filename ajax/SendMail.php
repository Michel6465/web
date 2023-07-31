<?php

$json = file_get_contents("php://input"); // json string
$data = json_decode($json); // php object

$from = "louis-bouchereau@louis-bouchereau.fr";
$to = "louis_bouchereau@laposte.net";
$subject = "Appli - ".$data->name;
$message = $data->msg."\n".$data->email;
$headers = "From:".$from;

mail($to, $subject, $message, $headers);
echo "ok";

?>

