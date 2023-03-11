<?php
$sayfa = "Kayıt Olan Kullanıcılar";
include("inc/ahead.php");



$sorgu = $baglanti->prepare("select * from kayitolan where id=:id");
$sorgu->execute(['id' => $_GET['id']]);
$sonuc = $sorgu->fetch();


if (@$_POST) {

    if (@$_POST["kadi"] != '' && @$_POST["parola"] != '' && @$_POST["ad_soyad"] != '' && @$_POST["email"] != '' && @$_POST["tel_no"] != '' && @$_POST["tc_no"] != '') {

        $ekleSorgu = $baglanti->prepare('UPDATE kayitolan SET kadi=:kadi, parola=:parola, ad_soyad=:ad_soyad, email=:email, tel_no=:tel_no, tc_no=:tc_no, bakiye=:bakiye WHERE id=:id');
        $ekle = $ekleSorgu->execute([
            'kadi' => @$_POST['kadi'],
            'parola' => @$_POST['parola'],
            'ad_soyad' => @$_POST['ad_soyad'],
            'email' => @$_POST['email'],
            'tel_no' => @$_POST['tel_no'],
            'tc_no' => @$_POST['tc_no'],
            'bakiye' => @$_POST['bakiye'],
            'id' => $_GET['id'],
        ]);




        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='kayitolan.php'}
        })</script>";
        } else {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Hata!', text:'Bir hata oluştu!', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', })</script>";
        }
    }
}



?>

<main>
    <div class="container-fluid px-5 py-4 mt-1 mb-5">
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Kayıt olan kullanıcıların bilgilerini buradan düzenleyebilirsiniz.</p>
        <div class="row row-cols-1 shadow rounded-end">

            <div class="col bg-primary bg-gradient text-uppercase text-white rounded">
                <h6 class="p-3 pb-2">Yeni Kullanıcılar</h6>
            </div>

            <form action="" method="post" enctype="multipart/form-data">


                <div class="form-group mt-2 mb-3">
                    <label>Kullanıcı Adı</label>
                    <input type="text" name="kadi" required class="form-control" value="<?= $sonuc["kadi"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Şifre</label>
                    <input type="text" name="parola" required class="form-control" value="<?= $sonuc["parola"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Ad Soyad</label>
                    <input type="text" name="ad_soyad" required class="form-control" value="<?= $sonuc["ad_soyad"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Email</label>
                    <input type="text" name="email" required class="form-control" value="<?= $sonuc["email"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Telefon Numarası</label>
                    <input type="text" name="tel_no" required class="form-control" value="<?= $sonuc["tel_no"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>TC Kimlik Numarası</label>
                    <input type="text" name="tc_no" required class="form-control" value="<?= $sonuc["tc_no"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Bakiye</label>
                    <input type="text" name="bakiye" required class="form-control" value="<?= $sonuc["bakiye"] ?>">
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