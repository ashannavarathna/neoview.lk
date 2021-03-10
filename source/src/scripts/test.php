<?php

//json data set
$success = false;
$message = 'server_messages => ';



//json responce
$response = array();
$response["data"] = array("success" => $success, "message" => $message);
$json = json_encode($response, JSON_FORCE_OBJECT);
echo $json;
