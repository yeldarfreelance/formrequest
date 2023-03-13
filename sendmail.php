<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Excepti
    
    require 'PHPMailer-6.8.0/src/Exception.php';
    require 'PHPMailer-6.8.0/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->Charset = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    $mail->setFrom('userinfo@guru', 'Письмо с данными');
    $mail->addAddress('eldar4592@gmail.com');
    $mail->Subject = 'Вам отправлено письмо с данными пользователя';

    $hand = 'Правая';
    if($_POST['hand'] == "left") {
        $hand = 'Левая';
    }

    $body = '<h1>Вам отправлено письмо с данными пользователя</h1>';

    if(trim(!empty($_POST['name']))){
        $body = '<p><strong>Имя*:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body = '<p><strong>E-mail*:</strong> '.$_POST['email'].'</p>';
    }
    if(trim(!empty($_POST['hand']))){
        $body = '<p><strong>Рука*:</strong> '.$_POST['hand'].'</p>';
    }
    if(trim(!empty($_POST['age']))){
        $body = '<p><strong>Возраст*:</strong> '.$_POST['age'].'</p>';
    }
    if(trim(!empty($_POST['message']))){
        $body = '<p><strong>Сообщение*:</strong> '.$_POST['message'].'</p>';
    }

    if (!empty($_FILES['image']['tmp_name'])) {
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];

        if (copy($_FILES['image']['tmp_name'], $filePath)){
            $fileAttach = $filePath;
            $body.= '<p><strong>Фото в приложении</strong></p>';
            $mail->addAttachment($fileAttach);
        }
    }


    $mail->Body = $body;

    if (!$mail->send()) {
        $message = 'Error';
    }else {
        $message = 'Done!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);





    


