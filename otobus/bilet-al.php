<?php


if (!isset($_GET["KI"])) header("Location:index.php");
$gidisDonus="gidis-donus";

if (!isset($_GET["KS"])) $gidisDonus="gidis";

$gidisSeferID=explode("_",$_GET["SI"])[1];

$donusSeferID=$gidisDonus=="gidis-donus"?explode("_",$_GET["SS"])[1]:"";


    function bilgiAyir($koltukCumlesi,$cevap){
    $koltukCumlesi=explode("|",$koltukCumlesi);
    $cinsiyet= null;
    $koltuklar=null;
    for ($i=0; $i<count($koltukCumlesi); $i++) {
        $geciciCumle=explode("-",$koltukCumlesi[$i]);
        $koltuklar[$i]=explode("_",$geciciCumle[0])[1];
        $cinsiyet[$i ]=$geciciCumle[1];
    }

    if ($cevap=="cins") return $cinsiyet;
    if ($cevap=="koltukNo") return $koltuklar;
}


$gidisCinsiyetleri=bilgiAyir($_GET["KI"],"cins");
$gidisKoltuklari=bilgiAyir($_GET["KI"],"koltukNo");
$donusCinsiyetleri=[];
$donusKoltuklari=[];
if ($gidisDonus=="gidis-donus")
{
    $donusCinsiyetleri=bilgiAyir($_GET["KS"],"cins");
    $donusKoltuklari=bilgiAyir($_GET["KS"],"koltukNo");
}


?>



<form action="?page=deneme&gidisCount=<?php echo count($gidisKoltuklari);

         echo $gidisDonus=="gidis"?"":"&donusCount=".count($donusKoltuklari); ?>"method="post">




<div class="sefer-container">

    <div class="sefer-liste-baslik">
        <h4 class="m-0">
            <i class="fas fa-chevron-right"></i>
            <span>Bilet Bilgilerini Giriniz</span>
        </h4>
    </div>
    <div class="bilet-bilgi-container">
        <div class="bilet-kutusu bilet-kutusu-baslik">
            <div class="bilet-kutusu-item bilet-kutusu-item-kucuk">
                <span>Koltuk No.</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-kucuk">
                <span>Cinsiyet</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <span>Yolcu Adı</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <span>Yolcu Soyadı</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <span>Yolcu TC Kimlik Numarası</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <span>Yolcu Telefon Numarası</span>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-buyuk">
                <span>Yolcu E-Posta Adresi</span>
            </div>
        </div>


        <?php
        $geciciKoltuk=$gidisKoltuklari;
        $geciciCins=$gidisCinsiyetleri;
        for ($i=0; $i<count($gidisKoltuklari)+count($donusKoltuklari); $i++) {

            if ($i<count($gidisKoltuklari))
            {
                $j = $i;
                $geciciKoltuk=$gidisKoltuklari;
                $geciciCins=$gidisCinsiyetleri;
            }
            else{
                $j=$i-count($gidisKoltuklari);
                $geciciKoltuk=$donusKoltuklari;
                $geciciCins=$donusCinsiyetleri;
            }


        ?>
        <div class="bilet-kutusu">
            <div class="bilet-kutusu-item bilet-kutusu-item-kucuk">
                <input name="koltuk_<?php echo $i; ?>" style="text-align: center" type='text' class=' giris-kutu ' readonly="true" value="<?php echo $geciciKoltuk[$j]; ?>"/>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-kucuk">
                <input name="cinsiyet_<?php echo $i; ?>" style="text-align: center" type='text' class=' giris-kutu ' readonly="true" value="<?php echo $geciciCins[$j]=="E"?"Bay":"Bayan"; ?>"/>
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <input name="adi_<?php echo $i; ?>" type='text' required="" class=' giris-kutu ' />
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <input name="soyadi_<?php echo $i; ?>" type='text' required="" class=' giris-kutu ' />
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <input name="tc_<?php echo $i; ?>" minlength="11" maxlength="11" required="" class=' giris-kutu ' />
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-orta">
                <input name="tel_<?php echo $i; ?>" minlength="13" maxlength="13" required="" class=' giris-kutu ' />
            </div>
            <div class="bilet-kutusu-item bilet-kutusu-item-buyuk">
                <input name="mail_<?php echo $i; ?>" type='email' required="" class=' giris-kutu ' />
            </div>
        </div>

        <?php
            if ($gidisDonus=="gidis-donus" &&$i==count($gidisKoltuklari)-1)
            {
        ?>
                <div class="bilet-donus-yazi">
                    <span>Dönüş Seferleri İçin Bilgiler </span>
                </div>

        <?php
            }

        }

        ?>


    </div>

    <div class="bilet-fiyat-bilgi">
        <span> </span>
    </div>

    <div style="display: none">
       <input name="gidisSeferID" value="<?php echo $gidisSeferID; ?>"/>
        <input name="donusSeferID" value="<?php echo $gidisDonus=="gidis-donus"?$donusSeferID:""; ?>"/>
    </div>


        <button type="submit" name="odemeYap" class="bilet-odeme-yap">
            <span>Ödeme Yap</span>
        </button>
</div>
</form>


<script>
    $("#tel").mask("999 999 99 99");
</script>