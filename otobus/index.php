<?php
ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="css/datepicker.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <link rel="stylesheet" href="css\home2.css">
    <link rel="stylesheet" href="css\biletal.css">
    <link rel="stylesheet" href="css\admin_paneli.css">
    <link rel="stylesheet" href="css\uyeol.css">
    <link rel="stylesheet" href="css\giris.css">

    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/datepicker.min.js" ></script>
    <script src="js/i18n/datepicker.en.js" ></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>


    <title>BiletAl.com</title>
</head>
<body>

<?php
if (!isset($_SESSION))
{
    session_start();
}
require_once("baglan.php");
require_once ("functions.php");
require_once('giris.php');
require_once ('navbar.php');

$page = 'anasayfa';
if (isset($_GET["page"])) $page = $_GET["page"];

switch ($page) {
    case 'anasayfa':
    case 'seferler':
    case 'admin_paneli':
    case 'bilet-al':
    case 'uyeol':
    case 'sifreunuttum':
    case 'bilgilerim':
    case 'deneme':
    case 'biletlerim':
        break;
    default:
        $page = "anasayfa";
}

if (isset($_SESSION['yetki']))
{

    if ($_SESSION['yetki']==1)
    {
        if ($page=="admin_paneli") {$page="admin_paneli";}
        else if ($page=="bilgilerim") {$page="bilgilerim";}
        else
        {
            $page="admin_paneli";
        }
    }
    else
    {
        if ($page=="admin_paneli")
        {
            $page="anasayfa";
        }
    }
}

?>

<div class="content-wrapper <?php echo $page === "anasayfa" ? 'bg-wrapper' : ''?>">
    <div id="container" class="container">
    <?php include ($page . ".php")?>
    </div>
</div>



<?php include ('footer.php'); ?>

<script>
    $(document).ready(function() {
        $('.datepicker-here').each(function (index, object) {
            var value = object.value
            var datePicker = $(object).datepicker({
                language: 'tr',
                dateFormat:'dd-mm-yyyy',
                minDate: new Date() // Now can select only dates, which goes after today,
            }).data('datepicker')
            if (value) {
                datePicker.selectDate(new Date(value))
            }
        })
        $('.datepicker-uye').datepicker
        ({
            maxDate:new Date(),
            dateFormat: 'dd-mm-yyyy'

        })
    })
    $.fn.datepicker.language['tr'] = {
        days: ['Pazartesi', 'Salı', 'Carsamba', 'Persembe', 'Cuma', 'Cumartesi', 'Pazar'],
        daysShort: ['pzr', 'sal', 'car', 'per', 'cum', 'cmr', 'paz'],
        daysMin: ['pz', 'sa', 'ca', 'pe', 'cu', 'cm', 'pa'],
        months: ['Ocak','Subat','Mart','Nisan','Mayıs','Haziran', 'Temmuz','Agustos','Eylül','Ekim','Kasım','Aralık'],
        monthsShort: ['Ock', 'Sub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Agu', 'Eyl', 'Eki', 'Kas', 'Ara'],
        today: 'Bugün',
        clear: 'Temiz',
        dateFormat: 'dd-mm-yyyy',
        timeFormat: 'hh:ii aa',
        firstDay: 0
    };




    $('#radio-gidis').click(function () {

        $('#gidis-donus').slideUp('medium');

    })
    $('#radio-gidis-donus').click(function () {

        $('#gidis-donus').slideDown('medium');

    })



    $('.menu-icon').click(function () {
        var menuDom = $('#navbar')

        if (menuDom.hasClass('menu-show')) {
            menuDom.removeClass('menu-show')
        } else {
            menuDom.addClass('menu-show')
        }

    })



    function isNumberKey(evt) /*tc kimlik sadece sayı girme*/
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    var nereden=document.getElementById('nereden');
    var nereye=document.getElementById('nereye');
    function sehirDegistir() {
        var gecici=nereden.value;
        nereden.value=nereye.value;
        nereye.value=gecici;

    }













    /*koltuk secme  için*/




</script>
</body>
</html>