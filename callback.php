<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        exit('Method not allowed');
    }

    if (isset($_SERVER['CONTENT_TYPE']) && !in_array('application/json', explode(';', $_SERVER['CONTENT_TYPE']))) {
        exit('Content-Type is not application/json');
    }

    // Enable this if you want to allow secure requests this endpoint using a query parameter
    $secure = false;
    $secureKey = getenv('EZXSS_CALLBACK_KEY') ?: 'secure_key';

    if ($secure && (!isset($_REQUEST['key']) || $_REQUEST['key'] !== $secureKey)) {
        exit('Unauthorized');
    }

    $data = json_decode(file_get_contents('php://input'), true);
    
    // Do something with the data
?>