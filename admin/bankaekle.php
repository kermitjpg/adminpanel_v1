<?php
$sayfa = "Bankalar";
include("inc/ahead.php");


// Yetkisiz kullanıcının girmemesi için yorum satırı kaldırılabilir.

// if ($_SESSION["yetki"] != "1") {
//     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
//     echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
//             if(value.isConfirmed){window.location.href='bankalar.php'}
//         })</script>";
//     exit;
// }

if ($_POST) {
    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;


    if ($_POST["havale_hesap"] != '' && $_POST["havale_ad"] != '' && $_POST["havale_hesap_no"] != '' && $_POST["havale_sube"] != '' && $_POST["havale_iban"] != '') {


        $ekleSorgu = $baglanti->prepare(
            'INSERT INTO bankalar SET havale_hesap=:havale_hesap, havale_ad=:havale_ad, havale_hesap_no=:havale_hesap_no, havale_sube=:havale_sube, havale_iban=:havale_iban, aktif=:aktif'
        );
        $ekle = $ekleSorgu->execute([
            'havale_hesap' => $_POST['havale_hesap'],
            'havale_ad' => $_POST['havale_ad'],
            'havale_hesap_no' => $_POST['havale_hesap_no'],
            'havale_sube' => $_POST['havale_sube'],
            'havale_iban' => $_POST['havale_iban'],
            'aktif' => $aktif
        ]);

        if ($ekle) {
            echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> Swal.fire( {title: 'Başarılı!', text:'Ekleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
            if(value.isConfirmed){window.location.href='bankalar.php'}
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
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Buradan yeni banka ekleyebilirsiniz.</p>
        <div class="row row-cols-1 shadow rounded-end">

            <div class="col bg-primary bg-gradient text-uppercase text-white rounded">
                <h6 class="p-3 pb-2">Bankalar</h6>
            </div>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group mt-2 mb-3">
                    <label>Banka Adı</label>
                    <input type="text" name="havale_hesap" required class="form-control" value="<?= @$_POST["havale_hesap"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Hesap Sahibi</label>
                    <input type="text" name="havale_ad" required class="form-control" value="<?= @$_POST["havale_ad"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Hesap Numarası</label>
                    <input type="text" name="havale_hesap_no" required class="form-control" value="<?= @$_POST["havale_hesap_no"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Şube Kodu</label>
                    <input type="text" name="havale_sube" required class="form-control" value="<?= @$_POST["havale_sube"] ?>">
                </div>

                <div class=" form-group mt-2 mb-3">
                    <label>Iban</label>
                    <input type="text" name="havale_iban" required class="form-control" value="<?= @$_POST["havale_iban"] ?>">
                </div>


                <div class="form-group form-check">
                    <label>
                        <input type="checkbox" name="aktif" class="form-check-input">Aktif mi?
                    </label>
                </div>

                <div class="form-group mt-3 mb-3">
                    <input type="submit" value="Ekle" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

</main>