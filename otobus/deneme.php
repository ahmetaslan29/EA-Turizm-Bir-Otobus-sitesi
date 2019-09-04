<?php


if (isset($_POST["odemeYap"]))
{
    $gidisSeferID=$_POST["gidisSeferID"];
    $donusSeferID=isset($_POST["donusSeferID"])?$_POST["donusSeferID"]:"";

    $gidisSayisi=$_GET["gidisCount"];
    $donusSayisi=isset($_GET["donusCount"])?$_GET["donusCount"]:0;


/*
echo $gidisSeferID;
echo $donusSeferID;*/
$kullanıcı_id="";
if (isset($_SESSION['tc']))
{

    $kullanıcı_id=$_SESSION['kullaniciid'];
}
    for ($i=0; $i<$gidisSayisi+$donusSayisi;$i++)
    {
        $query="INSERT INTO biletler 
            (kullanici_id,ad,soyad,cinsiyet,eposta,tc,tel,sefer_id,koltuk_no,durum)
            VALUES";
        if ($i>=$gidisSayisi)
        {
            $geciciSeferID=$donusSeferID;
        }
        else{

                $geciciSeferID=$gidisSeferID;
        }

        $query.=" ( 
            '.$kullanıcı_id.'
            ,'".$_POST["adi_".$i]."'
            ,'".$_POST["soyadi_".$i]."'
            ,".($_POST["cinsiyet_".$i]=='Bay'?'1':'0')."
            ,'".$_POST["mail_".$i]."'
            ,".$_POST["tc_".$i]."
            ,'".$_POST["tel_".$i]."'
            ,".$geciciSeferID."
            ,".$_POST["koltuk_".$i]."
            ,1
        )";

        $biletEkle=$db->query($query);



?><?php
        //echo "sira=".$i."-----".$_POST["koltuk_".$i]."<br>";

    }


    if ($biletEkle)
    {echo "Ödeme Başarıyla Gerçekleşti";


        ?>

        <script>

            setTimeout(function() {
                window.location.href = '?page=anasayfa'
            }, 2000)

        </script>


        <?php
    }




}


?>