<?php
	if(!isset($_SESSION)) {
	    session_start();
	};

 	require_once '../baglan.php';

    $tckullanici = isset($_POST["tckullanici"]) ? $_POST["tckullanici"] : "";
    $sifre = isset($_POST["sifre"]) ? $_POST["sifre"] : "";

    if (!$tckullanici || !$sifre) die("eksik");


    $sorgu  = $db->prepare("SELECT * FROM kullanici  WHERE tc=? && sifre=?");
    $sorgu->execute(array($tckullanici,$sifre));
    $islem=$sorgu->fetch();    

    if ($sorgu -> rowCount() > 0) {


        $_SESSION['kullaniciid'] =$islem['kullanici_id'];
        $_SESSION['giris'] = true;
        $_SESSION['ad'] = $islem['ad'];
        $_SESSION['tc'] = $islem['tc'];
        $_SESSION['soyad'] = $islem['soyad'];
        $_SESSION['eposta'] = $islem['eposta'];
        $_SESSION['telefon'] = $islem['tel'];
        $_SESSION['sifre'] = $islem['sifre'];
        $_SESSION['yetki'] = $islem['yetki'];
       
        

    } else {
    	die("hatali");
    }


    die("basarili");
    

?>