<?php
$phone=$_POST['tel'];
$code=$_POST['code'];

if ($code=="" and $phone!='' and $_GET['km']==1){
	//отправить sms	
	//print_r($_POST);
	$code_rand = rand(1000,9999); // код 
	$a1=base64_encode($code_rand);
	$a1="wWasDW1".$a1."wedd1fc";
	$a1=base64_encode($a1);
	$a1="23ddwd".$a1."48dwdwd";
	$a1=base64_encode($a1);
	
	require_once('curl.php');

	$sURL = 'https://api.smstraffic.ru/multi.php';
	$sLogin = 'bgfbank:site';
	$sPass = 'W3KeR!JmE';

	$sPhones = $phone;
	$sPhones=str_replace("+","",$sPhones);
	$sPhones=str_replace("-","",$sPhones);
	$sPhones=str_replace(")","",$sPhones);
	$sPhones=str_replace("(","",$sPhones);
	$sPhones=str_replace(" ","",$sPhones);
	$sMessage = 'Код подтверждения: '.$code_rand;
	$sMessage = iconv("utf-8", "windows-1251", $sMessage);
	
	$sRequest = $sURL . '?login='.$sLogin.'&password='.$sPass.'&phones='.$sPhones.'&message='.$sMessage.'&rus=1';
	$curl = new c_curl();
	$curl->getContent($sRequest);
	
	
	
	setcookie("s1", $a1, time()+10000, "/"); //закодировали
	//echo $code_rand;
	
} else if ($code!="" and $phone!=''){
	
	$code1=$_POST['code'];
	
	$code2=$_COOKIE['s1'];
	$code2=base64_decode($code2);	
	$code2=str_replace("23ddwd","",$code2);
	$code2=str_replace("48dwdwd","",$code2);
	$code2=base64_decode($code2);
	$code2=str_replace("wWasDW1","",$code2);
	$code2=str_replace("wedd1fc","",$code2);
	$code2=base64_decode($code2);

		
	if ($code1==$code2){
		echo '1';
	} else {
		//echo $code2;
	}
	

}



?>