<?php
include("inc/vt.php");
$ip = $_SERVER["REMOTE_ADDR"];
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <title>Üye Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>

<main>
    <div class="container">
        <div class="col">
            <div class="card-header mt-5">
                <h3 class="text-center">Üye Ol</h3>
            </div>

            <div class="card-body">


                <form method="POST" action="register.php" class="mt-5">
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

                    <div class="form-floating mb-3">
                        <input type="password" name="pTekrar"
                               class="form-control" id="pTekrar" required
                               placeholder="Password">
                        <label for="pTekrar">Şifre Tekrar</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" name="txtAdsoyad"
                               class="form-control" id="floatingAd" required
                               placeholder="Ad Soyad">
                        <label for="floatingAd">Ad Soyad</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="email" name="txtEmail" class="form-control"
                               id="floatingEmail" required placeholder="Email">
                        <label for="floatingEmail">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="txtTel_no" class="form-control"
                               id="floatingTel_no" required
                               placeholder="Telefon Numarası">
                        <label for="floatingTel_no">Telefon Numarası</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" name="txtTc_no" class="form-control"
                               id="floatingTc_no" required
                               placeholder="Telefon Numarası">
                        <label for="floatingTc_no">TC Kimlik No</label>
                    </div>

                    <input type="hidden" name="ipAdres" value="<?= $ip ?>">
                    
                    
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-3">
                        <input type="submit" class="btn text-white w-75"
                               value="Üye Ol"
                               style="background-color: #3c44b1; border-color: #3c44b1;"></input>
                    </div>
                </form>





                <?php
                if ($_POST) {

                    if ($_POST["txtKadi"] != '' && $_POST["txtParola"] != '' && $_POST["txtParola"] == $_POST["pTekrar"] && $_POST["txtAdsoyad"] !='' && $_POST["txtEmail"] != '' && $_POST["txtTel_no"] != '' && $_POST["txtTc_no"] != '' && $_POST["ipAdres"] != '') {

                        $sorgu = $baglanti->prepare("INSERT INTO kayitolan SET kadi=:kadi, parola=:parola, ad_soyad=:ad_soyad, email=:email, tel_no=:tel_no, tc_no=:tc_no, ip=:ip");
                        $ekle = $sorgu->execute(
                            [
                                'kadi' => htmlspecialchars($_POST["txtKadi"]),
                                'parola' => htmlspecialchars($_POST["txtParola"]),
                                'ad_soyad' => htmlspecialchars($_POST["txtAdsoyad"]),
                                'email' => htmlspecialchars($_POST["txtEmail"]),
                                'tel_no' => htmlspecialchars($_POST["txtTel_no"]),
                                'tc_no' => htmlspecialchars($_POST["txtTc_no"]),
                                'ip' => htmlspecialchars($_POST["ipAdres"]),
                                
                            ]
                        );

                        if ($ekle) {
                            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Üyelik oluşturuldu, giriş yapabilirsiniz.', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='login.php'}
        })</script>";
                        }
                    } else {
                        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                        echo "<script> Swal.fire( {title: 'Hata!', text:'Bilgileri eksiksiz ve doğru girdiğinizden emin olun.', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='login.php'}
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
