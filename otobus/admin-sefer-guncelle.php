
<?php


if (isset($_POST["Git"]))
{
    echo isset($_POST["kalkis_tarihi"])?"var":"yok";

    $otobus_id       = otobusDuzelt($_POST["otobus_id"]);

    $kalkis_tarihi   = tarihDuzelt($_POST["kalkis_tarihi"] , $_POST["kalkis_saat"]);
    $varis_tarihi   = tarihDuzelt($_POST["varis_tarihi"] , $_POST["varis_saat"]);
    $kalkis_otogar   = otogarDuzelt($_POST["kalkis_otogar"]);
    $varis_otogar    = otogarDuzelt($_POST["varis_otogar"]);
    $fiyat           =fiyatDuzelt($_POST["fiyat"]) ;


    $kaydet=$db->prepare("UPDATE seferler SET 

                kalkis_tarihi=:kalkis_tarihi,
                varis_tarihi=:varis_tarihi,
                kalkis_otogar=:kalkis_otogar,
                varis_otogar=:varis_otogar,
                fiyat=:fiyat
                where otobus_id=:otobus_id
                
                ");

    $insert=$kaydet->execute(array(
        "otobus_id"     => $otobus_id    ,
        "kalkis_tarihi" => $kalkis_tarihi,
        "varis_tarihi"  => $varis_tarihi ,
        "kalkis_otogar" => $kalkis_otogar,
        "varis_otogar"  => $varis_otogar ,
        "fiyat"         => $fiyat
    ));

    if ($insert)
        $GLOBALS["islemBasariliMi"]=true;
    else $GLOBALS["islemBasariliMi"]=false;
}
else{
    $sefer_id =$_GET["sefer_id"];

    $sefer_sec= $GLOBALS["db"]->prepare("SELECT * FROM seferler WHERE sefer_id=:id");
    $sefer_sec->execute( array( "id" => $sefer_id));
    $row=$sefer_sec->fetch(PDO::FETCH_ASSOC);


    $otobus = otobusIsmiGetir($row["otobus_id"]);
    $kalkis_tarihi = $row["kalkis_tarihi"];
    $varis_tarihi = $row["varis_tarihi"];
    $kalkis_otogar =otogarIsimGetir($row["kalkis_otogar"]) ;
    $varis_otogar =otogarIsimGetir($row["varis_otogar"]) ;
    $fiyat = $row["fiyat"];


}

?>

<div class="bildirim <?php
if (isset($_POST["guncelleGit"]))
{
    if ($GLOBALS["islemBasariliMi"])
        echo "basarili";
    else echo "basarisiz";
}
else echo "bildirim-kapat";
?>">
    <span class="mesaj"> <?php echo $islemBasariliMi?"Ekleme İşlemi Başarılı":"Ekleme İşlemi Başarısız!"; ?> </span>
    <i class="bildirim-kapat fas fa-times-circle"></i>
</div>
<form action="?page=admin_paneli&subpage=admin-sefer-guncelle" method="POST">
    <div class="giris-degerleri">
        <div class="sutun">
            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Kalkış Tarihi</span>
                    <input  name="kalkis_tarihi" type='text' required="" class='datepicker-here giris-kutu' value="<?php echo $kalkis_tarihi;?>" autocomplete="off"  disabled />
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Saat</span>
                    <input name="kalkis_saat" type='time' required="" value='<?php echo sadeceSaat($kalkis_tarihi);?>'  class=' giris-kutu ' />
                </div>

            </div>
            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Varış Tarihi</span>
                    <input name="varis_tarihi" type='text' required="" value='<?php echo $varis_tarihi;?>' class=' giris-kutu datepicker-here ' disabled />
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Saat</span>
                    <input name="varis_saat" type='time' required=""  value='<?php echo sadeceSaat($varis_tarihi);?>' class=' giris-kutu mask-saat' />
                </div>
            </div>





        </div>
        <div class="sutun ">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Kalkış Otogar</span>
                    <select name="kalkis_otogar" required="" class=' giris-kutu ' disabled >
                        <option selected><?php echo $kalkis_otogar; ?></option>
                    </select>

                </div>



            </div>  <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Varış Otogar</span>
                    <select name="varis_otogar" required="" class=' giris-kutu ' disabled >
                        <option selected><?php echo $varis_otogar; ?></option>
                    </select>
                </div>




            </div>
        </div>
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Otobüs Tipi</span>
                    <select name="otobus_id" required="" class=' giris-kutu ' disabled >
                        <option selected value="<?php echo $otobus; ?>"><?php echo $otobus; ?></option>
                    </select>

                    </select>
                </div>
            </div>

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Fiyat</span>
                    <input name="fiyat" type='text' required="" class=' giris-kutu mask-fiyat' value="<?php echo $fiyat; ?>" />
                </div>
            </div>

        </div>



    </div>
    <button name="Git" type="submit"  class="btnGit">Güncelle</button>



</form>


