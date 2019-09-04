<?php

require_once 'baglan.php';

$islemBasariliMi=false;

if (isset($_POST["ekle"]))
{
    $durakadi= $_POST["durakadi"];

    $duraksil= $db->prepare("DELETE FROM duraklar WHERE adi=?");
    $duraksil->execute(array($durakadi));

    $durakadibul= $db->prepare("SELECT * FROM duraklar  WHERE adi=?");
    $durakadibul->execute(array($durakadi));

    if ($durakadibul -> rowCount()>0) { $GLOBALS["islemBasariliMi"]=false;}
    else                            { $GLOBALS["islemBasariliMi"]=true;}
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

<form action="?page=admin_paneli&subpage=admin-durak-sil" method="post">
    <div class="giris-degerleri">
        <div class="sutun">

            <div class="giris">

                <div class="ic-giris buyuk">
                    <span class="giris-baslik">Durak Adı</span>
                    <select name="durakadi" required="" class=' giris-kutu ' >
                       <?php
                        $duraksec= $db->prepare("SELECT adi FROM duraklar");
                        $duraksec->execute();
                        while($row=$duraksec->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option><?php echo $row['adi']; ?> </option>
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