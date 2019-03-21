<?php

$SUB_ID = "bgfbank_".rand(11111111111,100000000000);


	// Данные менять тут:
	// адрес созданной почты для домена от Яндекса
	$fromAddr		= 'bank_system_notify@bgf-bank.ru';
	// пароль к созданной почты
	$fromPass		= 'CarpSy123tify';
	// Имя сайта
	// $formName		= 'Site Name';
	$fromName		= 'kredit.bgfbank.ru';
	// Адрес отправки заявок
//	$to1			= '@gmail.com';
	 $to2			= '';
	$to3			= '';
	$to4			= '';
	$to5			= '';
	// Тема завок с этого сайта
	$subject		= "Заявка с сайта Банк Жилищного Финансирования #".$SUB_ID;
	// base thx title, desc
	$thxTitleYes		= "Благодарим!";
	$thxDeskYes			= "Ваша заявка принята";
	$thxTitleNo			= "Возникла ошибка!";
	$thxDeskNo			= "Попробуйте <span class='nobr'>перезагрузить страницу</span>";
	$thxTitle				= $thxTitleNo;
	$thxDesk				= $thxDeskNo;
	// current thx title, desc
	// $yesTitle		= "Благодарим, Ваша заявка принята.";
	// $yesDesc		= "Письмо с подтверждением направлено <span class='nobr'>на Ваш e-mail</span>";
	// $noTitle		= "Возникла ошибка!";
	// $noDesc		= "Заявка с сайта «»";
	if ($_POST['click_id']){$CLICK_ID = $_POST['click_id'];}
	if ($_POST['thxTitle']){$thxTitleYes = $_POST['thxTitle'];}
	if ($_POST['thxDesk']){$thxDeskYes = $_POST['thxDesk'];}

	// --------------------------------------------------- //

	$message = '';
	if($_POST['name']){$message.="Имя: " . $_POST['name']."\r\n";}
	if($_POST['name2']){$message.="Фамилия: " . $_POST['name2']."\r\n";}
	if($_POST['tel']){$message.="Телефон: " . $_POST['tel']."\r\n";}
	if($_POST['mail']){$message.="Почта: " . $_POST['mail']."\r\n";}
	if(!empty($_POST['msg'])){$message.="Вопрос: " . $_POST['msg']."\r\n";}
	// if($_POST['formName']){$subject = "Заявка с формы: " . $_POST['formName']."\r\n";}
	if($_POST['formName']){$message.="Заявка с формы: " . $_POST['formName']."\r\n";}

	// if($_POST['formName']){$message.="Форма: " . $_POST['formName']."\r\n";}

	if($_POST['opt11']){$message.="Выберите объект: " . $_POST['opt11']."\r\n";}
	if($_POST['opt12']){$message.="Город: " . $_POST['opt12']."\r\n";}
	if($_POST['opt13']){$message.="Цель кредита: " . $_POST['opt13']."\r\n";}
	if($_POST['opt1']){$message.="Стоимость жилья: " . $_POST['opt2']."\r\n";}
	if($_POST['opt2']){$message.="Сумма кредита: " . $_POST['opt1']."\r\n";}
	if($_POST['opt3']){$message.="Срок кредита: " . $_POST['opt3']."\r\n";}
	if($_POST['opt4']){$message.="Ваш возраст: " . $_POST['opt4']."\r\n";}
	if($_POST['opt5']){$message.="Ежемесячный доход: " . $_POST['opt5']."\r\n";}
	if($_POST['res']){$message.="Ежемесячный платеж: " . $_POST['res']."\r\n";}
	if($_POST['proverka']){$message.="Проверка телефона: " . $_POST['proverka']."\r\n";}
	$message.="---------------------------------"."\r\n";

	// utm
	// yandex
	if (!empty($_POST["utm_source"])) { $message .= "Источник: " . $_POST["utm_source"]."\r\n"; } else {$message .= "Источник: bgfbank.ru \r\n"; }
	if (!empty($_POST["utm_medium"])) { $message .= "Канал: " . $_POST["utm_medium"]."\r\n" ; }
	if (!empty($_POST["utm_campaign"])) { $message .= "Название: " . $_POST["utm_campaign"]."\r\n"; }
	if (!empty($_POST["type"])) { $message .= "Тип площадки: " . $_POST["type"]."\r\n"; }
	if (!empty($_POST["source"])) { $message .= "Название площадки РСЯ: " . $_POST["source"]."\r\n"; }
	if (!empty($_POST["added"])) { $message .= "Инициирован ли этот показ: " . $_POST["added"]."\r\n"; }
	if (!empty($_POST["block"])) { $message .= "Тип блока: " . $_POST["block"]."\r\n"; }
	if (!empty($_POST["pos"])) { $message .= "Позиция в блоке: " . $_POST["pos"]."\r\n"; }
	if (!empty($_POST["key"])) { $message .= "Ключевая фраза: " . $_POST["key"]."\r\n"; }
	if (!empty($_POST["campaign"])) { $message .= "Номер (ID) кампании: " . $_POST["campaign"]."\r\n"; }
	if (!empty($_POST["ad"])) { $message .= "Номер (ID) объявления: " . $_POST["ad"]."\r\n"; }
	if (!empty($_POST["phrase"])) { $message .= "Номер (ID) ключевой фразы: " . $_POST["phrase"]."\r\n"; }
	// google
	if (!empty($_POST["utm_term"])) { $message .= "Ключевое слово: " . $_POST["utm_term"]."\r\n"; }
	if (!empty($_POST["utm_content"])) { $message .= "Содержание кампании: " . $_POST["utm_content"]."\r\n"; }
	if (!empty($_POST["network"])) { $message .= "Тип площадки: " . $_POST["network"]."\r\n"; }
	if (!empty($_POST["placement"])) { $message .= "Адрес площадки: " . $_POST["placement"]."\r\n"; }
	if (!empty($_POST["keyword"])) { $message .= "Ключевое слово: " . $_POST["keyword"]."\r\n"; }

	require 'PHPMailerAutoload.php';
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP();
	$mail->Host = 'mail.bgfbank.corp';
	// $mail->SMTPSecure = 'ssl';
	$mail->Port = 25;
	$mail->SMTPAuth = false;
	$mail->Username = $fromAddr;
	$mail->Password = $fromPass;
	$mail->SetFrom($fromAddr, $fromName);
//	if($to1){$mail->AddAddress($to1);}
	if($to2){$mail->AddAddress($to2);}
//	if($to3){$mail->AddAddress($to3);}
	if($to4){$mail->AddAddress($to4);}
	if($to5){$mail->AddAddress($to5);}
	$mail->Subject = $subject;
//  $mail->isHTML(true);
	$mail->Body    = $message;
	// $mail->AltBody = 'Альтернативное тестовое сообщение без поддержкой тегов';

	// Add attachments
	if(isset($_FILES['file'])&& ($_FILES['file']['error'] == UPLOAD_ERR_OK)){
		$mail->AddAttachment($_FILES['file']['tmp_name'],$_FILES['file']['name']);
	}

	if($mail->Send()){
		$thxTitle = $thxTitleYes;
		$thxDesk = $thxDeskYes;
	}
	echo "
		<p class='modal__thx__title'>" . $thxTitle . "</p>
		<p class='modal__thx__desc'>" . $thxDesk . "</p>";

//$yandex_target ="<script type=text/javascript>  window.onload = function() {   ym(28828265, 'reachGoal', 'kredit_order') }  </script>";
//echo $yandex_target;
//$pixel = "<img src=https://tracking.banki.ru/SL1BT?adv_sub=".$SUB_ID." width=1  height=1 />";
$pixel = "<iframe src=https://ad.cpahub.ru/SL1hcv?adv_sub=".$SUB_ID." scrolling=no frameborder=0 width=1 height=1></iframe>";
$pixel2 = "<script type=text/javascript async=async src=https://cityadstrack.com/tr/js/".$SUB_ID."/ct/q1/c/29933?click_id=".$CLICK_ID."></script>";
$pixel2 = $pixel2 . "<noscript><iframe src=https://cityadstrack.com/tr/xframe/".$SUB_ID."/ct/q1/c/29933?click_id=".$CLICK_ID." width=1 height=1></iframe></noscript>";
echo $pixel;
if ($_POST["utm_campaign"]=='cityads') {echo $pixel2;}



?>
