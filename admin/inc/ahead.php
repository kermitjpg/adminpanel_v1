<?php
session_start();
if (!(isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789")) {
    header("location:login.php");
}

include("../inc/vt.php");
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Yönetim Paneli</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Ara" aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Hesabım <i class="fa-regular fa-pen-to-square"></i></a></li>
                    <li><a class="dropdown-item" href="yoneticiler.php">Ayarlar <i class="fa-solid fa-gear"></i></a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Çıkış <i class="fa-solid fa-power-off"></i></a></li>
                </ul>
            </li>
        </ul>
    </nav>





    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Çıkış yapmak istediğinizden emin misiniz?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <a href="logout.php" class="btn btn-danger">Çıkış</a>
                </div>
            </div>
        </div>
    </div>



    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="sb-sidenav-menu-heading">Ana Sayfa</div>
                        <a class="nav-link <?= $sayfa == "Genel Bilgiler" ? "active" : "" ?>" href="index.php" />
                        <span class="fs-4">
                            <i class="fa-regular fa-user m-2"></i>
                        </span>
                        Genel Bilgiler
                        </a>


                        <div class="sb-sidenav-menu-heading">MENÜ</div>

                        <a class="nav-link <?= $sayfa == "Yöneticiler" ? "active" : "" ?>" href="yoneticiler.php">
                            <span class="fs-4">
                                <i class="fa-solid fa-user-tie m-2"></i>
                            </span>
                            Yöneticiler
                        </a>

                        <a class="nav-link <?= $sayfa == "Genel Ayarlar" ? "active" : "" ?>" href="genelayarlar.php"><span class="fs-4">
                                <i class="fa-solid fa-gear m-2"></i>
                            </span>
                            Genel Ayarlar
                        </a>


                        <a class="nav-link <?= $sayfa == "Hesap Ayarları" ? "active" : "" ?>" href="hesapayarlari.php">
                            <span class="fs-4">
                                <i class="fa-solid fa-piggy-bank m-2"></i>
                            </span>
                            Hesap Ayarları
                        </a>


                        <a class="nav-link <?= $sayfa == "Bankalar" ? "active" : "" ?>" href="bankalar.php">
                            <span class="fs-4">
                                <i class="fa-solid fa-building-columns m-2"></i>
                            </span>
                            Bankalar
                        </a>




                        <!-- EDİT -->
                        <!-- Okundu sayı bilgisi -->
                        <?php
                        $sorguOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE okundu=0");
                        $sorguOkundu->execute();
                        $sonucOkundu = $sorguOkundu->fetch();
                        ?>
                        <!-- Okundu sayı bilgisi -->




                        <a class="nav-link collapsed <?= $sayfa == "Havale" || $sayfa == "Papara" || $sayfa == "PayFix" || $sayfa == "Mefete" || $sayfa == "Kripto" ? "active" : "" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"></div>
                            <span class="fs-3"><i class="fa-solid fa-turkish-lira-sign mt-2"></i></span> &nbsp;&nbsp; Ödemeler
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="havale.php">Havale
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>



                                <!-- EDİT -->
                                <!-- Okundu sayı bilgisi -->
                                <?php
                                $sorguOkundu2 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM papara WHERE okundu=0");
                                $sorguOkundu2->execute();
                                $sonucOkundu2 = $sorguOkundu2->fetch();
                                ?>
                                <!-- Okundu sayı bilgisi -->


                                <a class="nav-link" href="papara.php">Papara
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu2["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>



                                <!-- EDİT -->
                                <!-- Okundu sayı bilgisi -->
                                <?php
                                $sorguOkundu3 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM payfix WHERE okundu=0");
                                $sorguOkundu3->execute();
                                $sonucOkundu3 = $sorguOkundu3->fetch();
                                ?>
                                <!-- Okundu sayı bilgisi -->

                                <a class="nav-link" href="payfix.php">PayFix
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu3["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>



                                <!-- EDİT -->
                                <!-- Okundu sayı bilgisi -->
                                <?php
                                $sorguOkundu4 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM mefete WHERE okundu=0");
                                $sorguOkundu4->execute();
                                $sonucOkundu4 = $sorguOkundu4->fetch();
                                ?>
                                <!-- Okundu sayı bilgisi -->

                                <a class="nav-link" href="mefete.php">Mefete
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu4["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>



                                <!-- EDİT -->
                                <!-- Okundu sayı bilgisi -->
                                <?php
                                $sorguOkundu5 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM kripto WHERE okundu=0");
                                $sorguOkundu5->execute();
                                $sonucOkundu5 = $sorguOkundu5->fetch();
                                ?>
                                <!-- Okundu sayı bilgisi -->

                                <a class="nav-link" href="kripto.php">Kripto
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-warning text-dark"> <?= $sonucOkundu5["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>
                            </nav>
                        </div>






                        <a class="nav-link collapsed <?= $sayfa == "Giriş Yapan Kullanıcılar" || $sayfa == "Kayıt Olan Kullanıcılar" ? "active" : "" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#kullanicilar" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"></div>
                            <span class="fs-4"><i class="fa-solid fa-users mt-2"></i></span> &nbsp; Kullanıcılar
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="kullanicilar" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">



                                <!--                                --><?php
                                                                        //                                $sorguOkundu5 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM girisyapan WHERE okundu=0");
                                                                        //                                $sorguOkundu5->execute();
                                                                        //                                $sonucOkundu5 = $sorguOkundu5->fetch();
                                                                        //                                
                                                                        ?>

                                <!---->
                                <!--                                <a class="nav-link" href="girisyapan.php">Giriş Yapan-->
                                <!--                                        &nbsp;-->
                                <!--                                    <span id="okunmaSayisi" class="badge rounded-pill bg-success text-dark"> --><? //= $sonucOkundu5["sayi"] 
                                                                                                                                                    ?>
                                <!--</span>-->
                                <!--                                </a>-->





                                <!-- EDİT -->
                                <!-- Okundu sayı bilgisi -->
                                <?php
                                $sorguOkundu6 = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM kayitolan WHERE okundu=0");
                                $sorguOkundu6->execute();
                                $sonucOkundu6 = $sorguOkundu6->fetch();
                                ?>
                                <!-- Okundu sayı bilgisi -->


                                <a class="nav-link" href="kayitolan.php">Kayıt Olan
                                    <!-- Okundu sayı bilgisi -->
                                    &nbsp;
                                    <span id="okunmaSayisi" class="badge rounded-pill bg-success text-dark"> <?= $sonucOkundu6["sayi"] ?></span>
                                    <!-- Okundu sayı bilgisi -->
                                </a>
                            </nav>
                        </div>




                        <a class="nav-link <?= $sayfa == "Yatırım Limitleri" ? "active" : "" ?>" href="yatirimlimitleri.php">
                            <span class="fs-4">
                                <i class="fa-solid fa-wallet m-2 mt-3"></i>
                            </span>
                            Yatırım Limitleri
                        </a>


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Kullanıcı:</div>
                    <?= $_SESSION["kadi"] ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

</html>


<!-- Kasa tutarları sorguları burada yazıldı ve ekrana yazdırmak için index.php'de tumToplam değişkenini kullanarak ekrana yazdırdık. -->
<?php

$havaleKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM havale WHERE aktif=1");
$havaleKasa->execute();
$havaleTopla = $havaleKasa->fetch();

$paparaKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM papara WHERE aktif=1");
$paparaKasa->execute();
$paparaTopla = $paparaKasa->fetch();

$payfixKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM payfix WHERE aktif=1");
$payfixKasa->execute();
$payfixTopla = $payfixKasa->fetch();

$mefeteKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM mefete WHERE aktif=1");
$mefeteKasa->execute();
$mefeteTopla = $mefeteKasa->fetch();

$kriptoKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM kripto WHERE aktif=1");
$kriptoKasa->execute();
$kriptoTopla = $kriptoKasa->fetch();

$havaleToplam = $havaleTopla["tutar"];
$paparaToplam = $paparaTopla["tutar"];
$payfixToplam = $payfixTopla["tutar"];
$mefeteToplam = $mefeteTopla["tutar"];
$kriptoToplam = $kriptoTopla["tutar"];
$tumToplam = $havaleToplam + $paparaToplam + $payfixToplam + $mefeteToplam + $kriptoToplam;
?>
<!-- Kasa tutarları sorguları burada yazıldı ve ekrana yazdırmak için index.php'de tumToplam değişkenini kullanarak ekrana yazdırdık. -->
<!-- Değişken tanımladık ve havale, papara, payfix, kripto toplamlarını çektik. Daha sonra oluşturduğumuz bu değişkenleri tek bir değişkenin içerisinde toplayarak tumToplam değişkenini kullanarak index.php'de ekrana yazdırdık. -->
<!-- havaletoplam eşittir ahead.php'den gelen tutara. -->
<!-- payfixtoplam eşittir ahead.php'den gelen tutara. -->
<!-- payfixtoplam eşittir ahead.php'den gelen tutara. -->
<!-- kriptotoplam eşittir ahead.php'den gelen tutara. -->
<!-- tumtoplam eşittir havaletoplam+paparatoplam+payfixtoplam+kriptotoplam, tumtoplam değişkenini kullanarak index.php'de ekrana yazdır. -->