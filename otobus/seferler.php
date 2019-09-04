<?php

if (!isset($_POST["seferbul"]))
{
header("Location: index.php");

}
else
{


    $kalkis_otogar="";
    $varis_otogar="";
    $gidis_tarihi="";
    $type=isset($_GET["type"])?($_GET["type"]=="gidis"?"gidis":"donus"):"deger gelmedi";

    $gidisDonus="gidis";
    if ($_POST["gidis-donus"]=="gidis-dönüs") $gidisDonus="gidis-donus";
    else $gidisDonus="gidis";


    if (isset($_GET["type"]))
    {
        if($_GET["type"]=="gidis"){


            $kalkis_otogar=$_POST["kalkis_otogar"];
            $varis_otogar= $_POST["varis_otogar"];
            $gidis_tarihi=tarihDuzelt($_POST["gidis_tarihi"],"00:00");
        }
        else{

            $kalkis_otogar=$_POST["varis_otogar"];
            $varis_otogar=$_POST["kalkis_otogar"];
            $gidis_tarihi=tarihDuzelt($_POST["donus_tarihi"],"00:00");


            }
        }

    }










?>

<div class="sefer-container" >
        <div class="sefer-liste-baslik">

                <!--<i class="fas fa-chevron-right"></i>-->
            <div class="sefer-liste-baslik-satir">
                <span><?php echo otogarIsimGetir($kalkis_otogar)."  "?><i class="fas fa-chevron-right"></i><?php echo "  ".otogarIsimGetir($varis_otogar);?></span>
            </div>
            <div class="sefer-liste-baslik-satir">
                <span><i class="fas fa-chevron-left"></i><?php echo $_POST["gidis_tarihi"]; ?><i class="fas fa-chevron-right"></i></span>
            </div>

        </div>
<form action="" method="post">



        <ul class="seferler">

            <?php
            $query = "SELECT * FROM seferler ";
            $whereCondition = "WHERE ";

            $whereCondition.="kalkis_otogar='".$kalkis_otogar."'";
                $whereCondition.=" AND ";
            $whereCondition.="varis_otogar='".$varis_otogar."'";
                $whereCondition.=" AND ";
            $whereCondition.="DATE(kalkis_tarihi)>='".$gidis_tarihi." 00:00:00'";


            $whereCondition.=" AND ";
            $whereCondition.="DATE(kalkis_tarihi)<='".$gidis_tarihi." 23:59:59'";


            $query.=$whereCondition;
            /*echo $query;*/

            $seferlerisec=$db->query($query,PDO::FETCH_ASSOC);

            if ($seferlerisec->rowCount()!=0)
            {
            ?>


                    <!-- SCRİPTTE BİR DİZİİ OLUŞTURDUK VE BU DİZİNİN İÇİNE TÜM SEFERLERİN DOLU KOLTUKLARI AKTARILCAK.
                    JQUERY İLE BUNLAR DOLU GÖSTERİLCEK  !-->
                     <script> var koltukBilgileri=[]; </script>


            <?php
            $forSayac=1;
            foreach ($seferlerisec as $row)
                {
                $queryBilet = "SELECT koltuk_no,cinsiyet FROM biletler ";
                $whereConditionBilet = "WHERE ";
                $whereConditionBilet.=" sefer_id=".$row["sefer_id"];
                $queryBilet.=$whereConditionBilet;
                $doluKoltukSec=$db->query($queryBilet,PDO::FETCH_ASSOC);
                //echo $queryBilet;
            ?>

                <script>

                    koltukBilgileri.push(
                        <?php

                            $cumle="s_".$row["sefer_id"]."|";
                        foreach ($doluKoltukSec as $satirlar) {

                            $cumle.=$satirlar["koltuk_no"].",".$satirlar["cinsiyet"].":";

                        }
                        echo "'".$cumle."'";


                        ?>);
                </script>

                <li id="s_<?php echo $row["sefer_id"];?>" class="sefer ">
                    <ul class="sefer-items">

                        <li style="flex: 2;"class=" sefer-item-info flex-column">
                            <span>Otobüs Tipi</span>
                            <span class="sefer-vurgu">
                                <?php
                                $tip=otobusIddenTipGetir( $row["otobus_id"]);
                                echo $tip;
                               /* if($tip==="2+1") echo $tip." Suit";
                                else echo $tip." Class";*/

                                ?>

                            </span>
                        </li>

                        <li style="flex: 3;" class="sefer-item-info flex-column"> <!--flex column kodu(bootstrap) display flex iken alt satılara geçmemizi sağlıyor-->
                            <span>Kalkış Saati</span>
                            <span class="sefer-vurgu"><i class="sefer-saati fas fa-clock"></i><?php echo sadeceSaat($row["kalkis_tarihi"]);?></span>
                        </li>

                        <li style="flex: 3;" class="sefer-item-info flex-column"> <!--flex column kodu(bootstrap) display flex iken alt satılara geçmemizi sağlıyor-->
                            <span>Varış Saati</span>
                            <span class="sefer-vurgu"><i class="sefer-saati fas fa-clock"></i><?php echo sadeceSaat($row["varis_tarihi"]);?></span>
                        </li>

                        <li style="flex: 2;"class="sefer-item-info flex-column">
                            <span>Boş Koltuk</span>
                            <span><i style="margin-right: 5px;" class="fas fa-couch"></i><?php echo kacKoltukBos($row["sefer_id"],$row["otobus_id"]);?></span>

                        </li>

                        <li style="flex: 2;" class="sefer-item-info flex-column"> <!--flex column kodu(bootstrap) display flex iken alt satılara geçmemizi sağlıyor-->
                            <span>Fiyat</span>
                            <span class="sefer-vurgu"><?php echo $row["fiyat"];?><i  style="margin-left: 3px" class="fas fa-lira-sign"></i></span>
                        </li>

                        <li style="flex: 4;"class="sefer-item-info">
                            <div class="sefer-sec">
                                <span>Koltuk Seç</span>
                            </div>
                        </li>
                    </ul>
                    <hr/>

                    <?php
                    if (otobusIddenTipGetir( $row["otobus_id"])=="2+1"){?>
                        <div class="koltuk-sec koltuk-sec-kapali">
                            <div class="otobus">
                                <div class="sira">

                                    <div class="bosluk"></div>

                                    <div id="k_3" class="koltuk"><span class="k-no">3</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_6" class="koltuk"><span class="k-no">6</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_9" class="koltuk"><span class="k-no">9</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div id="k_12" class="koltuk"><span class="k-no">12</span>

                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>

                                    </div>


                                    <div id="k_15" class="koltuk"><span class="k-no">15</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_18" class="koltuk"><span class="k-no">18</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_21" class="koltuk"><span class="k-no">21</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="bosluk"></div>

                                    <div id="k_25" class="koltuk"><span class="k-no">25</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_28" class="koltuk"><span class="k-no">28</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_31" class="koltuk"><span class="k-no">31</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_34" class="koltuk"><span class="k-no">34</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_37" class="koltuk"><span class="k-no">37</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="sira">

                                    <div class="bosluk"></div>

                                    <div id="k_2" class="koltuk"><span class="k-no">2</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_5" class="koltuk"><span class="k-no">5</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_8" class="koltuk"><span class="k-no">8</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_11" class="koltuk"><span class="k-no">11</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_14" class="koltuk"><span class="k-no">14</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_17" class="koltuk"><span class="k-no">17</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_20" class="koltuk"><span class="k-no">20</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="bosluk"></div>

                                    <div id="k_24" class="koltuk"><span class="k-no">24</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_27" class="koltuk"><span class="k-no">27</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_30" class="koltuk"><span class="k-no">30</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_33" class="koltuk"><span class="k-no">33</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_36" class="koltuk"><span class="k-no">36</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="sira koridor">
                                    <div class="koridor-yazi">
                                        Koridor
                                    </div>
                                </div>

                                <div class="sira">

                                    <div class="bosluk sofor"></div>

                                    <div id="k_1" class="koltuk"><span class="k-no">1</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_4" class="koltuk"><span class="k-no">4</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_7" class="koltuk"><span class="k-no">7</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_10" class="koltuk"><span class="k-no">10</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_13" class="koltuk"><span class="k-no">13</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_16" class="koltuk"><span class="k-no">16</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_19" class="koltuk"><span class="k-no">19</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_22" class="koltuk"><span class="k-no">22</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_23" class="koltuk"><span class="k-no">23</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_26" class="koltuk"><span class="k-no">26</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_29" class="koltuk"><span class="k-no">29</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_32" class="koltuk"><span class="k-no">32</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_35" class="koltuk"><span class="k-no">35</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            </div>
                            <div class="koltuk-bilgileri">
                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #0984E3"><span>Bay</span></div>
                                </div>
                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #FD79A8"><span>Bayan</span></div>
                                </div>

                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #15cda8"><span>Seçili</span></div>
                                </div>

                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: whitesmoke"><span>Boş</span></div>
                                </div>



                                <div style="display:none;">
                                    <input name="gidis-donus" value="<?php   echo $_POST["gidis-donus"]; ?>"></input>
                                    <input name="kalkis_otogar" value="<?php echo $_POST["kalkis_otogar"]; ?>"></input>
                                    <input name="varis_otogar" value="<?php  echo $_POST["varis_otogar"]; ?>"></input>
                                    <input name="gidis_tarihi" value="<?php  echo $_POST["gidis_tarihi"];?>"></input>
                                    <input name="donus_tarihi" value="<?php  echo $_POST["donus_tarihi"];?>"></input>
                                </div>

                                <button type="submit" name="seferbul" class="btnDevam">
                                    <span>Devam Et</span>
                                </button>
                            </div>
                        </div>
                    <?php }
                    else{?>
                        <div class="koltuk-sec koltuk-sec-kapali">
                            <div class="otobus">
                                <div class="sira2">

                                    <div class="bosluk"></div>

                                    <div id="k_4" class="koltuk "><span class="k-no">4</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_8" class="koltuk "><span class="k-no">8</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_12" class="koltuk"><span class="k-no">12</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div id="k_16" class="koltuk"><span class="k-no">16</span>

                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>

                                    </div>


                                    <div id="k_20" class="koltuk"><span class="k-no">20</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_24" class="koltuk "><span class="k-no">24</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_28" class="koltuk"><span class="k-no">28</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="bosluk"></div>

                                    <div id="k_34" class="koltuk"><span class="k-no">34</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_38" class="koltuk"><span class="k-no">38</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_42" class="koltuk"><span class="k-no">42</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_46" class="koltuk"><span class="k-no">46</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_50" class="koltuk"><span class="k-no">50</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="sira2">

                                    <div class="bosluk"></div>

                                    <div id="k_3" class="koltuk"><span class="k-no">3</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_7" class="koltuk"><span class="k-no">7</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_11" class="koltuk"><span class="k-no">11</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_15" class="koltuk"><span class="k-no">15</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_19" class="koltuk"><span class="k-no">19</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_23" class="koltuk"><span class="k-no">23</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_27" class="koltuk"><span class="k-no">27</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="bosluk"></div>

                                    <div id="k_33" class="koltuk"><span class="k-no">33</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_37" class="koltuk"><span class="k-no">37</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_41" class="koltuk"><span class="k-no">41</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_45" class="koltuk"><span class="k-no">45</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_49" class="koltuk"><span class="k-no">49</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="sira2 koridor">
                                    <div class="koridor-yazi">
                                        Koridor
                                    </div>
                                </div>
                                <div class="sira2">

                                    <div class="bosluk"></div>

                                    <div id="k_2" class="koltuk"><span class="k-no">2</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_6" class="koltuk"><span class="k-no">6</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_10" class="koltuk"><span class="k-no">10</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_14" class="koltuk"><span class="k-no">14</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_18" class="koltuk"><span class="k-no">18</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_22" class="koltuk"><span class="k-no">22</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_26" class="koltuk"><span class="k-no">26</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_30" class="koltuk"><span class="k-no">30</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_32" class="koltuk"><span class="k-no">32</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_36" class="koltuk"><span class="k-no">36</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_40" class="koltuk"><span class="k-no">40</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_44" class="koltuk"><span class="k-no">44</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_48" class="koltuk"><span class="k-no">48</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="sira2">

                                    <div class="bosluk sofor"></div>

                                    <div id="k_1" class="koltuk"><span class="k-no">1</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_5" class="koltuk"><span class="k-no">5</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_9" class="koltuk"><span class="k-no">9</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_13" class="koltuk"><span class="k-no">13</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_17" class="koltuk"><span class="k-no">17</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_21" class="koltuk"><span class="k-no">21</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_25" class="koltuk"><span class="k-no">25</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_29" class="koltuk"><span class="k-no">29</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_31" class="koltuk"><span class="k-no">31</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_35" class="koltuk"><span class="k-no">35</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_39" class="koltuk"><span class="k-no">39</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_43" class="koltuk"><span class="k-no">43</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="k_47" class="koltuk"><span class="k-no">47</span>
                                        <div class="cins-tooltip cins-tooltip-closed">
                                            <div class="tool toolErkek">
                                                <div class="tool-erkek-renk"></div>
                                                <i class="fas fa-male"></i>
                                                <span>Bay</span>
                                            </div>
                                            <div class="tool toolKadin">
                                                <div class="tool-kadın-renk"></div>
                                                <i class="fas fa-female"></i>
                                                <span>Bayan</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="koltuk-bilgileri">
                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #0984E3"><span>Bay</span></div>
                                </div>
                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #FD79A8"><span>Bayan</span></div>
                                </div>

                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: #15cda8"><span>Seçili</span></div>
                                </div>

                                <div class="koltuk-bilgi">
                                    <div class="renk-kutusu" style="background-color: whitesmoke"><span>Boş</span></div>
                                </div>

                                <button type="submit" name="seferbul" class="btnDevam">
                                    <span>Devam Et</span>
                                </button>
                            </div>
                        </div>
                    <?php }?>

                </li>

            <?php

                    $forSayac++;
                }
            }
            else{
                echo "Sefer Bulunamamktadır...!";
            }
            ?>


        </ul>
</form>
</div>

<script>

    var SecilenSeferID=null;
    var SecilenKoltuklar=[];
    var gidisDonus="<?php echo $gidisDonus; ?>";
    var type=   "<?php echo $type; ?>";
    console.log(gidisDonus);


    var CUMLE="?page=";
    function gidecekCumleBelirle() {
        if (gidisDonus=="gidis-donus")
        {
            if (type=="gidis")
                $("form").attr("action","?page=seferler&type=donus"+getCumlesiDegistir("&KI=","&SI="));

            if (type=="donus")
                $("form").attr("action","?page=bilet-al"<?php

                    if (isset($_GET["KI"]) && isset($_GET["SI"]) )
                    {
                        echo "+'&KI=".$_GET["KI"]."&SI=".$_GET["SI"]."'";

                    }



                 ?>+getCumlesiDegistir("&KS=","&SS="));

        }
        else
        {
            $("form").attr("action","?page=bilet-al&"+getCumlesiDegistir("&KI=","&SI="));
        }
    }


    function getCumlesiDegistir($koltuk,$sefer){

        var KoltukIcinDeger=$koltuk;
        var SeferIcinDeger=$sefer;



        var gidenKoltuklar=KoltukIcinDeger;


        if(SecilenKoltuklar.length>0)
        {
            for ($i=0 ; $i<SecilenKoltuklar.length; $i++)
            {
                if ($i!=SecilenKoltuklar.length-1)
                gidenKoltuklar+=SecilenKoltuklar[$i]+"|";
                else
                gidenKoltuklar+=SecilenKoltuklar[$i];
            }
            gidenKoltuklar+=SeferIcinDeger+SecilenSeferID+" ";




            /*
            console.log($(".btnDevam"));
            $("#"+SecilenSeferID).find(".btnDevam").attr("onclick",gidecekcumle);
            */
            //$("form").attr("action",gidenKoltuklar);
            return gidenKoltuklar;
        }
        else{
            return "#";
        }
    }




    /*koltuk secme bölümü açma animasyonu için*/
    $sefer=$('.koltuk-sec');
    $btnSec=$('.sefer-sec');
    $koltuklar=$('.koltuk');
    $seciliKoltuk=null;
    $seciliKoltukID=null;

    $toolAcikSecilmedi=false;
    $btnSec.click(function () {


        $anlikID=$(this).parents(".sefer").attr("id");
        console.log($anlikID);
        SecilenKoltuklar=[];
        $(".koltuk").removeClass("secili");

        if($("#"+$anlikID).children(".koltuk-sec").hasClass("koltuk-sec-kapali"))
        {
            seferleriKapat();
            $("#"+$anlikID).children(".koltuk-sec").removeClass("koltuk-sec-kapali");
            SecilenSeferID=$anlikID;
        }
        else
        {
            $("#"+$anlikID).children(".koltuk-sec").addClass("koltuk-sec-kapali");
        }

    })

    function seferleriKapat() {

        $(".koltuk-sec").addClass("koltuk-sec-kapali");
    }


/*   $(".sefer-sec").click(function () {
       alert("girdi");
        $(this).parent(".sefer").css("backgroun-color:black;")
       console.log($(this).parent(".sefer").css("backgroun-color:black"));
    })*/

    $koltuklar.click(function () {


        if ($toolAcikSecilmedi)
        {
            secimIptal(($seciliKoltuk));
            return;
        }

        if ($(this).hasClass('secili')){
            hafizadanSil($(this))
            secimIptal($(this));

        }
        else{
            secimYap($(this));
        }



    })

    function secimIptal($gelenKoltuk) {
        $seciliKoltuk=null;
        $seciliKoltukID=null; //secilen tooltip yok
        $gelenKoltuk.children(".cins-tooltip").addClass("cins-tooltip-closed"); // secilen koltuğun tooltipini kapat
        $gelenKoltuk.removeClass("secili");
        $toolAcikSecilmedi=false;
    }
    function secimYap($gelenKoltuk) {
        $seciliKoltuk=$gelenKoltuk;
        $seciliKoltukID=$gelenKoltuk.attr('id');
        $gelenKoltuk.children(".cins-tooltip").removeClass("cins-tooltip-closed"); // secilen koltuğun tooltipini aç
        $gelenKoltuk.addClass("secili");
        $toolAcikSecilmedi=true;
    }


    //tool da erkek veya kadın seçimini yapar. hafızada tutar.
    $(".tool").click(function (e) {
        e.stopPropagation();//ÖNEMLİ--- KOLTUK TIKLAMASI ALGILANMASIN DİYE


        if ($(this).hasClass("toolErkek"))
            SecilenKoltuklar.push($seciliKoltukID+"-E");
        else
            SecilenKoltuklar.push($seciliKoltukID+"-K");

        $gecici=$seciliKoltuk;
        secimIptal($seciliKoltuk);//Seçim yapıldığı için tooltipi kapatır
        $gecici.addClass("secili");
        gidecekCumleBelirle();
    })

    function hafizadanSil($gelenKoltuk){
        for ($i=0 ; $i<SecilenKoltuklar.length ; $i++)
        {
            console.log(SecilenKoltuklar[$i]+"------"+$gelenKoltuk.attr('id'));
            if (SecilenKoltuklar[$i].substr(0,SecilenKoltuklar[$i].indexOf('-'))==$gelenKoltuk.attr('id'))
            {

                SecilenKoltuklar.splice($i,1);
            }
        }
        gidecekCumleBelirle();
    }

    //tooltip açıkken başka yere tıklandığında tooltipi kapatır
    $('*').click(function (e) {
        if ($seciliKoltukID!==null)
            if (!$(e.target).is('.koltuk *')) {
                hafizadanSil();
                secimIptal($seciliKoltuk);

            }
    })




/*
    $(document).ready(function () {
        window.localStorage.setItem('secilen_koltuklar', JSON.stringify(['k_1-E']))

        // var a = window.localStorage.getItem('')
        // try {
        //     a = JSON.parse(a)
        // }catch (e) {
        //
        // }
    })*/

    /*DOLU KOLTUKLARI DOLU GÖSTERME*/



    function koltukDoldur($seferID,$koltuk, $cinsiyet) {
        if ($cinsiyet==1)
        {
            $cinsiyet="erkek";
        }
        else $cinsiyet="kadin"

        $("#"+$seferID).find("#k_"+$koltuk).addClass($cinsiyet);

    }



    for ($i=0; $i<koltukBilgileri.length ; $i++)
    {

        $seferID=koltukBilgileri[$i].substr(0,koltukBilgileri[$i].indexOf("|"));
        koltukBilgileri[$i]=koltukBilgileri[$i].substr(koltukBilgileri[$i].indexOf("|")+1); // | işaretini siliyor sade koltuk ve cinsiyetler kalıyor
        
        if (koltukBilgileri[$i].indexOf(':')==-1)  continue; //dolu koltuk yoksa atla
        else{
            koltukBilgileri[$i]=koltukBilgileri[$i].substr(0,koltukBilgileri[$i].length-1); //sondaki : yı sil
        }


        $koltukVeCinsler=koltukBilgileri[$i].split(":");

        for ($j=0; $j<$koltukVeCinsler.length; $j++)
        {

            $koltuk=$koltukVeCinsler[$j].split(",")[0];

            $cins=$koltukVeCinsler[$j].split(",")[1];
            //console.log($seferID+$koltuk+$cins);
            console.log($seferID+"--"+$koltuk+"---"+$cins);
            koltukDoldur($seferID,$koltuk,$cins);
        }

    }

</script>
