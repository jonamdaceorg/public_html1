<?php

$to = $this->input->get_post('to');
$msg = $this->input->get_post('msg');


// Authorisation details.
$username = "1stepshop.in@gmail.com";
$hash = "f0f1821c296cbf7c8d740604120719e3b0cb15c33fca4b0f5ad5a43f0c4180be";

// Config variables. Consult http://api.textlocal.in/docs for more info.
$test = "0";

// Data for text message. This is the text message data.
$sender = "TXTLCL"; // This is who the message appears to be from.
$numbers = "91".$to; // A single number or a comma-seperated list of numbers
$message = $msg;
// 612 chars or less
// A single number or a comma-seperated list of numbers
$message = urlencode($message);
$data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
$ch = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $result = curl_exec($ch); // This is the result from the API
curl_close($ch);
?>