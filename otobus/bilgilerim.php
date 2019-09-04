<?php 
require_once 'baglan.php';
    
    $tcno = $_SESSION["tc"];
    $eposta = isset($_POST["bilgilereposta"]) ? $_POST["bilgilereposta"] : "";
    $tel = isset($_POST["bilgilertel"]) ? $_POST["bilgilertel"] : "";
    $sifre = isset($_POST["bilgilersifre"]) ? $_POST["bilgilersifre"] : "";
    

    $bilgimesaji="";

    if (isset($_POST['bilgilerimbuton'])) {

          $bilgilerkontrol  = $db->prepare("UPDATE kullanici SET eposta=?, tel=?, sifre=?  WHERE tc=?");
          $bilgilerkontrol->execute(array($eposta,$tel,$sifre,$tcno));


          if ($bilgilerkontrol -> rowCount()>0) 
            {
                $_SESSION["eposta"]=$eposta;
                $_SESSION["telefon"]=$tel;
                $_SESSION["sifre"]=$sifre;
                $bilgimesaji="Bilgiler degistirildi...";   
            }
        else if ($bilgilerkontrol -> rowCount()==0) 
            {
                $bilgimesaji="Bilgiler aynı kaldı...";
            }
            else
            {
                $bilgimesaji="Bilgiler değistirelemedi...";
            }

    }


 ?>






<div id="sifreanakutu">
	<div id="kutuheader">
        <p id="headeryazı" class="headeryazılar">EA Turizm Bilgilerim</p>
        <li class="w3-ul ikon"><a href="?page=anasayfa"id="donanasayfa"class="headeryazılar"><i class="fa fa-home">Anasayfa</i></a></li>
    </div>

	<div id="arabolme"></div>

	<div class="container-fluid" id="sifreortakısım">
	
		<div class="row">
            <div class="col-md-10" style="display: ">

                <div class="birgrup">
                    <label class="yazılar" >T.C. Kimlik Numarası</label>
                    <span class="sifreyıldız">*</span>
                    <input type="text" name="bilgilerimtc" id="bilgilerimtc" class="txtbox" pattern="\d{11}"
                    value="<?php echo $_SESSION["tc"] ?>" READONLY>
                   
                </div>

                <div class="birgrup">

                    <label  class="yazılar">Adınız</label>
                    <span  class="yıldız">*</span>
                    <input  type="text" class="txtbox" name="bilgilerad" id="bilgilerad" READONLY
                    value="<?php echo $_SESSION["ad"] ?>">

                </div>

                <div class="birgrup">

                        <label  class="yazılar" >Soyadınız</label>
                        <span  class="yıldız">*</span>
                        <input  type="text" class="txtbox" name="bilgilersoyad" id="bilgilersoyad" READONLY 
                        value="<?php echo $_SESSION["soyad"] ?>">

                </div>
            </div>
        </div>

        <div class="row" id="bilgilerdoldur"  >
            <div class="col-md-10" >


            <form method="POST" onsubmit="return bsifrekontrol()">
				<div class="birgrup">
                    <label class="yazılar" for="bilgilereposta">E-Posta</label>
                    <span class="sifreyıldız">*</span>
                    <input type="email" class="txtbox" id="bilgilereposta" autocomplete="off" name="bilgilereposta"
                    value="<?php echo $_SESSION["eposta"] ?>">
                </div>

                <div class="birgrup">
                    <label class="yazılar" for="bilgilertel">Telefon</label>
                    <span class="sifreyıldız">*</span>

                    <input type="text"  pattern="{13}" placeholder="___ ___ __ __" autocomplete="off" onkeypress="return isNumberKey(event)"class="txtbox"  id="bilgilertel" name="bilgilertel"
                    value="<?php echo $_SESSION["telefon"] ?>">
                </div>
				
				<div class="birgrup">

                        <label  class="yazılar" for="bilgilersifre">Yeni Sifre</label>
                        <span  class="yıldız">*</span>
                        <input  type="password" class="txtbox"  name="bilgilersifre" id="bilgilersifre" 
                        value="<?php echo $_SESSION["sifre"] ?>">

                </div>
			
                <div class="birgrup">
                    <label class="yazılar" for="bilgilersifret">Sifre Tekrar</label>
                    <span class="yıldız">*</span>
                    <label class="uyarıyazıları" id="byazısifret" style="display: none;"for="bilgilersifret"> Şifreler uyuşmuyor...</label>
                    <input type="password" class="txtbox" id="bilgilersifret" name="bilgilersifret"
                    value="<?php echo $_SESSION["sifre"] ?>">
                </div>

               
                <div class="col-md-12">
                    <label id="bilgilerbosuyarı" class="ajaxbilgileryazılar" style="display: none;" > Boş bırakılamaz.</label>
                </div>
<?php

    if ($bilgimesaji!="") 
    {
     echo "<b><font color='#A52A2A'>$bilgimesaji</font></b><br>";
    
     echo "
        <script>

            setTimeout(function() {
                window.location.href = '?page=anasayfa'
                }, 1000)
        </script>";
    }
 ?>
                     
                	<br>
                <div >
                    <button id="butonkaydet" type="submit" name="bilgilerimbuton" class="form-control sifrebtn btn-info ">Güncelle</button> 
                </div>

            </form>

			</div>
        </div>


	</div>

</div>

<script>
    $("#bilgilertel").mask("999 999 99 99");


    function bsifrekontrol()
{   
    var eposta=$('#bilgilereposta').val();
    var tel=$('#bilgilertel').val();
    var sifre=$('#bilgilersifre').val();
    var sifret=$('#bilgilersifret').val();

     $('#byazısifret').slideUp('medium');
      $('#bilgilerbosuyarı').slideUp('medium');
    if (eposta=="" || tel=="" || sifre=="" || sifret=="") 
    {
         $('#bilgilerbosuyarı').slideDown('medium');
        
        return false;
    }
    else if (sifre!=sifret) 
    {
        $('#byazısifret').slideDown('medium');
        
        return false;
    }
    return true;
}


</script>