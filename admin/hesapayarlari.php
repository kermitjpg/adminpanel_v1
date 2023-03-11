<?php
$sayfa = "Hesap Ayarları";
include("inc/ahead.php");
$sorgu3 = $baglanti->prepare("select * from hesapayarlari");
$sorgu3->execute();
$sonuc3 = $sorgu3->fetch();
?>


<main>
    <div class="container-fluid px-5 py-4 mt-1 mb-5">
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Hesap ayarlarını buradan düzenleyebilirsiniz.</p>
        <div class="row row-cols-1 shadow rounded-end">
            <div class="col bg-primary bg-gradient text-uppercase text-white rounded">
                <h6 class="p-3 pb-2">Hesap Ayarları</h6>
            </div>

            <form action="" method="post" id="form">
                <div class="row g-3 mt-3 mb-3">
                    <div class="col-sm-6">
                        <label for="formGroupExampleInput" class="form-label">Papara Hesap Sahibi</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" required placeholder="Hesap Sahibi" aria-label="First name" value="<?= $sonuc3["papara_hesap"] ?>" name="papara_hesap">
                    </div>

                    <div class="col-sm-6 mb-2">
                        <label for="formGroupExampleInput2" class="form-label">Papara Hesap Numarası</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" required placeholder="Papara Hesap Numarası" aria-label="Last name" value="<?= $sonuc3["papara_no"] ?>" name="papara_no">
                    </div>



                    <div class="col-sm-6">
                        <label for="formGroupExampleInput3" class="form-label">PayFix Hesap Sahibi</label>
                        <input type="text" class="form-control" id="formGroupExampleInput3" required placeholder="Hesap Sahibi" aria-label="First name" value="<?= $sonuc3["payfix_hesap"] ?>" name="payfix_hesap">
                    </div>

                    <div class="col-sm-6 mb-2">
                        <label for="formGroupExampleInput4" class="form-label">PayFix Hesap Numarası</label>
                        <input type="text" class="form-control" id="formGroupExampleInput4" required placeholder="PayFix Hesap Numarası" aria-label="Last name" value="<?= $sonuc3["payfix_no"] ?>" name="payfix_no">
                    </div>



                    <div class="col-sm-6">
                        <label for="formGroupExampleInput5" class="form-label">Kripto Kodu</label>
                        <input type="text" class="form-control" id="formGroupExampleInput5" required placeholder="Kripto Kodu" aria-label="First name" value="<?= $sonuc3["kripto_no"] ?>" name="kripto_no">
                    </div>

                    <div class="col-sm-6 mb-2">
                        <label for="formGroupExampleInput6" class="form-label">Kripto QR</label>
                        <input type="text" class="form-control" id="formGroupExampleInput6" placeholder="QR Kodu" aria-label="Last name">
                    </div>


                    <hr class="mt-3">



                </div>

                <button class="btn btn-primary mb-3 w-100" type="button" id="btnGonder2" onclick="save();">Kaydet</button>
                <!-- <input class="btn btn-primary mb-3 w-100" type="submit" value="Kaydet"> -->
            </form>
        </div>
    </div>
</main>



<?php
include("inc/afooter.php");
?>
<script type="text/javascript">
    function save() {
        $.ajax({
            type: 'POST',
            url: 'hesapayarlari.php',
            data: $('#form').serialize(),
            success: function(e) {

                Swal.fire({
                    title: 'Harika!',
                    text: 'Güncelleme başarılı!',
                    icon: 'success',
                    confirmButtonText: 'Tamam',
                    confirmButtonColor: "#000",

                }).then((result) => {
                    window.location.reload();
                })

            }
        })
    };
</script>

<?php
if ($_POST) { ///veri güncelle

    $guncelleSorgu = $baglanti->prepare("Update hesapayarlari set papara_hesap=:papara_hesap, papara_no=:papara_no, payfix_hesap=:payfix_hesap, payfix_no=:payfix_no, kripto_no=:kripto_no");
    $guncelle = $guncelleSorgu->execute([
        'papara_hesap' => $_POST["papara_hesap"],
        'papara_no' => $_POST["papara_no"],
        'payfix_hesap' => $_POST["payfix_hesap"],
        'payfix_no' => $_POST["payfix_no"],
        'kripto_no' => $_POST["kripto_no"],
    ]);

    // if ($guncelle) {
    //     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    //     echo "<script> Swal.fire( {title: 'Başarılı!', text:'Güncelleme başarılı!', icon:'success', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
    //         if(value.isConfirmed){window.location.href='hesapayarlari.php'}
    //     })</script>";
    // }
}
?>