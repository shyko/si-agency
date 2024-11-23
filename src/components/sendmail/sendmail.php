<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);


	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'shyko2004@gmail.com';                     //SMTP username
	$mail->Password   = 'zcpz szfa zdou vzvc';                               //SMTP password
	$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
	$mail->Port       = 587;                 


	//Від кого лист
	$mail->setFrom('shyko2004@gmail.com', 'SI-AGENCY - Запис на консультацію'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('nick.shyshkin@zanzarra.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Запис на консультацію';

	//Тіло листа
	$body = '<h1>Запис на консультацію</h1>';

	if(trim(!empty($_POST['name']))){
		$body.=$_POST['name'];
	}
	if(trim(!empty($_POST['phone']))){
		$body.=$_POST['phone'];
	}		
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>