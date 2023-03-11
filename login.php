<?php
$sayfa = "Kullanıcı Girişi";
include("inc/vt.php");


$sorgu2 = $baglanti->prepare("select * from anasayfa");
$sorgu2->execute();
$sonuc2 = $sorgu2->fetch();
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>


<body>


<main>
    <div class="container">
        <div class="col">
            <div class="card-header mt-5">
                <h3 class="text-center">Kullanıcı Giriş</h3>
            </div>

            <div class="card-body">


                <?php
                session_start();
                include("inc/vt.php");


                if (isset($_SESSION["kullanici"]) && $_SESSION["kullanici"] == "1234") {
                    header("location:index.php");
                } elseif (isset($_COOKIE["cerez"])) {


                    $sorgu = $baglanti->prepare("select kadi, parola from kayitolan WHERE aktif=1");
                    $sorgu->execute();
                    while ($sonuc = $sorgu->fetch()) {
                        if ($_COOKIE["cerez"] == md5("aa" . $sonuc["kadi"] . "bb")) {

                            $_SESSION["kullanici"] = "1234";
                            $_SESSION["kadi"] = $sonuc["kadi"];
                            $_SESSION["parola"] = $sonuc["parola"];



                            header("location:index.php");
                        }
                    }
                }


                if ($_POST) {
                    $kadi = $_POST["txtKadi"];
                    $parola = $_POST["txtParola"];
                }

                ?>


                <form method="POST" action="login.php" class="mt-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="txtKadi" class="form-control"
                               id="floatingInput" required
                               placeholder="name@example.com">
                        <label for="floatingInput">Kullanıcı Adı</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="password" name="txtParola"
                               class="form-control" id="floatingPassword"
                               required placeholder="Password">
                        <label for="floatingPassword">Şifre</label>
                    </div>


                    <div class="form-check mb-3">
                        <input class="form-check-input"
                               id="inputRememberPassword" type="checkbox"
                               name="cbHatirla" value=""/>
                        <label class="form-check-label"
                               for="inputRememberPassword">Beni Hatırla</label>
                    </div>


                    <div class="d-flex align-items-center justify-content-center mt-4 mb-3">
                        <input type="submit" class="btn text-white w-75"
                               value="Giriş"
                               style="background-color: #3c44b1; border-color: #3c44b1;"></input>
                    </div>
                </form>


                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


                <?php



                if ($_POST) {
                    $sorgu = $baglanti->prepare("select parola from kayitolan WHERE kadi=:kadi and aktif=1");
                    $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                    $sonuc = $sorgu->fetch();
                    if ($parola == $sonuc["parola"]) {


                        $_SESSION["kullanici"] = "1234";
                        $_SESSION["kadi"] = $kadi;



                        if (isset($_POST["cbHatirla"])) {
                            setcookie("cerez", md5("aa" . $kadi . "bb"), time() + (60 * 60 * 24 * 7));
                        }


                        header("location:index.php");
                    } else {
                        echo "<script> Swal.fire({
                            title: 'Hata!',
                            text: 'Kullanıcı adı veya şifre hatalı!',
                            icon: 'error',
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: '#000',
                        })</script>";
                    }
                }

                ?>


            </div>
        </div>
    </div>
</main>


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


</body>

</html>