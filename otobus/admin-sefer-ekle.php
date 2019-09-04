<?php






    $islemBasariliMi=false;



   if (isset($_POST["ekle"]))
    {



        $otobus_id       = otobusDuzelt($_POST["otobus_id"]);

        $kalkis_tarihi   = tarihDuzelt($_POST["kalkis_tarihi"] , $_POST["kalkis_saat"]);
        $varis_tarihi   = tarihDuzelt($_POST["varis_tarihi"] , $_POST["varis_saat"]);
        $kalkis_otogar   = otogarDuzelt($_POST["kalkis_otogar"]);
        $varis_otogar    = otogarDuzelt($_POST["varis_otogar"]);
        $fiyat           =fiyatDuzelt($_POST["fiyat"]) ;


                $kaydet=$db->prepare("INSERT INTO seferler (otobus_id,kalkis_tarihi,varis_tarihi,kalkis_otogar,varis_otogar,fiyat)
                VALUES
                (
                :otobus_id,
                :kalkis_tarihi,
                :varis_tarihi,
                :kalkis_otogar,
                :varis_otogar,
                :fiyat
                )

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
    <span class="mesaj"> <?php echo $islemBasariliMi?"Ekleme İşlemi Başarılı":"Ekleme İşlemi Başarısız!"; ?> </span>
    <i class="bildirim-kapat fas fa-times-circle"></i>
</div>

<form action="?page=admin_paneli&subpage=admin-sefer-ekle" method="post">
    <div class="giris-degerleri">
        <div class="sutun">
            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Kalkış Tarihi</span>
                    <input  name="kalkis_tarihi" type='text' required="" class=' giris-kutu datepicker-here kalkisT' autocomplete="off"   data-language='en'  />
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Saat</span>
                    <input name="kalkis_saat" type='time' required="" class=' giris-kutu ' />
                </div>

            </div>
            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Varış Tarihi</span>
                    <input name="varis_tarihi" type='text' required="" autocomplete="off" class=' giris-kutu datepicker-here varisT' data-language='en' />
                </div>

                <div class="ic-giris kucuk">
                    <span class="giris-baslik">Saat</span>
                    <input name="varis_saat" type='time' required="" class=' giris-kutu mask-saat' />
                </div>
            </div>





        </div>
        <div class="sutun ">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Kalkış Otogar</span>
                    <select name="kalkis_otogar" required="" class=' giris-kutu ' >
                        <?php
                        $sehirsec= $db->prepare("SELECT adi FROM duraklar");
                        $sehirsec->execute();
                        while($row=$sehirsec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['adi']; ?> </option>
                            <?php
                        }
                        ?>
                    </select>

                </div>



            </div>  <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Varış Otogar</span>
                    <select name="varis_otogar" required="" class=' giris-kutu ' >
                        <?php
                        $sehirsec= $db->prepare("SELECT adi FROM duraklar");
                        $sehirsec->execute();
                        while($row=$sehirsec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['adi']; ?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>




            </div>
        </div>
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Otobüs Tipi</span>
                    <select name="otobus_id" required="" autocomplete="off" class=' giris-kutu ' >
                        <?php
                        $otobussec= $db->prepare("SELECT marka_model,tipi FROM otobusler");
                        $otobussec->execute();
                        while($row=$otobussec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['marka_model']." (".$row['tipi'].")"; ?> </option>
                            <?php
                        }
                        ?>
                    </select>

                    </select>
                </div>
            </div>

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Fiyat</span>
                    <input name="fiyat" type='text' autocomplete="off" required="" class=' giris-kutu mask-fiyat' />
                </div>
            </div>

        </div>



    </div>
    <button type="submit" name="ekle" class="btnGit">Ekle</button>



</form>




