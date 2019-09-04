<?php 
require_once 'baglan.php';

	$sifre = isset($_POST["sifreyeni"]) ? $_POST["sifreyeni"] : "";
    $tc=$_SESSION['tc'];
    $bilgimesaji="";

    if (isset($_POST['sifrebutonyakala2'])) {

		  $mevcutkontrol=$db->query("UPDATE kullanici SET sifre='$sifre' WHERE tc='$tc'",PDO::FETCH_ASSOC);

        if ($mevcutkontrol -> rowCount()>0) 
            {
                $bilgimesaji="Sifre değiştirildi...";   
            }
        else if ($mevcutkontrol -> rowCount()==0) 
            {
                $bilgimesaji="Eski sifrenizi girdiniz.";
            }
            else
            {
                $bilgimesaji="Sifre değiştirilemedi...";
            }

    }


 ?>








<div id="sifreanakutu">
	<div id="kutuheader">
        <p id="headeryazı" class="headeryazılar">EA Turizm Sifre</p>
        <li class="w3-ul ikon"><a href="?page=anasayfa"id="donanasayfa"class="headeryazılar"><i class="fa fa-home">Anasayfa</i></a></li>
    </div>

	<div id="arabolme"></div>

	<div class="container-fluid" id="sifreortakısım">
	
	
		<div class="row">
                <div class="col-md-10" id="bilgilerdogru" style="display: ">
<?php

    if ($bilgimesaji!="") 
    {
         echo "<b><font color='#A52A2A'>$bilgimesaji</font></b>";
         echo "
        <script>

            setTimeout(function() {
                window.location.href = '?page=anasayfa'
                }, 1000)
            
        </script>

    ";

    }
 ?>
                   <div class="birgrup">
                        <label class="yazılar" for="sifretc">T.C. Kimlik Numarası</label>
                        <span class="sifreyıldız">*</span>
                        <input type="text" pattern="\d{11}"  autocomplete="off" maxlength="11" onkeypress="return isNumberKey(event)" class="txtbox" name="sifretc" id="sifretc">

                    </div>

					<div class="birgrup">
                    
                        <label class="yazılar" for="sifreeposta">E-Posta</label>
                        <span class="sifreyıldız">*</span>
                        <label class="uyarıyazıları" id="sifreyazıeposta" style="display: none;"     for="ideposta"> E-posta hatalı...</label>
                        <input type="text" class="txtbox" id="sifreeposta" autocomplete="off" name="sifreeposta">
                    </div>

                    <div class="birgrup">
                        <label class="yazılar" for="sifretel">Telefon</label>
                        <span class="sifreyıldız">*</span>

                        <input type="text"  pattern="{13}" placeholder="___ ___ __ __" autocomplete="off" onkeypress="return isNumberKey(event)"class="txtbox"  id="sifretel" name="sifretel">
                    </div>
					
					
					<div class="col-md-12">
                     	<label id="sifrebosuyarı" class="ajaxuyarıyazısı" style="display: none;" > Lütfen boş alanları doldurunuz...</label>
                     	<label id="yanlısuyarı" class="ajaxuyarıyazısı" style="display: none;" > Bilgiler hatalı...</label>
                     	<label id="bosuyarı" class="ajaxuyarıyazısı" style="display: none;" > Boş bırakılamaz.</label>
                        
                    </div>
                    <br>

					 <div >
                        <button id="butonbilgi" onclick="sifrebilgiler()" name="sifrebutonyakala" class="form-control sifrebtn btn-info ">Bilgi kontrol</button> 
                    </div>

                </div>
		</div>

		<div class="row" id="sifreacılır" style="display: none;" >
	<form method="POST"  id="sifreform" onsubmit="return sifrekontrol()">		
			<div class="col-md-10" >
				<div class="birgrup">

                        <label  class="yazılar" for="sifreyeni">Yeni Sifre</label>
                        <span  class="yıldız">*</span>
                        <input  type="password" class="txtbox" name="sifreyeni" id="sifreyeni" >

                    </div>
			
                <div class="birgrup">
                    <label class="yazılar" for="sifretekrar">Sifre Tekrar</label>
                    <span class="yıldız">*</span>
                    <label class="uyarıyazıları" id="yazısifret" style="display: none;"for="sifretekrar"> Şifreler uyuşmuyor...</label>
                    <input type="password" class="txtbox" id="sifretekrar" name="sifretekrar">
                </div>

                <div >
                	<label id="sifrebosuyarı" class="ajaxuyarıyazısı" style="display: none;" > Boş bırakılamaz.</label>
                     
                	<br>
                        <button id="butonkaydet" type="submit" name="sifrebutonyakala2" class="form-control sifrebtn btn-info ">Kaydet</button> 
                    </div>

			</div>
		</form>


		</div>
	</div>
</div>
<script >
	
	$("#sifretel").mask("999 999 99 99");

function sifrebilgiler()
{ 
		var tc = $('#sifretc').val();
        var eposta = $('#sifreeposta').val();
        var tel = $('#sifretel').val();
        document.getElementById('bosuyarı').style.display = 'none';
        document.getElementById('yanlısuyarı').style.display = 'none';

       
      
        $.ajax({
            url: 'ajax/sifreunuttum.php',
            type: 'POST',
            data: {
                sifretc: tc,
                sifreeposta: eposta,
                sifretel:tel
            },
            success: function(rsp) {
                if (rsp.trim() === 'eksik') {
                        $('#bosuyarı').slideDown('medium');

                } 
                else if (rsp.trim() === 'basarisiz') {
                        $('#yanlısuyarı').slideDown('medium');

                } 
                else {
                    document.getElementById('bilgilerdogru').style.display = 'none';
   					document.getElementById('sifreacılır').style.display = '';
                        
                }
            }
        });
}

function sifrekontrol()
{
	var sifre=$('#sifreyeni').val();
	var sifret=$('#sifretekrar').val();

	 $('#sifrebosuyarı').slideUp('medium');
 	document.getElementById('yazısifret').style.display = 'none';
	if (sifre=="" || sifret=="") 
	{
		 $('#sifrebosuyarı').slideDown('medium');
		
		return false;
	}
	else if (sifre!=sifret) 
	{
		$('#yazısifret').slideDown('medium');
		
		return false;
	}
	return true;
}

</script>