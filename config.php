<?php

// start Facebook PHP SDK

require_once 'vendor/autoload.php';

if(!session_id())
{
    session_start();
}

$facebook = new \Facebook\Facebook([
    'app_id'                => '870470873434632',
    'app_secret'            => '4fc87c954a92c47918753618415e7462',
    'default_graph_version' => 'v6.0'
]);

$facebook_helper = $facebook->getRedirectLoginHelper();

// End Facebook PHP SDK

// Start Discord Login Cord Started

$dc_client_id ="691610557156950030";
$dc_client_secret = "SLSM2j6cpc5PkDYUuzsExZD4BCbX-pNv";

// End Discord Login Cord Started
?>