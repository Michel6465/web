<?php

$json = file_get_contents("php://input"); // json string
$data = json_decode($json); // php object

if (mail("louis_bouchereau@laposte.net", "Contact appli", $data->msg, 'Reply-To: '.$data->reply)) {
	echo "ok";
} else {
	echo "nok";
}

?>
