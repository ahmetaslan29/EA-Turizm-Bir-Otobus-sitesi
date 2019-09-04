
<div id="navbar">
    <div id="nav-container" class="container">
        <div id="logo-kutusu">
        <a href="index.php">
            <img id="logo" src="img/logo-ufak.png">
            <p id="title">EA Turizm</p>
        </a>
        </div>
        <div id="menu" class="menu">
            <div class="menu-icon">
                <a href="javascript:void(0);"> <i class="fas fa-bars"></i></a>
            </div>

            <ul>
                <li id="navbarhosgeldin" style="display:none; color:white; "><a href="?page=bilgilerim">  Hoşgeldin <?php echo $_SESSION['ad']?></a></li>

                <li id="biletnavbar" style="display: none "><a href="?page=biletlerim"  > <i class="fas fa-recycle"> </i>Biletlerim </a> </li>

                <li id="uyenavbar" ><a href="?page=uyeol"  > <i class="fas fa-user-plus">  </i>Üye Ol </a> </li>

                <li id="girisnavbar"><a href=""    data-toggle='modal' data-target='#exampleModalCenter'> <i class="fas fa-user"> </i> Giriş Yap </a> </li>

                <li  id="cikisyapnavbar" style="display=none;" ><a href="exit.php" > <i class="fa fa-sign-out"> </i>Çıkış Yap</a> </li>
                <?php
                if (isset($_SESSION["giris"])) {
                    if ($_SESSION['giris']!=false) {


                        if ($_SESSION['yetki']==1)
                        {
                            echo "<script> document.getElementById('uyenavbar').style.display = 'none'; </script> ";
                            echo "<script> document.getElementById('girisnavbar').style.display = 'none'; </script> ";
                            echo "<script> document.getElementById('biletnavbar').style.display = 'none'; </script> ";
                            echo "<script> document.getElementById('cikisyapnavbar').style.display = ''; </script> ";
                            echo "<script> document.getElementById('navbarhosgeldin').style.display = ''; </script> ";


                        }
                        else if ($_SESSION['yetki']==0)
                        {
                            echo "<script> document.getElementById('uyenavbar').style.display = 'none'; </script> ";
                            echo "<script> document.getElementById('girisnavbar').style.display = 'none'; </script> ";
                            echo "<script> document.getElementById('cikisyapnavbar').style.display = ''; </script> ";
                            echo "<script> document.getElementById('navbarhosgeldin').style.display = ''; </script> ";
                            echo "<script> document.getElementById('biletnavbar').style.display = ''; </script> ";

                        }




                    }
                    else if ($_SESSION['giris']==false) {
                        echo "<script> document.getElementById('uyenavbar').style.display = ''; </script> ";
                        echo "<script> document.getElementById('girisnavbar').style.display = ''; </script> ";
                        echo "<script> document.getElementById('cikisyapnavbar').style.display = 'none'; </script> ";
                        echo "<script> document.getElementById('navbarhosgeldin').style.display = 'none'; </script> ";

                    }



                }

                ?>

            </ul>



















        </div>
    </div>
</div>
