<?php
$sayfa = "Yöneticiler";
include("inc/ahead.php");


if ($_SESSION["yetki"] != "1") {
    echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='index.php'}
        })</script>";
    exit;
}


$sorgu = $baglanti->prepare("select * from yoneticiler where id=:id");
$sorgu->execute(['id' => $_GET['id']]);
$sonuc = $sorgu->fetch();


if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["kadi"] != '' && $_POST["parola"] != '' && $_POST["parola"] == $_POST["pTekrar"] && $_POST["email"] != '' && $_POST["yetki"] != '') {

        $guncelleSorgu = $baglanti->prepare('UPDATE yoneticiler SET kadi=:kadi, parola=:parola, email=:email, yetki=:yetki, aktif=:aktif WHERE id=:id');
        $guncelle = $guncelleSorgu->execute([
            'kadi' => $_POST['kadi'],
            'parola' => $_POST['parola'],
            'email' => $_POST['email'],
            'yetki' => $_POST['yetki'],
            'aktif' => $aktif,
            'id' => $_GET['id'],
        ]);

        if ($guncelle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='yoneticiler.php'}
        })</script>";
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'Bir hata oluştu!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    }
}



?>

<main>
    <div class="container-fluid px-5 py-4 mt-1 mb-5" style="">
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Yöneticilerin bilgilerini buradan düzenleyebilirsiniz.</p>
        <div class="row row-cols-1 shadow rounded-end">

            <div class="col bg-primary bg-gradient text-uppercase text-white rounded">
                <h6 class="p-3 pb-2">Yöneticiler</h6>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group mt-2 mb-3">
                    <label>Kullanıcı Adı</label>
                    <input type="text" name="kadi" required class="form-control" value="<?= $sonuc["kadi"] ?>">
                </div>


                <div class=" form-group mt-2 mb-3">
                    <label>Parola</label>
                    <input type="text" name="parola" class="form-control" value="<?= $sonuc["parola"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Parola Tekrar</label>
                    <input type="text" name="pTekrar" class="form-control" value="<?= $sonuc["parola"] ?>">
                </div>



                <div class=" form-group mt-2 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $sonuc["email"] ?>">
                </div>


                <div class="form-group my-3">
                    <label>Yetki</label> <br>
                    <label> <input type="radio" name="yetki" value="1" <?= $sonuc['yetki'] == '1' ? 'checked' : '' ?>>Admin</label><br>
                    <label><input type="radio" name="yetki" value="2" <?= $sonuc['yetki'] == '2' ? 'checked' : '' ?>>Normal Kullanıcı</label>

                </div>

                <div class="form-group my-3">
                    <input type="submit" value="Güncelle" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</main>


<?php
include("inc/afooter.php")
?>