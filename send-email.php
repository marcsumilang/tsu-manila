<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();        
    }    
    $_SESSION['contact_form_status'] = false;
    include('input-filter.php');

    $_POST = purifyArray($_POST);

    $mail = array();
    $mail['to'] = $_POST['recipient'];
    $mail['subject'] = $_POST['about'].' - '.$_POST['subject'];
    $mail['message'] = $_POST['body'];
    $mail['headers'] = 'From: info@thissideupmanila.com' . "\r\n" .
    'Reply-To: '.$_POST['email']  . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($mail['to'], $mail['subject'], $mail['message'],  $mail['headers'])){
        $_SESSION['contact_form_status'] = true;
    }

    header("Location: contact-us");

    // echo json_encode($_POST);
?>