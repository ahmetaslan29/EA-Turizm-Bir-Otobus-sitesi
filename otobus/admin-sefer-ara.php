<?php
/*
$hedef="";
if (isset($_POST["guncelle"]))
    $hedef="?page=admin_paneli&subpage=admin-sefer-guncelle";
else if(isset($_POST["ara"]))
    $hedef="?page=admin_paneli&subpage=admin-sefer-ara";

echo $hedef;*/
?>
<form action="?page=admin_paneli&subpage=admin-sefer-ara" method="post">
    <div class="sefer-duzenle-container">

        <div class="sefer-arama">

            <div class="sefer-arama-container">
                <div class="sutun">

                    <div class="giris">

                        <div class="ic-giris buyuk">
                            <span class="giris-baslik">Başlangıç Tarihi</span>
                            <input name="baslangic-tarihi" autocomplete="off" type='text' class=' giris-kutu datepicker-here'
                                   data-language='en'/>
                        </div>
                    </div>

                    <div class="giris">


                        <div class="ic-giris buyuk">
                            <span class="giris-baslik">Bitiş Tarihi</span>
                            <input name="bitis-tarihi" autocomplete="off" type='text' class=' giris-kutu datepicker-here'
                                   data-language='en'/>
                        </div>

                    </div>


                </div>
                <div class="sutun ">

                    <div class="giris">

                        <div class="ic-giris buyuk">
                            <span class="giris-baslik">Kalkış Otogar</span>
                            <select name="kalkis_otogar" class=' giris-kutu '>
                                <option value="">*Tüm Otogarlarda Ara</option>
                                <?php

                                $sehirsec = $db->prepare("SELECT adi FROM duraklar");
                                $sehirsec->execute();
                                while ($row = $sehirsec->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option><?php echo $row['adi']; ?> </option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>


                    </div>
                    <div class="giris">

                        <div class="ic-giris buyuk">
                            <span class="giris-baslik">Varış Otogar</span>
                            <select name="varis_otogar" class=' giris-kutu '>
                                <option value="">*Tüm Otogarlarda Ara</option>
                                <?php
                                $sehirsec = $db->prepare("SELECT adi FROM duraklar");
                                $sehirsec->execute();
                                while ($row = $sehirsec->fetch(PDO::FETCH_ASSOC)) {
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
                            <select name="otobus_id" class=' giris-kutu '>
                                <option value="">*Tüm Otobüslerde Ara</option>
                                <?php
                                $otobussec = $db->prepare("SELECT marka_model,tipi FROM otobusler");
                                $otobussec->execute();
                                while ($row = $otobussec->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option><?php echo $row['marka_model'] . " (" . $row['tipi'] . ")"; ?> </option>
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
                            <input name="fiyat" type='text' placeholder="*Tüm Fiyatları Aramak İçin Boş Bırakınız."
                                   class=' giris-kutu mask-fiyat'/>
                        </div>
                    </div>

                </div>

            </div>
            <button type="submit" name="ara" class="btnGit">Arama Yap</button>
        </div>


        <div  class="sefer-listesi">
            <table class="sefer-tablo <?php
            if (!isset($_POST["ara"])) echo "sefer-tablo-kapali";

            ?>">
                <thead>
                <tr>
                    <th>Sefer No</th>
                    <th>Kalkış Tarihi</th>
                    <th>Varış Tarihi</th>
                    <th>Kalkış Otogar</th>
                    <th>Varış Otogar</th>
                    <th>Fiyatı</th>
                    <!--<th>Düzenle</th>
                    <th>Sil</th>-->
                </tr>
                </thead>


                <tbody>


                <?php

                if (isset($_POST["ara"])) {

                    //SQL CÜMLELERİ DÜZENLEME
                    $query = "SELECT * FROM seferler";
                    $whereCondition = "";

                    if (isset($_POST["baslangic-tarihi"]) && trim($_POST["baslangic-tarihi"])) //başlangıç tarihi dolu mu
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("DATE(kalkis_tarihi) >= '" . tarihDuzeltSaatsiz($_POST["baslangic-tarihi"])." 00:00:00'");
                    }

                    if (isset($_POST["bitis-tarihi"]) && trim($_POST["bitis-tarihi"]))
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("DATE(varis_tarihi) <= '" . tarihDuzeltSaatsiz($_POST["bitis-tarihi"])." 23:59:59'");
                    }

                    if (isset($_POST["kalkis_otogar"]) && trim($_POST["kalkis_otogar"]))
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("kalkis_otogar='" . otogarDuzelt($_POST["kalkis_otogar"]) . "'");
                    }

                    if (isset($_POST["varis_otogar"]) && trim($_POST["varis_otogar"]))
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("varis_otogar='" . otogarDuzelt($_POST["varis_otogar"])."'");
                    }

                    if (isset($_POST["otobus_id"]) && trim($_POST["otobus_id"]))
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("otobus_id='" . otobusDuzelt($_POST["otobus_id"])."'");
                    }

                    if (isset($_POST["fiyat"]) && trim($_POST["fiyat"]))
                    {
                        if ($whereCondition) $whereCondition .= " AND ";
                        $whereCondition .= ("fiyat='" . fiyatDuzelt($_POST["fiyat"]) . "'");
                    }

                    if ($whereCondition) $query .= (" WHERE " . $whereCondition);
                    $sefererisec = $db->query($query, PDO::FETCH_ASSOC);

                    //echo $query;
                    if ($sefererisec && $sefererisec->rowCount()) {

                        foreach ($sefererisec as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row["sefer_id"]; ?></td>
                                <td><?php echo $row["kalkis_tarihi"]; ?></td>
                                <td><?php echo $row["varis_tarihi"]; ?></td>
                                <td><?php echo otogarIsimGetir($row["kalkis_otogar"]); ?></td>
                                <td><?php echo otogarIsimGetir($row["varis_otogar"]); ?></td>
                                <td><?php echo $row["fiyat"]; ?>₺</td>
                              <!--  <td>
                                    <button type="button"  onclick="location.href='?page=admin_paneli&subpage=admin-sefer-guncelle&sefer_id=<?php echo $row["sefer_id"]; ?>'"
                                            class="btnGuncelle">
                                    Düzenle
                                    </button>
                                </td>
                                <td>
                                    <button type="submit" name="sil" class="btnSil">Sil</button>
                                </td>-->
                            </tr>
                            <?php

                        }
                    }

                }


                ?>


                </tbody>
            </table>
        </div>

    </div>

</form>


