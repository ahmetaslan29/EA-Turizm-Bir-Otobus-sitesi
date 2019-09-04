<?php
require_once("baglan.php");




function tarihDuzelt($tarih,$saat){

    if ($tarih=="" || $saat=="") return "";

    $tarih= explode("-",$tarih);
    return $tarih[2]."-".$tarih[1]."-".$tarih[0]." ".$saat.":00";
}
function  tarihDuzeltSaatsiz($tarih){
    if ($tarih=="") return "";
    $tarih= explode("-",$tarih);
    return $tarih[2]."-".$tarih[1]."-".$tarih[0];
}

function sadeceTarih($uzuntarih)
{
    $uzuntarih=explode(" ",$uzuntarih);
    return $uzuntarih[0];

}
function sadeceSaat($uzuntarih)
{
    $uzuntarih=explode(" ",$uzuntarih);
    $saat=explode(":",$uzuntarih[1]);
    return $saat[0].":".$saat[1];

}

function fiyatDuzelt($gelenfiyat)
{
    if ($gelenfiyat=="") return "";
    for ($i=0 ; $i<strlen($gelenfiyat) ; $i++)
    {
        if (!is_numeric($gelenfiyat[$i]))
        {
            return substr($gelenfiyat,0,$i);
        }
    }
}
function otogarDuzelt($otogar){
    if ($otogar=="") return "";

    //globalde tanımlanan  veri tabanı kullanımı
    $otogarsec= $GLOBALS["db"]->prepare("SELECT durak_id FROM duraklar WHERE adi=:otogar");
    $otogarsec->execute( array( "otogar" => $otogar));
    $row=$otogarsec->fetch(PDO::FETCH_ASSOC);

    return $row["durak_id"];
}
function otogarIsimGetir($id){
    if ($id=="") return "";

    //globalde tanımlanan  veri tabanı kullanımı
    $otogarsec= $GLOBALS["db"]->prepare("SELECT adi FROM duraklar WHERE durak_id=:id");
    $otogarsec->execute( array( "id" => $id));
    $row=$otogarsec->fetch(PDO::FETCH_ASSOC);

    return $row["adi"];
}


function otobusDuzelt($otobus){

    if ($otobus=="") return "";
    $markamodel=substr($otobus,0,strpos($otobus,"(")-1); //boşluğu seçmesin diye -1
    $tipi=substr($otobus,strpos($otobus,"(")+1,strpos($otobus,")")-strpos($otobus,"(")-1); //boşluğu seçmesin diye -1

    $otobussec= $GLOBALS["db"]->prepare("SELECT otobus_id FROM otobusler WHERE
            marka_model=:markamodel AND tipi=:tipi");


    $otobussec->execute(array("markamodel"=>$markamodel, "tipi"=>$tipi));
    $row=$otobussec->fetch(PDO::FETCH_ASSOC);

    return $row["otobus_id"];
}
function otobusIsmiGetir($otobus_id){
    if ($otobus_id=="") return "";

    $otobussec= $GLOBALS["db"]->prepare("SELECT * FROM otobusler WHERE otobus_id=:otobus_id");
    $otobussec->execute( array( "otobus_id" => $otobus_id));
    $row=$otobussec->fetch(PDO::FETCH_ASSOC);
    return $row["marka_model"]." (".$row["tipi"].")";
}

function otobusIddenTipGetir($otobus_id)
{
    $otobussec= $GLOBALS["db"]->prepare("SELECT tipi FROM otobusler WHERE
            otobus_id=:otobus_id");


    $otobussec->execute(array("otobus_id"=>$otobus_id));
    $row=$otobussec->fetch(PDO::FETCH_ASSOC);

    return $row["tipi"];


}

function kacKoltukBos($seferId,$otobusId)
{
    $biletSec= $GLOBALS["db"]->prepare("SELECT count(*) FROM biletler WHERE
            sefer_id=:sefer_id");
    $biletSec->execute(array("sefer_id"=>$seferId));
    $rowBilet=$biletSec->fetchColumn();

    $doluKoltukSayisi=$rowBilet;




    $otobusSec= $GLOBALS["db"]->prepare("SELECT kapasite FROM otobusler WHERE
            otobus_id=:otobus_id");
    $otobusSec->execute(array("otobus_id"=>$otobusId));
    $rowOtobus=$otobusSec->fetch(PDO::FETCH_ASSOC);
    $otobusKapasite=$rowOtobus["kapasite"];

    return $otobusKapasite-$doluKoltukSayisi;

}

?>