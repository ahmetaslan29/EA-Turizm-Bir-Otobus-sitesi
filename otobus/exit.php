<?php 
session_start();
$_SESSION['giris']=false;
$_SESSION['ad']=NULL;
$_SESSION['tc']=NULL;
$_SESSION['durum']=NULL;
$_SESSION['soyad']=NULL;
$_SESSION['eposta']=NULL;
$_SESSION['telefon']=NULL;
$_SESSION['sifre']=NULL;
$_SESSION['yetki']=NULL;
$_SESSION["kalkis_otogar"]=null;
$_SESSION["varis_otogar"]=null;
$_SESSION["gidis_tarihi"]=null;
$_SESSION["donus_tarihi"]=null;
$_SESSION["gidis-donus"]=null;
$_SESSION['kullaniciid']=null;
header("location:index.php");
 ?>