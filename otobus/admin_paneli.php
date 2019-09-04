<div class="admin-container">
    <div class="admin-liste-baslik">
        <h4 class="m-0">
            <i class="fas fa-chevron-right"></i>
            <span>Yönetim Paneli</span>
        </h4>
    </div>

    <div class="ic-container">
        <div class="yonlendirici">
            <div class="kategori">
                <span class="kategori-isim "><i class="fas fa-ticket-alt"></i>Seferler</span>
                <div class="kategori-tooltip">
                    <div  class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-sefer-ekle" for="sefer-ekle"> Sefer Ekle</a></div>
                    <div class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-sefer-ara"> Sefer Ara</a></div>
                </div>
            </div>
            <div class="kategori">
                <span class="kategori-isim"><i class="fas fa-bus"></i>Otobüsler</span>
                <div class="kategori-tooltip">
                    <div class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-otobus-ekle"> Otobüs Ekle</a></div>
                    <div class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-otobus-sil"> Otobüs Sil</a></div>
                </div>
            </div>
            <div class="kategori">
                <span class="kategori-isim"><i class="fas fa-archway"></i>Duraklar</span>
                <div class="kategori-tooltip">
                    <div class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-durak-ekle"> Durak Ekle</a></div>
                    <div class="kategori-tool-item"><a href="?page=admin_paneli&subpage=admin-durak-sil"> Durak Sil</a></div>
                </div>
            </div>
            <!--<div class="kategori">
                <span class="kategori-isim"><i class="fas fa-users"></i>Üyeler</span>
                <div class="kategori-tooltip">
                    <div class="kategori-tool-item"><a href=""> Üye Güncelle</a></div>
                </div>
            </div>-->
        </div>

        <?php



        $subpage = '';
        $baslik="";
        if (isset($_GET["subpage"])) $subpage = $_GET["subpage"];

        switch ($subpage) {
            case 'admin-sefer-ekle':
            case 'admin-sefer-ara':
            case 'admin-otobus-ekle':
            case 'admin-otobus-sil':
            case 'admin-durak-ekle':
            case 'admin-durak-sil':
            case 'admin-uye-duzenle':

            case 'admin-sefer-guncelle':
                break;
            default:
                $subpage = "admin-sefer-ekle";
        }
        if($subpage==='admin-sefer-ekle')               $baslik="> Seferler > Sefer Ekle";
        else if($subpage=== 'admin-sefer-ara')      $baslik="> Seferler > Sefer Ara";
        else if($subpage=== 'admin-otobus-ekle')        $baslik="> Otobüsler > Otobüs Ekle";
        else if($subpage=== 'admin-otobus-sil')     $baslik="> Otobüsler > Otobüs Sil";
        else if($subpage=== 'admin-durak-ekle')         $baslik="> Duraklar > Durak Ekle";
        else if($subpage=== 'admin-durak-sil')      $baslik="> Duraklar > Durak Sil";
        else if($subpage=== 'admin-uye-duzenle')        $baslik="> Üyeler > Üye Ekle";

        else if($subpage=== 'admin-sefer-guncelle')        $baslik="> Seferler > Sefer Güncelle";

        ?>


        <div class="icerik">
            <div class="icerik-container">
                <div class="icerik-baslik"><span><?php echo $baslik; ?> </span></div>
                <?php
                    include($subpage.".php");
                ?>
            </div>
        </div>
    </div>

</div>

<script>
    $(".mask-fiyat").mask("999₺",{autoclear:false});

    $(".bildirim-kapat").click(function () {
        $(".bildirim").addClass("bildirim-close");
    });
</script>