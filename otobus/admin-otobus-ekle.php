<?php

require_once("baglan.php");

$islemBasariliMi=false;


if (isset($_POST["ekle"]))
{



    $marka_model= $_POST["marka_model"];
    $cikis_yili= $_POST["cikis_yili"];
    $tipi= $_POST["tipi"];
    $kapasite= $_POST["tipi"] === "2+1" ?  37 : 50 ;


    $otobussec= $db->prepare("SELECT tipi FROM otobusler WHERE
            marka_model=:markamodel AND tipi=:tipi AND cikis_yili=:cikis_yili");


    $otobussec->execute(array("markamodel"=>$marka_model, "tipi"=>$tipi, "cikis_yili"=>$cikis_yili));
    $row=$otobussec->fetch(PDO::FETCH_ASSOC);


    //aynısı varsa ekleme yapmasın
        if ($otobussec->rowCount()!=0)
        {
          /*  echo "Bu Bilgilere Sahip Otobüs Zaten Var! Farklı Model Eklemek İstiyorsanız 'Marka/Model' Kısmını Detaylı Doldurunuz.";*/
        }
        else
        {

        $kaydet=$db->prepare("INSERT INTO otobusler (marka_model, cikis_yili, tipi, kapasite)
                    VALUES
                    (
                    :marka_model,
                    :cikis_yili,
                    :tipi,
                    :kapasite
                    )
    
                    ");

        $insert=$kaydet->execute(array(
            "marka_model" => $marka_model    ,
            "cikis_yili" => $cikis_yili,
            "tipi" => $tipi ,
            "kapasite" => $kapasite,
        ));

        if ($insert)
            $GLOBALS["islemBasariliMi"]=true;
        else $GLOBALS["islemBasariliMi"]=false;
        }
}
?>





<div class="bildirim <?php
if (isset($_POST["ekle"]))
{
    if ($GLOBALS["islemBasariliMi"])
        echo "basarili";
    else echo "basarisiz";
}
else echo "bildirim-kapat";
?>">
    <div class="mesaj"> <?php echo $islemBasariliMi?"Ekleme İşlemi Başarılı":"Ekleme İşlemi Başarısız!"; ?> </div>
    <i class="bildirim-kapat fas fa-times-circle"></i>
</div>

<form action="?page=admin_paneli&subpage=admin-otobus-ekle" method="post">
    <div class="giris-degerleri">
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Marka/Model</span>
                    <input  name="marka_model" type='text' required="" class=' giris-kutu ' />
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Çıkış Yılı</span>
                    <select name="cikis_yili" required="" class=' giris-kutu ' >
                        <?php



                        $bu_yil=date("Y");
                        for ($i=$bu_yil; $i>$bu_yil-50; $i--)
                        {
                        ?> <option> <?php echo $i;} ?> </option>


                    </select>
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Tipi</span>
                    <select name="tipi" required="" class=' giris-kutu ' >

                        <option>2+1</option>
                        <option>2+2</option>
                    </select>
                </div>


            </div>

        </div>
    </div>
    <button type="submit" name="ekle" class="btnGit">Ekle</button>



</form>




<script>
    $(document).ready(function() {


    })


</script>





