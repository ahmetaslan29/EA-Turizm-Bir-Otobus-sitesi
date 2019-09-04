<?php
require_once '../baglan.php';
if(!isset($_SESSION)) {
        session_start();
    };
    $tc = isset($_POST["sifretc"]) ? $_POST["sifretc"] : "";
    $eposta = isset($_POST["sifreeposta"]) ? $_POST["sifreeposta"] : "";
    $sifre = isset($_POST["sifreyeni"]) ? $_POST["sifreyeni"] : "";
    $tel = isset($_POST["sifretel"]) ? $_POST["sifretel"] : "";


    if (!$tc || !$eposta || !$tel) die("eksik");
       
        $sorgu  = $db->prepare("SELECT * FROM kullanici WHERE
                tc=? and eposta=? and tel=?");

        $sorgu->execute(array($tc,$eposta,$tel));
        $islem=$sorgu->fetch(); 

        
        if ($sorgu -> rowCount()>0)  
        	{$_SESSION['tc'] = $islem['tc'];
        		die("basarili");}
        
        else{die("basarisiz");}
        
      
?>