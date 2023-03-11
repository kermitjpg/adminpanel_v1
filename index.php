<?php
$sayfa = "Anasayfa";
include("inc/vt.php");
include("admin/inc/ayar.php"); // Ziyaretçi sayacını buradan sayacağımız için buraya dahil ettik.
include("admin/inc/fonksiyon.php"); // Ziyaretçi sayacını buradan sayacağımız için buraya dahil ettik.
sayac_ayar(); // fonksiyonu çağırdık.
session_start();


$sorgu = $baglanti->prepare("select * from anasayfa");
$sorgu->execute();
$sonuc = $sorgu->fetch();
$tanimlama = $sonuc["tanimlama"];
$anahtar = $sonuc["anahtar"];


$sorgu2 = $baglanti->prepare("select * from anasayfa");
$sorgu2->execute();
$sonuc2 = $sorgu2->fetch();
$baslik = $sonuc2["baslik"];


$sorgu3 = $baglanti->prepare("select * from hesapayarlari");
$sorgu3->execute();
$sonuc3 = $sorgu3->fetch();

$sorgu4 = $baglanti->prepare("select * from yatirimlimitleri");
$sorgu4->execute();
$sonuc4 = $sorgu4->fetch();


include("inc/head.php");


?>


<body>

<div class="container">
    <div class="row">
        <div class="col">
            <input type="text" name="" readonly
                   value="<?= $sonuc3["papara_hesap"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc3["papara_no"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc3["payfix_hesap"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc3["payfix_no"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc3["kripto_no"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc4["papara_minimum"] ?>"/>
            <input type="text" name="" readonly
                   value="<?= $sonuc4["papara_maksimum"] ?>"/>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/c5eff4ee4b.js"
        crossorigin="anonymous"></script>


<!--Canlı destek eklemek için bu kodlar kullanıldı-->
<?=
$sonuc2["tawk"];
// 	$canli = $sonuc2["tawk"];
// 	echo $canli;
?>




<?php

 if ($_SESSION['kullanici']!='') {
    $kadi = $_SESSION['kadi'];
    $islemSorgu = $baglanti->query("SELECT * FROM kayitolan WHERE kadi='" . $kadi . "'");
    $islemCek = $islemSorgu->fetch(PDO::FETCH_ASSOC);


    $bakiyecek = $islemCek['bakiye'];
    $sifrecek = $islemCek['parola'];

}

?>

<p> Bakiye: <?= $bakiyecek ?> </p>
<p> Şifreniz: <?= $sifrecek ?> </p>
<p> Kullanıcı Adınız: <?= $_SESSION["kadi"]?></p>


</body>

</html>