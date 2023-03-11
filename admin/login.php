<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="bg-dark" style="font-family: 'Poppins', sans-serif; background: url(assets/img/login-background.jpg) no-repeat; background-size: cover; background-position: center; min-height: 100vh;">

    <main>
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-5 mt-5 mb-5 py-5">

                    <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5 bg-light">
                        <div class="card-header">

                            <h3 class="text-center font-weight-light my-4">Admin Giriş</h3>
                        </div>
                        <div class="card-body">

                            <?php
                            session_start();
                            include("../inc/vt.php");

                            if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
                                header("location:index.php");
                            } elseif (isset($_COOKIE["cerez"])) {

                                $sorgu = $baglanti->prepare("select kadi, yetki from yoneticiler WHERE aktif=1");
                                $sorgu->execute();
                                while ($sonuc = $sorgu->fetch()) {
                                    if ($_COOKIE["cerez"] == md5("aa" . $sonuc["kadi"] . "bb")) {

                                        $_SESSION["Oturum"] = "6789";
                                        $_SESSION["kadi"] = $sonuc["kadi"];
                                        $_SESSION["yetki"] = $sonuc["yetki"];



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
                                    <input type="text" name="txtKadi" class="form-control" id="floatingInput" required placeholder="name@example.com">
                                    <label for="floatingInput">Kullanıcı Adı</label>
                                </div>


                                <div class="form-floating mb-3">
                                    <input type="password" name="txtParola" class="form-control" id="floatingPassword" required placeholder="Password">
                                    <label for="floatingPassword">Şifre</label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="cbHatirla" value="" />
                                    <label class="form-check-label" for="inputRememberPassword">Beni Hatırla</label>
                                </div>


                                <div class="d-flex align-items-center justify-content-center mt-4 mb-3">
                                    <input type="submit" class="btn text-white w-75" value="Giriş" style="background-color: #3c44b1; border-color: #3c44b1;"></input>
                                </div>
                            </form>



                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



                            <?php





                            if ($_POST) {
                                $sorgu = $baglanti->prepare("select parola, yetki from yoneticiler WHERE kadi=:kadi and aktif=1");
                                $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                $sonuc = $sorgu->fetch();
                               
                                // if (md5("56" . $parola . "23") == $sonuc["parola"]) {  ---- kodunu yerleştirebilirsiniz.
                                    // Bu kod md5 formatında gireceğiniz parolanın başına 56, sonuna 23 ekleyecektir.
                                    // Parolayı almak için; echo md5("56" . "parolanızıgiriniz" . "23"); ---- yazabilirsiniz

                                     // parolanın şifreli (md5) olmasını isterseniz aşağıdaki kodu silip yerine yukarıdaki kodu kullanabilirsiniz.
                                if ($parola == $sonuc["parola"]) {

                                    $_SESSION["Oturum"] = "6789";
                                    $_SESSION["kadi"] = $kadi;
                                    $_SESSION["yetki"] = $sonuc["yetki"];

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
                        <div class="card-footer text-center py-3">
                            <div class="small">Copyright © Kermitjpg 2023</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/c5eff4ee4b.js" crossorigin="anonymous"></script>
</body>

</html>