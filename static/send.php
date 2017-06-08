<?php
    header("Access-Control-Allow-Origin: *");

    $subject = $_GET['Title'];
    $headers = 'From: '.$_GET['From'] . "\r\n" .'X-Mailer: PHP/'. phpversion();
    $message = "{$_GET['Text']} \n";

    echo mail($_GET['Email'], $subject, $message, $headers);
?>