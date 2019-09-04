<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div id="girisyap">
                <div id="header-girisyap">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p id="Girisp">Giris Yap</p>
                </div>

                <label for="tckullanici" class="girisuyarıyazısı" id="bosuyarıyazı" style="display: none;">Lütfen boş alan bırakmayınız...</label>
                <label for="tckullanici" class="girisuyarıyazısı" id="girishatali" style="display: none;">Bilgiler Hatalı</label>

                <div id="header-bottom">

                    <p class="bottomtext">T.C. Kimlik Numarası</p>
                    <span id="girisyazı" style="display: none; float: right;"> Giriş başarılı</span>
                    <input type="text"  id="tckullanici"  name="tckullanici" pattern="\d{11}" onkeypress="return isNumberKey(event)" maxlength="11" class="giristext" >
                    <p class="bottomtext">Şifre</p>
                    <input type="password" name="sifre" id="sifre" class="giristext" id="girisbottomtext" >

                    <div >

                        <button onclick="girisYap()" id="butongiris" name="girisbuton"  class="form-control btn btn-info">Giriş Yap</button>
                    </div>

                    <div id="yadacizgi">
                        <p>----------------</p><p id="yada">YA DA</p><p >----------------</p>
                    </div>

                </div>


                <div id="model-footer content-footer" >
                    <div id="footerüyeol">
                        <a href="?page=sifreunuttum"  class="footertext"> Şifreni mi unuttun?</a>
                        Hesabın yok mu?
                        <a href="?page=uyeol"  class="footertext">Üye ol</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    function girisYap() {
        var tc = $('#tckullanici').val();
        var sifre = $('#sifre').val();
        $('#bosuyarıyazı').slideUp('medium');
        $('#girishatali').slideUp('medium');

        $.ajax({
            url: 'ajax/giris.php',
            type: 'POST',
            data: {
                tckullanici: tc,
                sifre: sifre
            },
            success: function(rsp) {
                if (rsp.trim() === 'eksik') {
                    $('#bosuyarıyazı').slideDown('medium');
                } else if (rsp.trim() === 'hatali') {
                    $('#girishatali').slideDown('medium');

                } else {
                    setTimeout(function() {
                        window.location.href = '?page=anasayfa'
                    }, 500)

                }
            }
        });
    }



</script>