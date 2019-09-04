<form action="?page=seferler&type=gidis" method="post">


    <div id="kart">
        <div id="kart-slogan">
            <img src="img/2.png">
            <p id="kart-yazi">Online Bilet</p>
        </div>
        <div id="kart-body">
            <div class="secim">
                <div class="secilen"><input id="radio-gidis" name="gidis-donus" type="radio" value="gidis" checked ><label style="margin:0px; margin-left: 3px;" for="radio-gidis" >Gidiş</label></div>
                <div class="secilen"><input id="radio-gidis-donus" name="gidis-donus" type="radio" value="gidis-dönüs" ><label style="margin:0px;  margin-left: 3px;" for="radio-gidis-donus">Gidiş- Dönüş</label></div>
            </div>

            <div class="kart-eleman">
                <p class="bilgi-baslik">Nereden</p>
                <select name="kalkis_otogar" id="nereden" class="bilgi-yazisi">
                    <?php
                    $sehirsec = $db->prepare("SELECT * FROM duraklar");
                    $sehirsec->execute();
                    while ($row = $sehirsec->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo $row['durak_id'];   ?>"><?php echo $row['adi']; ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div id="degistir" onclick="sehirDegistir();"><i class="fas fa-exchange-alt"></i></div>
            <div class="kart-eleman">
                <p class="bilgi-baslik">Nereye</p>
                <select name="varis_otogar" id="nereye" class="bilgi-yazisi">
                    <?php

                    $sehirsec = $db->prepare("SELECT * FROM duraklar");
                    $sehirsec->execute();
                    while ($row = $sehirsec->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo $row['durak_id'];   ?>"><?php echo $row['adi']; ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div id="gidis" class="kart-eleman">
                <p class="bilgi-baslik">Gidiş Tarihi</p>
                <input name="gidis_tarihi" type='text' class='bilgi-yazisi datepicker-here' autocomplete="off"    data-language='en' required="none"/>
            </div>
            <div id="gidis-donus" class="kart-eleman" style="display:none">
                <p class="bilgi-baslik">Dönüş Tarihi</p>
                <input name="donus_tarihi" type='text' class='bilgi-yazisi datepicker-here'  autocomplete="off"  data-language='en' />
            </div>
            <div class="kart-eleman">
                <button type="submit" name="seferbul" class="form-control btn btn-info">Seferleri Ara</button>
            </div>
        </div>
    </div>
</form>

    <div id="slogan" >
        <div class="slogan-satir">
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-hourglass-start"></i>
                <p class="slogan-yazisi"> 7/24 Sınırsız Hizmet </p>
            </div>
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-lock"></i>
                <p class="slogan-yazisi"> Güvenli Ödeme </p>
            </div>
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-undo-alt"></i>
                <p class="slogan-yazisi"> İptal Edilen Otobüs Biletine Kesintisiz İade</p>
            </div>
        </div>
        <div class="slogan-satir">
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-users"></i>
                <p class="slogan-yazisi"> Ayda 8 Milyondan Fazla Ziyaretçi </p>
            </div>
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-database"></i>
                <p class="slogan-yazisi"> Komisyon Yok, Ücretsiz </p>
            </div>
            <div class ="slogan-item">
                <i class="slogan-icon fas fa-clock"></i>
                <p class="slogan-yazisi"> 2 Dakikada Biletini Al</p>
            </div>
        </div>
    </div>

<script>



</script>