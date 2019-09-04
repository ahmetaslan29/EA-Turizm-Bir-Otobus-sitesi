<?php
    $ad = isset($_POST["ad"]) ? $_POST["ad"] : "";
    $soyad = isset($_POST["soyad"]) ? $_POST["soyad"] : "";
    $tc = isset($_POST["tc"]) ? $_POST["tc"] : "";
    $eposta = isset($_POST["eposta"]) ? $_POST["eposta"] : "";
    $sifre = isset($_POST["sifre"]) ? $_POST["sifre"] : "";
    $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
    $eskidogum = isset($_POST["dogum"]) ? $_POST["dogum"] : "";
    $cinsiyet = isset($_POST["cinsiyet"]) ? $_POST["cinsiyet"] : "0"; 
    $dogum = date("Y-m-d", strtotime($eskidogum));

    ?>


<div id="anakutu">
    <div id="kutuheader">
        <p id="headeryazı" class="headeryazılar">EA Turizm Başvuru Formu</p>
        <li class="w3-ul ikon"><a href="?page=anasayfa"id="donanasayfa"class="headeryazılar"><i class="fa fa-home">Anasayfa</i></a></li>
    </div>

    <div id="arabolme">
        
    </div>
 
    <div class="container-fluid" id="ortakısım">
        <p id="Basyazı" >Lütfen bilgileri doğru ve eksiksiz giriniz. Bilgilerin doğruluğu size ulaşabilmemiz ve indirimlerden faydalanabilmeniz için önemlidir.</p>
        <form method="POST"  id="form_id" onsubmit="return yazikontrolleri(this,'form_id','eposta')">
            <div class="row">
                <div class="col-md-6"  >
                    <div class="birgrup">

                        <label class="yazılar">Adınız</label>
                        <span class="yıldız">*</span>
                        <input type="text" class="txtbox" id="idad" name="ad" autocomplete="off" value="<?php echo $ad; ?>">

                    </div>
                    <div class="birgrup">

                        <label class="yazılar">T.C. Kimlik Numarası</label>
                        <span class="yıldız">*</span>

                         <label class="uyarıyazıları" id="yazıtc" style="display: none;"     for="idad"> Boş geçilemez...</label>
                        <input type="text" pattern="\d{11}" autocomplete="off" onkeypress="return isNumberKey(event)" maxlength="11" class="txtbox" name="tc" id="tc" value="<?php echo $tc; ?>">

                    </div>
                    <div class="birgrup">

                        <label  class="yazılar">Şifre</label>
                        <span  class="yıldız">*</span>
                        <input  type="password" class="txtbox" name="sifre" >

                    </div>
                    <div class="birgrup ">

                        <label class="yazılar">Doğum Tariniz</label>
                        <span class="yıldız">*</span>
                        <input type='text' id="datapıcker" autocomplete="off" class='txtbox datepicker-uye' data-language='tr' value="<?php echo $eskidogum; ?>"  name="dogum" READONLY />
                        <label class="calenderbox" for="datapıcker">
                            <i class="far fa-calendar "aria-hidden="true" ></i>
                        
                    </div>

                    <div class="birgrup">

                        <label class="yazılar">Cinsiyet</label>
                        <span class="yıldız">*</span><br>

                       <input id="radio-erkek" name="cinsiyet" type="radio" value="1" <?php echo $cinsiyet == "1" ? "checked" : "";?> >    
                       <label style="margin:0px; margin-left: 3px;" for="radio-erkek" >Erkek</label>

                        <input id="radio-kadın" name="cinsiyet" type="radio" value="0" <?php echo $cinsiyet == "0" ? "checked" : "";?> >
                        <label style="margin:0 40px 0 2px ;" for="radio-kadın">Kadın</label>
                    </div>
                    <br>
                    
                </div>

                <div class="col-md-6"  >
                    <div class="birgrup">
                        <label class="yazılar">Soyadınız</label>
                        <span class="yıldız">*</span>
                        <input type="text" class="txtbox" name="soyad" autocomplete="off" value="<?php echo $soyad; ?>">
                    </div>

                    <div class="birgrup">
                    
                        <label class="yazılar">E-Posta</label>
                        <span class="yıldız">*</span>
                        <label class="uyarıyazıları" id="yazıeposta" style="display: none;"     for="ideposta"> E-posta hatalı...</label>
                        <input type="text" class="txtbox" id="ideposta" autocomplete="off" name="eposta" value="<?php echo $eposta; ?>">
                    </div>
                    <div class="birgrup">
                        <label class="yazılar">Şifre tekrar</label>
                        <span class="yıldız">*</span>
                        <label class="uyarıyazıları" id="yazısifret" style="display: none;"for="idsifre"> Şifreler uyuşmuyor...</label>
                        <input type="password" class="txtbox" autocomplete="off" id="idsifre" name="sifret">
                    </div>
                    <div class="birgrup">
                        <label class="yazılar">Telefon</label>
                        <span class="yıldız">*</span>

                        <input type="text"  pattern="{13}" autocomplete="off" placeholder="___ ___ __ __" onkeypress="return isNumberKey(event)"class="txtbox" id="tel" name="tel"  value="<?php echo $tel; ?>" >
                    </div>
                    <br>
                    
                    <div class="birgrup">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" name="sözlesme">
                          <label class="form-check-label" for="inlineCheckbox1">Üyelik Sözleşmesi 'ni okudum ve kabul ediyorum. </label>

                        </div>

                    </div>
                    <br>

                    
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                     <label id="bosalanyazısı"  style="display: none;"> Lütfen boş alanları doldurunuz...</label>
                     <?php

    require_once 'baglan.php';
    if (isset($_POST['butonyakala'])) {

        $mevcutkontrol=$db->query("SELECT * FROM kullanici WHERE
            tc='$tc' or eposta='$eposta' or tel='$tel'",PDO::FETCH_ASSOC);

        if ( $say = $mevcutkontrol -> rowCount()) 
        {
            if ($say > 0)   {echo "Kayıt başarısız...Bu kayıt mevcut";}
            
            else   {echo "Bilinmeyen Hata!!! Kayıt başarısız...";}
        }
        else
        {
             $kaydet=$db->prepare("INSERT INTO kullanici SET 
                    ad=:adtakma,  soyad=:soyadtakma,
                    tc=:tctakma,  sifre=:sifretakma,
                    eposta=:epostatakma,  tel=:teltakma,
                    cinsiyet=:cinsiyettakma,  dogum=:dogumtakma,
                    yetki=0
                        ");

                $insert=$kaydet->execute(array(

                    'adtakma'=>$ad,
                    'soyadtakma'=>$soyad,
                    'tctakma'=>$tc,
                    'sifretakma'=>$sifre,
                    'epostatakma'=>$eposta,
                    'teltakma'=>$tel,
                    'cinsiyettakma'=>$cinsiyet,
                    'dogumtakma'=>$dogum));

                     echo "<font color='black'>Yeni Kayıt Eklendi...</font> <br>";

                    echo "
                        <script>

                            setTimeout(function() {
                                window.location.href = '?page=anasayfa'
                                }, 1000)
                            
                        </script>

                    ";

        }
      
    }

?>

                </div>
                <div class="col-md-6">
                    <div >
                        <button id="buton" type="submit" name="butonyakala" class="form-control btn btn-info ">Üyeliği Gerçekleştir</button> 
                    </div>
                </div>
                        
                    
            </div>

        </form>
    </div>
</div>



<script>
    $("#tel").mask("999 999 99 99");


function yazikontrolleri(frm,form_id,epostam)
{
/*tanımlamalar*/
    var ad=frm.ad.value;
    var tc=frm.tc.value
    var soyad=frm.soyad.value;
    var eposta=frm.eposta.value;
    var sifre=frm.sifre.value;
    var sifret=frm.sifret.value;
    var tel=frm.tel.value;
    var dogum=frm.dogum.value;
    var sözlesme=frm.sözlesme.checked;

/*eposta tanımlaması*/

    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; 
    var address = document.forms[form_id].elements[epostam].value;
/**/
/*genel kontrol*/
    if( tc==""|| ad=="" || soyad=="" || eposta=="" || 
        sifre=="" ||sifret==""|| tel==""|| dogum=="" || sözlesme=="")
    {
        document.getElementById('bosalanyazısı').style.display = '';
        return false;
    }
    else{    
        document.getElementById('bosalanyazısı').style.display = 'none';

        if(reg.test(address) == false) {
            document.getElementById('yazıeposta').style.display = '';} 
        else if (reg.test(address) == true) 
        {document.getElementById('yazıeposta').style.display = 'none';}

        if (sifre!=sifret) 
        {document.getElementById('yazısifret').style.display = ''; }
        else
        {document.getElementById('yazısifret').style.display = 'none';}

        if (sifre!=sifret || reg.test(address) == false) 
        { 
            return false;
        }



        return true;
        }
}



</script>
