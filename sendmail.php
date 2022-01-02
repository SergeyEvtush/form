<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exeption;
require 'phpmailer/src/Exeption.php';
require 'phpmailer/src/PHPMailer.php';
$mail=new PHPMailer(true);
$mail->Charset='UTF-8';
$mail->setLanguage('ru','phpmailer/laguage/');
$mail->IsHtml(true);
$mail->setFrom ( 'evtushru208@gmail.com' , 'Автопрокат' );
$mail->setFrom ( 'evtushru2008@yandex.ru' );
$mail->Subject ='Привет автопрокат';
$hand="Правая";
if($_POST['hand']=="left"){$hand="Левая";}
$body='<h1>Встречайте супер письмо</h1>';
if(trim(!empty($_POST['name']))){
$body.='<p><stromg>Имя:</stromg>' .$_POST['name'].'</p>';
}
if(trim(!empty($_POST['email']))){
$body.='<p><stromg>E-mail:</stromg>' .$_POST['email'].'</p>';
}
if(trim(!empty($_POST['hand']))){
$body.='<p><stromg>Рука:</stromg>' .$_POST['hand'].'</p>';
}
if(trim(!empty($_POST['age']))){
$body.='<p><stromg>Возраст:</stromg>' .$_POST['age'].'</p>';
}
if(trim(!empty($_POST['message']))){
$body.='<p><stromg>Сообщение:</stromg>' .$_POST['message'].'</p>';
}
if(!empty($_FILES['image']['tmp_name'])){
$filePath=__DIR__."/files/" . $_FILES['image']['name'];
if(copy($_FILES['image']['tmp_name'],$filePath)){
	$fileAttach=$filePath;
	$body.='<p><strong>Фото в приложении</strong>';
	$mail->addAttachment($fileAttach);
	}
}

$mail->Body=$body;
if(!$mail->send()){
$message='Ошибка';

}else{
	$message='Данные отправлены';
}
$response=['message' =>$message];
header('Content-type: application/json');
echo json_encode($response);
?>