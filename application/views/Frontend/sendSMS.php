<?php

$to = $this->input->get_post('to');
$msg = $this->input->get_post('msg');


// Authorisation details.
$username = "1stepshop.in@gmail.com";
$hash = "ee0d4f20c3e75cf251603cc2de2b756f309446f8d4d5fe6fc382aa57fc88e432";

// Config variables. Consult http://api.textlocal.in/docs for more info.
$test = "0";

// Data for text message. This is the text message data.
$sender = "TXTOSS"; // This is who the message appears to be from.
$numbers = "91".$to; // A single number or a comma-seperated list of numbers
//$message = $msg;
$message = "OTP for 1stepshop.in Forgot Password is 777";
// 612 chars or less
// A single number or a comma-seperated list of numbers
//$message = urlencode($message);
$data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
$ch = curl_init('http://api.textlocal.in/send/?');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $result = curl_exec($ch); // This is the result from the API
curl_close($ch);
?>