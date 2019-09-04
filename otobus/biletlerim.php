

<div  class="sefer-container">


    <table class="sefer-tablo">
        <thead>
        <tr>
            <th>Bilet Numarası</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Kalkış Otogar</th>
            <th>Varış Otogar</th>
            <th>Koltuk Numarası</th>
            <th>Fiyatı</th>
            <!--<th>Düzenle</th>
            <th>Sil</th>-->
        </tr>
        </thead>


        <tbody>


        <?php

        if (isset($_SESSION["kullaniciid"])) {


            $query = "SELECT * FROM biletler WHERE kullanici_id=".$_SESSION["kullaniciid"];
            $biletsec = $db->query($query, PDO::FETCH_ASSOC);

            if ($biletsec && $biletsec->rowCount()) {

                foreach ($biletsec as $row) {

                    $querySefer = "SELECT * FROM seferler WHERE sefer_id=".$row["sefer_id"];
                    $seferSec = $db->query($querySefer );
                    $rowSefer=$seferSec->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo $row["bilet_id"]; ?></td>
                        <td><?php echo $row["ad"]; ?></td>
                        <td><?php echo $row["soyad"]; ?></td>
                        <td><?php echo otogarIsimGetir($rowSefer["kalkis_otogar"]); ?></td>
                        <td><?php echo otogarIsimGetir($rowSefer["varis_otogar"]); ?></td>
                        <td><?php echo $row["koltuk_no"]; ?></td>
                        <td><?php echo $rowSefer["fiyat"]; ?></td>
                    </tr>
                    <?php

                }
            }

        }


        ?>


        </tbody>
    </table>
</div>