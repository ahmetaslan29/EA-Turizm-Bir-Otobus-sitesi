<?php

require_once 'baglan.php';

$islemBasariliMi=false;

if (isset($_POST["ekle"]))
{
    $sehiradi= $_POST["sehiradi"];
    $durakadi= $_POST["durakadi"];

     $durakkontrol= $db->prepare("SELECT * FROM duraklar WHERE
     adi=:durakadtakma AND sehir_id=(SELECT sehir_id FROM sehirler WHERE adi=:sehiradtakma)");
    
    $durakkontrol->execute(array("durakadtakma"=>$durakadi,"sehiradtakma"=>$sehiradi));

     if ($durakkontrol -> rowCount()>0) 
        {
    
        }
    else
    {   
        $sehir_idbul= $db->prepare("SELECT * FROM sehirler  WHERE adi=?");
        $sehir_idbul->execute(array($sehiradi));
        $islem=$sehir_idbul->fetch();
        $sehir_id=$islem['sehir_id'];
        
        $durakkaydet=$db->prepare("INSERT INTO duraklar SET 
                    sehir_id=:sehirtakma,  adi=:adtakma
                        ");
                $insert=$durakkaydet->execute(array( 
                    'sehirtakma'=>$sehir_id,
                    'adtakma'=>$durakadi));

                if ($insert)
                $GLOBALS["islemBasariliMi"]=true;
                else $GLOBALS["islemBasariliMi"]=false;
                
    }
}

?>

<div class="bildirim 
    <?php
    if (isset($_POST["ekle"]))
    {
        if ($GLOBALS["islemBasariliMi"])
            echo "basarili";
        else echo "basarisiz";
    }
    else echo "bildirim-kapat";
    ?>"
>
    <div class="mesaj"> <?php echo $islemBasariliMi?"Ekleme İşlemi Başarılı":"Ekleme İşlemi Başarısız!"; ?> </div>
    <i class="bildirim-kapat fas fa-times-circle"></i>
</div>


<form action="?page=admin_paneli&subpage=admin-durak-ekle" method="post">
    <div class="giris-degerleri">
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Şehir Adı</span>
                    <select name="sehiradi" required="" autocomplete="off" class=' giris-kutu ' >
                       <?php
                        $sehirsec= $db->prepare("SELECT adi FROM sehirler");
                        $sehirsec->execute();
                        while($row=$sehirsec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['adi']; ?> </option>
                            <?php
                        }
                        ?>


                    </select>
                </div>
                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Durak Adı</span>
                    <input  name="durakadi" type='text' required="" class='giris-kutu' />
                    
                </div>

            </div>

        </div>
    </div>
    <button type="submit" name="ekle" class="btnGit">Ekle</button>
</form>