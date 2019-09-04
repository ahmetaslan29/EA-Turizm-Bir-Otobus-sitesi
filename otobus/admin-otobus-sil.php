<?php

require_once 'baglan.php';

$islemBasariliMi=false;

if (isset($_POST["ekle"]))
{
    $otobusadi= $_POST["otobusadi"];
    $otobuscikis= $_POST["otobuscikis"];
    $otobustip= $_POST["otobustip"];

    $otobusbul= $db->prepare("SELECT * FROM otobusler WHERE marka_model=? and cikis_yili=? and tipi=?" );
    $otobusbul->execute(array($otobusadi,$otobuscikis,$otobustip));

    if ($otobusbul -> rowCount()>0) 
    { 	
    	$otobussil= $db->prepare("DELETE FROM otobusler WHERE marka_model=? and cikis_yili=? and tipi=?");
    	$otobussil->execute(array($otobusadi,$otobuscikis, $otobustip));

    	$otobuskontrol= $db->prepare("SELECT * FROM otobusler WHERE marka_model=? and cikis_yili=? and tipi=?" );
    	$otobuskontrol->execute(array($otobusadi,$otobuscikis,$otobustip));
    	
    	if ($otobuskontrol -> rowCount()==0) {$GLOBALS["islemBasariliMi"]=true;}
    
	}
    else
    { 
    	$GLOBALS["islemBasariliMi"]=false;
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
    <div class="mesaj"> <?php echo $islemBasariliMi?"Silme İşlemi Başarılı":"Silme İşlemi Başarısız!"; ?> </div>
    <i class="bildirim-kapat fas fa-times-circle"></i>
</div>

<form action="?page=admin_paneli&subpage=admin-otobus-sil" method="post">
    <div class="giris-degerleri">
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Otobüs Adı</span>
                    <select name="otobusadi" required="" autocomplete="off" class=' giris-kutu ' >
                       <?php
                        $otobussec= $db->prepare("SELECT marka_model FROM otobusler");
                        $otobussec->execute();
                        while($row=$otobussec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['marka_model']; ?> </option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Çıkış Yılı</span>
                    <select name="otobuscikis" required="" class=' giris-kutu '>
                       <?php
                        
                       for ($i=0; $i <10 ; $i++) { 
                            ?>
                            <option><?php echo "201$i"; ?> </option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Tipi</span>
                    <select name="otobustip" required="" class=' giris-kutu '>
                       <?php
                        
                       for ($i=1; $i <=2 ; $i++) { 
                            ?>
                            <option><?php echo "2+$i"; ?> </option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                
            </div>

        </div>
    </div>
    <button type="submit" name="ekle" class="btnGit">Sil</button>
</form>